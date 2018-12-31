<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\AdminlteAsset;
use yii\data\ActiveDataProvider;
use app\models\Tasks;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TasksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $asset app\assets\AdminlteAsset */
/* @var $baseUrl string */

$asset = AdminlteAsset::register($this);
$baseUrl = $asset->baseUrl;

$this->title = 'لیست وظیفه ها';
?>
<span style="font-size:45px;"><?= Html::encode($this->title) ?></span>
<?= Html::a('افزودن', ['tasks/create'], ['class'=>'btn btn-success']);
?>
<br><br>
<?=
 GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'summary'=>'',
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

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

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>