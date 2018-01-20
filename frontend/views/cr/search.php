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
		  	<span class="normal-font">部落名称：<?=$account['clan']?></span>
		  </div>
		</div>
	</div>

	<div class="row-group">
		<div class="row">
		  <div class="col-md-3">
		  	<span class="normal-font">最好赛季：</span>
		  </div>
		  <div class="col-md-3">
		  	<span class="normal-font"><?=$account['best_season']['Trophies']?> 奖杯数</span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-3">
		  	<span class="normal-font">上赛季：</span>
		  </div>
		  <div class="col-md-3">
		  	<span class="normal-font"><?=$account['previous_season']['Trophies']?> 奖杯数</span>
		  </div>
		</div>
	</div>

	<div class="row-group">
		<?php foreach($account['stats'] ?: [] as $stat){?>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font"><?=$stat['name'] ?>：<?=$stat['value']?></span>
		  </div>
		</div>
		<?php }?>
	</div>
<style type="text/css">
	.player_card {
    display: inline-block;
    width: calc(4rem + 4vw);
    max-width: 6rem;
    text-align: center;
    background-size: contain;
    background-repeat: no-repeat;
    position: relative;
    margin-bottom: 0.5rem;
    padding-bottom: 0.5rem;

}

.player_card_enter img {
    background-color: #ffea8b;
    -moz-box-shadow: 0 0 15px #ffdf05;
    -webkit-box-shadow: 0 0 15px #ffdf05;
    box-shadow: 0px 0px 15px #ffdf05;
}

.player_card img {
    display: block;
    max-width: 100%;
}

.player_card * {
    color: black;
}

.cardlevel {
    margin-top: -2.5rem !important;
    margin-bottom: 2rem !important;
    color: white;
    text-shadow: 0 2px 5px #000;
    font-weight: 900;
}

.card_upgrades {
    position: absolute;
    z-index: 200;
    font-size: 0.7rem;
    text-align: center;
    font-weight: 500;
    width: 100%;
    bottom: 0.5rem;

}

.card_progress_bg {
    border-radius: 0.2rem;
    height: 100%;
    width: 100%;
    position: absolute;
    left: 0;
    margin: 0 0;
    top: 0;

}

.card_progress_container {
    border-radius: 0.2rem;
    height: 0.5rem;
    margin: 0 0.4rem 0;
    position: relative;
    max-width: 100%;
    z-index: 100;
    background-color: rgba(0, 0, 0, 0.1);
}

.progress_color_green {
    background-color: rgba(86, 182, 84, 1.000);
}

.progress_color_blue {
    background-color: rgba(60, 133, 202, 1.000);
}

.progress_color_red {
    background-color: rgba(204, 59, 51, 1.000);
}
</style>
	<div class="row-group">
		<div class="row">
		<?php foreach($account['crads'] ?: [] as $card){?>
		  <div class="col-md-2">
		  	<div class="player_card">
                <img class="player_card_img" style="width: 100px;" src="<?=$card['icon']?>">
                <div class="ui center aligned cardlevel"><?=$card['level']?></div>
                <div class="card_progress_container">
                    <?=$card['card_progress_container']?>
                </div>
            </div>
		  </div>
		<?php }?>
		</div>
	</div>

	
	

</div>