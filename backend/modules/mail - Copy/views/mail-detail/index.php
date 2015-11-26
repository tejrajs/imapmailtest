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
        <?= Html::a('Create Mail Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'mail',
            'imapLogin',
            'imapPassword',
            // 'active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
