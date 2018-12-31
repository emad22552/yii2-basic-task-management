<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Groups */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="groups-form">

    <!-- active form begin -->
    <?php $form = ActiveForm::begin(); ?>
    
    <!-- name field -->
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <!-- submit button -->
    <div class="form-group">
        <?= Html::submitButton('ذخیره', ['class' => 'btn btn-success']) ?>
    </div>

    <!-- active form end -->
    <?php ActiveForm::end(); ?>

</div>
