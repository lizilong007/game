<?php
use yii\helpers\Url;
?>
<div class="content">
	
	<!-- 头部简要信息开始 -->
	<div class="row-group">
		
		<div class="row-group">
			<div class="row">
			  <div class="col-md-12" style="text-align:center;"><span class="blod-font">抱歉，查询的角色未找到，请检查角色名是否正确后重试。</span></div>
			</div>
			<div class="row">
			  <div class="col-md-12" style="text-align:center;"><a href="<?=Url::to(['game/search'])?>" class="btn btn-default">返回查询页</a></div>
			</div>
		</div>
	</div>
	<!-- 头部简要信息结束 -->


</div>