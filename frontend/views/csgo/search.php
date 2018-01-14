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
	  <div class="col-md-3"><span class="blod-font">CS GO</span></div>
	</div>

	</div>
	<!-- 头部简要信息结束 -->
<?php
$statData = $account['playerstats']['stats'];
$stat = [];
foreach($statData ?: [] as $s)
{
	$stat[$s['name']] = $s['value'];
}
?>
	<div class="row-group">
	<div class="row">
	  <div class="col-md-12">
	  	<span class="blod-font">玩家综合战绩</span>
	  </div>
	</div>

	<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">击杀数=<?=$stat['total_kills']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">游戏时间=<?=$stat['total_time_played']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">MVP获得次数=<?=$stat['total_mvps']?> 	</span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">炸弹放置次数=<?=$stat['total_planted_bombs']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">人质拯救次数=<?=$stat['total_rescued_hostages']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">死亡数=<?=$stat['total_deaths']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">金钱获得数=<?=$stat['total_money_earned']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">总伤害=<?=$stat['total_damage_done']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">拆除炸弹数=<?=$stat['total_defused_bombs']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">比赛场数=<?=$stat['total_matches_played']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">比赛赢得数=<?=$stat['total_matches_won']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">回合次数=<?=$stat['total_rounds_play']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">回合赢得数=<?=$stat['total_wins']?>  </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">武器給队友数=<?=$stat['total_weapons_donated']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">手雷击杀数=<?=$stat['total_kills_hegrenade']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">使用敌方武器击杀数=<?=$stat['total_kills_enemy_weapon']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">盲杀数=<?=$stat['total_kills_enemy_blinded']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">匕首击杀数=<?=$stat['total_kills_knife']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">狙杀数=<?=$stat['total_kills_against_zoomed_sniper']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">爆头数=<?=$stat['total_kills_headshot']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">贡献分数=<?=$stat['total_contribution_score']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">开火数=<?=$stat['total_shots_fired']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">命中数=<?=$stat['total_shots_hit']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">控制=<?=$stat['total_dominations']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">赶尽杀绝=<?=$stat['total_domination_overkills']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">复仇=<?=$stat['total_revenges']?>  </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">手枪局获胜数=<?=$stat['total_gun_game_rounds_won']?>  </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">手枪局局数=<?=$stat['total_gun_game_rounds_played']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">窗户毁坏数=<?=$stat['total_broken_windows']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">匕首局击杀数=<?=$stat['total_kills_knife_fight']?> </span>
	  </div>
	</div>

	</div>


	<div class="row-group">
	<div class="row">
	  <div class="col-md-12">
	  	<span class="blod-font">玩家最近战绩</span>
	  </div>
	</div>

	<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">上一局比赛警方获胜数=<?=$stat['last_match_ct_wins']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">上一局比赛匪徒获胜数=<?=$stat['last_match_t_wins']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">上一局比赛最多玩家=<?=$stat['last_match_max_players']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">上一局比赛击杀=<?=$stat['last_match_kills']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">上一局比赛死亡=<?=$stat['last_match_deaths']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">上一局比赛伤害=<?=$stat['last_match_damage']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">上一局比赛消费=<?=$stat['last_match_money_spent']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">上一局比赛贡献分数=<?=$stat['last_match_contribution_score']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">上一局比赛MVP获得次数=<?=$stat['last_match_mvps']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">上一局比赛回合数=<?=$stat['last_match_rounds']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">上一局比赛控制数=<?=$stat['last_match_dominations']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">上一局比赛最爱用的武器=<?=$stat['last_match_favweapon_id']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">上一局比赛最爱用武器开火数=<?=$stat['last_match_favweapon_shots']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">上一局比赛最爱用武器命中数=<?=$stat['last_match_favweapon_hits']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">上一局比赛最爱用武器击杀数=<?=$stat['last_match_favweapon_kills']?> </span>
	  </div>
	</div>
<div class="row">
	  <div class="col-md-12">
	  	<span class="normal-font">上一局比赛复仇数=<?=$stat['last_match_revenges']?> </span>
	  </div>
	</div>

	</div>
	

</div>