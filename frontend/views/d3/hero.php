<?php
use yii\helpers\Url;
?>
<style type="text/css">
	.row {
	    margin: .1rem;
	}
	.hero-row {
		margin: 1rem;
	}
</style>
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

	
	<div class="row-group">
		<div class="row">
		  <div class="col-md-12"><span class="blod-font">主动技能</span></div>
		</div>
		<?php foreach($hero['skills']['active'] ?: [] as $cskill){?>
			<div class="row hero-row">
			  <div class="col-md-2"></div>
			  <div class="col-md-10">
			  	<div class="row">
				  <div class="col-md-12"><span class="normal-font">名称：<?=$cskill['name']?></span></div>
				</div>
				<div class="row">
				  <div class="col-md-12"><span class="normal-font">等级：<?=$cskill['level']?></span></div>
				</div>
				<div class="row">
				  <div class="col-md-12"><span class="normal-font">介绍：<?=$cskill['description']?></span></div>
				</div>
			  </div>
			</div>
		<?php }?>
	</div>

	<div class="row-group">
		<div class="row">
		  <div class="col-md-12"><span class="blod-font">被动技能</span></div>
		</div>
		<?php foreach($hero['skills']['passive'] ?: [] as $pskill){?>
			<div class="row hero-row">
			  <div class="col-md-2"></div>
			  <div class="col-md-10">
			  	<div class="row">
				  <div class="col-md-12"><span class="normal-font">名称：<?=$pskill['name']?></span></div>
				</div>
				<div class="row">
				  <div class="col-md-12"><span class="normal-font">等级：<?=$pskill['level']?></span></div>
				</div>
				<div class="row">
				  <div class="col-md-12"><span class="normal-font">介绍：<?=$pskill['description']?></span></div>
				</div>
			  </div>
			</div>
		<?php }?>
	</div>

	<div class="row-group">
		<div class="row">
		  <div class="col-md-12"><span class="blod-font">符文</span></div>
		</div>
		<?php foreach($hero['rune'] ?: [] as $rune){?>
			<div class="row hero-row">
			  <div class="col-md-2"></div>
			  <div class="col-md-10">
			  	<div class="row">
				  <div class="col-md-12"><span class="normal-font">名称：<?=$rune['name']?></span></div>
				</div>
				<div class="row">
				  <div class="col-md-12"><span class="normal-font">等级：<?=$rune['level']?></span></div>
				</div>
				<div class="row">
				  <div class="col-md-12"><span class="normal-font">介绍：<?=$rune['description']?></span></div>
				</div>
			  </div>
			</div>
		<?php }?>
	</div>

	<div class="row-group">
		<div class="row">
		  <div class="col-md-12"><span class="blod-font">装备</span></div>
		</div>
		<?php foreach($hero['items'] ?: [] as $item){?>
			<div class="row hero-row">
			  <div class="col-md-2"></div>
			  <div class="col-md-10">
			  	<div class="row">
				  <div class="col-md-12"><span class="normal-font">部位：<?=$item['position']?></span></div>
				</div>
				<div class="row">
				  <div class="col-md-12"><span class="normal-font">名称：<?=$item['name']?></span></div>
				</div>
			  </div>
			</div>
		<?php }?>
	</div>

	<div class="row-group">
		<div class="row">
		  <div class="col-md-12"><span class="blod-font">卡奈魔盒传奇力量</span></div>
		</div>
		<div class="row">
		  <div class="col-md-2"></div>
		  <div class="col-md-10">
		  	<span class="normal-font"><?=implode(',', $hero['legendaryPowers'])?></span>
		  </div>
		</div>
	</div>

	<div class="row-group">
		<div class="row">
		  <div class="col-md-12"><span class="blod-font">状态数据</span></div>
		</div>
		<?php foreach($hero['stats'] ?: [] as $key => $stat){?>
			<div class="row hero-row">
			  <div class="col-md-2"></div>
			  <div class="col-md-10">
			  	<div class="row">
				  <div class="col-md-12"><span class="normal-font"><?=$key?>：<?=$stat?></span></div>
				</div>
			  </div>
			</div>
		<?php }?>
	</div>


</div>