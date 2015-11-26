<?php

namespace app\modules\mail\controllers;

use Yii;
use common\models\MailDetail;
use app\modules\mail\models\search\MailDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\Crypt;

/**
 * MailDetailController implements the CRUD actions for MailDetail model.
 */
class MailDetailController extends Controller
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

    /**
     * Lists all MailDetail models.
     * @return mixed
     */
    /*public function actionIndex()
    {
        $searchModel = new MailDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

    /**
     * Displays a single MailDetail model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MailDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MailDetail();
		
        if ($model->load(Yii::$app->request->post())) {
        	$model->imapPassword = Crypt::encode($model->imapPassword);
        	$model->user_id = \Yii::$app->user->id;
        	$model->active = '0';
        	if($model->save()){
            	return $this->redirect(['view', 'id' => $model->id]);
        	}
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MailDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
        	$model->imapPassword = Crypt::encode($model->imapPassword);
        	if($model->save()){
            	return $this->redirect(['view', 'id' => $model->id]);
        	}
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MailDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    /*public function actionDeActive($id)
    {
    	$model = $this->findModel($id);
    	$model->active = '0';
    	if($model->save()){
    		return $this->redirect(['/mail/setting/index','sucess'=>'1']);
    	}else{
    		return $this->redirect(['/mail/setting/index','sucess'=>'0']);
    	}
    }*/
    public function actionActive($id)
    {
    	$model = $this->findModel($id);
    	MailDetail::updateAll(['active' => '0'],['user_id' => $model->user_id]);    	
    	$model->active = '1';
    	if($model->save()){
    		return $this->redirect(['/mail/setting/index','sucess'=>'1']);
    	}else{
    		return $this->redirect(['/mail/setting/index','sucess'=>'0']);
    	}
    }

    /**
     * Finds the MailDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MailDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MailDetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
