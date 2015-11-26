<?php

namespace app\modules\mail\models;

use Yii;

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
            [['user_id', 'mail', 'imapLogin', 'imapPassword'], 'required'],
            [['user_id','active'], 'integer'],
            [['mail', 'imapLogin', 'imapPassword','folder'], 'string', 'max' => 150]
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
            'mail' => 'Mail',
            'imapLogin' => 'Imap Login',
            'imapPassword' => 'Imap Password',
        	'folder' => 'Folder',	
        	'active' => 'Active',
        ];
    }
}
