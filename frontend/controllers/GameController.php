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
    public function actionError()
    {
        $this->layout = 'default.php';
        $this->view->title = '号角个人游戏数据查询系统 - 内部版';
        return $this->render('error');
    }
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
                    $this->redirect(['pubg/search', 'name' => $name]);
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
                case CrawlerBase::PSN:
                    $this->redirect(['psn/search', 'name' => $name]);
                    break;
                case CrawlerBase::STEAM:
                    $this->redirect(['steam/search', 'name' => $name]);
                    break;
                case CrawlerBase::COC:
                    $this->redirect(['coc/search', 'name' => $name]);
                    break;
                case CrawlerBase::CR:
                    $this->redirect(['cr/search', 'name' => $name]);
                    break;
                case CrawlerBase::OW:
                    $this->redirect(['ow/search', 'name' => $name]);
                    break;
                case CrawlerBase::XBOX:
                    $this->redirect(['xbox/search', 'name' => $name]);
                    break;
                
                default:
                    
                    break;
            }
        }

        return $this->render('search');
    }




}

?>