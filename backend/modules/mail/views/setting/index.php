<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mail\models\search\MailDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mail Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mail Detail', ['/mail/mail-detail/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'mail',
            [
            	'label'=>'Mail Host',
            	'value' => function($model){
            		return ucwords($model->mail);
            	}
            ],
            'imapLogin',
            [
            	'label'=>'IMAP Password ',
            	'value' => function($model){
            		return '*******';
            	}
            ],
			[
	            'label'=>' ',
	            'format'=>'raw',	             
	            'value' => function($model){
	            	//return Html::radio('active',$model->active > 0?true:false,['value'=>$model->id, 'id'=>'activeSave']);
					if($model->active > 0){
	                	return Html::tag('span','',['class' => 'glyphicon glyphicon-ok-sign']);
	                	//Html::a('',['/mail/mail-detail/de-active','id' => $model->id]);
					}else{
						return Html::a(Html::tag('span','',['class' => 'glyphicon glyphicon-remove-sign']),['/mail/mail-detail/active','id' => $model->id]);
					}
	            }
	        ],
            
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete}',
				'buttons' => [
					'update' => function ($url,$model) {
						return Html::a('<span class="glyphicon glyphicon-edit"></span>',['/mail/mail-detail/update','id' => $model->id]);
					},
					'delete' => function ($url,$model,$key) {
							return Html::a('<span class="glyphicon glyphicon-trash"></span>',['/mail/mail-detail/delete','id' => $model->id]);
					},
				],
			],
        ],
    ]); ?>

</div>
