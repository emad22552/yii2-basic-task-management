<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tasks */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('بروزرسانی', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('حذف', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'آیا از حذف این مورد اطمینان دارید؟!',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'owner',
                'value'     => function ($model){
                    return  $model->owner0->username;
                },
            ],
            [
                'attribute' => 'status',
                'value'     => function ($model){
                    return  $model->status0->name;
                },
            ],
            [
                'attribute' => '_group',
                'value'     => function ($model){
                    return  $model->group->name;
                },
            ],
            'created_at',
        ],
    ]) ?>

</div>
