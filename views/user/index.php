<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'لیست کاربران';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="user-index">

    <span style="font-size:45px;"><?= Html::encode($this->title) ?></span>
    <?= Html::a('افزودن', ['user/create'], ['class'=>'btn btn-success']);
    ?>
    <br><br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'username',
            [
                'attribute' => 'is_admin',
                'value'     => function ($model){
                    if($model->is_admin) return 'بله';
                    return 'خیر';
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
