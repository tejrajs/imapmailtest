<?php

namespace app\modules\mail\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\modules\mail\models\search\MailDetailSearch;

class SettingController extends Controller
{
	public function behaviors()
	{
		return [
				'verbs' => [
						'class' => VerbFilter::className(),
						'actions' => [
								'delete' => ['post'],
						],
				],
		];
	}
    public function actionIndex()
    {
    	$searchModel = new MailDetailSearch();
    	$searchModel->user_id = \Yii::$app->user->id;
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    	
    	return $this->render('index', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	]);
        
    }

}
