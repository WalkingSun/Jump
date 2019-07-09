<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "AM_user".
 *
 * @property integer $userid
 * @property string $mobile
 * @property string $password
 * @property string $userIn.userPasswd
 * @property string $imei
 * @property string $token
 * @property string $imsi
 * @property string $remark
 */
class AMUser extends Basic
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'AM_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mobile', 'password', 'userIn.userPasswd'], 'required'],
            [['mobile', 'password'], 'string', 'max' => 30],
            [['userIn.userPasswd', 'imei', 'token', 'imsi', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => 'Userid',
            'mobile' => 'Mobile',
            'password' => 'Password',
            'userIn.userPasswd' => 'User In User Passwd',
            'imei' => 'Imei',
            'token' => 'Token',
            'imsi' => 'Imsi',
            'remark' => 'Remark',
        ];
    }
}
