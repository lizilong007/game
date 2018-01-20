<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use yii\web\View;

use common\crawler\LolDogCrawler;


/**
 * Site controller
 */
class LolController extends Controller
{
    public $gameId = \common\crawler\CrawlerBase::LOL;
    // 搜索
    public function actionSearch()
    {
        $this->layout = 'default.php';
        $this->view->title = '号角个人游戏数据查询系统 - 内部版';
        $name = \Yii::$app->request->get('name');

        $crawler = new LolDogCrawler;
        $account = $crawler->search($name);

        return $this->render('search', ['account' => $account , 'name' => $name, 'gameId' => $gameId, 'gameName' => \common\crawler\CrawlerBase::$games[$gameId]]);
    }

    // index
    public function actionIndex()
    {
        $this->layout = 'default.php';
        $this->view->title = '号角个人游戏数据查询系统 - 内部版';
        $accountId = \Yii::$app->request->get('accountId');
        $name = \Yii::$app->request->get('name');

        $crawler = new LolDogCrawler;
        $account = $crawler->account($accountId, $name);

        $this->view->registerJs('$(function(){
        $(".match-detail-button").click(function() {
            var key = $(this).attr("matchkey");
            $( "#match-detail-"+key ).slideToggle( "slow" );
        });
    });', View::POS_READY);

        return $this->render('index', ['account' => $account , 'name' => $name, 'gameId' => $gameId, 'gameName' => \common\crawler\CrawlerBase::$games[$gameId]]);
    }


}

?>