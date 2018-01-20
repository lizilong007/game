<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

use common\crawler\SteamCrawler;


/**
 * Site controller
 */
class SteamController extends Controller
{
    public $gameId = \common\crawler\CrawlerBase::STEAM;
    // 搜索
    public function actionSearch()
    {
        $this->layout = 'default.php';
        $this->view->title = '号角个人游戏数据查询系统 - 内部版';
        $name = \Yii::$app->request->get('name');

        $crawler = new SteamCrawler;
        $account = $crawler->make($name, SteamCrawler::LEVEL_INDEX);

        return $this->render('search', ['account' => $account , 'name' => $name, 'gameId' => $gameId, 'gameName' => \common\crawler\CrawlerBase::$games[$gameId]]);
    }

    public function actionFriend()
    {
        $this->layout = 'default.php';
        $this->view->title = '号角个人游戏数据查询系统 - 内部版';
        $name = \Yii::$app->request->get('name');

        $crawler = new SteamCrawler;
        $account = $crawler->make($name, SteamCrawler::LEVEL_FRIEND);

        return $this->render('friend', ['account' => $account , 'name' => $name, 'gameId' => $gameId, 'gameName' => \common\crawler\CrawlerBase::$games[$gameId]]);
    }


}

?>