<?php
namespace common\crawler;

error_reporting(0);

use common\helper\NumberHelper;

class LolCrawler extends CrawlerBase implements CrawlerInterface {

    private $_baseUrl = 'http://lol.sucks.life/';

    public function make($name) {


    }

    public function search($name)
    {
        return json_decode($this->getContent($this->searchUrl($name)), true);
    }

    public function matchList($accountId)
    {
        return json_decode($this->getContent($this->matchListUrl($accountId)), true);
    }

    public function matchDetail($accountId, $matchId)
    {
        return json_decode($this->getContent($this->matchDetailUrl($accountId, $matchId)), true);
    }


    private function searchUrl($name) {
        // 搜索 http://lol.sucks.life/search/%E9%9C%9C%E9%BE%99%E9%AA%91%E5%A3%AB
        return $this->_baseUrl . 'search/' . urlencode($name);
    }

    private function accountUrl($accountId)
    {
        // 账号详情 http://lol.sucks.life/user/detail/dx1/2930856056
        return $this->_baseUrl . 'user/detail/dx1/' . $accountId;
    }

    private function matchListUrl($accountId)
    {
        // 比赛列表 http://lol.sucks.life/battle/list/dx1/2930856056
        return $this->_baseUrl . 'battle/list/dx1/' . $accountId;
    }

    private function matchDetailUrl($accountId, $matchId)
    {
        // 比赛详情 http://lol.sucks.life/battle/detail/dx1/2930856056/3142598024
        return $this->_baseUrl . 'battle/detail/dx1/' . $accountId . '/' . $matchId;
    }


}

?>