<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%imap_detail}}".
 *
 * @property integer $id
 * @property string $mail
 * @property string $imapPath
 * @property string $serverEncoding
 * @property string $attachmentsDir
 */
class ImapDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%imap_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mail', 'imapPath', 'serverEncoding', 'attachmentsDir'], 'required'],
            [['mail', 'imapPath', 'serverEncoding'], 'string', 'max' => 150],
            [['attachmentsDir'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mail' => 'Mail',
            'imapPath' => 'Imap Path',
            'serverEncoding' => 'Server Encoding',
            'attachmentsDir' => 'Attachments Dir',
        ];
    }
    public function getUcmail(){
    	return ucwords($this->mail);
    }
}
