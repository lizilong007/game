<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

use common\models\LolAccount;
use common\crawler\LolCrawler;


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

        $crawler = new LolCrawler;
        $accountList = $crawler->search($name);
        // 先保存
        foreach($accountList['player_list'] ?: [] as $account)
        {
            LolAccount::createOrUpdate($account);
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
        $user_id = \Yii::$app->request->get('user_id');

        $account = LolAccount::findOne(['user_id' => $user_id]);

        $crawler = new LolCrawler;
        $matchList = $crawler->matchList($account->user_id);

        if(!$account)
        {
            throw new NotFoundHttpException("the user id : $user_id, not found", 1);
        }

        return $this->render('index', ['matchList' => $matchList, 'account' => $account]);
    }

    public function actionUpdate()
    {
    	$name = \Yii::$app->request->get('name');
    	
    }



}

?>