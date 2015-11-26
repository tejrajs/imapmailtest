<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MailDetail */

$this->title = 'Create Mail Detail';
$this->params['breadcrumbs'][] = ['label' => 'Setting', 'url' => ['/mail/setting/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
