<?php
namespace common\crawler;

error_reporting(0);

use common\helper\NumberHelper;
use common\models\SteamGames;

class SteamCrawler extends CrawlerBase implements CrawlerInterface {

    const  LEVEL_ALL = 1;
    const  LEVEL_INDEX = 2;
    const  LEVEL_FRIEND = 3;

    // 76561198134713498
    private $_baseUrl = 'http://api.steampowered.com/';
    private $_api_key = '7129AE02449532DF192612C7DCDFEBC0';

    public function make($name, $level = SteamCrawler::LEVEL_ALL) {

        $account = [];
        $steamId = $this->steamId($name);
        
        $account = $this->parseUser($steamId);

        if ((int)$level != SteamCrawler::LEVEL_FRIEND)
        {
            $recent = json_decode($this->getContent($this->recentUrl($steamId)), true);
            // https://steamcdn-a.akamaihd.net/steamcommunity/public/images/apps/374030/8a4ca3287751f31c4b0a2f5c1326b56b82a27207
            $account['recent'] = $recent['response'];

            $has = json_decode($this->getContent($this->hasUrl($steamId)), true);
            $account['has'] = $has['response'];

            $gids = array_map(function($g){return $g['appid'];}, $account['has']['games']);
            $account['has']['names'] = SteamGames::find()->where(['appid' => $gids])->indexBy('appid')->all();
        }

        if ((int)$level != SteamCrawler::LEVEL_INDEX)
        {
            $account['friends'] = $this->parseFriends($steamId);
        }
        
        return $account;

        var_dump($account);die;
    }

    public function parseFriends($steamId)
    {
        $friends = [];

        $friend = json_decode($this->getContent($this->friendUrl($steamId)), true);
        
        foreach($friend['friendslist']['friends'] ?: [] as $f)
        {
            $friends[$f['steamid']] = $f;
        }
        $friendUsers = json_decode($this->getContent($this->userUrl(implode(',', array_keys($friends)))), true);
        foreach($friendUsers['response']['players'] ?: [] as $fu)
        {
            $friends[$fu['steamid']]['timecreated'] = $fu['timecreated'];
            $friends[$fu['steamid']]['lastlogoff'] = $fu['lastlogoff'];
            $friends[$fu['steamid']]['avatar'] = $fu['avatar'];
            $friends[$fu['steamid']]['personaname'] = $fu['personaname'];
        }

        return $friends;
    }

    public function parseUser($steamId)
    {
        $account = [];

        $user = json_decode($this->getContent($this->userUrl($steamId)), true);
        $user = $user['response']['players'][0];

        $account['steamid'] = $user['steamid'];
        $account['timecreated'] = $user['timecreated'];
        $account['lastlogoff'] = $user['lastlogoff'];
        $account['avatar'] = $user['avatar'];
        $account['personaname'] = $user['personaname'];

        $level = json_decode($this->getContent($this->levelUrl($steamId)), true);
        $account['level'] = $level['response']['player_level'];

        return $account;
    }






    public function setGames()
    {
        $url = 'http://api.steampowered.com/ISteamApps/GetAppList/v0001/';
        $games = json_decode($this->getContent($url), true);
        foreach($games['applist']['apps']['app'] ?: [] as $game)
        {
            try {
                $model = SteamGames::findOne(['appid' => $game['appid']]);
                if(!$model)
                {
                    $model = new SteamGames;
                    $model->appid = $game['appid'];
                    $model->name = $game['name'];
                    $model->save();
                } 
            } catch (\Exception $e) {
                
            }
            
        }
    }

    public static function appAvatar($appId)
    {
        return "http://cdn.akamai.steamstatic.com/steam/apps/".$appId."/header.jpg?t=1498149128";
    }

    public static function gameAvatar($data)
    {
        return "https://steamcdn-a.akamaihd.net/steamcommunity/public/images/apps/".$data['appid']."/".$data['img_logo_url'].".jpg";
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

    private function userUrl($steamId)
    {
        // ISteamUser/GetPlayerSummaries/v0002/?key=[KEY]&steamids=[userid]
        return $this->_baseUrl . 'ISteamUser/GetPlayerSummaries/v0002/?key='.$this->_api_key.'&steamids='.$steamId;
    }

    private function levelUrl($steamId)
    {
        // IPlayerService/GetSteamLevel/v1?key=[KEY]&steamid=[UserID]
        return $this->_baseUrl . 'IPlayerService/GetSteamLevel/v1?key='.$this->_api_key.'&steamid='.$steamId;
    }

    private function recentUrl($steamId)
    {
        // IPlayerService/GetRecentlyPlayedGames/v0001/?key=[KEY]&steamid=[userid]
        return $this->_baseUrl . 'IPlayerService/GetRecentlyPlayedGames/v1/?key='.$this->_api_key.'&steamid='.$steamId;
    }

    private function hasUrl($steamId)
    {
        // IPlayerService/GetOwnedGames/v1?key=[KEY]&steamid=[UserID]
        return $this->_baseUrl . 'IPlayerService/GetOwnedGames/v1?key='.$this->_api_key.'&steamid='.$steamId;
    }

    private function friendUrl($steamId)
    {
        // http://api.steampowered.com/ISteamUser/GetFriendList/v0001/?key=[KEY]&steamid=[USERID]&relationship=friend
        return $this->_baseUrl . 'ISteamUser/GetFriendList/v0001/?key='.$this->_api_key.'&steamid='.$steamId.'&relationship=friend';
    }

    private function customUrl($name) 
    {
        // http://api.steampowered.com/ISteamUser/ResolveVanityURL/v0001/?key=7129AE02449532DF192612C7DCDFEBC0&vanityurl=Frostwyrmknight
        return $this->_baseUrl . 'ISteamUser/ResolveVanityURL/v0001/?key='.$this->_api_key.'&vanityurl=' . urlencode($name);
    }



}

?>