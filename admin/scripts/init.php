<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Shibly
 * Date: 3/20/12
 * Time: 9:29 PM
 * To change this template use File | Settings | File Templates.
 */

define('REAL_PATH', ABSPATH . "wp-content/themes/jqmobile/");
define('PAGE', "admin/pages/");
define('SCRIPT', "admin/scripts/");
define('BOOTSTRAP', "admin/bootstrap/");
define('CSS', "admin/bootstrap/css/");
define('JS', "admin/bootstrap/js/");
define('JQUERYUI', "admin/jqueryui/");
define('AJAXUPLOAD', "admin/ajaxupload/");
define('redactor', "admin/redactor/");
define('colorpicker', "admin/colorpicker/");
define('select2', "admin/select2");
function init_scripts()
{
    echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/' . select2 . '/' . 'select2.css">' . "\n";
    echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/' . colorpicker . '/css/' . 'colorpicker.css">' . "\n";
    echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/' . CSS . '/' . 'bootstrap-responsive.min.css">' . "\n";
    echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/' . CSS . '/' . 'bootstrap.min.css">' . "\n";
    echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/' . CSS . '/' . 'style.css">' . "\n";
    echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/' . JQUERYUI . 'themes/base/' . 'jquery-ui.css">' . "\n";
    echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/' . JQUERYUI . 'themes/base/' . 'jquery.ui.datepicker.css">' . "\n";
    echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/' . JQUERYUI . 'themes/base/' . 'jquery.ui.slider.css">' . "\n";
    echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/' . AJAXUPLOAD . 'client/' . 'fileuploader.css">' . "\n";
    echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/' . redactor . '/css/' . 'redactor.css">' . "\n";
    echo "<link href='http://fonts.googleapis.com/css?family=Didact+Gothic|PT+Sans:400,400italic,700' rel='stylesheet' type='text/css'>";

    echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/' . JS . '/' . 'bootstrap.js"></script>' . "\n";
    echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/' . JQUERYUI . 'ui/' . 'jquery-ui.js"></script>' . "\n";
    echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/' . JQUERYUI . 'ui/' . 'jquery.ui.core.js"></script>' . "\n";
    echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/' . JQUERYUI . 'ui/' . 'jquery.ui.widget.js"></script>' . "\n";
    echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/' . JQUERYUI . 'ui/' . 'jquery.ui.datepicker.js"></script>' . "\n";
    echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/' . JQUERYUI . 'ui/' . 'jquery.ui.slider.js"></script>' . "\n";
    echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/' . AJAXUPLOAD . 'client/' . 'fileuploader.js"></script>' . "\n";
    echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/' . JS . '/' . 'anytime.js"></script>' . "\n";
    echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/' . redactor . 'redactor.js"></script>' . "\n";
    echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/' . select2 . '/select2.js"></script>' . "\n";
    echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/' . colorpicker . '/' . '/js/' . 'bootstrap-colorpicker.js"></script>' . "\n";
}

add_action('wp_head', 'init_scripts', 100);

