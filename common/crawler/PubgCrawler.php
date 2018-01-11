<?php
namespace common\crawler;

error_reporting(ERROR_ALL);

use Symfony\Component\DomCrawler\Crawler;

use common\models\PubgCompre;
use common\models\PubgMatch;
use common\helper\NumberHelper;

class PubgCrawler extends CrawlerBase implements CrawlerInterface {

    private $_baseUrl = 'https://pubg.op.gg/user/';
    private $_baseApiUrl = 'https://pubg.op.gg/api/';

    public function make($name) {

        $time = time(); // 抓取时间

        $name = trim($name);

        $content = $this->getContent($this->buildUrl($name));

        if(empty($content))
        {
            throw new CrawlerException(CrawlerException::CRAWLER_NOT_FOUND_CONTENT, "$name");
        }

        $account = PubgCompre::find()->where(['name' => $name])->limit(1)->one();

        if(empty($account))
        {
            $account = new PubgCompre();
            $account->name = $name;
            $account->created_at = $time;
        }

        $crawler = new Crawler($content);

        $compreData = $this->getCompre($crawler);

        $account->setAttributes($compreData, false);
        $account->updated_at = $time;

        $account->save();

        $matches = $this->getMatches($account, $crawler);

        foreach($matches ?: [] as $index => $match)
        {
            /* 存在既更新 不存在即插入 */
            $pubgMatch = PubgMatch::find()->where(['number' => $index + 1, 'uid' => $account->id])->limit(1)->one();
            if(empty($pubgMatch))
            {
                $pubgMatch = new PubgMatch();
                $pubgMatch->uid = $account->id;
                $pubgMatch->number = $index + 1;
                $pubgMatch->created_at = $time;
            }
            $pubgMatch->setAttributes($match, false);
            $pubgMatch->updated_at = $time;

            $pubgMatch->save();
        }

        return $account;

    }

    private function getMatches($account, $crawler) {

        $data = [];

        // 前五场比赛
        $matchList = $crawler->filter('ul[data-selector=total-played-game-list] li[data-selector=total-played-game-item]')->slice(0, 5);

        // 比赛基本信息
        $matchList->each(function($match, $index) use(&$data, $crawler, $account) {
            $matchData = [];

            $matchData['match_time'] = NumberHelper::secToTime(round(trim($match->filter('div.matches-item__time-value')->first()->attr('data-game-length'))));
            $matchData['match_date'] = strtotime(trim($match->filter('div.matches-item__reload-time')->first()->attr('data-ago-date')));
            $matchData['match_type'] = trim($match->filter('div.matches-item__mode .sp__mode')->first()->text());
            $matchData['match_rank'] = trim($match->filter('div.matches-item__ranking')->first()->text());
            $matchData['match_hurt'] = trim($match->filter('div.matches-item__column--damage .matches-item__value')->first()->text());
            $matchData['match_kill'] = trim($match->filter('div.matches-item__column--kill .matches-item__value')->first()->text());


            $statistics = $match->filter('div.matches-detail__item-inner')->each(function($node, $i){
                return trim($node->filter('div.matches-detail__value')->first()->text());
            });

            $matchData['match_headshot'] = $statistics[1][3];
            $matchData['match_healthy_num'] = $statistics[7][0];
            $matchData['match_strong_num'] = $statistics[7][4];
            $matchData['match_assistant_num'] = $statistics[2];
            $matchData['match_down_num'] = $statistics[3];
            $matchData['match_walk_distance'] = preg_split("/\W+/", $statistics[5])[0];
            $matchData['match_travel_distance'] = preg_split("/\W+/", $statistics[6])[0];
            $matchData['match_by_help_num'] = $statistics[8];
            $matchData['match_move_distance'] = preg_split("/\W+/", $statistics[4])[0];

            $matchKey = trim($match->filter('div[data-selector=played-game-ranking]')->first()->attr('data-u-id'));

            $deathContent = $this->getContent($this->matchDeathsUrl($matchKey));
            $deathContent = \GuzzleHttp\json_decode($deathContent, true);

            // 寻找他击杀的人 以及击杀他的人 记录：时间 人 武器 /* 距离 暂时没有*/
            $match_kill_list = [];
            $match_be_kill_list = [];
            foreach($deathContent['deaths'] ?:[] as $death)
            {
                // 查找 killer 的 user name 为自己的， 记录被杀者信息，为击杀的人
                if(!empty($death['killer']) && $account->name == $death['killer']['user']['nickname'])
                {
                    $match_kill_list[] = [
                        'time' => NumberHelper::secToTime($death['time_event']),
                        'name' => $death['victim']['user']['nickname'],
                        'description' => $death['description'],
                    ];
                }
                // 查找 victim 的 user name 为自己的， 记录杀者信息，为被击杀的人
                elseif (!empty($death['victim']) && $account->name == $death['victim']['user']['nickname'])
                {
                    $match_be_kill_list[] = [
                        'time' => NumberHelper::secToTime($death['time_event']),
                        'name' => empty($death['killer']) ? '' : $death['killer']['user']['nickname'],
                        'description' => $death['description'],
                    ];
                }
            }

            $matchData['match_kill_list'] = json_encode($match_kill_list);
            $matchData['match_be_kill_list'] = json_encode($match_be_kill_list);
            $matchData['match_kd'] = NumberHelper::division(count($match_kill_list), count($match_be_kill_list) ?: 1, 1);

            $data[] = $matchData;
        });

        return $data;

    }

    private function getCompre($crawler) {

        $data = [];

        // 服务器名字 .game-server__item--on .sp__server
        $data['serverName'] = trim($crawler->filter('.game-server__item--on .sp__server')->first()->text());
        $data['server'] = trim(str_replace('https://pubg.op.gg/user/beckerr?server=', '', trim($crawler->filter('.game-server__item--on a[data-selector=ch-server]')->first()->attr('href'))));
        // 场数 .game-server__item--on .game-server__play-count
        list($data['total_num'], ) = preg_split("/\W+/", trim($crawler->filter('.game-server__item--on .game-server__play-count')->first()->text()));
        $data['user_id'] = trim($crawler->filter('#userNickname')->first()->attr('data-user_id'));

        // 获取赛季单排 双排 四排数据
        $typeArray = [
            1 => 'single',
            2 => 'double',
            4 => 'four'
        ];

        foreach($typeArray as $size => $prefix)
        {
            $apiUrl = $this->rankUrl($data['user_id'], $data['server'], $size);
            $rankData = $this->getContent($apiUrl);
            if(empty($rankData))
            {
                throw new CrawlerException(CrawlerException::CRAWLER_NOT_FOUND_RANK, "$apiUrl");
            }
            $rankData = \GuzzleHttp\json_decode($rankData, true);

            $data[$prefix . '_score'] = $rankData['stats']['rating'];
            $data[$prefix . '_num'] = $rankData['stats']['matches_cnt'];
            $data[$prefix . '_win_rate'] = NumberHelper::percent($rankData['stats']['win_matches_cnt'], $rankData['stats']['matches_cnt']);
            $data[$prefix . '_top10_rate'] = NumberHelper::percent($rankData['stats']['topten_matches_cnt'], $rankData['stats']['matches_cnt']);
            $data[$prefix . '_avg_rank'] = round($rankData['stats']['rank_avg'], 1);
            $data[$prefix . '_kd'] = NumberHelper::division($rankData['stats']['kills_sum'], $rankData['stats']['deaths_sum'] ?: 1, 2);
            $data[$prefix . '_headshot_rate'] = NumberHelper::percent($rankData['stats']['headshot_kills_sum'], $rankData['stats']['kills_sum']);
            $data[$prefix . '_avg_hurt'] = round($rankData['stats']['damage_dealt_avg']);
            $data[$prefix . '_kda'] = NumberHelper::division($rankData['stats']['headshot_kills_sum'] + $rankData['stats']['assists_sum'], $rankData['stats']['deaths_sum'] ?: 1);
            $data[$prefix . '_max_kill'] = $rankData['stats']['kills_max'];
            $data[$prefix . '_avg_lifetime'] = NumberHelper::secToTime(round($rankData['stats']['time_survived_avg']));
        }

        return $data;

    }

    private function matchDeathsUrl($matchKey)
    {
        // https://pubg.op.gg/api/matches/2U4GBNA0YmnlivLidr6LNa3HHEkbQGGKZAcK21VxvSaxY08A3gnQI1h2mo1ZzK_A/deaths
        return $this->_baseApiUrl . "matches/$matchKey/deaths";
    }

    private function buildUrl($name) {
        return $this->_baseUrl . $name;
    }

    private function rankUrl($user_id, $server, $size)
    {
        $season = date('Y-m');
        return $this->_baseApiUrl . "users/$user_id/ranked-stats?season=$season&server=$server&queue_size=$size&mode=tpp";
    }

}

?>