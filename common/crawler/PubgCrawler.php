<?php
namespace common\crawler;

use Symfony\Component\DomCrawler\Crawler;

use common\models\PubgCompre;

class PubgCrawler extends CrawlerBase implements CrawlerInterface {

    private $_baseUrl = 'https://pubg.op.gg/user/';
    private $_baseApiUrl = 'https://pubg.op.gg/api/';

    public function make($name) {

        $name = trim($name);

        $content = $this->getContent($this->buildUrl($name));

        if(empty($content))
        {
            throw new CrawlerException(CrawlerException::CRAWLER_NOT_FOUND_CONTENT, "$name");
        }

        $account = PubgCompre::find()->where(['name' => $name])->limit(1)->one();

        if(empty($account))
        {
            $account = new PubgCompre();
        }

        $crawler = new Crawler($content);

        $compreData = $this->getCompre($crawler);

        var_dump($content);die;

    }

    private function getCompre($crawler) {

        $data = [];

        // 服务器名字 .game-server__item--on .sp__server
        $data['serverName'] = trim($crawler->filter('.game-server__item--on .sp__server')->first()->text());
        $data['server'] = trim(str_replace('https://pubg.op.gg/user/beckerr?server=', '', trim($crawler->filter('.game-server__item--on a[data-selector=ch-server]')->first()->attr('href'))));
        // 场数 .game-server__item--on .game-server__play-count
        list($data['total_num'], ) = preg_split("/\W+/", trim($crawler->filter('.game-server__item--on .game-server__play-count')->first()->text()));
        $data['user_id'] = trim($crawler->filter('#userNickname')->first()->attr('data-user_id'));

        // 获取赛季单排 双排 四排数据
        $typeArray = [
            1 => 'single',
            2 => 'double',
            4 => 'four'
        ];

        foreach($typeArray as $size => $prefix)
        {
            $apiUrl = $this->rankUrl($data['user_id'], $data['server'], $size);
            $rankData = $this->getContent($apiUrl);
            if(empty($rankData))
            {
                throw new CrawlerException(CrawlerException::CRAWLER_NOT_FOUND_RANK, "$apiUrl");
            }
            $rankData = \GuzzleHttp\json_decode($rankData, true);

            var_dump($rankData);die;
        }

        return $data;

    }

    private function buildUrl($name) {
        return $this->_baseUrl . $name;
    }

    private function rankUrl($user_id, $server, $size)
    {
        $season = date('Y-m');
        return $this->_baseApiUrl . "users/$user_id/ranked-stats?season=$season&server=$server&queue_size=$size&mode=tpp";
    }

}

?>