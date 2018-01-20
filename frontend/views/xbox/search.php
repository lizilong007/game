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
	<?php
		$totalScore = array_sum(array_map(function($one){return $one['currentGamerscore'];}, $account['one'])) + array_sum(array_map(function($box360){return $box360['currentGamerscore'];}, $account['box360']));
	?>
	<div class="row-group">
		<div class="row">
		  <div class="col-md-12">
		  	<span class="blod-font">用户资料</span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-2">
		  	<!-- 头像 -->
		  	<img  class="img-responsive img-rounded" style="width:100px;" src="<?=$account['GameDisplayPicRaw']?>">
		  </div>
		  <div class="col-md-5">
		  	<span class="normal-font"><?=$totalScore?></span>
		  </div>
		</div>
	</div>

	<div class="row-group">

		<div class="row">
		  <div class="col-md-12">
		  	<span class="blod-font">用户最近玩过的游戏</span>
		  </div>
		</div>
		<?foreach($account['recent'] ?: [] as $game){?>
		<div class="row">
		  <div class="col-md-5">
		  	<img  class="img-responsive img-rounded" style="width: 100px;height: 100px;" src="<?=$game['contentImageUri']?>">
		  </div>
		  <div class="col-md-7" style="    padding-top: 2rem;">
		  	<span class="normal-font"><?=$game['contentTitle']?></span>
		  </div>
		</div>
		<?php }?>
	</div>


	<div class="row-group">

		<div class="row">
		  <div class="col-md-12">
		  	<span class="blod-font">用户拥有的XBOX one游戏</span>
		  </div>
		</div>
		<?foreach($account['one'] ?: [] as $game){?>
		<div class="row">
		  <div class="col-md-5">
		  	<span class="normal-font"><?=$game['name']?></span>
		  </div>
		  <div class="col-md-7">
		  	<span class="normal-font">成就数：<?=$game['earnedAchievements']?> 当前游戏积分：<?=$game['currentGamerscore']?></span>
		  </div>
		</div>
		<?php }?>
	</div>


	<div class="row-group">

		<div class="row">
		  <div class="col-md-12">
		  	<span class="blod-font">用户拥有的XBOX 360游戏</span>
		  </div>
		</div>
		<?foreach($account['box360'] ?: [] as $game){?>
		<div class="row">
		  <div class="col-md-5">
		  	<span class="normal-font"><?=$game['name']?></span>
		  </div>
		  <div class="col-md-7">
		  	<span class="normal-font">成就数：<?=$game['earnedAchievements']?> 当前游戏积分：<?=$game['currentGamerscore']?></span>
		  </div>
		</div>
		<?php }?>
	</div>

	

</div>