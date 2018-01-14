<?php
namespace common\crawler;

error_reporting(0);

use common\helper\NumberHelper;

class Dota2Crawler extends CrawlerBase implements CrawlerInterface {

    private $_baseUrl = 'https://api.opendota.com/api/';

    public function make($name) {


    }

    public function search($name)
    {
        return json_decode($this->getContent($this->searchUrl($name)), true);
    }

    public function account($accountId)
    {
        return json_decode($this->getContent($this->accountUrl($accountId)), true);
    }

    public function matchList($accountId)
    {
        return json_decode($this->getContent($this->matchListUrl($accountId)), true);
    }

    // public function matchDetail($accountId, $matchId)
    // {
    //     return json_decode($this->getContent($this->matchDetailUrl($accountId, $matchId)), true);
    // }


    private function searchUrl($name) {
        // 搜索 https://api.opendota.com/api/search?q=1024
        return $this->_baseUrl . 'search?q=' . urlencode($name);
    }

    private function accountUrl($accountId)
    {
        // 账号详情 https://api.opendota.com/api/players/173388456
        return $this->_baseUrl . 'players/' . $accountId;
    }

    private function matchListUrl($accountId)
    {
        // 比赛列表 https://api.opendota.com/api/players/173388456/recentMatches
        return $this->_baseUrl . 'players/' . $accountId . '/recentMatches';
    }

    // private function matchDetailUrl($accountId, $matchId)
    // {
    //     // 比赛详情 http://lol.sucks.life/battle/detail/dx1/2930856056/3142598024
    //     return $this->_baseUrl . 'battle/detail/dx1/' . $accountId . '/' . $matchId;
    // }


}

?>