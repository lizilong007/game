<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\PubgCompre;
use common\crawler\PubgCrawler;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

/**
 * Site controller
 */
class PubgController extends Controller
{
    public $gameId = \common\crawler\CrawlerBase::PUBG;
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'default.php';
        $this->view->title = '号角个人游戏数据查询系统 - 内部版';
        $name = \Yii::$app->request->get('name');
        $account = PubgCompre::find()->where(['name' => $name])->one();
        if(empty($account))
        {
        	try {
        		$crawler = new PubgCrawler;
        		$account = $crawler->make($name);
        	} catch (\Exception $e) {
        		throw new NotFoundHttpException("crawler role name : $name, not found." . $e->getMessage(), 1);
        	}
        	
        }

        if(empty($account))
        {
        	throw new NotFoundHttpException("the role name : $name, not found", 1);
        }
        
        return $this->render('index', ['account' => $account]);
    }

    public function actionUpdate()
    {
    	$name = \Yii::$app->request->get('name');
    	ob_start();
    	echo '<h1 style="text-align:center;">正在更新中，请稍后....</h1>';
    	ob_flush();
    	try {
    		$crawler = new PubgCrawler;
    		$account = $crawler->make($name);
    	} catch (\Exception $e) {
    		throw new NotFoundHttpException("crawler role name : $name, not found." . $e->getMessage(), 1);
    	}
    	echo '<script>window.location.href="' . Url::to(['pubg/index', 'name' => $name]) . '";</script>';
    	ob_flush();
    }



}

?>