<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\PubgCompre;
use common\models\PubgUpdate;
use common\crawler\PubgCrawler;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use yii\web\View;

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

    public function actionSearch()
    {
        $this->layout = 'default.php';
        $this->view->title = '号角个人游戏数据查询系统 - 内部版';
        $name = \Yii::$app->request->get('name');
        $name = trim($name);

        $pubgUpdate = PubgUpdate::find()->where(['name' => $name])->one();

        if(empty($pubgUpdate))
        {
            $pubgUpdate = new PubgUpdate;
            $pubgUpdate->name = $name;
        }

        $pubgUpdate->updating;

        $pubgUpdate->save();

        $this->view->registerJs('
            setInterval(function(){
                $.get("'.Url::to(['pubg/update', 'name' => $name]).'", function(data){
                    if(data.status == "success")
                    {
                        window.location.href = "'.Url::to(['pubg/index', 'name' => $name]).'";
                    }
                }, "json");
            }, 2000);
            ', View::POS_READY);

        return $this->render('search', ['pubgUpdate' => $pubgUpdate]);
    }

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
    	$name = trim($name);

        $pubgUpdate = PubgUpdate::find()->where(['name' => $name])->one();

        if(empty($pubgUpdate))
        {
            // success
            $ret = ['status' => 'success'];
        }
        else
        {
            // fail
            $ret = ['status' => 'fail'];
        }
        

        echo json_encode($ret);

        die;
    }



}

?>