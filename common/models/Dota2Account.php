<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

use yii\web\NotFoundHttpException;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class Dota2Account extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dota2_account}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }

    public function attributeLabels()
    {
        return [
        ];
    }


    public static function createOrUpdate($data)
    {
        $time = time();
        $account = Dota2Account::findOne(['name' => $data['personaname'], 'account_id' => $data['account_id']]);

        if(!$account)
        {
            $account = new Dota2Account;
            $account->created_at = $time;
            
        }
        $account->name = $data['personaname'];
        $account->account_id = $data['account_id'];
        $account->avatar = $data['avatarfull'];
        $account->last_online_time = strtotime($data['last_match_time']);
        $account->updated_at = $time;

        return $account->save();
    }

    public static function updateRank(&$account, $data)
    {
        if(!$account)
        {
            throw new NotFoundHttpException("the dota2 account, not found", 1);
        }

        $account->solo_competitive_rank = $data['solo_competitive_rank'];
        $account->rank_tier = $data['rank_tier'];
        $account->leaderboard_rank = $data['leaderboard_rank'];
        $account->competitive_rank = $data['competitive_rank'];

        return $account->save();
    }


}
