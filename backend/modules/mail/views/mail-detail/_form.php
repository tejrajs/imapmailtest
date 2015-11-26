<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\mail\models\ImapDetail;

/* @var $this yii\web\View */
/* @var $model common\models\MailDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mail-detail-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'type')->dropDownList(['imap'=>'IMAP', 'pop' => 'POP']) ?>

    <?= $form->field($model, 'incomming')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'imapLogin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
