yii2 Imap Module
==========
This Module is used to fetch mail

Installation by composer
------------

'modules' => [
    'mail' => [
    	'class' => 'app\modules\mail\Module',
    	//'mainLayout' => 'main',	used its deafult
    ],
],

yii migrate --migrationPath=@app/modules/mail/migrations