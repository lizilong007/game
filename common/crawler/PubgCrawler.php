<?php
namespace common\crawler;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\str;

class PubgCrawler implements CrawlerInterface {

    public function make($name) {

        $request = new Request('GET', 'https://pubg.op.gg/user/beckerr');

        var_dump($request);die;
        echo \GuzzleHttp\Psr7\str($request);


    }

}

?>