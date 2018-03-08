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
        return json_decode($this->vget($this->searchUrl($name)), true);
    }

    public function account($accountId)
    {
        return json_decode($this->vget($this->accountUrl($accountId)), true);
    }

    public function matchList($accountId)
    {
        return json_decode($this->vget($this->matchListUrl($accountId)), true);
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

    private function vget($url){ // 模拟提交数据函数
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        // curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        $tmpInfo = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            echo 'Errno'.curl_error($curl);//捕抓异常
        }
        curl_close($curl); // 关闭CURL会话
        return $tmpInfo; // 返回数据
    }


}

?>