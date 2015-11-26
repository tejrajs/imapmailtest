<?php

namespace app\modules\mail\controllers;

use Yii;
use yii\web\Controller;
use app\modules\mail\components\Mail;
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
    	
    	if(isset($get['search'])){
    		$search = $get['search'];
    	}else{
    		$search = 'All';
    	}
        $mail = new Mail($type);
       // $mail->sortMails();
        $totalMials = $mail->countMails();
    	$pagination = new Pagination(['totalCount'=> $totalMials]);
    	
    	$page = 1;
    	
    	if(isset($get['page']) && $get['page'] > 0 ){
    		$page = $get['page'];
    	}	
    	
    	
    	
        return $this->render('index',[
        	'page' => $page,
        	'search'  => $search,
        	'oMail' => $mail,	
        	'type' => $type,	
        	'totalMials' => $totalMials,	
        	'pagination' => $pagination
        ]);
    }
}
