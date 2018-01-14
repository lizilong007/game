<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use common\crawler\CrawlerBase;



/**
 * Site controller
 */
class GameController extends Controller
{
    // 搜索
    public function actionSearch()
    {
        $this->layout = 'default.php';
        $this->view->title = '号角个人游戏数据查询系统 - 内部版';
        $name = \Yii::$app->request->get('name');
        $game_id = \Yii::$app->request->get('game_id');

        if($name && $game_id)
        {
            switch ($game_id) {
                case CrawlerBase::PUBG:
                    $this->redirect(['pubg/index', 'name' => $name]);
                    break;
                case CrawlerBase::LOL:
                    $this->redirect(['lol/search', 'name' => $name]);
                    break;
                case CrawlerBase::DOTA2:
                    $this->redirect(['dota2/search', 'name' => $name]);
                    break;
                case CrawlerBase::CSGO:
                    $this->redirect(['csgo/search', 'name' => $name]);
                    break;
                case CrawlerBase::D3:
                    $this->redirect(['d3/search', 'name' => $name]);
                    break;
                
                default:
                    
                    break;
            }
        }

        return $this->render('search');
    }




}

?>