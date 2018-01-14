<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

use common\models\Dota2Account;
use common\crawler\Dota2Crawler;


/**
 * Site controller
 */
class Dota2Controller extends Controller
{
    public $gameId = \common\crawler\CrawlerBase::DOTA2;
    // 搜索
    public function actionSearch()
    {
        $this->layout = 'default.php';
        $this->view->title = '号角个人游戏数据查询系统 - 内部版';
        $name = \Yii::$app->request->get('name');

        $crawler = new Dota2Crawler;
        $accountList = $crawler->search($name);
        // 先保存
        foreach($accountList ?: [] as $account)
        {
            Dota2Account::createOrUpdate($account);
        }

        return $this->render('search', ['accountList' => $accountList , 'name' => $name]);
    }
    // 比赛详情
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    // 详情
    public function actionIndex()
    {
        $this->layout = 'default.php';
        $this->view->title = '号角个人游戏数据查询系统 - 内部版';
        $account_id = \Yii::$app->request->get('account_id');

        $crawler = new Dota2Crawler;

        $account = Dota2Account::findOne(['account_id' => $account_id]);

        $matchList = $crawler->matchList($account->account_id);
        $accountData = $crawler->account($account->account_id);

        Dota2Account::updateRank($account, $accountData);

        return $this->render('index', ['matchList' => $matchList, 'account' => $account]);
    }

    public function actionUpdate()
    {
    	$name = \Yii::$app->request->get('name');
    	
    }



}

?>