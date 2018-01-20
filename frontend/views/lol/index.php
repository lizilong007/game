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
		  <div class="col-md-2">
		  	<img  class="img-responsive img-rounded" style="width:80px;" src="<?=$account['avatar']?>">
		  </div>
		  <div class="col-md-10">
		  	<div class="row">
			  <div class="col-md-12">
			  	<span class="normal-font"><?=$account['server']?></span>
			  </div>
			</div>
			<div class="row">
			  <div class="col-md-3">
			  	<span class="normal-font">隐藏分：<?=$account['hide_score']?></span>
			  </div>
			  <div class="col-md-3">
			  	<span class="normal-font">段位：<?=$account['tier']?></span>
			  </div>
			  <div class="col-md-3">
			  	<span class="normal-font">总场次：<?=$account['sum']?></span>
			  </div>
			</div>
			<div class="row">
			  <div class="col-md-3">
			  	<span class="normal-font">胜场：<?=$account['win_sum']?></span>
			  </div>
			  <div class="col-md-3">
			  	<span class="normal-font">负场：<?=$account['defeat_sum']?></span>
			  </div>
			  <div class="col-md-3">
			  	<span class="normal-font">胜率：<?=$account['win_rate']?></span>
			  </div>
			</div>
		  </div>
		</div>
	</div>

	<div class="row-group">
		<div class="row">
		  <div class="col-md-5">
		  	<span class="blod-font">最近战绩</span>
		  </div>
		  <div class="col-md-5">
		  	<a href="<?=Url::to(['lol/search', 'name' => $name])?>" class="btn btn-primary btn-lg ">返回上一页</a>
		  </div>
		  
		</div>
	</div>

<?php
$resultArray = [
	'失败' => '胜利',
	'胜利' => '失败'
];
?>

	<div class="row-group">
		<?php foreach($account['match_list'] ?: [] as $match){
				$randKey = uniqid() . rand(0, 1000);
			?>
		<div class="match">
			<div class="row">
			  <div class="col-md-2">
			  	<img  class="img-responsive img-rounded" style="width:60px;" src="<?=$match['avatar']?>">
			  </div>
			  <div class="col-md-6">
			  	<div class="row">
				  <div class="col-md-12">
				  	<span class="normal-font">模式：<?=$match['type']?> 战斗结果：<?=$match['result']?></span>
				  </div>
				</div>
				<div class="row">
				  <div class="col-md-12">
				  	<span class="normal-font">时间：<?=$match['time']?></span>
				  </div>
				</div>
				<div class="row">
				  <div class="col-md-12">
				  	<span class="normal-font">击杀：<?=$match['kill']?> 死亡：<?=$match['death']?> 助攻：<?=$match['assist']?></span>
				  </div>
				</div>
			  </div>
			  <div class="col-md-4">
			  	<div class="row">
				  <div class="col-md-12">
				  </div>
				</div>
				<div class="row">
				  <div class="col-md-12">
				  	<button type="button" matchkey="<?=$randKey?>" class="btn btn-primary btn-lg btn-block match-detail-button">详情</button>
				  </div>
				</div>
				<div class="row">
				  <div class="col-md-12">
				  </div>
				</div>
			  </div>
			</div>

			<div class="match-detail" id="match-detail-<?=$randKey?>" style="display:none;">
				<div class="row">
				  <div class="col-md-12">
				  <span class="blod-font">我方<?=$match['result']?></span>
				  </div>
				</div>
				<?php foreach($match['our'] ?: [] as $m){?>
				<div class="row">
				  <div class="col-md-2">
				  <img  class="img-responsive img-rounded" style="width:60px;" src="<?=$m['avatar']?>">
				  </div>
				  <div class="col-md-1">
				  <?php foreach($m['spell'] ?: [] as $sp){?>
				  	<div class="row">
					  <img  class="img-responsive img-rounded" style="width:30px;" src="<?=$sp?>">
					</div>
				  <?php }?>
				  </div>
				  <div class="col-md-3">
				  <?php
				  	$equipList = array_chunk($m['equip_icon'], 3);
				  	foreach($equipList ?: [] as $clist){
				  ?>
				  	<div class="row">
				  	<?php foreach($clist ?: [] as $e){?>
					  <div class="col-md-4">
					  <img  class="img-responsive img-rounded" style="width:30px;" src="<?=$e?>">
					  </div>
					  <?php }?>
					</div>
				  <?php }?>
				  </div>
				  <div class="col-md-5">
				  	<div class="row">
					  <div class="col-md-12">
					  <span class="normal-font">KDA：<?=$m['kill']?>/<?=$m['death']?>/<?=$m['assist']?></span>
					  </div>
					</div>
					<div class="row">
					  <div class="col-md-12">
					  <span class="normal-font">输出：<?=$m['export']?></span>
					  </div>
					</div>
					<div class="row">
					  <div class="col-md-12">
					  <span class="normal-font">经济：<?=$m['gold']?></span>
					  </div>
					</div>
				  </div>
				</div>
				<?php }?>

				<div class="row">
				  <div class="col-md-12">
				  <span class="blod-font">敌方<?=$resultArray[$match['result']]?></span>
				  </div>
				</div>
				<?php foreach($match['enemy'] ?: [] as $m){?>
				<div class="row">
				  <div class="col-md-2">
				  <img  class="img-responsive img-rounded" style="width:60px;" src="<?=$m['avatar']?>">
				  </div>
				  <div class="col-md-1">
				  <?php foreach($m['spell'] ?: [] as $sp){?>
				  	<div class="row">
					  <img  class="img-responsive img-rounded" style="width:30px;" src="<?=$sp?>">
					</div>
				  <?php }?>
				  </div>
				  <div class="col-md-3">
				  <?php
				  	$equipList = array_chunk($m['equip_icon'], 3);
				  	foreach($equipList ?: [] as $clist){
				  ?>
				  	<div class="row">
				  	<?php foreach($clist ?: [] as $e){?>
					  <div class="col-md-4">
					  <img  class="img-responsive img-rounded" style="width:30px;" src="<?=$e?>">
					  </div>
					  <?php }?>
					</div>
				  <?php }?>
				  </div>
				  <div class="col-md-5">
				  	<div class="row">
					  <div class="col-md-12">
					  <span class="normal-font">KDA：<?=$m['kill']?>/<?=$m['death']?>/<?=$m['assist']?></span>
					  </div>
					</div>
					<div class="row">
					  <div class="col-md-12">
					  <span class="normal-font">输出：<?=$m['export']?></span>
					  </div>
					</div>
					<div class="row">
					  <div class="col-md-12">
					  <span class="normal-font">经济：<?=$m['gold']?></span>
					  </div>
					</div>
				  </div>
				</div>
				<?php }?>

			</div>

		</div>
		<?php }?>
	</div>

	
</div>




