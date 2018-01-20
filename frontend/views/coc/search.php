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
	</div>

	<div class="row-group">
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">玩家名字：<?=$account['name']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">城镇等级：<?=$account['townHallLevel']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">玩家等级：<?=$account['expLevel']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">奖杯数：<?=$account['trophies']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">最高奖杯：<?=$account['bestTrophies']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">战斗星数：<?=$account['warStars']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">攻击获胜次数：<?=$account['attackWins']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">防御获胜次数：<?=$account['defenseWins']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">对战奖杯：<?=$account['versusTrophies']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">对战最高奖杯：<?=$account['bestVersusTrophies']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">对战获胜次数：<?=$account['versusBattleWins']?></span>
		  </div>
		</div>

	</div>

	<div class="row-group">
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">部落名称：<?=$account['clan']['name']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">部落等级：<?=$account['clan']['clanLevel']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">联赛所处级别：<?=$account['league']['name']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">联赛奖杯总数：<?=$account['legendStatistics']['legendTrophies']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">上赛季排名：<?=$account['legendStatistics']['previousSeason']['rank']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">上赛季奖杯数：<?=$account['legendStatistics']['previousSeason']['trophies']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">最好赛季排名：<?=$account['legendStatistics']['bestSeason']['rank']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">最好赛季奖杯数：<?=$account['legendStatistics']['bestSeason']['trophies']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">当前赛季排名：<?=$account['legendStatistics']['currentSeason']['rank']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">当前奖杯数：<?=$account['legendStatistics']['currentSeason']['trophies']?></span>
		  </div>
		</div>

	</div>

	<div class="row-group">

	<div class="row">
	  <div class="col-md-12">
	  	<span class="blod-font">军队信息</span>
	  </div>
	</div>
	<?foreach($account['troops'] ?: [] as $game){?>
	<div class="row">
	  <div class="col-md-3">
	  	<span class="normal-font"><?=$game['name']?></span>
	  </div>
	  <div class="col-md-3">
	  	<span class="normal-font">当前等级：<?=$game['level']?></span>
	  </div>
	  <div class="col-md-3">
	  	<span class="normal-font">最大等级：<?=$game['maxLevel']?></span>
	  </div>
	</div>
	<?php }?>
	</div>

	<div class="row-group">

	<div class="row">
	  <div class="col-md-12">
	  	<span class="blod-font">英雄信息</span>
	  </div>
	</div>
	<?foreach($account['heroes'] ?: [] as $game){?>
	<div class="row">
	  <div class="col-md-3">
	  	<span class="normal-font"><?=$game['name']?></span>
	  </div>
	  <div class="col-md-3">
	  	<span class="normal-font">当前等级：<?=$game['level']?></span>
	  </div>
	  <div class="col-md-3">
	  	<span class="normal-font">最大等级：<?=$game['maxLevel']?></span>
	  </div>
	</div>
	<?php }?>
	</div>

	<div class="row-group">

	<div class="row">
	  <div class="col-md-12">
	  	<span class="blod-font">法术信息</span>
	  </div>
	</div>
	<?foreach($account['spells'] ?: [] as $game){?>
	<div class="row">
	  <div class="col-md-3">
	  	<span class="normal-font"><?=$game['name']?></span>
	  </div>
	  <div class="col-md-3">
	  	<span class="normal-font">当前等级：<?=$game['level']?></span>
	  </div>
	  <div class="col-md-3">
	  	<span class="normal-font">最大等级：<?=$game['maxLevel']?></span>
	  </div>
	</div>
	<?php }?>
	</div>

	

</div>