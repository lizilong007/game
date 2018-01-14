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
	  <div class="col-md-3"><span class="blod-font">暗黑破坏神3</span></div>
	</div>

	<div class="row">
	  <div class="col-md-3"><span class="blod-font">Battletag</span></div>
	  <div class="col-md-3"><span class="blod-font"><?=$name?></span></div>
	</div>

	</div>
	<!-- 头部简要信息结束 -->
	<div class="row-group">

	<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">战网昵称：<?=$account['battleTag']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">巅峰等级：<?=$account['paragonLevel']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">专家模式巅峰等级：<?=$account['paragonLevelHardcore']?> 	</span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">赛季巅峰等级：<?=$account['paragonLevelSeason']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">赛季专家模式巅峰等级：<?=$account['paragonLevelSeasonHardcore']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">工会名：<?=$account['guildName']?> </span>
	  </div>
	</div>

	</div>


	<!-- 账号列表 -->
	<?php foreach($account['heroes'] ?: [] as $index => $hero){?>
	
	<div class="row-group">
	<div class="row">
	  <div class="col-md-2">
	  	<span class="blod-font">#<?=$index + 1?></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">角色<?=$index + 1?></span>
	  </div>
	</div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">ID：<?=$hero['id']?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">角色名字：<?=$hero['name']?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">职业：<?=$hero['class']?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">性别：<?=$hero['gender'] == 1 ? '女' : '男'?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">等级：<?=$hero['level']?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">击杀：<?=array_sum($hero['kills'])?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">怪物消灭：<?=$hero['kills']['monsters'] ?: 0?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">精英模式击杀：<?=$hero['kills']['elites'] ?: 0?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">专家模式怪物消灭：<?=$hero['kills']['hardcoreMonsters'] ?: 0?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">巅峰等级：<?=$hero['paragonLevel']?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">是否专家模式：<?=$hero['hardcore'] ? '是' : '否'?></span>
	  </div>
	  </div>
	<div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">专家模式最高等级：<?=$hero['highestHardcoreLevel'] ?: 0?></span>
	  </div>
	  </div>
	  <div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">是否是赛季英雄：<?=$hero['seasonal'] ? '是' : '否'?></span>
	  </div>
	  </div>
	  <div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">最后登录：<?=date('Y-m-d H:i:s', $hero['last-updated'])?></span>
	  </div>
	  </div>
	  <div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-7">
	  	<span class="normal-font">是否死亡：<?=$hero['dead'] ? '是' : '否'?></span>
	  </div>
	  </div>

	  <div class="row">
	  <div class="col-md-2">
	  	<span></span>
	  </div>
	  <div class="col-md-5">
	  	<a href="<?=Url::to(['d3/hero', 'heroId' => $hero['id'], 'name' => $name])?>" class="btn btn-primary btn-lg btn-block">详情</a>
	  </div>
	  </div>
	  
	</div>

	<?php }?>
	

</div>