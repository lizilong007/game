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
	  <div class="col-md-3"><span class="blod-font">DOTA2</span></div>
	</div>
	</div>
	<!-- 头部简要信息结束 -->

	<!-- 账号列表 -->
	<?php foreach($accountList ?: [] as $player){?>
	<div class="row-group">
	<div class="row">
	  <div class="col-md-2">
	  	<!-- 头像 -->
	  	<img src="<?=$player['avatarfull']?>" class="img-responsive img-rounded" style="width: 80px;">
	  </div>
	  <div class="col-md-5">
	  	<div class="row">
		  <div class="col-md-12"><span class="blod-font"><?=$player['personaname']?></span></div>
		</div>
		<div class="row">
		  <div class="col-md-12"><span class="normal-font">ID：<?=$player['account_id']?></span></div>
		</div>
		<div class="row">
		  <div class="col-md-12"><span class="normal-font">最后上线时间：<?=date('Y-m-d H:i:s', strtotime($player['last_match_time']))?></span></div>
		</div>
	  </div>

	  <div class="col-md-5">
	  	<a href="<?=Url::to(['dota2/index', 'account_id' => $player['account_id']])?>" class="btn btn-default btn-lg">详情</a>
	  </div>

	</div>
	</div>
	<?php }?>
	<!-- 账号列表 -->

</div>