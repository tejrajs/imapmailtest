<?php
namespace app\modules\mail\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\components\Mail;
use yii\helpers\Json;


class MailController extends Controller{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
				'verbs' => [
						'class' => VerbFilter::className(),
						'actions' => [
								'logout' => ['post'],
						],
				],
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
				'error' => [
						'class' => 'yii\web\ErrorAction',
				],
		];
	}
	public function actionIndex()
    {
    	
    	return $this->render('index',[
    			
    	]);
    }
    public function actionDelete($id)
    {
    	$mail = new Mail();
    	$mailDetail = $mail->deleteMail($id);
    	return $this->redirect(['/mail/default/index']);
    }
    public function actionShow($id)
    {
    	$mail = new Mail();
    	//$mailinfo = $mail->getMailsInfo([$id]);
    	//print_r($mailinfo);die;
    	
    	$mailDetail = $mail->getMail($id);
    	return $this->render('show',[
    		'mailDetail' => $mailDetail
    	]);
    }
    public function actionImportant($id)
    {
    	$mail = new Mail();
    	
    	$mail->markMailAsImportant($id);   			
    	return $this->redirect(['/mail/default/index']);
    }
    public function actionRead()
    {
    	if (Yii::$app->request->post()) {
    		$post = Yii::$app->request->post();
    		$mailids = $post['mail'];
    		$mail = new Mail();
    		if(!empty($mailids)){
    			foreach ($mailids as $id){
    				$mailDetail = $mail->markMailAsRead($id);
    			}
    			echo Json::encode(['sucess' => 1,'msg' => '<b>Sucessfully Maked Read</b>']);
    		}else{
    			echo Json::encode(['error' => 'Failed']);
    		}
    	}else{
    		echo Json::encode(['error' => 'Failed']);
    	}
    	
    	//return $this->redirect(['/mail/default/index']);
    }
    public function actionUnRead()
    {
    	if (Yii::$app->request->post()) {
    		$post = Yii::$app->request->post();
    		$mailids = $post['mail'];
    		$mail = new Mail();
    		if(!empty($mailids)){
    			foreach ($mailids as $id){
    				$mailDetail = $mail->markMailAsUnread($id);
    			}
    			echo Json::encode(['sucess' => 1,'msg' => '<b>Sucessfully Maked Read</b>']);
    		}else{
    			echo Json::encode(['error' => 'Failed']);
    		}
    	}else{
    			echo Json::encode(['error' => 'Failed']);
    	}
    }
    public function actionImportants()
    {
    	if (Yii::$app->request->post()) {
    		$post = Yii::$app->request->post();
    		$mailids = $post['mail'];
    		$mail = new Mail();
    		if(!empty($mailids)){
    			foreach ($mailids as $id){
    				$mailDetail = $mail->markMailAsImportant($id);
    			}
    			echo Json::encode(['sucess' => 1,'msg' => '<b>Sucessfully Maked Importants</b>']);
    		}else{
    			echo Json::encode(['error' => 'Failed']);
    		}
    	}else{
    			echo Json::encode(['error' => 'Failed']);
    	}
    }
    public function actionDeleteAll()
    {
    	if (Yii::$app->request->post()) {
    		$post = Yii::$app->request->post();
    		$mailids = $post['mail'];
    		$mail = new Mail();
    		if(!empty($mailids)){
    			foreach ($mailids as $id){	
    				$mailDetail = $mail->deleteMail($id);
    			}
    			echo Json::encode(['sucess' => 1,'msg' => '<b>Sucessfully Deleted Selected</b>']);
    		}else{
    			echo Json::encode(['error' => 'Failed']);
    		}
    	}else{
    			echo Json::encode(['error' => 'Failed']);
    	}
    }
    
}