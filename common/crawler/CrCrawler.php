<?php
namespace common\crawler;

error_reporting(0);

use Symfony\Component\DomCrawler\Crawler;

use common\helper\NumberHelper;

class CrCrawler extends CrawlerBase implements CrawlerInterface {

    private $_baseUrl = 'https://cr-api.com/player/';

    public function make($name) {

        $time = time(); // 抓取时间

        $name = trim($name);

        $account = [];

        $account = $this->getCompre($name);
        $account['crads'] = $this->getCards($name);
        $account['tag'] = $name;

        return $account;

    }

    private function getCompre($name) {

        $data = [];

        $content = $this->vget($this->indexUrl($name));
        // $content = file_get_contents(__DIR__ . '/_crindex.html');

        if(empty($content))
        {
            throw new CrawlerException(CrawlerException::CRAWLER_NOT_FOUND_CONTENT, "$name");
        }

        $crawler = new Crawler($content);

        $data['name'] = trim($crawler->filter('.thirteen h1')->first()->text());
        $data['clan'] = trim($crawler->filter('.thirteen .item')->eq(1)->text());
        $data['best_season'] = [
            'Trophies' => trim($crawler->filter('.ui.two.stackable .card')->eq(0)->filter('.item')->eq(1)->text()),
        ];
        $data['previous_season'] = [
            'Trophies' => trim($crawler->filter('.ui.two.stackable .card')->eq(1)->filter('.item')->eq(1)->text()),
        ];

        $keysName = [
            'Trophies' => '奖杯总数',
            'Highest Trophies' => '最高奖杯数',
            'Rank' => ' 排名',
            'Ladder 1v1 Wins' => '天梯1V1胜利次数',
            'Ladder 1v1 Losses' => '天梯1V1失败次数',
            'Ladder 1v1 Draws + 2v2 Games' => '天梯1V1/2V2平手次数',
            'Total Ladder Games' => '总天梯对战次数',
            'Ladder 1v1 Win Percentage' => '天梯1V1胜率',
            'Ladder 1v1 Loss Percentage' => '天梯1V1失败率',
            'Three Crown Wins on Ladder + Challenges' => '天梯三冠挑战次数',
            'Min. Time Spent on Ladder' => '天梯最小时间花费',
            'Challenge Max Wins' => '最大连胜次数',
            'Challenge Cards Won' => '获得卡牌数',
            'Tourney Games Played' => '锦标赛参赛次数',
            'Tourney Cards Won' => '锦标赛获得卡牌数',
            'Cards Found' => '卡牌发现数',
            'Total Donations' => '总捐献数',
            'Level' => '等级',
            'League 7' => '联盟'
        ];

        $stats = $crawler->filter('.ui.four.stackable.doubling.cards .card')->each(function($node, $index) use ($keysName){
            $value = trim($node->filter('.content .header')->first()->text());
            $key = trim($node->filter('.content .meta')->first()->text());

            return [
                'name' => $keysName[$key],
                'value' => $value,
                'key' => $key
            ];
        });

        $data['stats'] = $stats;

        return $data;

    }

    private function getCards($name) {

        $data = [];

        $content = $this->vget($this->cardUrl($name));
        // $content = file_get_contents(__DIR__ . '/_crcard.html');

        if(empty($content))
        {
            throw new CrawlerException(CrawlerException::CRAWLER_NOT_FOUND_CONTENT, "$name");
        }

        $crawler = new Crawler($content);

        $data = $crawler->filter('div.ui.segment.container a')->each(function($node, $index) {
            return [
                'icon' => 'https://cr-api.com' . trim($node->filter('div.player_card img')->first()->attr('src')),
                'upgrades' => trim($node->filter('div.card_upgrades')->first()->text()),
                'level' => trim($node->filter('div.cardlevel')->first()->text()),
                'card_progress_container' => trim($node->filter('div.card_progress_container')->first()->html()),
            ];
        });

        return $data;

    }

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

    private function handleName($name)
    {
        return str_replace(['#', '＃'], '', $name);
    }

    private function indexUrl($name) {
        // https://cr-api.com/player/89Y8RVLY/
        return $this->_baseUrl . $this->handleName($name) . '/';
    }

    private function cardUrl($name) {
        // https://cr-api.com/player/89Y8RVLY/cards
        return $this->_baseUrl . $this->handleName($name) . '/cards';
    }

}

?>