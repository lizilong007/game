<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use yii\web\View;

use common\crawler\D3Crawler;


/**
 * Site controller
 */
class D3Controller extends Controller
{
    public $gameId = \common\crawler\CrawlerBase::D3;
    // 搜索
    public function actionSearch()
    {
        $this->layout = 'default.php';
        $this->view->title = '号角个人游戏数据查询系统 - 内部版';
        $name = \Yii::$app->request->get('name');

        $crawler = new D3Crawler;
        try {
            $account = $crawler->account($name);
        } catch (\Exception $e) {
            throw new NotFoundHttpException("crawler role name : $name, not found." . $e->getMessage(), 1);
        }
        if(!$account)
        {
            throw new NotFoundHttpException("crawler role name : $name, not found." . $e->getMessage(), 1);
        }

        return $this->render('search', ['account' => $account , 'name' => $name]);
    }

    public function actionHero()
    {
        $this->layout = 'default.php';
        $this->view->title = '号角个人游戏数据查询系统 - 内部版';
        $name = \Yii::$app->request->get('name');
        $heroId = \Yii::$app->request->get('heroId');

        $crawler = new D3Crawler;
        try {
            $hero = $crawler->hero($name, $heroId);
        } catch (\Exception $e) {
            throw new NotFoundHttpException("crawler role name : $name, not found." . $e->getMessage(), 1);
        }
        if(!$hero)
        {
            throw new NotFoundHttpException("crawler role name : $name, not found." . $e->getMessage(), 1);
        }

        // 需要展示的数据

        // followers下的内容全部删除
        // progrecession下的内容全部删除
        unset($hero['followers']);
        unset($hero['progression']);

        // SKILLS 下只保留 
        // slug 
        // name
        // level
        // description
        // simpledescription

        // rune下只保留
        // name
        // level
        // description
        // simplediscription
        array_walk($hero['skills']['active'], function(&$value, $key){
            unset($value['skill']['icon']);
            unset($value['skill']['categorySlug']);
            unset($value['skill']['tooltipUrl']);
            unset($value['skill']['skillCalcId']);
            unset($value['rune']['slug']);
            unset($value['rune']['type']);
            unset($value['rune']['tooltipParams']);
            unset($value['rune']['skillCalcId']);
            unset($value['rune']['order']);
        });
        array_walk($hero['skills']['passive'], function(&$value, $key){
            unset($value['skill']['icon']);
            unset($value['skill']['categorySlug']);
            unset($value['skill']['tooltipUrl']);
            unset($value['skill']['skillCalcId']);
            unset($value['rune']['slug']);
            unset($value['rune']['type']);
            unset($value['rune']['tooltipParams']);
            unset($value['rune']['skillCalcId']);
            unset($value['rune']['order']);
        });
        
        // items下只保留
        // 各类部位 如mainhand等
        // 下面保留
        // id
        // name
        array_walk($hero['items'], function(&$value, $key){
            unset($value['icon']);
            unset($value['displayColor']);
            unset($value['tooltipParams']);
        });

        // stats 全部保留

        $heroJson = addcslashes(json_encode($hero), "\n");

        $this->view->registerJs("var str = '".$heroJson."';resultStr = str.replace(/[\\r\\n]/g, '');var data = JSON.parse(resultStr);$('#json-renderer').jsonViewer(data, {collapsed: false, withQuotes: true});", View::POS_READY);

        $this->view->registerCssFile('@web/js/jquery.json-viewer/json-viewer/jquery.json-viewer.css');

        return $this->render('hero', ['hero' => $hero , 'name' => $name]);
    }



}

?>