<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AdminlteAsset;
use yii\helpers\Url;
use yii\db\Query;

// AppAsset::register($this);

$asset = AdminlteAsset::register($this);
$baseUrl = $asset->baseUrl;

$isAdmin = Yii::$app->user->can('admin');

$query = new Query;
$userId = Yii::$app->user->getId();
if($isAdmin){
    $allUsers = count($query->from('user')->all());
    $allTasks = count($query->from('tasks')->all());
    $allToDoTasks = count($query->from('tasks')->where('status=1')->all());
    $allDoingTasks = count($query->from('tasks')->where('status=2')->all());
    $allDoneTasks = count($query->from('tasks')->where('status=3')->all());
} else {
    $allTasks = count($query->from('tasks')->where(['owner' => $userId])->all());
    $allToDoTasks = count($query->from('tasks')->where(['owner' => $userId, 'status' => 1])->all());
    $allDoingTasks = count($query->from('tasks')->where(['owner' => $userId, 'status' => 2])->all());
    $allDoneTasks = count($query->from('tasks')->where(['owner' => $userId, 'status' => 3])->all());
}
$toDoPer = round(($allToDoTasks / $allTasks) * 100);
$DoingPer = round(($allDoingTasks / $allTasks) * 100);
$DonePer = round(($allDoneTasks / $allTasks) * 100);
$username = ($query->select(['username'])->from('user')->where(['user_id' => $userId])->one())['username'];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="skin-blue sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?= Url::toRoute(['tasks/index']);?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>پنل</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>پنل</b> مدیریت</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Tasks: style can be found in dropdown.less -->

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= $baseUrl ?>/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?= $username ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?= $baseUrl ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                <p>
                                <?= $username ?>
                                <b>
                                    <?= ($isAdmin) ? ' - admin' : ' - user'?>
                                </b>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <!-- <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div> -->
                                <div class="pull-left">
                                <?php echo
                                    Html::beginForm(['/site/logout'], 'post')
                                    . Html::submitButton(
                                        'خروج',
                                        ['class' => 'btn btn-default btn-flat']
                                    )
                                    . Html::endForm()
                                ?>
                                    <!-- <a href="<?= null //Url::toRoute(['site/logout']);?>" class="btn btn-default btn-flat">خروج</a> -->
                                </div>
                                <!-- <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div> -->
                            </li>
                            <!-- Menu Footer-->
                            <!-- <li class="user-footer">
                                
                            </li> -->
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <!-- <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li> -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-right image">
                    <img src="<?= $baseUrl ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?= $username ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> آنلاین</a>
                </div>
            </div>
            <!-- search form -->
            <!-- <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="جستوجو ...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i></button>
              </span>
                </div>
            </form> -->
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">ناوبری اصلی</li>

                <!-- item -->
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-circle-o text-green"></i>
                        <span>وظایف</span>
                        <!-- <span class="label label-primary pull-left">2</span> -->
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::toRoute(['tasks/index']);?>"><i class="fa fa-circle-o"></i>مشاهده همه وظایف</a></li>
                        <li><a href="<?= Url::toRoute(['tasks/create']);?>"><i class="fa fa-circle-o"></i>ایجاد وظیفه جدید</a></li>
                    </ul>
                </li><!-- /.item -->
                <?php if($isAdmin): ?>
                    <!-- item -->
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-circle-o text-aqua"></i>
                            <span>گروه ها</span>
                            <!-- <span class="label label-primary pull-left">2</span> -->
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?= Url::toRoute(['groups/index']);?>"><i class="fa fa-circle-o"></i>مشاهده همه گروه ها</a></li>
                            <li><a href="<?= Url::toRoute(['groups/create']);?>"><i class="fa fa-circle-o"></i>ایجاد گروه جدید</a></li>
                        </ul>
                    </li><!-- /.item -->
                    <!-- item -->
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-circle-o text-yellow"></i>
                            <span>کاربران</span>
                            <!-- <span class="label label-primary pull-left">2</span> -->
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?= Url::toRoute(['user/index']);?>"><i class="fa fa-circle-o"></i>مشاهده همه کاربران</a></li>
                            <li><a href="<?= Url::toRoute(['user/create']);?>"><i class="fa fa-circle-o"></i>ایجاد کاربر جدید</a></li>
                        </ul>
                    </li><!-- /.item -->
                <?php endif; ?>
                
                <!-- <li class="header">داکیومنت ها</li>
                <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li> -->
                    

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                پیشخوان
                <small>پنل مدیریت</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= Url::toRoute(['tasks/index']);?>"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li class="active">پیشخوان</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
            <?php if($isAdmin): ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?= $allUsers; ?></h3>
                            <p>کاربر ثبت نام کرده</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="<?= Url::toRoute(['user/index']);?>" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php endif; ?>
                <div class="col-lg-3 col-xs-6">
                    <div class="info-box bg-red" style="height: 130px;">
                        <span class="info-box-icon" style="height: 130px;"><i class="fa fa-calendar" style="margin-top: 42px;"></i></span>
                        <div class="info-box-content" style="padding: 36px 10px;">
                        <span class="info-box-text">وظایف آینده</span>
                        <span class="info-box-number"><?= $allToDoTasks; ?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?= $toDoPer; ?>%"></div>
                        </div>
                        <span class="progress-description">
                        <?= $toDoPer; ?> درصد پیشرفت کلی
                        </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="info-box bg-green" style="height: 130px;">
                        <span class="info-box-icon" style="height: 130px;"><i class="fa fa-coffee" style="margin-top: 42px;"></i></span>
                        <div class="info-box-content" style="padding: 36px 10px;">
                        <span class="info-box-text">وظایف در حال انجام</span>
                        <span class="info-box-number"><?= $allDoingTasks; ?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?= $DoingPer; ?>%"></div>
                        </div>
                        <span class="progress-description">
                        <?= $DoingPer; ?> درصد پیشرفت کلی
                        </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="info-box bg-aqua" style="height: 130px;">
                        <span class="info-box-icon" style="height: 130px;"><i class="fa fa-rocket" style="margin-top: 42px;"></i></span>
                        <div class="info-box-content" style="padding: 36px 10px;">
                        <span class="info-box-text">وظایف تمام شده</span>
                        <span class="info-box-number"><?= $allDoneTasks; ?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?= $DonePer; ?>%"></div>
                        </div>
                        <span class="progress-description">
                        <?= $DonePer; ?> درصد پیشرفت کلی
                        </span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
            </div><!-- /.row -->
            <!-- Main row -->
            <div class="row">

                <section class="col-lg-12 connectedSortable">
                    <div class="box box-primary">
                        <div class="box-header">
                            <i class="fa fa-columns"></i>
                            <h3 class="box-title">داشبورد</h3>
                            <!-- tools box -->
                            <div class="pull-left box-tools">
                                <!-- <?= Html::a('Create Tasks', ['create'], ['class' => 'btn btn-success']) ?> -->
                                <!-- <?= $isAdmin ? Html::a('Create Users', ['user/create'], ['class' => 'btn btn-warning']) : null ?> -->
                                <!-- <?= $isAdmin ? Html::a('Create Groups', ['groups/create'], ['class' => 'btn btn-info']) : null ?> -->
                            </div><!-- /. tools -->
                        </div>
                        <div class="box-body">

                            <?= $content ?>

                        </div>
                        <!-- <div class="box-footer clearfix">
                            <button class="pull-left btn btn-default" id="sendEmail">Send <i
                                        class="fa fa-arrow-circle-left"></i></button>
                        </div> -->
                    </div>
                </section><!-- right col -->
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">

                </section><!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-5 connectedSortable">

                </section><!-- right col -->
            </div><!-- /.row (main row) -->

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-left hidden-xs">
            ویرایش 0.0.1
        </div>
        <strong>کپی رایت &copy; 1397 | </strong> تمامی حقوق محفوظ است.
    </footer>

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->




<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
