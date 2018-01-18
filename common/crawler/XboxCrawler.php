<?php
namespace common\crawler;

error_reporting(0);

use common\helper\NumberHelper;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;

class XboxCrawler extends CrawlerBase implements CrawlerInterface {

    private $_baseUrl = 'https://xboxapi.com/v2/';
    private $_token = 'b0c3672ef44bd1efbbb2bb7c48a6ec5b4f12af9d';
    private $_client = null;
    private $_promises = null;


    public function make($name) {

        $account = [];
        $account['name'] = $name;

        $xuid = 2763816199901839;//$this->toXuid($name);
        $account['xuid'] = $xuid;

        $this->profile($xuid);
        $this->recent($xuid);
        $this->one($xuid);
        $this->box360($xuid);

        $results = Promise\unwrap($this->_promises);

        $profile = json_decode((String)$results['profile']->getBody(), true);
        $recent = json_decode((String)$results['recent']->getBody(), true);
        $one = json_decode((String)$results['one']->getBody(), true);
        $box360 = json_decode((String)$results['box360']->getBody(), true);

        $account['GameDisplayName'] = $profile['GameDisplayName'];
        $account['GameDisplayPicRaw'] = $profile['GameDisplayPicRaw'];

        foreach($recent ?: [] as $cent)
        {
            if(!isset($account['recent'][$cent['contentTitle']]))
            {
                $account['recent'][$cent['contentTitle']] = [
                    'contentTitle' => $cent['contentTitle'],
                    'contentImageUri' => $cent['contentImageUri'],
                ];
            }
        }

        foreach($one['titles'] ?: [] as $o)
        {
            // name 游戏名字
            // earnedAchievements 获取的成就书
            // currentGamerscore 当前积分
            $account['one'][] = [
                'name' => $o['name'],
                'earnedAchievements' => $o['earnedAchievements'],
                'currentGamerscore' => $o['currentGamerscore'],
            ];
        }

        foreach($box360['titles'] ?: [] as $b360)
        {
            // name 游戏名字
            // currentAchievements 获取的成就书
            // currentGamerscore 当前积分
            $account['box360'][] = [
                'name' => $b360['name'],
                'currentAchievements' => $b360['currentAchievements'],
                'currentGamerscore' => $b360['currentGamerscore'],
            ];
        }
        
        return $account;

    }

    public function toXuid($name)
    {
        return $this->search($this->xuidUrl($name));
    }

    public function profile($xuid)
    {
        return $this->search($this->profileUrl($xuid), 'profile');
    }

    public function recent($xuid)
    {
        return $this->search($this->recentUrl($xuid), 'recent');
    }

    public function one($xuid)
    {
        return $this->search($this->oneUrl($xuid), 'one');
    }

    public function box360($xuid)
    {
        return $this->search($this->box360Url($xuid), 'box360');
    }

    private function profileUrl($xuid)
    {
        // https://xboxapi.com/v2/[xuid]/profile
        return $this->_baseUrl . $xuid . '/profile';
    }

    private function recentUrl($xuid)
    {
        // https://xboxapi.com/v2/2763816199901839/[xuid]/recent
        return $this->_baseUrl . $xuid . '/activity/recent';
    }

    private function oneUrl($xuid)
    {
        // https://xboxapi.com/v2/[xuid]/xboxonegames
        return $this->_baseUrl . $xuid . '/xboxonegames';
    }

    private function box360Url($xuid)
    {
        // https://xboxapi.com/v2/[xuid]/xbox360games
        return $this->_baseUrl . $xuid . '/xbox360games';
    }

    private function xuidUrl($name)
    {
        // https://xboxapi.com/v2/xuid/[Gamertag]
        return $this->_baseUrl . 'xuid/' . urlencode(trim($name));
    }

    public function search($url, $type = '')
    {
        if(empty($type))
        {
            $client = new \GuzzleHttp\Client();
            try {
                $res = $client->request('GET', $url, [
                        'headers' => [
                            'X-AUTH' => $this->_token,
                        ]
                    ]);

                if ($res->getStatusCode() == 200) {
                    return json_decode((String)$res->getBody(), true);
                }
            } catch (\Exception $e) {
                var_dump($e->getMessage());
                return null;
            }
        }
        else
        {
            if(empty($this->_client))
            {
                $this->_client = new Client();
            }

            // Initiate each request but do not block
            $this->_promises[$type] = $this->_client->getAsync($url, [
                'headers' => [
                    'X-AUTH' => $this->_token,
                ]
            ]);

            return true;
        }
    }

}

?>