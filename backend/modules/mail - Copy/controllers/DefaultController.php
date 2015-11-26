<?php

namespace app\modules\mail\controllers;

use Yii;
use yii\web\Controller;
use common\components\Mail;
use yii\data\Pagination;

class DefaultController extends Controller
{
    public function actionIndex()
    {
    	$get = Yii::$app->request->get();
    	if(isset($get['type'])){
    		$type = $get['type'];
    	}else{
    		$type = '';
    	}
        $mail = new Mail($type);
        $totalMials = $mail->countMails();
    	$pagination = new Pagination(['totalCount'=> $totalMials]);
    	
    	$page = 1;
    	
    	if(isset($get['page']) && $get['page'] > 0 ){
    		$page = $get['page'];
    	}	
        return $this->render('index1',[
        	'page' => $page,
        	'mail'  => $mail,
        	'totalMials' => $totalMials,	
        	'pagination' => $pagination
        ]);
    }
}
