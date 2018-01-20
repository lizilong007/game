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
	  <div class="col-md-3"><span class="blod-font">英雄联盟</span></div>
	</div>

	<div class="row">
	  <div class="col-md-3"><span class="blod-font">用户名/游戏ID</span></div>
	  <div class="col-md-3"><span class="blod-font"><?=$name?></span></div>
	</div>
	</div>
	<!-- 头部简要信息结束 -->

	<!-- 账号列表 -->
	<?php foreach($accountList['player_list'] ?: [] as $player){?>
	<div class="row-group">
	<div class="row">
	  <div class="col-md-2">
	  	<!-- 头像 -->
	  	<img src="<?=\common\models\LolAccount::getAvatar($player['icon'])?>" class="img-responsive img-rounded">
	  </div>
	  <div class="col-md-5">
	  	<div class="row">
		  <div class="col-md-6"><span class="normal-font"><?=$player['game_zone']['server_name'] .' '. $player['game_zone']['alias']?></span></div>
		  <div class="col-md-6"><span class="normal-font">等级：<?=$player['level']?></span></div>
		</div>

		<div class="row">
		  <div class="col-md-6"><span class="normal-font">隐藏分：<?=$player['box_score']?></span></div>
		  <div class="col-md-6"><span class="normal-font">段位：<?=$player['tier_rank']['tier']['name_cn'] . $player['tier_rank']['rank']['name'] ?: '无段位'?></span></div>
		</div>
	  </div>

	  <div class="col-md-5">
	  	<a href="<?=Url::to(['lol/index', 'user_id' => $player['user_id']])?>" class="btn btn-default btn-lg">详情</a>
	  </div>

	</div>
	</div>
	<?php }?>
	<!-- 账号列表 -->

</div>