<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\AdminlteAsset;
/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$asset = AdminlteAsset::register($this);
$this->title = 'لیست گروه ها';
$this->params['breadcrumbs'][] = $this->title;
?>
<span style="font-size:45px;"><?= Html::encode($this->title) ?></span>
<?= Html::a('افزودن', ['groups/create'], ['class'=>'btn btn-success']);
?>

<br><br>

<div class="groups-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
