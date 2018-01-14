<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

use common\crawler\CsgoCrawler;


/**
 * Site controller
 */
class CsgoController extends Controller
{
    public $gameId = \common\crawler\CrawlerBase::CSGO;
    // 搜索
    public function actionSearch()
    {
        $this->layout = 'default.php';
        $this->view->title = '号角个人游戏数据查询系统 - 内部版';
        $name = \Yii::$app->request->get('name');

        $crawler = new CsgoCrawler;
        $account = $crawler->search($name);

        return $this->render('search', ['account' => $account , 'name' => $name]);
    }




}

?>