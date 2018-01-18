<?php

namespace console\controllers;
use Yii;
use yii\console\Controller;

use common\models\PubgCompre;
use common\crawler\PubgCrawler;

use common\crawler\PsnCrawler;
use common\crawler\CocCrawler;
use common\crawler\SteamCrawler;
use common\crawler\CrCrawler;
use common\crawler\XboxCrawler;
use common\crawler\OwCrawler;

class PubgController extends Controller
{

    public function actionCrawler(){

//        $user = PubgCompre::find()->andWhere(['id' => 1])->one();

        $crawler = new PubgCrawler;

        var_dump($crawler->make('BABABABA1'));die;

    }

    public function actionPsn(){

//        $user = PubgCompre::find()->andWhere(['id' => 1])->one();

        $crawler = new PsnCrawler;

        var_dump($crawler->make('FrostwyrmKnight'));die;

    }

    public function actionCoc(){

//        $user = PubgCompre::find()->andWhere(['id' => 1])->one();

        $crawler = new CocCrawler;

        var_dump($crawler->make('#V8RJJGYR'));die;

    }

    public function actionSteam(){

//      $user = PubgCompre::find()->andWhere(['id' => 1])->one();

	    $crawler = new SteamCrawler;

	    var_dump($crawler->make('76561198023656749'));die;

    }

    public function actionSteamgame(){

//      $user = PubgCompre::find()->andWhere(['id' => 1])->one();

	    $crawler = new SteamCrawler;

	    var_dump($crawler->setGames());die;

    }

    public function actionCr(){

//      $user = PubgCompre::find()->andWhere(['id' => 1])->one();

	    $crawler = new CrCrawler;

	    var_dump($crawler->make('89Y8RVLY'));die;

    }

    public function actionXbox(){

//      $user = PubgCompre::find()->andWhere(['id' => 1])->one();

	    $crawler = new XboxCrawler;

	    var_dump($crawler->make('CapacityList22'));die;

    }

    public function actionOw(){

//      $user = PubgCompre::find()->andWhere(['id' => 1])->one();

	    $crawler = new OwCrawler;

	    var_dump($crawler->make('HaGoPeun-3364'));die;

    }

}

?>