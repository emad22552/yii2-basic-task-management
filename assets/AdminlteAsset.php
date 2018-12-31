<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminlteAsset extends AssetBundle
{
    // public $sourcePath = '@web/adminlte';
    public $basePath = '@webroot/adminlte';
    public $baseUrl = '@web/adminlte';
    public $css = [
        'css/AdminLTE.min.css',
        'css/blue.css',
        //'css/bootstrap.min.css',
        'css/_all-skins.min.css',
        'css/bootstrap-rtl.min.css',
        'css/rtl.css',
        'css/morris.css',
        'css/jquery-jvectormap-1.2.2.css',
        'css/datepicker3.css',
        'css/daterangepicker-bs3.css',
        'css/bootstrap3-wysihtml5.min.css',
        'css/fonts-fa.css',
        'css/font-awesome.min.css',
        'css/ionicons.min.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
        'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/icheck.min.js',
        'js/jQuery-2.1.4.min.js',
        'js/app.min.js',
        'js/demo.js',
        'js/morris.min.js',
        'js/jquery.sparkline.min.js',
        'js/jquery-jvectormap-1.2.2.min.js',
        'js/jquery-jvectormap-world-mill-en.js',
        'js/jquery.knob.js',
        'js/daterangepicker.js',
        'js/bootstrap-datepicker.js',
        'js/bootstrap3-wysihtml5.all.min.js',
        'js/jquery.slimscroll.min.js',
        'js/fastclick.min.js',
        'js/jquery-ui.min.js',
        'js/moment.min.js',
        'js/raphael-min.js',
        // 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js',
        'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
        // 'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js'

    ];
    public $publishOptions = [
        'only' => [
            'fonts/*',
            'css/*',
            'js/*'
        ]
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}
