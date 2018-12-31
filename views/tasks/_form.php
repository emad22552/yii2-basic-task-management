<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper; 

use app\models\User;
use app\models\Status;
use app\models\Groups;

/* @var $this yii\web\View */
/* @var $model app\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
/* @var $isAdmin boolean */
/* @var $id integer */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('نام') ?>

    <?= $isAdmin ?
        $form->field($model, 'owner')->dropDownList(
            ArrayHelper::map(User::find()->all(),'id','username'))->label('انتخاب کاربر')
        :
        $form->field($model, 'owner')->hiddenInput(['value'=> $id])->label(false);
        ?> 

    <?= $form->field($model, 'status')->dropDownList(
            ArrayHelper::map(Status::find()->all(),'id','name'))->label('وضعیت وظیفه')?>

    <?= $form->field($model, '_group')->dropDownList(
            ArrayHelper::map(Groups::find()->all(),'id','name'))->label('انتخاب گروه')?> 

    <div class="form-group">
        <?= Html::submitButton('ذخیره', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
