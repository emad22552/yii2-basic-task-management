<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GroupsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="groups-search">
    
    <!-- active form begin -->
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    
    <!-- id field -->
    <?= $form->field($model, 'id') ?>

    <!-- name field -->
    <?= $form->field($model, 'name') ?>

    <!-- created_at field -->
    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <!-- action buttons -->
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <!--\. active form end -->
    <?php ActiveForm::end(); ?>

</div>
