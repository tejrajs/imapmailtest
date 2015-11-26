<?php

namespace app\modules\mail\models;

use Yii;
use yii\base\Model;
use common\components\Crypt;

/**
 * This is the model class for table "{{%mail_detail}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $mail
 * @property string $imapLogin
 * @property string $imapPassword
 */
class MailSetting extends Model
{
	public static function MailDetail(){
		$userID = \Yii::$app->user->id;
		$detail = MailDetail::findOne(['user_id' => $userID, 'active' => '1']);
		$imapDetail = ImapDetail::findOne(['mail' => $detail->mail]);
		return [
				'imapPath' => $imapDetail->imapPath.$detail->folder,//.'INBOX',
				'imapLogin' => $detail->imapLogin,
				'imapPassword' => Crypt::decode($detail->imapPassword),
				'serverEncoding'=> $imapDetail->serverEncoding, // utf-8 default.
				'attachmentsDir'=> $imapDetail->attachmentsDir
		];
	}
}