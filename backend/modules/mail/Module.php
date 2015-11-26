<?php

namespace app\modules\mail;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\mail\controllers';
	
    public $mainLayout;
    
    public function init()
    {
        parent::init();
       	$this->layout = $this->mainLayout;
    }
}
