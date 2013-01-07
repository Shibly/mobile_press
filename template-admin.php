<?php
if (!current_user_can('administrator')) {
    wp_redirect(site_url('/client/'));
    die();
}

/**
 * Template Name: Admin
 * Created by JetBrains PhpStorm.
 * User: Shibly
 * Date: 7/24/12
 * Time: 12:02 AM
 * To change this template use File | Settings | File Templates.
 */

require_once('admin/scripts/init.php');
?>

<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo "Admin portal :: " . $_GET['do'] ?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php wp_head(); ?>
</head>
<body>
<div class="container">
    <?php require_once SCRIPT . 'head.php';?>
    <div class="container">
        <div class="wrapper">
            <div class="page">
                <?php if (file_exists(REAL_PATH . PAGE . $_GET['do'] . ".php")) {
                require_once PAGE . $_GET['do'] . ".php";
            } else {
                require_once PAGE . "home.php";
            }
                ?>

            </div>
        </div>
    </div>
</body>
</html>