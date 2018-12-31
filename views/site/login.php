<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\AppAsset;
use app\assets\AdminlteAsset;
// AppAsset::register($this);

AdminlteAsset::register($this);
?>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html">سیستم <b>مدیریت</b> وظایف</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">اطلاعات خود را وارد نمایید.</p>
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            // 'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div>{input}</div>\n<div>{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]); ?>
        <!-- <form action="../../index2.html" method="post"> -->
          <div class="form-group has-feedback">
            <!-- <input type="text" class="form-control" placeholder="Email"> -->
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control', 'placeholder' => 'نام کاربری'])->label(false) ?>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <!-- <input type="password" class="form-control" placeholder="Password"> -->
            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => 'رمز عبور'])->label(false) ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <!-- <input type="checkbox"> Remember Me -->
                  <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div>{input} {label}</div><div>{error}</div>",
                ]) ?>
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
							<div class="form-group">
								<?= Html::submitButton('ورود', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
							</div>
              <!-- <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button> -->
            </div>
            <!-- /.col -->
          </div>
        </form>
    
        <?php ActiveForm::end(); ?>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
