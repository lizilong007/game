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

        // $content = $this->getContent($this->indexUrl($name));
        $content = file_get_contents(__DIR__ . '/_crindex.html');

        if(empty($content))
        {
            throw new CrawlerException(CrawlerException::CRAWLER_NOT_FOUND_CONTENT, "$name");
        }

        $crawler = new Crawler($content);

        return $data;

    }

    private function getCards($name) {

        $data = [];

        // $content = $this->getContent($this->cardUrl($name));
        $content = file_get_contents(__DIR__ . '/_crcard.html');

        if(empty($content))
        {
            throw new CrawlerException(CrawlerException::CRAWLER_NOT_FOUND_CONTENT, "$name");
        }

        $crawler = new Crawler($content);

        return $data;

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