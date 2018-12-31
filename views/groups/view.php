<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Groups */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="groups-view">

    <!-- echo group name -->
    <h1>مشاهده گروه: <?= Html::encode($this->title) ?></h1>

    <!-- create action buttons -->
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

    <!-- display group info -->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'created_at',
        ],
    ]) ?>

</div>
