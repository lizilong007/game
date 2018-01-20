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
	  	<img  class="img-responsive img-rounded" style="width:200px;" src="<?=$account['avatar']?>">
	  </div>
	  <div class="col-md-2">
	  	<img  class="img-responsive img-rounded" style="width:200px;" src="<?=$account['rank_image']?>">
	  </div>
	</div>
	</div>

	<?php
		$statList = [
			'rolling_average_stats' => '精选统计资料',
			'game_stats' => '生涯统计资料',
			'overall_stats' => '整体资料',
		];
	?>
	<?php foreach($account ?: [] as $key => $list){?>
		<?php
			if(in_array($key, ['name', 'avatar', 'rank_image']))
			{
				continue;
			}
		?>
	<div class="row-group">
		<div class="row">
		  <div class="col-md-2">
		  	<span class="blod-font"><?=strtoupper($key)?></span>
		  </div>
		</div>
	  	<?php foreach($list ?: [] as $type => $typeList){?>
	  		<div class="row">
	  			<div class="col-md-2">
	  				<span class="blod-font"><?=($type == 'competitive' ? '天梯' : '快速比赛')?></span>
	  			</div>
	  		</div>
	  		<?php foreach($typeList ?: [] as $statKey => $sList){?>
	  		<div class="row">
	  			<div class="col-md-2">
	  				<span class="blod-font"><?=$statList[$statKey]?></span>
	  			</div>
	  		</div>
	  		
	  		<div class="row">
	  			<div class="col-md-2">
	  				<span class="normal-font"></span>
	  			</div>
	  			<div class="col-md-10">
	  			<?php foreach($sList ?: [] as $s){?>
	  				<div class="col-md-5">
	  				<span class="normal-font"><?=$s['name']?>： <?=$s['value']?></span>
	  				</div>
	  			<?php }?>
	  			</div>
	  		</div>
	  		
	  		<?php }?>
	  	<?php }?>
		
	</div>
	<?php }?>

	
	

</div>