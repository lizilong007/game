<?php
use yii\helpers\Url;
?>
<div class="content">
	
	<!-- 头部简要信息开始 -->
	<div class="row-group">
	<div class="row">
	  <div class="col-md-6"><span class="blod-font">号角个人游戏数据查询系统 - 内部版</span></div>
	  <div class="col-md-6"><a href="<?=Url::to(['game/search'])?>" class="btn btn-default">返回查询页</a></div>
	</div>

	<div class="row">
	  <div class="col-md-3"><span class="blod-font">游戏名</span></div>
	  <div class="col-md-3"><span class="blod-font"><?=$gameName?></span></div>
	</div>

	<div class="row">
	  <div class="col-md-3"><span class="blod-font">游戏名/游戏ID</span></div>
	  <div class="col-md-3"><span class="blod-font"><?=$name?></span></div>
	</div>

	</div>
	<!-- 头部简要信息结束 -->
	<div class="row-group">
	<?php foreach($account ?: [] as $acc){?>
	<div class="row">
	  <div class="col-md-2">
	  	<img  class="img-responsive img-rounded" style="width:80px;" src="<?=$acc['avatar']?>">
	  </div>
	  <div class="col-md-5">
	  	<span class="normal-font"><?=$acc['server']?></span>
	  </div>
	  <div class="col-md-3">
	  	<a href="<?=Url::to(['lol/index', 'accountId' => $acc['accountId'], 'name' => $name])?>" class="btn btn-primary btn-lg btn-block">详情</a>
	  </div>
	</div>
	<?php }?>
	</div>

	
	

</div>