<?php

namespace app\modules\mail\components;

use app\modules\mail\components\imap\Mailbox;
use app\modules\mail\models\MailDetail;
use app\modules\mail\models\ImapDetail;

class Mail extends Mailbox{
	public function __construct($folder = ''){
		
		$userID = \Yii::$app->user->id;
		$detail = MailDetail::findOne(['user_id' => $userID, 'active' => '1']);
		$imapDetail = ImapDetail::findOne(['mail' => $detail->mail]);
		
		$this->imapPath 		= $imapDetail->imapPath;
		$this->imapLogin 		= $detail->imapLogin;
		$this->imapPassword 	= Crypt::decode($detail->imapPassword);
		$this->serverEncoding 	= $imapDetail->serverEncoding;
		$this->attachmentsDir 	=  $imapDetail->attachmentsDir;
		$this->folder = $folder;
		
	}
}