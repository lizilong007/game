<?php
namespace common\crawler;

error_reporting(0);

use common\helper\NumberHelper;
use Symfony\Component\DomCrawler\Crawler;

class LolDogCrawler extends CrawlerBase implements CrawlerInterface {

    private $_baseUrl = 'http://www.laoyuegou.com/';

    public function make($name) {

        $account = [];

    }

    public function search($name)
    {
        // 名字 头像 大区
        $list = [];
        $content = $this->getContent($this->searchUrl($name));
        $crawler = new Crawler($content);
        if(!$crawler->filter('#searchUL li'))
        {
            throw new CrawlerException(CrawlerException::CRAWLER_NOT_FOUND_CONTENT, "$name");
        }
        $list = $crawler->filter('#searchUL li')->each(function($node, $index) use ($name) {
            $href = '';
            try {
                $href = trim($node->filter('a')->first()->attr('href'));
            } catch (\Exception $e) {
                return [];
            }
            if (!$href) return [];
            preg_match("/globalId=(\d+)\.html/", trim($node->filter('a')->first()->attr('href')), $result);
            return [
                'name' => $name,
                'avatar' => trim($node->filter('img')->first()->attr('src')),
                'server' => trim($node->filter('p.col-gray')->first()->text()),
                'accountId' => $result[1],
            ];
        });

        return array_filter($list);
    }

    public function account($accountId, $name, $page = 1, $area)
    {
        $account = [];

        try {
            $content = $this->getContent($this->accountUrl($accountId, $page));
            $crawler = new Crawler($content);
            // 名字 头像 服务器 隐藏分 段位 总场次 胜场 负场 胜率
            $account['name'] = $name;
            $account['avatar'] = trim($crawler->filter('.avatarbox img.avatar')->first()->attr('src'));
            $account['server'] = trim($crawler->filter('.pm-head .div1 p')->first()->text());
            $account['hide_score'] = trim($crawler->filter('.score .item .p1')->eq(0)->text());
            $account['tier'] = trim($crawler->filter('.pm-head .dan p')->first()->text());
            $account['sum'] = trim($crawler->filter('.score .item .p1')->eq(1)->text());
            $account['win_sum'] = str_replace('胜', '', trim($crawler->filter('.shengfu .win span')->first()->text()));
            $account['defeat_sum'] = str_replace('负', '', trim($crawler->filter('.shengfu .defeat span')->first()->text()));
            $account['win_rate'] = trim($crawler->filter('.score .item .p1')->eq(2)->text());

            $account['match_list'] = $crawler->filter('.record-item')->each(function($node, $index){
                $match = [];
                // 模式 战斗结果 比赛时间 击杀 死亡 助攻 英雄头像
                $match['type'] = trim($node->filter('.item-head .game-status .item')->eq(0)->filter('.p2')->first()->text());
                $match['result'] = trim($node->filter('.item-head .game-status .item')->eq(0)->filter('.p1')->first()->text());
                $match['time'] = trim($node->filter('.item-head .time')->first()->text());
                $match['kill'] = trim($node->filter('.item-head .myinfo .rentou span.kill')->first()->text());
                $match['death'] = trim($node->filter('.item-head .myinfo .rentou span.die')->first()->text());
                $match['assist'] = trim($node->filter('.item-head .myinfo .rentou span.help')->first()->text());
                $match['avatar'] = trim($node->filter('.item-head span.hero-img img')->first()->attr('src'));

                // 我方和敌方的 英雄头像 召唤师技能图片 装备图片 杀死助 输出 经济
                $node->filter('.gameteam .teaminfo')->each(function($info, $i) use (&$match) {
                    $tempCamp = '';
                    // i=0 我方 i=1 敌方
                    $camp = ['our', 'enemy'];
                    $tempCamp = $camp[$i];
                    $info->filter('tbody tr')->each(function($people, $pos) use ($tempCamp, &$match){
                        $message = [];

                        $kda = trim($people->filter('td')->eq(2)->filter('p')->eq(1)->text());
                        $kda = explode('/', $kda);
                        $message['avatar'] = trim($people->filter('td')->eq(0)->filter('img')->first()->attr('src'));
                        $message['spell'] = $people->filter('td')->eq(1)->filter('.jinneg img')->each(function($spell, $si){
                            return trim($spell->attr('src'));
                        }) ;
                        $message['equip_icon'] = $people->filter('td')->eq(8)->filter('.left6 img')->each(function($equip, $ei){
                            return trim($equip->attr('src'));
                        }) ;
                        $message['kill'] = $kda[0];
                        $message['death'] = $kda[1];
                        $message['assist'] = $kda[2];
                        $message['export'] = trim($people->filter('td')->eq(3)->filter('div')->first()->text());
                        $message['gold'] = trim($people->filter('td')->eq(4)->filter('div')->first()->text());

                        $match[$tempCamp][] = $message;
                    });
                });

                return $match;
            });
        } catch (\Exception $e) {
            $account = (new LolCrawler)->search($name, $area);
        }
        
        
        return $account;
    }


    private function searchUrl($name) {
        // 搜索 http://www.laoyuegou.com/enter/search/search.html?type=lol&name=%E9%9C%9C%E9%BE%99%E9%AA%91%E5%A3%AB
        return $this->_baseUrl . 'enter/search/search.html?type=lol&name=' . urlencode($name);
    }

    private function accountUrl($accountId, $page = 1)
    {
        // 账号详情 http://www.laoyuegou.com/x/zh-cn/lol/lol/player.html?globalId=9101001518416.html
        // &page=2
        $pageString = '';
        if ($page > 1) $pageString = '&page=' . $page;
        return $this->_baseUrl . 'x/zh-cn/lol/lol/player.html?globalId=' . $accountId . '.html' . $pageString;
    }


}

?>