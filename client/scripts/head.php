<?php
global $wpdb;
/**
 * Created by JetBrains PhpStorm.
 * User: Shibly
 * Date: 3/20/12
 * Time: 9:36 PM
 * To change this template use File | Settings | File Templates.
 */
$wp_uid = get_current_user_id();
$page_id = $_SESSION['id'];
?>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">Mobile App</a>

            <div class="nav-collapse">
                <ul class="nav">

                    <li id="home" class="active"><a href="<?php echo bloginfo('url') . "/client/?do=home"; ?>">Home</a>
                    </li>
                    <li id="about"><a href="<?php echo bloginfo('url') . "/client/?do=about"; ?>">About Us</a></li>
                    <li id="locations"><a href="<?php echo bloginfo('url') . "/client/?do=location"; ?>">Locations</a>
                    </li>
                    <li id="contact"><a href="<?php echo bloginfo('url') . "/client/?do=contact"; ?>">Contact Info</a>
                    </li>
                    <li id="services"><a href="<?php echo bloginfo('url') . "/client/?do=service"; ?>">Services</a></li>
                    <li id="member"><a href="<?php echo bloginfo('url') . "/client/?do=member"; ?>">Members</a></li>
                    <li id="socialMedia"><a href="<?php echo bloginfo('url') . "/client/?do=socialMedia"; ?>">Social
                        Media</a></li>
                    <li id="list_menu"><a href="<?php echo bloginfo('url') . "/client/?do=nmenu"; ?>">Menu</a></li>
                    <li id="select_page" class="active"><a
                        href="<?php echo bloginfo('url') . "/client/?do=unselectpage"; ?>">Select A Page</a>
                    </li>

                    <li id="logout" class="destroy_page"><a href="<?php echo wp_logout_url();?>"
                                                            data-id="<?php echo $_SESSION['id'];?>">Logout</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery('li').on("click", function () {
        jQuery(this).removeClass('active').addClass('active');

    });

    jQuery(".destroy_page").unbind('click').on('click', function () {
        var data = jQuery(this).attr('data-id');
        console.log(data);
    });
</script>
