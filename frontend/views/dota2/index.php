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

	<div class="row-group">
	<div class="row">
	  <div class="col-md-2">
	  	<!-- 头像 -->
	  	<img src="<?=$account->avatar?>" class="img-responsive img-rounded" style="width:80px;">
	  </div>
	  <div class="col-md-7">
	  	<div class="row">
		  <div class="col-md-12"><span class="blod-font"><?=$account->name?></span></div>
		</div>

		<div class="row">
		  <div class="col-md-12"><span class="normal-font">ID：<?=$account->account_id?></span></div>
		</div>
		<div class="row">
		  <div class="col-md-12"><span class="normal-font">最后上线时间：<?=date('Y-m-d H:i:s', $account->last_online_time)?></span></div>
		</div>
	  </div>

	</div>

	<div class="row-group">
	<div class="row">
	  <div class="col-md-4">
	  	<!-- 头像 -->
	  	<span class="blod-font">用户战力</span>
	  </div>
	  </div>
	  <div class="row">
	  <div class="col-md-4">
	  	<!-- 头像 -->
	  	<span class="normal-font">SOLO RANK 分：<?=$account->solo_competitive_rank ?: 0?></span>
	  </div>
	  </div>
	  <div class="row">
	  <div class="col-md-4">
	  	<!-- 头像 -->
	  	<span class="normal-font">RANK 等级：<?=$account->rank_tier ?: 0?></span>
	  </div>
	  </div>
	  <div class="row">
	  <div class="col-md-4">
	  	<!-- 头像 -->
	  	<span class="normal-font">排行榜RANK分：<?=$account->leaderboard_rank ?: 0?></span>
	  </div>
	  </div>
	  <div class="row">
	  <div class="col-md-4">
	  	<!-- 头像 -->
	  	<span class="normal-font">比赛RANK分：<?=$account->competitive_rank ?: 0?></span>
	  </div>
		</div>
	</div>
	</div>


	<div class="row-group">
	<div class="row">
	  <div class="col-md-4">
	  	<!-- 头像 -->
	  	<span class="blod-font">最近比赛</span>
	  </div>

	</div>
	</div>

	<!-- 账号列表 -->
	<?php foreach($matchList ?: [] as $index => $match){?>
	
	<div class="row-group">
	<div class="row">
	  <div class="col-md-2">
	  	<span class="blod-font">#<?=$index + 1?></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">比赛ID:<?=$match['match_id']?></span>
	  </div>
	</div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">比赛持续时间:<?=\common\helper\NumberHelper::secToTime($match['duration'])?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">比赛开始时间:<?=date('Y-m-d H:i:s', $match['start_time'])?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">英雄ID:<?=$match['hero_id']?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">击杀:<?=$match['kills']?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">死亡:<?=$match['deaths']?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">助攻:<?=$match['assists']?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">每分钟经验:<?=$match['xp_per_min']?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">每分钟经济:<?=$match['gold_per_min']?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">英雄伤害:<?=$match['hero_damage']?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">建筑伤害:<?=$match['tower_damage']?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">治疗:<?=$match['hero_healing']?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">补刀:<?=$match['last_hits']?></span>
	  </div>
	  </div>
	  
	</div>

	<?php }?>
	<!-- 账号列表 -->

</div>