<?php
namespace common\crawler;

error_reporting(0);

use Symfony\Component\DomCrawler\Crawler;

use common\helper\NumberHelper;

class PsnCrawler extends CrawlerBase implements CrawlerInterface {

    private $_baseUrl = 'https://psnprofiles.com/';

    public function make($name) {

        $time = time(); // 抓取时间

        $name = trim($name);

        $account = [];

        $content = $this->getContent($this->buildUrl($name));
        // $content = file_get_contents(__DIR__ . '/_psn.html');
        // var_dump($this->buildUrl($name));die;
        if(empty($content))
        {
            throw new CrawlerException(CrawlerException::CRAWLER_NOT_FOUND_CONTENT, "$name");
        }

        $crawler = new Crawler($content);

        $account = $this->getCompre($crawler);
        $account['name'] = $name;

        return $account;

    }

    private function getCompre($crawler) {

        $data = [];

        $data['avatar'] = trim($crawler->filter('#user-bar img')->first()->attr('src'));
        // 等级 奖杯总数 白金 金 银 铜 铁
        $data['grade'] = trim($crawler->filter('.trophy-count li.icon-sprite')->first()->text());
        
        $data['total'] = trim($crawler->filter('.no-shrink li.total')->first()->text());
        $data['platinum'] = trim($crawler->filter('.no-shrink li.platinum')->first()->text());
        $data['gold'] = trim($crawler->filter('.no-shrink li.gold')->first()->text());
        $data['silver'] = trim($crawler->filter('.no-shrink li.silver')->first()->text());
        $data['bronze'] = trim($crawler->filter('.no-shrink li.bronze')->first()->text());

        // .stats.flex span.stat.grow
        $stat = [];
        $stat = $crawler->filter('.stats.flex span.stat.grow')->each(function($node, $index){
            return trim(preg_replace("/\<span>.*\<\/span>/", "", $node->html()));
        });

        $data['played'] = $stat[0];
        $data['completed'] = $stat[1];
        $data['completion'] = $stat[2];
        $data['unearned_trophies'] = $stat[3];

        $gameList = [];
        $gameList = $crawler->filter('#gamesTable tr')->each(function($node, $index){
            $temp = [
                'avatar' => '',
                'name' => '',
                'trophies' => '',
                'platforms' => '',
                'rank' => '',
                'gold' => '',
                'silver' => '',
                'bronze' => '',
            ];
            $temp['avatar'] = trim($node->filter('td')->eq(0)->filter('img')->attr('src'));
            $temp['name'] = trim($node->filter('td')->eq(1)->filter('.ellipsis span a')->text());//
            $temp['trophies'] = preg_replace("/\W+/", ' ', str_replace('Trophies', '', trim($node->filter('td')->eq(1)->filter('span.small-info')->text())));//span.small-info
            $temp['platforms'] = $node->filter('td')->eq(2)->filter('.tag')->each(function($n, $i){return trim($n->text());});
            $temp['rank'] = trim($node->filter('td')->eq(3)->filter('.game-rank')->text());//game-rank
            $temp['gold'] = trim($node->filter('td')->eq(5)->filter('li.gold')->text());// li.gold
            $temp['silver'] = trim($node->filter('td')->eq(5)->filter('li.silver')->text());
            $temp['bronze'] = trim($node->filter('td')->eq(5)->filter('li.bronze')->text());

            return $temp;
        });

        $data['gameList'] = $gameList;

        return $data;

    }

    private function buildUrl($name) {
        return $this->_baseUrl . $name;
    }

}

?>