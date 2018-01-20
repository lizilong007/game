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

	<div class="row">
	  <div class="col-md-12">
	  	<span class="blod-font">用户资料</span>
	  </div>
	</div>
	<div class="row">
	  <div class="col-md-2">
	  	<!-- 头像 -->
	  	<img  class="img-responsive img-rounded" style="width:100px;" src="<?=$account['avatar']?>">
	  </div>
	  <div class="col-md-10">
	  	<div class="row">
		  <div class="col-md-2">
		  	<span class="normal-font">等级：<?=$account['grade']?></span>
		  </div>
		  <div class="col-md-2">
		  	<span class="normal-font">奖杯总数：<?=$account['total']?></span>
		  </div>
		  <div class="col-md-3">
		  	<span class="normal-font">玩过的游戏：<?=$account['played']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-2">
		  	<span class="normal-font">白金杯：<?=$account['platinum']?></span>
		  </div>
		  <div class="col-md-2">
		  	<span class="normal-font">金杯：<?=$account['gold']?></span>
		  </div>
		  <div class="col-md-2">
		  	<span class="normal-font">银杯：<?=$account['silver']?></span>
		  </div>
		  <div class="col-md-2">
		  	<span class="normal-font">铜杯：<?=$account['bronze']?></span>
		  </div>
		</div>
		<div class="row">
		 <div class="col-md-3">
		  	<span class="normal-font">全部通关的游戏：<?=$account['completed']?></span>
		  </div>
		  <div class="col-md-3">
		  	<span class="normal-font">完成率：<?=$account['completion']?></span>
		  </div>
		  <div class="col-md-3">
		  	<span class="normal-font">未获得的奖杯：<?=$account['unearned_trophies']?></span>
		  </div>
		</div>
	  </div>
	</div>

	</div>

	<div class="row-group">

	<div class="row">
	  <div class="col-md-12">
	  	<span class="blod-font">游戏资料</span>
	  </div>
	</div>
	<?foreach($account['gameList'] ?: [] as $game){?>
	<div class="row">
	  <div class="col-md-2">
	  	<img  class="img-responsive img-rounded" style="width:100px;" src="<?=$game['avatar']?>">
	  </div>
	  <div class="col-md-10">
	  	<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font"><?=$game['name']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font"><?=$game['trophies']?> 奖杯数</span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font"><?=implode('/', $game['platforms'])?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">Rank: <?=$game['rank']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-2">
		  	<span class="normal-font">金杯：<?=$game['gold']?></span>
		  </div>
		  <div class="col-md-2">
		  	<span class="normal-font">银杯：<?=$game['silver']?></span>
		  </div>
		  <div class="col-md-2">
		  	<span class="normal-font">铜杯：<?=$game['bronze']?></span>
		  </div>
		</div>
	  </div>
	</div>
	<?php }?>
	</div>

	

</div>