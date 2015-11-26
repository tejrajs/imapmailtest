<?php

namespace app\modules\mail\models;


use Yii;
use app\modules\mail\components\Crypt;

/**
 * This is the model class for table "{{%mail_detail}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $mail
 * @property string $imapLogin
 * @property string $imapPassword
 */
class MailDetail extends \yii\db\ActiveRecord
{
    public $password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mail_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'incomming', 'imapPath', 'imapLogin'], 'required'],
            [['user_id','active'], 'integer'],
        	['password', 'required', 'on'=>'create'],
            [['type', 'imapPassword','password', 'incomming', 'serverEncoding', 'attachmentsDir', 'imapLogin'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
        	'type' => 'Type',	
        	'incomming' => 'In-Comming Server',
            'imapPath' => 'Imap Path',
            'serverEncoding' => 'Server Encoding',
            'attachmentsDir' => 'Attachments Dir',
            'imapLogin' => 'Imap Login',
            'imapPassword' => 'Imap Password',
        	'password' => 'Password',
        	'active' => 'Active',
        ];
    }
}
