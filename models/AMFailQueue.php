<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "AM_failQueue".
 *
 * @property integer $queue_id
 * @property string $mobile
 * @property string $userIn.userPasswd
 * @property string $imei
 * @property string $token
 * @property string $imsi
 * @property string $remark
 * @property integer $count
 * @property string $createtime
 * @property integer $isDelete
 */
class AMFailQueue extends Basic
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'AM_failQueue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mobile', 'userIn.userPasswd'], 'required'],
            [['count', 'isDelete'], 'integer'],
            [['createtime'], 'safe'],
            [['mobile'], 'string', 'max' => 30],
            [['userIn.userPasswd'], 'string', 'max' => 64],
            [['imei', 'token', 'imsi', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'queue_id' => 'Queue ID',
            'mobile' => 'Mobile',
            'userIn.userPasswd' => 'User In User Passwd',
            'imei' => 'Imei',
            'token' => 'Token',
            'imsi' => 'Imsi',
            'remark' => 'Remark',
            'count' => 'Count',
            'createtime' => 'Createtime',
            'isDelete' => 'Is Delete',
        ];
    }
}
