<?php

namespace app\controllers;

use yii\rest\ActiveController;

use yii\data\ActiveDataProvider;
use yii\filters\ContentNegotiator;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\VerbFilter;

use yii\web\Response;

/**
 * This is the model class for table "status".
 *
 * @property string $modelClass
 */
class RestController extends ActiveController
{
    /**
     * The model class name. This property must be set.
     */
    public $modelClass = 'app\models\User';

    /**
     * {@inheritdoc}
     */
    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpBasicAuth::className(),
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                // 'delete' => ['POST'],
                'index' => ['GET', 'HEAD'],
                'view' => ['GET', 'HEAD'],
                'create' => ['POST'],
                'update' => ['PUT', 'PATCH'],
                'delete' => ['DELETE'],
            ],
        ];

        return $behaviors;
    }

    /**
     * {@inheritdoc}
     */
    public function init(){
        parent::init();
        \Yii::$app->user->enableSession = false;
    }
}