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
	  <div class="col-md-3"><span class="blod-font"><?=$account['personaname']?></span></div>
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
	  <div class="col-md-6">
	  	<div class="row">
		  <div class="col-md-6">
		  	<span class="normal-font">个人姓名：</span>
		  </div>
		  <div class="col-md-6">
		  	<span class="normal-font"><?=$account['personaname']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-6">
		  	<span class="normal-font">用户等级：</span>
		  </div>
		  <div class="col-md-6">
		  	<span class="normal-font"><?=$account['level']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-6">
		  	<span class="normal-font">最后登录时间：</span>
		  </div>
		  <div class="col-md-6">
		  	<span class="normal-font"><?=date('Y-m-d H:i:s', $account['lastlogoff'])?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-6">
		  	<span class="normal-font">帐号创建时间：</span>
		  </div>
		  <div class="col-md-6">
		  	<span class="normal-font"><?=date('Y-m-d H:i:s', $account['timecreated'])?></span>
		  </div>
		</div>

	  </div>
	  <div class="col-md-4">
	  	<a href="<?=Url::to(['steam/search', 'name' => $name])?>" class="btn btn-primary btn-lg btn-block">返回上一页</a>
	  </div>
	</div>

	</div>

	<div class="row-group">

	<div class="row">
	  <div class="col-md-5">
	  	<span class="blod-font">用户好友列表</span>
	  </div>
	</div>
	<?foreach($account['friends'] ?: [] as $friend){?>
	<div class="row">

	  <div class="col-md-2">
	  	<img  class="img-responsive img-rounded" style="width:80px;" src="<?=$friend['avatar']?>">
	  </div>
	  <div class="col-md-5">
	  	<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">个人姓名：<?=$friend['personaname']?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">最后登录时间：<?=date('Y-m-d H:i:s', $friend['lastlogoff'])?></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
		  	<span class="normal-font">好友确立时间：<?=date('Y-m-d H:i:s', $friend['friend_since'])?></span>
		  </div>
		</div>
	  </div>

	</div>
	<?php }?>
	</div>


	

</div>