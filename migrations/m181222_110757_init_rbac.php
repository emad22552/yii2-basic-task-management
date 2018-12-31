<?php

use yii\db\Migration;

/**
 * Class m181222_110757_init_rbac
 */
class m181222_110757_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "administration" permission
        $administration = $auth->createPermission('administration');
        $administration->description = 'admin permission';
        $auth->add($administration);

        // add "admin" role and give this role the "administration" permission
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $administration);
    }
    
    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
