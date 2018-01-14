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
	  <div class="col-md-3"><span class="blod-font"><?=$account->name?></span></div>
	</div>
	</div>
	<!-- 头部简要信息结束 -->

	<div class="row-group">
	<div class="row">
	  <div class="col-md-2">
	  	<!-- 头像 -->
	  	<img src="<?=$account->avatar()?>" class="img-responsive img-rounded">
	  </div>
	  <div class="col-md-5">
	  	<div class="row">
		  <div class="col-md-6"><span class="normal-font"><?=$account->server_name .' '. $account->server_alias?></span></div>
		  <div class="col-md-6"><span class="normal-font">等级：<?=$account->level?></span></div>
		</div>

		<div class="row">
		  <div class="col-md-6"><span class="normal-font">隐藏分：<?=$account->box_score?></span></div>
		  <div class="col-md-6"><span class="normal-font">段位：<?=$account->tier . $account->rank ?: '无段位'?></span></div>
		</div>
	  </div>

	</div>
	</div>

	<div class="row-group">
	<div class="row">
	  <div class="col-md-6">
	  	<!-- 头像 -->
	  	<span class="blod-font">最近战绩</span>
	  </div>
	  <div class="col-md-6">
	  	<a href="" class="btn btn-primary">返回上一页</a>
	  </div>

	</div>
	</div>


	<!-- 账号列表 -->
	<?php foreach($matchList['game_list'] ?: [] as $match){?>
	<a href="<?=Url::to(['lol/match', 'user_id' => $account->user_id, 'match_id' => $match['game_id']])?>">
	<div class="row-group">
	<div class="row">
	  <div class="col-md-2">
	  	<!-- 头像 -->
	  	<img src="<?=\common\models\LolAccount::getChampionAvatar($match['champion']['name'])?>" class="img-responsive img-rounded">
	  </div>
	  <div class="col-md-5">
	  	<div class="row">
		  <div class="col-md-12">
			  <span class="normal-font">
			  	<?=$match['champion']['display_name'] .'-'. $match['champion']['title']?>
			  </span>
		  </div>
		</div>

		<div class="row">
		  <div class="col-md-12">
			  <span class="normal-font">
			  	<?=date('Y-m-d H:i:s', $match['created'])?>
			  </span>
		  </div>
		</div>

		<div class="row">
		  <div class="col-md-12">
			  <span class="normal-font">
			  	<?=$match['game_type']['name_cn']?>
			  </span>
		  </div>
		</div>
	  </div>

	  <div class="col-md-1">
	  	<span class="<?=$match['battle_result'] ? 'success-font' : 'fail-font'?>"><?=$match['battle_result'] ? '胜利' : '失败'?></span>
	  </div>

	</div>
	</div>
	</a>
	<?php }?>
	<!-- 账号列表 -->

</div>