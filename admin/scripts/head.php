<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Shibly
 * Date: 3/20/12
 * Time: 9:36 PM
 * To change this template use File | Settings | File Templates.
 */

?>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">Admin Portal</a>

            <div class="nav-collapse">
                <ul class="nav">
                    <li id="home" class="active"><a href="<?php echo bloginfo('url') . "/admin/?do=home"; ?>">Home</a>
                    </li>
                    <li id="client"><a href="<?php echo bloginfo('url') . "/admin/?do=add_client"; ?>">Add Client</a>
                    </li>
                    <li id="edit_client"><a href="<?php echo bloginfo('url') . "/admin/?do=edit_client"; ?>">Edit
                        Client</a>
                    </li>
                    <li id="page"><a href="<?php echo bloginfo('url') . "/admin/?do=add_page"; ?>">Add Site</a>
                    </li>
                    <li id="edit_page"><a href="<?php echo bloginfo('url') . "/admin/?do=edit_page"; ?>">Edit Site</a>
                    </li>
                    <li id="admin_logout"><a href="<?php echo wp_logout_url();?>">Logout</a></li>
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
</script>
