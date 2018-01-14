<?php
use yii\helpers\Url;
?>
<div class="content" >
  
  <form method="GET" action="<?=Url::to(['game/search'])?>">
  <!-- 头部简要信息开始 -->
  <div class="row-group">
  <div class="row">
    <div class="col-md-12"><span class="blod-font">号角个人游戏数据查询系统 - 内部版</span></div>
  </div>
  </div>

  <div class="row-group">
  <div class="row">
    <div class="col-md-4"><span class="blod-font">选择游戏</span></div>
    <div class="col-md-4">
      <select name="game_id">
        <option value="0">===请选择你要查询的游戏===</option>
        <?php foreach(\common\crawler\CrawlerBase::$games as $id => $gameName){?>
        <option value="<?=$id?>"><?=$gameName?></option>
        <?php }?>
      </select>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4"><span class="blod-font">请输入游戏ID/用户名</span></div>
    <div class="col-md-4">
      <input type="text" name="name" placeholder="">
    </div>
  </div>

  <div class="row">
    <div class="col-md-4"><button type="submit" class="btn btn-primary btn-lg btn-block">查询</button></div>
  </div>
  </div>
</form>

</div>