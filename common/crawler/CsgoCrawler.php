<?php
namespace common\crawler;

error_reporting(0);

use common\helper\NumberHelper;

class CsgoCrawler extends CrawlerBase implements CrawlerInterface {

// 用户输入STEAMID64或者customurl进行查询

// API KEY:7129AE02449532DF192612C7DCDFEBC0

// 当用户输入Customurl时，使用http://api.steampowered.com/ISteamUser/ResolveVanityURL/v0001/?key=[KEY]&vanityurl=CustomURL进行查询 获得用户的STEAMID64
// 当用户输入STEAMID64时，使用http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?key=[KEY] &appid=730&steamid=[STEAMID64]获取用户
    // 76561198134713498
    private $_baseUrl = 'http://api.steampowered.com/';
    private $_api_key = '7129AE02449532DF192612C7DCDFEBC0';

    public function make($name) {


    }

    public function search($name)
    {
        return json_decode($this->getContent($this->searchUrl($this->steamId($name))), true);
    }

    private function steamId($name)
    {
        if(is_numeric($name))
        {
            return $name;
        }
        $steam = json_decode($this->getContent($this->customUrl($name)), true);
        return $steam['response']['steamid'];
    }

    private function customUrl($name) 
    {
        // http://api.steampowered.com/ISteamUser/ResolveVanityURL/v0001/?key=7129AE02449532DF192612C7DCDFEBC0&vanityurl=Frostwyrmknight
        return $this->_baseUrl . 'ISteamUser/ResolveVanityURL/v0001/?key='.$this->_api_key.'&vanityurl=' . urlencode($name);
    }

    private function searchUrl($name) {
        // 搜索 http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?key=[KEY] &appid=730&steamid=[STEAMID64]
        return $this->_baseUrl . 'ISteamUserStats/GetUserStatsForGame/v0002/?key='.$this->_api_key.'&appid=730&steamid=' . $name;
    }



}

?>