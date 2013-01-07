<?php
session_start();

//$current_user = get_current_user_id();
/*
* Template Name: Client
*
* */

if ($_GET['do'] == 'unselectpage') {
    $_SESSION['page'] = false;
    $_SESSION['id'] = '';
} elseif ($_GET['do'] == 'selectpage' && $_GET['id']) {
    $_SESSION['page'] = true;
    $_SESSION['id'] = $_GET['id'];
}
?>
<?php require_once('client/scripts/init.php'); ?>

<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo "Mobile Page Listing : " . $_GET['do'];?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php wp_head();?>
</head>
<body>
<div class="container">
    <?php require_once SCRIPT . 'head.php';?>
    <div class="container">
        <div class="wrapper">
            <div class="page">
                <?php
                if ($_GET['do'] == 'selectpage' || $_GET['do'] == 'unselectpage' || !($_SESSION['page'] && $_SESSION['id'])) {
                    require_once PAGE . "select_page.php";
                } else if (file_exists(REAL_PATH . PAGE . $_GET['do'] . ".php")) {
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
