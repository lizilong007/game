<?php
namespace common\crawler;

error_reporting(0);

use common\helper\NumberHelper;

class OwCrawler extends CrawlerBase implements CrawlerInterface {


    private $_baseUrl = 'https://owapi.net/api/v3/u/';

    private $_statsName = [
        'rolling_average_stats' => [
            '平均攻防时间' => 'objective_time',
            '平均阵亡' => 'deaths',
            '平均最后一击' => 'final_blows',
            '平均每10分钟伤害总量' => 'all_damage_done',
            '平均治疗量' => 'healing_done',
            '平均每10分钟伤害总量' => 'barrier_damage_done',
            '平均单独消灭' => 'solo_kills',
            '平均目标攻防消灭' => 'objective_kills',
            '平均英雄伤害' => 'hero_damage_done',
            '平均消灭' => 'eliminations',
            '平均目标攻防时间' => 'time_spent_on_fire',
        ],
        
        'game_stats' => [
            '近身最后一击' => 'melee_final_blows',
            '英雄伤害总量' => 'hero_damage_done',
            '攻击助攻' => 'offensive_assists',
            '防御助攻' => 'defensive_assists',
            '杰出卡' => 'cards',
            '目标攻防消灭' => 'objective_kills',
            '单场最长火力全开时间' => 'time_spent_on_fire_most_in_game',
            '单场最多近战最后一击' => 'melee_final_blows_most_in_game',
            '火力全开时间' => 'time_spent_on_fire',
            '治疗量' => 'healing_done',
            '消灭' => 'eliminations',
            '单场最多攻击助攻' => 'offensive_assists_most_in_game',
            '阵亡' => 'deaths',
            '单场最多单独消灭' => 'solo_kills_most_in_game',
            '最佳瞬间消灭' => 'multikill_best',
            '黄金奖章' => 'medals_gold',
            '单场最多消灭' => 'eliminations_most_in_game',
            '单场最多防御助攻' => 'defensive_assists_most_in_game',
            '单场伤害总量' => 'all_damage_done_most_in_game',
            '奖章' => 'medals',
            '最后一击' => 'final_blows',
            '白银奖章' => 'medals_silver',
            '游戏时间' => 'games_played',
            '伤害总量' => 'all_damage_done',
            '单场最多治疗量' => 'healing_done_most_in_game',
            '比赛胜利' => 'games_won',
            '目标攻防时间' => 'objective_time',
            '瞬间消灭' => 'multikill',
            '单场最多目标攻防消灭' => 'objective_kills_most_in_game',
            '青铜奖章' => 'medals_bronze',
            '单场最多英雄伤害量' => 'hero_damage_done_most_in_game',
            '游戏时间' => 'time_played',
            '比赛失败' => 'games_lost',
            '单场最多最后一击' => 'final_blows_most_in_game',
            '单独消灭' => 'solo_kills',
        ],
        'overall_stats' => [
            '玩家等级' => 'level',
            '胜率' => 'win_rate',
            '排名' => 'comprank',
            '级别' => 'tier',
            '总场数' => 'games',
        ]
        
    ];

    public function make($name) {

        $account = [];

        $rolling_average_stats_name = array_flip($this->_statsName['rolling_average_stats']);
        $game_stats_name = array_flip($this->_statsName['game_stats']);
        $overall_stats_name = array_flip($this->_statsName['overall_stats']);

        $account['name'] = $name;

        $data = $this->getData($name);

        foreach($data ?: [] as $server => $d)
        {
            foreach($d ?: [] as $statses)
            {
                foreach($statses ?: [] as $playType => $stats)
                {
                    foreach($rolling_average_stats_name as $k => $n)
                    {
                        $account[$server][$playType]['rolling_average_stats'][] = [
                            'name' => $n,
                            'value' => $stats['rolling_average_stats'][$k]
                        ];
                    }

                    foreach($game_stats_name as $k => $n)
                    {
                        $account[$server][$playType]['game_stats'][] = [
                            'name' => $n,
                            'value' => $stats['game_stats'][$k]
                        ];
                    }

                    foreach($overall_stats_name as $k => $n)
                    {
                        $account[$server][$playType]['overall_stats'][] = [
                            'name' => $n,
                            'value' => $stats['overall_stats'][$k]
                        ];
                    }
                    // avatar和rank_image overall_stats
                    if(empty($account['avatar']) || empty($account['rank_image']))
                    {
                        $account['avatar'] = $stats['overall_stats']['avatar'];
                        $account['rank_image'] = $stats['overall_stats']['rank_image'];
                    }
                }
            }
        }

        return $account;
        var_dump($account);die;

    }

    public function getData($name)
    {
        return json_decode($this->getContent($this->accountUrl($this->handleName($name))), true);
    }

    private function handleName($name)
    {
        return str_replace(['#', '＃'], '-', trim($name));
    }

    private function accountUrl($name) 
    {
        // https://owapi.net/api/v3/u/[battletag]]/stats
        return $this->_baseUrl . $name . '/stats';

    }



}

?>