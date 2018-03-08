<?php
namespace common\crawler;

error_reporting(0);

use common\helper\NumberHelper;
use yii\web\NotFoundHttpException;

class LolCrawler extends CrawlerBase implements CrawlerInterface {

    private $_baseUrl = 'http://api.lolbox.duowan.com/api/v3/player/';

    public function make($name) {


    }

    // 如果捞月狗没战绩 －》参数：用户名，大区
    // 搜索多玩 获得 对应的玩家
    // 组装详情页数据
    public function search($name, $area)
    {
        $account = [];

        $search = $this->searchUser($name);
        $searchUser = null;
        foreach($search['player_list'] ?: [] as $user)
        {
            if($user['game_zone']['alias'] === trim($area))
            {
                $searchUser = $user;
            }
        }
        if(empty($searchUser))
        {
            throw new NotFoundHttpException("$name, $area, 未找到");
        }

        $user_id = $searchUser['user_id'];
        $area_id = $searchUser['game_zone']['pinyin'];

        $account['name'] = $name;
        $account['avatar'] = 'http://cdn.tgp.qq.com/lol/images/resources/usericon/'.$searchUser['icon'].'.png';
        $account['server'] = $area;
        $account['hide_score'] = $searchUser['box_score'];
        $account['tier'] = $searchUser['tier_rank']['tier']['name_cn'];
        $account['sum'] = $searchUser['total_lose_normal']+$searchUser['total_lose_aram']+$searchUser['total_win_normal']+$searchUser['total_win_aram'];
        $account['win_sum'] = $searchUser['total_win_normal']+$searchUser['total_win_aram'];
        $account['defeat_sum'] = $searchUser['total_lose_normal']+$searchUser['total_lose_aram'];
        $account['win_rate'] = NumberHelper::percent($account['win_sum'], $account['sum']) . '%';

        $account['match_list'] = [];
        foreach($searchUser['game_recent_list'] ?: [] as $recent)
        {
            $gameId = $recent['game_id'];

            $temp = [];
            $temp['type'] = $recent['game_type']['name_cn'];
            $temp['result'] = $recent['battle_result'] ? '胜利' : '失败';
            $temp['time'] = date('Y-m-d H:i:s',strtotime($recent['created']));
            $temp['kill'] = 0;
            $temp['death'] = 0;
            $temp['assist'] = 0;
            $temp['avatar'] = 'http://static.lolbox.duowan.com/images/champions/'.$recent['champion']['name'].'_40x40.jpg';

            try {
                $detail = $this->matchDetail($area_id, $user_id, $gameId);
            } catch (\Exception $e) {
                continue;
            }
            

            if(empty($detail['player_game_list']))
            {
                continue;
            }

            $detail = $detail['player_game_list'][0];

            $temp['our'] = [];
            $temp['enemy'] = [];

            $our = null;
            $enemy = null;

            if($recent['battle_result'] === true)
            {
                $our = $detail['team_win'];
                $enemy = $detail['team_lose'];
            }
            else
            {
                $our = $detail['team_lose'];
                $enemy = $detail['team_win'];
            }

            $parsePlayer = function($champion){
                $championTemp = [];
                $championTemp['avatar'] = 'http://static.lolbox.duowan.com/images/champions/'.$champion['champion']['name'].'_40x40.jpg';
                $championTemp['spell'] = array_map(function($s){
                    return '';//'http://img.db.178.com/lol/images/content/spell/tf_'.$s['id'].'.jpg';
                }, $champion['spells']);//['', ''];
                $championTemp['equip_icon'] = array_map(function($item){
                    return 'http://static.lolbox.duowan.com/images/items/'.$item['id'].'_40x40.jpg';
                }, $champion['items']);
                $championTemp['kill'] = $champion['total_killed'];
                $championTemp['death'] = $champion['total_death'];
                $championTemp['assist'] = $champion['total_assist'];
                $championTemp['export'] = $champion['total_damage_dealt_to_champions'];
                $championTemp['gold'] = $champion['gold_earned'];

                return $championTemp;
            };

            foreach($our['player_champions'] ?: [] as $champion)
            {
                $championTemp = [];
                
                $championTemp = $parsePlayer($champion);

                // 如果是自己 就 补全
                if($champion['player']['user_id'] == $user_id)
                {
                    $temp['kill'] = $championTemp['kill'];
                    $temp['death'] = $championTemp['death'];
                    $temp['assist'] = $championTemp['assist'];
                }

                $temp['our'][] = $championTemp;
            }

            foreach($enemy['player_champions'] ?: [] as $champion)
            {
                $championTemp = [];
                
                $championTemp = $parsePlayer($champion);

                $temp['enemy'][] = $championTemp;
            }

            $account['match_list'][] = $temp;
        }

        return $account;

        var_dump($account);die;
    }

    public function searchUser($name)
    {
        list($jquery, $url) = $this->searchUrl($name);
        $content = $this->getContent($url);
        $content = substr($content, 0, strlen($content) - 1);
        $content = str_replace("$jquery(", "", $content);
        return json_decode($content, true);
    }

    public function matchDetail($area, $accountId, $matchId)
    {
        list($jquery, $url) = $this->matchDetailUrl($area, $accountId, $matchId);
        $content = $this->getContent($url);
        $content = substr($content, 0, strlen($content) - 1);
        $content = str_replace("$jquery(", "", $content);
        return json_decode($content, true);
    }


    private function searchUrl($name) {
        // 搜索 http://api.lolbox.duowan.com/api/v3/player/search/?game_zone=all&player_name_list=%E9%9C%9C%E9%BE%99%E9%AA%91%E5%A3%AB&wsSecret=undefined&ts=&callback=jQuery111208603194718373157_1516530306300&_=1516530306301
        $jquery = 'jQuery11120'.uniqid().'_'.time();
        $url = $this->_baseUrl . 'search/?game_zone=all&player_name_list=' . urlencode($name) . '&wsSecret=undefined&ts=&callback='.$jquery.'&_='.time();
        return[$jquery, $url];
    }

    private function matchDetailUrl($area, $accountId, $matchId)
    {
        // 比赛详情 http://api.lolbox.duowan.com/api/v3/player/dx1/2930856056/game/3125766800/?callback=jQuery111102412924285787852_1516530826958&_=1516530826960
        $jquery = 'jQuery11120'.uniqid().'_'.time();
        $url = $this->_baseUrl . $area .'/' . $accountId . '/game/' . $matchId . '/?callback='.$jquery.'&_='.time();
        return[$jquery, $url];
    }


}

?>