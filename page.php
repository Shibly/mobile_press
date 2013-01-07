<?php if (is_page('admin') || is_page('client')) { ?>
<?php get_header(); ?>
<div class="right">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="post" id="post-<?php the_ID(); ?>">
        <?php /*  include (TEMPLATEPATH . '/inc/meta.php' ); */ ?>
        <div class="entry">
            <?php the_content(); ?>
            <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
        </div>
        <?php edit_post_link('Edit this entry', '<p>', '</p>'); ?>
    </div>
    <?php comments_template(); ?>
    <?php endwhile; endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php
} else {
    $page_id = $post->ID; //page id for this page
    get_header(); ?>

<?php $colorVal = "select color_value from tbl_home where site_id = '$page_id'";
    $res = $wpdb->get_results($colorVal);
        ?>
    <style type="text/css">
        .ui-content{
        background-color: <?php echo $res[0]->color_value; ?> !important;
        }
    </style>
<div class="right">
    <ul data-inset="true" data-role="listview" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
        <li data-theme="c" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c">
            <div class="ui-btn-inner ui-li ui-corner-top" aria-hidden="true">
                <div class="ui-btn-text">
                    <a href="#" id="home_page" class="ui-link-inherit"><p
                            class="ui-li-aside ui-li-desc"></p>

                        <h3 class="ui-li-heading">Home</h3>

                        <div><p style="font-size: 10px;" class="ui-li-desc">Home Info</p>
                        </div>
                    </a>
                </div>
                <span class="ui-icon ui-icon-arrow-r ui-icon-shadow"></span></div>
        </li>
        <li data-theme="c" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c">
            <div class="ui-btn-inner ui-li" aria-hidden="true">
                <div class="ui-btn-text">
                    <a href="#" id="about_page" class="ui-link-inherit"><p
                            class="ui-li-aside ui-li-desc"></p>

                        <h3 class="ui-li-heading">About</h3>


                        <div><p style="font-size: 10px;" class="ui-li-desc">About The Site Info</p>
                        </div>
                    </a>
                </div>
                <span class="backhome ui-icon ui-icon-arrow-r ui-icon-shadow"></span></div>
        </li>
        <li data-theme="c" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c">
            <div class="ui-btn-inner ui-li" aria-hidden="true">
                <div class="ui-btn-text">
                    <a href="#" id="services" class="ui-link-inherit"><p
                            class="ui-li-aside ui-li-desc"></p>

                        <h3 class="ui-li-heading">Services</h3>

                        <div><p style="font-size: 10px;" class="ui-li-desc">Services Info</p>
                        </div>
                    </a>
                </div>
                <span class="ui-icon ui-icon-arrow-r ui-icon-shadow"></span></div>
        </li>
        <li data-theme="c" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c">
            <div class="ui-btn-inner ui-li" aria-hidden="true">
                <div class="ui-btn-text">
                    <a href="#" id="members" class="ui-link-inherit"><p
                            class="ui-li-aside ui-li-desc"></p>

                        <h3 class="ui-li-heading">Members</h3>


                        <div><p style="font-size: 10px;" class="ui-li-desc">Members Here</p>
                        </div>
                    </a>
                </div>
                <span class="ui-icon ui-icon-arrow-r ui-icon-shadow"></span></div>
        </li>
        <li data-theme="c" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c">
            <div class="ui-btn-inner ui-li" aria-hidden="true">
                <div class="ui-btn-text">
                    <a href="#" id="social_media" class="ui-link-inherit"><p
                            class="ui-li-aside ui-li-desc"></p>

                        <h3 class="ui-li-heading">Social Media</h3>

                        <div><p style="font-size: 10px;" class="ui-li-desc">Social Media Here</p>
                        </div>
                    </a>

                </div>
                <span class="ui-icon ui-icon-arrow-r ui-icon-shadow"></span></div>
        </li>
        <li data-theme="c" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c">
            <div class="ui-btn-inner ui-li" aria-hidden="true">
                <div class="ui-btn-text">
                    <a href="#" id="menu" data-id='0' class="ui-link-inherit"><p
                            class="ui-li-aside ui-li-desc"></p>

                        <h3 class="ui-li-heading">Menu</h3>

                        <div><p style="font-size: 10px;" class="ui-li-desc">Menu Here</p>
                        </div>
                    </a>
                </div>
                <span class="ui-icon ui-icon-arrow-r ui-icon-shadow"></span></div>
        </li>
        <li data-theme="c" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c">
            <div class="ui-btn-inner ui-li" aria-hidden="true">
                <div class="ui-btn-text">
                    <a href="#" id="contact_info" class="ui-link-inherit"><p
                            class="ui-li-aside ui-li-desc"></p>

                        <h3 class="ui-li-heading">Contact Info</h3>

                        <p style="font-size: 10px;" class="ui-li-desc">Contact Information Here</p>

                        <div><p class="ui-li-desc"></p>
                        </div>
                    </a>
                </div>
                <span class="ui-icon ui-icon-arrow-r ui-icon-shadow"></span></div>
        </li>
        <li data-theme="c" class="ui-btn ui-btn-up-c ui-btn-icon-right ui-li-has-arrow ui-li">
            <div class="ui-btn-inner ui-li" aria-hidden="true">
                <div class="ui-btn-text">
                    <a href="#" id="location" class="ui-link-inherit"><p
                            class="ui-li-aside ui-li-desc"></p>

                        <h3 class="ui-li-heading">Locations</h3>

                        <p style="font-size: 10px;" class="ui-li-desc">Locations Here</p>

                        <div></div>
                    </a>
                </div>
                <span class="ui-icon ui-icon-arrow-r ui-icon-shadow"></span></div>
        </li>
    </ul>
</div>
<!--/content-primary-->
</div>
<script type="text/javascript">
jQuery("body").delegate("#home_page", "click", function () {
    var opts = {
        url:"<?php echo bloginfo('url') . "/cpage/?ajax=home&id=" . $page_id?>",
        cache:false,
        type:'POST',
        dataType:'JSON',
        success:function (data) {
            jQuery(".right ul").html('');
            jQuery(".right ul").html("<li data-theme='c' class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c'>" +
                    "<div class='ui-btn-inner ui-li' aria-hidden='true'>" +
                    "<div class='ui-btn-text'>" +
                    "<a href='#' class='ui-link-inherit'>" +
                    "<p class='ui-li-aside ui-li-desc'></p>" +
                    "<h3 class='ui-li-heading'>Company Name</h3>" +
                    "<div><p style='font-size: 10px;' class='ui-li-desc'>" + data.business_name + "</p>" +
                    "</div>" +
                    "<h3 class='ui-li-heading'>Web Address</h3>" +
                    "<div><p style='font-size: 10px;' class='ui-li-desc'>" + data.business_url + "</p>" +
                    "</div>" +
                    "</a>" +
                    "</div>" +
                    "<span id='backhome' class='ui-icon ui-icon-arrow-l ui-icon-shadow' style='z-index:100;" +
                    "'></span></div>" +
                    "</li>");

        }
    };
    jQuery.ajax(opts);
    return false;
});

jQuery("body").delegate("#about_page", "click", function () {
    var opts = {
        url:"<?php echo bloginfo('url') . "/cpage/?ajax=about&id=" . $page_id?>",
        cache:false,
        type:'POST',
        dataType:'JSON',
        success:function (data) {
            jQuery(".right ul").html('');
            jQuery(".right ul").html("<li data-theme='c' class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c'>" +
                    "<div class='ui-btn-inner ui-li' aria-hidden='true'>" +
                    "<div class='ui-btn-text'>" +
                    "<a href='#' class='ui-link-inherit'>" +
                    "<p class='ui-li-aside ui-li-desc'></p>" +
                    "<h3 class='ui-li-heading'>About Us</h3>" +
                    "<div><p style='font-size: 10px;' class='ui-li-desc'>" + data.about_desc + "</p>" +
                    "</div>" +
                    "</a>" +
                    "</div>" +
                    "<span id='backhome' class='ui-icon ui-icon-arrow-l ui-icon-shadow' style='z-index:100;" +
                    "'></span></div>" +
                    "</li>");
        }
    };
    jQuery.ajax(opts);
    return false;
});

jQuery("body").delegate("#location", "click", function () {
    var opts = {
        url:"<?php echo bloginfo('url') . "/cpage/?ajax=location&id=" . $page_id?>",
        type:'POST',
        cache:false,
        dataType:'JSON',
        success:function (data) {

            jQuery(".right ul").html('');
            jQuery.each(data, function (key, val) {
                jQuery(".right ul").html("<li data-theme='c' class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c'>" +
                        "<div class='ui-btn-inner ui-li' aria-hidden='true'>" +
                        "<div class='ui-btn-text'>" +
                        "<a href='#' class='ui-link-inherit'>" +
                        "<p class='ui-li-aside ui-li-desc'></p>" +
                        "<h3 class='ui-li-heading'>Location Name</h3>" +
                        "<div><p style='font-size: 10px;' class='ui-li-desc'>" + val.location_name + "</p>" +
                        "</div>" +
                        "<h3 class='ui-li-heading'>Phone Number</h3>" +
                        "<div><p style='font-size: 10px;' class='ui-li-desc'>" + val.phone_number + "</p>" +
                        "</div>" +
                        "<h3 class='ui-li-heading'>Address</h3>" +
                        "<div><p style='font-size: 10px;' class='ui-li-desc'>" + val.address + "</p>" +
                        "</div>" +
                        "<h3 class='ui-li-heading'>City</h3>" +
                        "<div><p style='font-size: 10px;' class='ui-li-desc'>" + val.city + "</p>" +
                        "</div>" +
                        "<h3 class='ui-li-heading'>State</h3>" +
                        "<div><p style='font-size: 10px;' class='ui-li-desc'>" + val.state + "</p>" +
                        "</div>" +
                        "<h3 class='ui-li-heading'>Zip Code</h3>" +
                        "<div><p style='font-size: 10px;' class='ui-li-desc'>" + val.zip_code + "</p>" +
                        "</div>" +
                        "</a>" +
                        "</div>" +
                        "<span id='backhome' class='ui-icon ui-icon-arrow-l ui-icon-shadow' style='z-index:100;" +
                        "'></span></div>" +
                        "</li>");
            });
        }

    };
    jQuery.ajax(opts);
    return false;
});

jQuery("body").delegate("#members", "click", function () {
    var opts = {
        url:"<?php echo bloginfo('url') . "/cpage/?ajax=member&id=" . $page_id?>",
        type:'POST',
        cache:false,
        dataType:'JSON',
        success:function (data) {
            jQuery(".right ul").html('');
            jQuery.each(data, function (key, val) {
                jQuery(".right ul").html("<li data-theme='c' class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c'>" +
                        "<div class='ui-btn-inner ui-li' aria-hidden='true'>" +
                        "<div class='ui-btn-text'>" +
                        "<a href='#' class='ui-link-inherit'>" +
                        "<p class='ui-li-aside ui-li-desc'></p>" +
                        "<h3 class='ui-li-heading'>Member's Name</h3>" +
                        "<div><p style='font-size: 10px;' class='ui-li-desc'>" + val.member_name + "</p>" +
                        "</div>" +
                        "<h3 class='ui-li-heading'>Member's Bio</h3>" +
                        "<div><p style='font-size: 10px;' class='ui-li-desc'>" + val.member_bio + "</p>" +
                        "</div>" +
                        "<h3 class='ui-li-heading'>Member's Image</h3>" +
                        "<div><img style='height:95px; width:100px;' " +
                        "src='<?php echo bloginfo('template_directory');?>/admin/ajaxupload/server/uploads/"
                        + val.member_image + "'>" + "</img>" +
                        "</div>" +
                        "</a>" +
                        "</div>" +
                        "<span id='backhome' class='ui-icon ui-icon-arrow-l ui-icon-shadow' style='z-index:100;" +
                        "'></span></div>" +
                        "</li>");
            });

        }
    };
    jQuery.ajax(opts);
    return false;
});
jQuery("body").delegate("#social_media", "click", function () {
    var opts = {
        url:"<?php echo bloginfo('url') . "/cpage/?ajax=social_media&id=" . $page_id?>",
        type:'POST',
        cache:false,
        dataType:'JSON',
        success:function (ret) {

            jQuery(".right ul").html('');
            jQuery.each(ret, function (key, data) {
                jQuery(".right ul").html("<li data-theme='c' class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c'>" +
                        "<div class='ui-btn-inner ui-li' aria-hidden='true'>" +
                        "<div class='ui-btn-text'>" +
                        "<a href='#' class='ui-link-inherit'>" +
                        "<p class='ui-li-aside ui-li-desc'></p>" +
                        "<h3 class='ui-li-heading'>Social Media URL</h3>" +
                        "<div><p style='font-size: 10px;' class='ui-li-desc'>" + data.social_media_url + "</p>" +
                        "</div>" +
                        "<h3 class='ui-li-heading'>Title</h3>" +
                        "<div><p style='font-size: 10px;' class='ui-li-desc'>" + data.social_media_title + "</p>" +
                        "</div>" +
                        "<h3 class='ui-li-heading'>Name</h3>" +
                        "<div><p style='font-size: 10px;' class='ui-li-desc'>" + data.social_media_name + "</p>" +
                        "</div>" +
                        "</a>" +
                        "</div>" +
                        "<span id='backhome' class='ui-icon ui-icon-arrow-l ui-icon-shadow' style='z-index:100;" +
                        "'></span></div>" +
                        "</li>");

            });
        }
    };
    jQuery.ajax(opts);
    return false;
});
jQuery("body").delegate("#services", "click", function () {
    var opts = {
        url:"<?php echo bloginfo('url') . "/cpage/?ajax=services&id=" . $page_id?>",
        type:'POST',
        cache:false,
        dataType:'JSON',
        success:function (ret) {
            jQuery(".right ul").html('');
            jQuery.each(ret, function (key, data) {
                jQuery(".right ul").html("<li data-theme='c' class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c'>" +
                        "<div class='ui-btn-inner ui-li' aria-hidden='true'>" +
                        "<div class='ui-btn-text'>" +
                        "<a href='#' class='ui-link-inherit'>" +
                        "<p class='ui-li-aside ui-li-desc'></p>" +
                        "<h3 class='ui-li-heading'>Service Title</h3>" +
                        "<div><p style='font-size: 10px;' class='ui-li-desc'>" + data.service_title + "</p>" +
                        "</div>" +
                        "<h3 class='ui-li-heading'>Service Description</h3>" +
                        "<div><p style='font-size: 10px;' class='ui-li-desc'>" + data.service_description + "</p>" +
                        "</div>" +
                        "<h3 class='ui-li-heading'>Service Image</h3>" +
                        "<div><img style='height:95px; width:100px;' " +
                        "src='<?php echo bloginfo('template_directory');?>/admin/ajaxupload/server/uploads/"
                        + data.service_image + "'>" + "</img>" +
                        "</div>" +
                        "</a>" +
                        "</div>" +
                        "<span id='backhome' class='ui-icon ui-icon-arrow-l ui-icon-shadow' style='z-index:100;" +
                        "'></span></div>" +
                        "</li>");

            });
        }
    };
    jQuery.ajax(opts);
    return false;
});
jQuery("body").delegate("#contact_info", "click", function () {
    var opts = {
        url:"<?php echo bloginfo('url') . "/cpage/?ajax=contact_info&id=" . $page_id?>",
        type:'POST',
        cache:false,
        dataType:'JSON',
        success:function (data) {
            jQuery(".right ul").html('');
            jQuery(".right ul").html("<li data-theme='c' class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c'>" +
                    "<div class='ui-btn-inner ui-li' aria-hidden='true'>" +
                    "<div class='ui-btn-text'>" +
                    "<a href='#' class='ui-link-inherit'>" +
                    "<p class='ui-li-aside ui-li-desc'></p>" +
                    "<h3 class='ui-li-heading'>Phone Number</h3>" +
                    "<div><p style='font-size: 10px;' class='ui-li-desc'>" + data.contact_phone + "</p>" +
                    "</div>" +
                    "<h3 class='ui-li-heading'>Email Address</h3>" +
                    "<div><p style='font-size: 10px;' class='ui-li-desc'>" + data.email_address + "</p>" +
                    "</div>" +
                    "<h3 class='ui-li-heading'>Web Address</h3>" +
                    "<div><p style='font-size: 10px;' class='ui-li-desc'>" + data.web_address + "</p>" +
                    "</div>" +
                    "</a>" +
                    "</div>" +
                    "<span id='backhome' class='ui-icon ui-icon-arrow-l ui-icon-shadow' style='z-index:100;" +
                    "'></span></div>" +
                    "</li>");
        }
    };
    jQuery.ajax(opts);
    return false;
});


jQuery("body").delegate("#menu", "click", function () {
    jQuery(".right ul").html('');

    var opts = {
        url:"<?php echo bloginfo('url') . "/cpage/?ajax=menus&id=" . $page_id?>" + "&pid=" + jQuery(this).attr('data-id'),
        type:'POST',
        cache:false,
        dataType:'JSON',
        success:function (data) {
            jQuery.each(data, function (i, item) {
                jQuery(".right ul").append("<li data-id=" + item.menu_id + " class='ui-btn ui-btn-icon-right " +
                        "ui-li-has-arrow ui-li ui-li-static " +
                        "ui-body-c ui-corner-bottom ui-btn-up-c' data-theme='c'>" +
                        "<div aria-hidden='true' class='ui-btn-inner ui-li ui-li-static ui-body-c'><div class='ui-btn-text'>" +
                        "<a data-id=" + item.menu_id + " class='ui-link-inherit' id='menu' href='#'><p class='ui-li-aside ui-li-desc'></p>" +
                        "<h3 class='ui-li-heading'>" + item.name + "</h3><p class='ui-li-desc' style='font-size: 10px;" +
                        "'>Locationsre</p>" +
                        "<div></div></a></div><span id='backhome' class='ui-icon ui-icon-arrow-l ui-icon-shadow' style='z-index:100;" +
                        "'></span></div></li>"
                );
            });

        }
    };
    jQuery.ajax(opts);

    var opts = {
        url:"<?php echo bloginfo('url') . "/cpage/?ajax=menutext&id=" . $page_id?>" + "&pid=" + jQuery(this).attr('data-id'),
        type:'POST',
        dataType:'JSON',
        success:function (data) {
            jQuery.each(data, function (i, item) {
                jQuery(".right ul").append("<li class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-li-static " +
                        "ui-body-c ui-corner-bottom ui-btn-up-c' data-theme='c'>" +
                        "<div aria-hidden='true' class='ui-btn-inner ui-li ui-li-static ui-body-c'><div class='ui-btn-text'>" +
                        "<a data-id=" + item.menu_id + " class='ui-link-inherit' id='menu' href='#'><p " +
                        "class='ui-li-aside ui-li-desc'></p>" +
                        "<h3 class='ui-li-heading'>" + item.name + "</h3><p class='ui-li-desc' style='font-size: 10px;" +
                        "'></p>" +
                        "<div></div></a></div><span id='backhome' class='ui-icon ui-icon-arrow-l ui-icon-shadow' style='z-index:100;" +
                        "'></span></div></li>"
                );
            });
        }
    };
    jQuery.ajax(opts);
    return false;

});

jQuery("body").delegate("#backhome", "click", function () {
    jQuery(".right ul").html('');
    jQuery(".right ul").html("<li class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-li-static " +
            "ui-body-c ui-corner-top ui-btn-up-c' data-theme='c'>" +
            "<div aria-hidden='true' class='ui-btn-inner ui-li ui-li-static ui-body-c ui-corner-top'><div " +
            "class='ui-btn-text'><a class='ui-link-inherit' id='home_page' href='#'><p class='ui-li-aside " +
            "ui-li-desc'></p><h3 class='ui-li-heading'>Home</h3><div><p class='ui-li-desc' style='font-size: 10px;" +
            "'>Home Info</p></div></a></div><span class='ui-icon ui-icon-arrow-r ui-icon-shadow'></span></div>" +
            "</li><li class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-li-static ui-body-c ui-btn-up-c' " +
            "data-theme='c'><div aria-hidden='true' class='ui-btn-inner ui-li ui-li-static ui-body-c'>" +
            "<div class='ui-btn-text'><a class='ui-link-inherit' id='about_page' href='#'><p class='ui-li-aside " +
            "ui-li-desc'></p><h3 class='ui-li-heading'>About</h3>" +
            "<div><p class='ui-li-desc' style='font-size: 10px;'>About The Site Info</p></div></a></div>" +
            "<span class='ui-icon ui-icon-arrow-r ui-icon-shadow'></span></div></li>" +
            "<li class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c ui-li-static ui-body-c' " +
            "data-theme='c'><div aria-hidden='true' class='ui-btn-inner ui-li ui-li-static ui-body-c'>" +
            "<div class='ui-btn-text'><a class='ui-link-inherit' id='services' href='#'><p class='ui-li-aside " +
            "ui-li-desc'></p><h3 class='ui-li-heading'>Services</h3>" +
            "<div><p class='ui-li-desc' style='font-size: 10px;'>Services Info</p></div></a></div>" +
            "<span class='ui-icon ui-icon-arrow-r ui-icon-shadow'></span></div></li>" +
            "<li class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-li-static ui-body-c ui-btn-up-c' " +
            "data-theme='c'><div aria-hidden='true' class='ui-btn-inner ui-li ui-li-static ui-body-c'>" +
            "<div class='ui-btn-text'><a class='ui-link-inherit' id='members' href='#'><p class='ui-li-aside " +
            "ui-li-desc'></p><h3 class='ui-li-heading'>Members</h3>" +
            "<div><p class='ui-li-desc' style='font-size: 10px;'>Members Here</p>" +
            "</div></a></div><span class='ui-icon ui-icon-arrow-r ui-icon-shadow'></span></div>" +
            "</li><li class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c ui-li-static ui-body-c' data-theme='c'>" +
            "<div aria-hidden='true' class='ui-btn-inner ui-li ui-li-static ui-body-c'>" +
            "<div class='ui-btn-text'><a class='ui-link-inherit' id='social_media' href='#'><p class='ui-li-aside ui-li-desc'></p>" +
            "<h3 class='ui-li-heading'>Social Media</h3><div><p class='ui-li-desc' style='font-size: 10px;'>Social Media Here</p>" +
            "</div></a></div><span class='ui-icon ui-icon-arrow-r ui-icon-shadow'></span></div>" +
            "</li><li class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-li-static ui-body-c ui-btn-up-c' data-theme='c'>" +
            "<div aria-hidden='true' class='ui-btn-inner ui-li ui-li-static ui-body-c'><div class='ui-btn-text'>" +
            "<a class='ui-link-inherit' id='menu' href='#'><p class='ui-li-aside ui-li-desc'></p>" +
            "<h3 class='ui-li-heading'>Menu</h3><div><p class='ui-li-desc' style='font-size: 10px;'>Menu Here</p>" +
            "</div></a></div><span class='ui-icon ui-icon-arrow-r ui-icon-shadow'></span></div>" +
            "</li><li class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-li-static ui-body-c ui-btn-up-c' data-theme='c'>" +
            "<div aria-hidden='true' class='ui-btn-inner ui-li ui-li-static ui-body-c'>" +
            "<div class='ui-btn-text'><a class='ui-link-inherit' id='contact_info' href='#'><p class='ui-li-aside ui-li-desc'></p>" +
            "<h3 class='ui-li-heading'>Contact Info</h3><p class='ui-li-desc' style='font-size: 10px;'>Contact Information Here</p>" +
            "<div><p class='ui-li-desc'></p></div></a></div><span class='ui-icon ui-icon-arrow-r ui-icon-shadow'></span></div>" +
            "</li><li class='ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-li-static ui-body-c ui-corner-bottom ui-btn-up-c' data-theme='c'>" +
            "<div aria-hidden='true' class='ui-btn-inner ui-li ui-li-static ui-body-c'><div class='ui-btn-text'>" +
            "<a class='ui-link-inherit' id='location' href='#'><p class='ui-li-aside ui-li-desc'></p>" +
            "<h3 class='ui-li-heading'>Locations</h3><p class='ui-li-desc' style='font-size: 10px;'>Locations Here</p>" +
            "<div></div></a></div><span class='ui-icon ui-icon-arrow-r ui-icon-shadow'></span></div></li>");
});
</script>
<?php } ?>
