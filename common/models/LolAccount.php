<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

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
class LolAccount extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lol_account}}';
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

    public function avatar()
    {
        return "http://static.lolbox.duowan.com/images/profile_icons/".$this->icon.".jpg";
    }

    public function getAvatar($icon)
    {
        return "http://static.lolbox.duowan.com/images/profile_icons/".$icon.".jpg";
    }

    public function getChampionAvatar($key)
    {
        return "http://ossweb-img.qq.com/images/lol/img/champion/$key.png";
    }

    public static function createOrUpdate($data)
    {
        $time = time();
        $account = LolAccount::findOne(['name' => $data['pn'], 'user_id' => $data['user_id']]);

        if(!$account)
        {
            $account = new LolAccount;
            $account->created_at = $time;
            
        }
        $account->name = $data['pn'];
        $account->user_id = $data['user_id'];
        $account->server_name = $data['game_zone']['server_name'];
        $account->server_alias = $data['game_zone']['alias'];
        $account->level = $data['level'];
        $account->box_score = $data['box_score'];
        $account->tier = $data['tier_rank']['tier']['name_cn'];
        $account->rank = $data['tier_rank']['rank']['name'];
        $account->icon = $data['icon'];
        $account->updated_at = $time;

        return $account->save();
    }


}
