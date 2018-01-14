
<div class="content">

<!-- 头部简要信息开始 -->
<div class="row-group">
<div class="row">
  <div class="col-md-6"><span class="blod-font">号角个人游戏数据查询系统 - 内部版</span></div>
  <div class="col-md-6"><a href="<?=Url::to(['game/search'])?>" class="btn btn-default">返回查询页</a></div>
</div>

<div class="row">
  <div class="col-md-3"><span class="blod-font">游戏名</span></div>
  <div class="col-md-3"><span class="blod-font">绝地求生</span></div>
</div>

<div class="row">
  <div class="col-md-3"><span class="blod-font">用户名/游戏ID</span></div>
  <div class="col-md-3"><span class="blod-font"><?=$account->name?></span></div>
</div>
</div>
<!-- 头部简要信息结束 -->

<!-- 总场数开始 -->
<div class="row-group">
<div class="row">
  <div class="col-md-3">
  	<div class="group-font">
  		<span class="normal-font group-font-left">总场数</span>
  		<span class="normal-font group-font-right"><?=$account->total_num?></span>
  	</div>
  </div>
  <div class="col-md-3">
  	<div class="group-font">
  		<span class="normal-font group-font-left">服务器</span>
  		<span class="normal-font group-font-right"><?=$account->serverName?></span>
  	</div>
  </div>
</div>
</div>
<!-- 总场数结束 -->



<?php
$rankList = ['single' => '单排', 'double' => '双排', 'four' => '四排'];
foreach($rankList as $keyName => $name){
?>
<!-- 单排/双排/四排 开始 -->
<div class="row-group">
<div class="row">
  <div class="col-md-1"><span class="blod-font"><?=$name ?></span></div>
</div>

<div class="row">
  <div class="col-md-3">
  	<div class="group-font">
  		<span class="normal-font group-font-left">Ranking分</span>
  		<span class="normal-font group-font-right"><?=$account->{$keyName . '_score'}?></span>
  	</div>
  </div>

  <div class="col-md-3">
  	<div class="group-font">
  		<span class="normal-font group-font-left">场数</span>
  		<span class="normal-font group-font-right"><?=$account->{$keyName . '_num'}?></span>
  	</div>
  </div>

  <div class="col-md-3">
  	<div class="group-font">
  		<span class="normal-font group-font-left">胜率</span>
  		<span class="normal-font group-font-right"><?=$account->{$keyName . '_win_rate'}?>%</span>
  	</div>
  </div>

  <div class="col-md-3">
  	<div class="group-font">
  		<span class="normal-font group-font-left">Top10率</span>
  		<span class="normal-font group-font-right"><?=$account->{$keyName . '_top10_rate'}?>%</span>
  	</div>
  </div>
</div>
  <div class="row">
  <div class="col-md-3">
  	<div class="group-font">
  		<span class="normal-font group-font-left">平均排名</span>
  		<span class="normal-font group-font-right"><?=$account->{$keyName . '_avg_rank'}?></span>
  	</div>
  </div>

  <div class="col-md-3">
  	<div class="group-font">
  		<span class="normal-font group-font-left">K/D</span>
  		<span class="normal-font group-font-right"><?=$account->{$keyName . '_kd'}?></span>
  	</div>
  </div>

  <div class="col-md-3">
  	<div class="group-font">
  		<span class="normal-font group-font-left">爆头率</span>
  		<span class="normal-font group-font-right"><?=$account->{$keyName . '_headshot_rate'}?>%</span>
  	</div>
  </div>

  <div class="col-md-3">
  	<div class="group-font">
  		<span class="normal-font group-font-left">场均伤害</span>
  		<span class="normal-font group-font-right"><?=$account->{$keyName . '_avg_hurt'}?></span>
  	</div>
  </div>
</div>
  <div class="row">
  <div class="col-md-3">
  	<div class="group-font">
  		<span class="normal-font group-font-left">KDA</span>
  		<span class="normal-font group-font-right"><?=$account->{$keyName . '_kda'}?></span>
  	</div>
  </div>

  <div class="col-md-3">
  	<div class="group-font">
  		<span class="normal-font group-font-left">最多击杀</span>
  		<span class="normal-font group-font-right"><?=$account->{$keyName . '_max_kill'}?></span>
  	</div>
  </div>

  <div class="col-md-6">
  	<div class="group-font">
  		<span class="normal-font group-font-left">平均生存时间</span>
  		<span class="normal-font group-font-right"><?=$account->{$keyName . '_avg_lifetime'}?></span>
  	</div>
  </div>
</div>

</div>
<!-- 单排/双排/四排 结束 -->
<?php }?>



<!-- 最近战绩 开始 -->
<div class="row-group">
<div class="row">
  <div class="col-md-1"><span class="blod-font">最近战绩</span></div>
</div>

<!-- 
1 2 2 3 4  ＊ 3
1 4 4 4
1 1
1 1 1 2 2 1 ＊ 2
1 2
1 1 2 2 1 
 -->
 <?php
$matches = $account->matches;

foreach($matches ?: [] as $index => $match){
 ?>
<div class="match-detail">
<div class="row">
  <div class="col-md-1">
  	<span class="blod-font">#<?=$index + 1?></span>
  </div>
  <div class="col-md-2">
	<div class="group-font">
		<span class="normal-font group-font-left">模式</span>
		<span class="normal-font group-font-right"><?=$match['match_type']?></span>
	</div>
  </div>
  <div class="col-md-2">
  	<div class="group-font">
		<span class="normal-font group-font-left">日期</span>
		<span class="normal-font group-font-right"><?=date('Y/m/d H:i', $match['match_date'])?></span>
	</div>
  </div>
  <div class="col-md-3">
  	<div class="group-font">
		<span class="normal-font group-font-left">所用时间</span>
		<span class="normal-font group-font-right"><?=$match['match_time']?></span>
	</div>
  </div>
  <div class="col-md-4">
  	<div class="group-font">
		<span class="normal-font group-font-left">排名</span>
		<span class="normal-font group-font-right"><?=$match['match_rank']?></span>
	</div>
  </div>
</div>

<div class="row">
  <div class="col-md-1">
  	<span class="blod-font"></span>
  </div>
  <div class="col-md-2">
	<div class="group-font">
		<span class="normal-font group-font-left">伤害</span>
		<span class="normal-font group-font-right"><?=$match['match_hurt']?></span>
	</div>
  </div>
  <div class="col-md-2">
  	<div class="group-font">
		<span class="normal-font group-font-left">击杀</span>
		<span class="normal-font group-font-right"><?=$match['match_kill']?></span>
	</div>
  </div>
  <div class="col-md-3">
  	<div class="group-font">
		<span class="normal-font group-font-left">爆头</span>
		<span class="normal-font group-font-right"><?=$match['match_headshot']?></span>
	</div>
  </div>
  <div class="col-md-4">
  	<div class="group-font">
		<span class="normal-font group-font-left">治疗次数及增强次数</span>
		<span class="normal-font group-font-right"><?=$match['match_healthy_num']?>/<?=$match['match_strong_num']?></span>
	</div>
  </div>
</div>

<div class="row">
  <div class="col-md-1">
  	<span class="blod-font"></span>
  </div>
  <div class="col-md-2">
	<div class="group-font">
		<span class="normal-font group-font-left">K/D</span>
		<span class="normal-font group-font-right"><?=$match['match_kd']?></span>
	</div>
  </div>
  <div class="col-md-2">
  	<div class="group-font">
		<span class="normal-font group-font-left">助攻</span>
		<span class="normal-font group-font-right"><?=$match['match_assistant_num']?></span>
	</div>
  </div>
  <div class="col-md-3">
  	<div class="group-font">
		<span class="normal-font group-font-left">击倒</span>
		<span class="normal-font group-font-right"><?=$match['match_down_num']?></span>
	</div>
  </div>
  <div class="col-md-4">
  	<div class="group-font">
		<span class="normal-font group-font-left">被救起次数</span>
		<span class="normal-font group-font-right"><?=$match['match_by_help_num']?></span>
	</div>
  </div>
</div>

<div class="row">
  <div class="col-md-1">
  	<span class="blod-font"></span>
  </div>
  <div class="col-md-3">
  	<div class="group-font">
		<span class="normal-font group-font-left">移动距离</span>
		<span class="normal-font group-font-right"><?=$match['match_move_distance']?>KM</span>
	</div>
  </div>
  <div class="col-md-3">
  	<div class="group-font">
		<span class="normal-font group-font-left">行走距离</span>
		<span class="normal-font group-font-right"><?=$match['match_walk_distance']?>KM</span>
	</div>
  </div>
  <div class="col-md-3">
  	<div class="group-font">
		<span class="normal-font group-font-left">搭乘距离</span>
		<span class="normal-font group-font-right"><?=$match['match_travel_distance']?>KM</span>
	</div>
  </div>
</div>


<?php
$killList = $match->match_kill_list;
if($killList)
{
	$killList = json_decode($killList, true);
	if($killList){
	?>

<div class="row">
  <div class="col-md-1">
  	<span class="blod-font"></span>
  </div>
  <div class="col-md-1">
  	<span class="blod-font">击杀</span>
  </div>
</div>

	<?php
	}
}

foreach($killList ?: [] as $i => $kill){
?>

<div class="row">
  <div class="col-md-1">
  	<span class="blod-font"></span>
  </div>
  <div class="col-md-1">
  	<span class="normal-font"><?= str_pad($i, 2, STR_PAD_LEFT)?></span>
  </div>
  <div class="col-md-1">
  	<span class="normal-font"><?=$kill['time']?></span>
  </div>
  <div class="col-md-2">
  	<span class="normal-font"><?=$kill['name']?></span>
  </div>
  <div class="col-md-3">
  	<span class="normal-font"><?=$kill['description']?></span>
  </div>
  <div class="col-md-1">
  	<span class="normal-font"></span>
  </div>
</div>
<?php }?>


<?php
$be_killList = $match->match_be_kill_list;
if($be_killList)
{
	$be_killList = json_decode($be_killList, true);
	if($be_killList){
	?>

<div class="row">
  <div class="col-md-1">
  	<span class="blod-font"></span>
  </div>
  <div class="col-md-1">
  	<span class="blod-font">被击杀</span>
  </div>
</div>

	<?php
	}
}

foreach($be_killList ?: [] as $i => $be_kill){
?>

<div class="row">
  <div class="col-md-1">
  	<span class="blod-font"></span>
  </div>
  <div class="col-md-1">
  	<span class="normal-font"><?= str_pad($i, 2, STR_PAD_LEFT)?></span>
  </div>
  <div class="col-md-1">
  	<span class="normal-font"><?=$be_kill['time']?></span>
  </div>
  <div class="col-md-2">
  	<span class="normal-font"><?=$be_kill['name']?></span>
  </div>
  <div class="col-md-3">
  	<span class="normal-font"><?=$be_kill['description']?></span>
  </div>
  <div class="col-md-1">
  	<span class="normal-font"></span>
  </div>
</div>
<?php }?>

</div>
<?php }?>

</div>
<!-- 最近战绩 结束 -->

</div>

</div>
</div>
