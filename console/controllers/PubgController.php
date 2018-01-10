<?php

namespace console\controllers;
use Yii;
use yii\console\Controller;

use common\models\PubgCompre;
use common\crawler\PubgCrawler;

class PubgController extends Controller
{

    public function actionCrawler(){

//        $user = PubgCompre::find()->andWhere(['id' => 1])->one();

        $crawler = new PubgCrawler;

        var_dump($crawler->make('beckerr'));die;

    }





}

?>