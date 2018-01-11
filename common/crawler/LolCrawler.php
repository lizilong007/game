<?php
namespace common\crawler;

error_reporting(ERROR_ALL);

use common\helper\NumberHelper;

class LolCrawler extends CrawlerBase implements CrawlerInterface {

    private $_baseUrl = 'http://lol.sucks.life/';

    public function make($name) {


    }


    private function buildUrl($name) {
        // 搜索 http://lol.sucks.life/search/%E9%9C%9C%E9%BE%99%E9%AA%91%E5%A3%AB
        // 账号详情 http://lol.sucks.life/user/detail/dx1/2930856056
        // 比赛列表 http://lol.sucks.life/battle/list/dx1/2930856056
        // 比赛详情 http://lol.sucks.life/battle/detail/dx1/2930856056/3142598024
        return $this->_baseUrl . $name;
    }


}

?>