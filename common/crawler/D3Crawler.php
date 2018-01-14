<?php
namespace common\crawler;

error_reporting(0);

use common\helper\NumberHelper;

class D3Crawler extends CrawlerBase implements CrawlerInterface {


    private $_baseUrl = 'https://api.battlenet.com.cn/d3/profile/';
    private $_api_key = 'mq7c3yewmk23kwaatzkedeq2ybga9usf';

    public function make($name) {


    }

    public function account($name)
    {
        return json_decode($this->getContent($this->accountUrl($this->handleName($name))), true);
    }

    public function hero($name, $heroId)
    {
        return json_decode($this->getContent($this->heroUrl($this->handleName($name), $heroId)), true);
    }

    private function handleName($name)
    {
        return str_replace(['#', '＃'], '-', trim($name));
    }

    private function heroUrl($name, $heroId) {
        // 搜索 https://api.battlenet.com.cn/d3/profile/霜龙骑士-5626/hero/8645425?locale=zh_CN&apikey=mq7c3yewmk23kwaatzkedeq2ybga9usf
        return $this->_baseUrl . $name . '/hero/' . $heroId . '?locale=zh_CN&apikey=' . $this->_api_key;
    }

    private function accountUrl($name) 
    {
        // https://api.battlenet.com.cn/d3/profile/霜龙骑士-5626/?locale=zh_CN&apikey=mq7c3yewmk23kwaatzkedeq2ybga9usf
        return $this->_baseUrl . $name . '/?locale=zh_CN&apikey=' . $this->_api_key;

    }



}

?>