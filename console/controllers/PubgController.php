<?php

namespace console\controllers;
use Yii;
use yii\console\Controller;

use common\models\PubgCompre;
use common\crawler\PubgCrawler;
use common\models\PubgUpdate;

use common\crawler\PsnCrawler;
use common\crawler\CocCrawler;
use common\crawler\SteamCrawler;
use common\crawler\CrCrawler;
use common\crawler\XboxCrawler;
use common\crawler\OwCrawler;
use common\crawler\LolDogCrawler;
use common\crawler\LolCrawler;
use common\crawler\D3Crawler;
use common\crawler\CsgoCrawler;
use common\crawler\Dota2Crawler;

class PubgController extends Controller
{
    public function actionUpdate()
    {
        while (true) {
            $pubgUpdate = PubgUpdate::find()->all();
            if($pubgUpdate)
            {
                $names = [];
                foreach($pubgUpdate ?: [] as $pubg)
                {
                    $names[$pubg->name] = $pubg->name;
                }

                foreach($names ?: [] as $name)
                {
                    try {
                        $crawler = new PubgCrawler;
                        $crawler->make($name);
                    } catch (\Exception $e) {
                        PubgUpdate::deleteAll(['name' => $name]);
                    }
                    PubgUpdate::deleteAll(['name' => $name]);
                }
            }
            sleep(2);
        }
        
    }

    public function actionPubg(){

//        $user = PubgCompre::find()->andWhere(['id' => 1])->one();

        $crawler = new PubgCrawler;

        var_dump($crawler->make('霜龙骑士'));die;

    }

    public function actionD3(){

//        $user = PubgCompre::find()->andWhere(['id' => 1])->one();

        $crawler = new D3Crawler;

        var_dump($crawler->account('霜龙骑士-5626'));die;

    }

    public function actionCsgo(){

//        $user = PubgCompre::find()->andWhere(['id' => 1])->one();

        $crawler = new CsgoCrawler;

        var_dump($crawler->search('76561198134713498'));die;

    }

    public function actionDota2(){

//        $user = PubgCompre::find()->andWhere(['id' => 1])->one();

        $crawler = new Dota2Crawler;

        var_dump($crawler->search('129529499'));die;

    }

    public function actionPsn(){

//        $user = PubgCompre::find()->andWhere(['id' => 1])->one();

        $crawler = new PsnCrawler;

        var_dump(json_encode($crawler->make('FrostwyrmKnight')));die;

    }

    public function actionCoc(){

//        $user = PubgCompre::find()->andWhere(['id' => 1])->one();

        $crawler = new CocCrawler;

        var_dump(json_encode($crawler->make('#V8RJJGYR')));die;

    }

    public function actionSteam(){

//      $user = PubgCompre::find()->andWhere(['id' => 1])->one();

	    $crawler = new SteamCrawler;

	    var_dump(json_encode($crawler->make('76561198023656749')));die;

    }

    public function actionSteamgame(){

//      $user = PubgCompre::find()->andWhere(['id' => 1])->one();

	    $crawler = new SteamCrawler;

	    var_dump($crawler->setGames());die;

    }

    public function actionCr(){

//      $user = PubgCompre::find()->andWhere(['id' => 1])->one();

	    $crawler = new CrCrawler;

	    var_dump(json_encode($crawler->make('89Y8RVLY')));die;

    }

    public function actionXbox(){

//      $user = PubgCompre::find()->andWhere(['id' => 1])->one();

	    $crawler = new XboxCrawler;

	    var_dump(json_encode($crawler->make('CapacityList22')));die;

    }

    public function actionOw(){

//      $user = PubgCompre::find()->andWhere(['id' => 1])->one();

	    $crawler = new OwCrawler;

	    var_dump(json_encode($crawler->make('HaGoPeun-3364')));die;

    }

    public function actionDog(){

//      $user = PubgCompre::find()->andWhere(['id' => 1])->one();

        $crawler = new LolDogCrawler;

        var_dump(json_encode($crawler->account(9101001518416, '霜龙骑士')));die;

        var_dump($crawler->search('霜龙骑士'));die;

    }

    public function actionLol(){

//      $user = PubgCompre::find()->andWhere(['id' => 1])->one();

        $crawler = new LolCrawler;

        var_dump(json_encode($crawler->search('魔鬼终结使者', '艾欧尼亚')));die;

    }

}

?>