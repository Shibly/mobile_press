<?php
$id = $_SESSION['id'];
$wp_uid = get_current_user_id();
?>
<div class="row">
    <div class="span10">
        <Legend>Add Menu</Legend>
        <div class="control-group">
            <label class="control-label">Choose a Type:</label>
            <br/>

            <div class="controls">
                <input type="radio" name="option" value="item" checked="checked" id="item"/> Item
                <input type="radio" name="option" value="category" id="category"/> Category
            </div>
        </div>

        <form enctype="multipart/form-data" action="" method="post" id="menu_category" class="form_menu">

            <div class="control-group">
                <label for="menu_name">Menu Name:</label>

                <div class="controls">
                    <input type="text" name="menu_name" id="menu_name" class="input-xxlarge"/>
                </div>
            </div>
            <div class="control-group">
                <label for="menu_text">Description:</label>

                <div class="controls">
                    <textarea name="menu_text" id="menu_text" class="input-xxlarge"></textarea>
                </div>
            </div>

            <!--            <div class="control-group">
                <label for="select_menu">Select Parent:</label>

                <div class="controls">
                    <select id="select_menu" name="select_menu" class="input-xxlarge">
                        <option value="select_menu">Select Parent</option>
                        <?php
            /*                        $id = $_SESSION['id'];
            $sql = "select menu_id, name  from tbl_menu where parent = 0 and site_id = $id and wp_uid = $wp_uid order by name";
            $result = $wpdb->get_results($sql);
            foreach ($result as $client) {
                echo "<option value='$client->menu_id'>$client->name</option>";
            }
            */?>
                    </select>
                </div>
            </div>-->
            <div class="control-group">
                <div class="controls">
                    <div id="message" style="display: none;">

                    </div>

                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="controls" id="bottoms">
                        <a href="#" id="submit" data-id="add" class="btn btn-info">Add Category</a>
                    </div>
                </div>
            </div>
        </form>
        <form enctype="multipart/form-data" action="" method="post" id="menu_item" class="form_menu">

            <div class="control-group">
                <label for="menu_name">Name:</label>

                <div class="controls">
                    <input type="text" name="item_name" id="item_name" class="input-xxlarge"/>
                </div>
            </div>
            <div class="control-group">
                <label for="menu_name">Price:</label>

                <div class="controls">
                    <input type="text" name="item_price" id="item_price" class="input-xxlarge"/>
                </div>
            </div>

            <div class="control-group">
                <label for="item_photo">Service Image</label>

                <div class="controls">
                    <div id="file-uploader">
                        <noscript>
                            <p>Please enable JavaScript to use file uploader.</p>
                        </noscript>
                    </div>
                    <input type="hidden" name="item_photo" id="item_photo"/>
                </div>
            </div>
            <div class="control-group">
                <label for="menu_name">Description:</label>

                <div class="controls">
                    <input type="text" name="item_description" id="item_description" class="input-xxlarge"/>
                </div>
            </div>


            <div class="control-group">
                <label for="select_item">Select Parent:</label>

                <div class="controls">
                    <select id="select_item" name="select_menu" class="input-xxlarge">
                        <option value="select_menu">Select Parent</option>
                        <?php
                        $sql = "select menu_id, name  from tbl_menu where site_id = $id and wp_uid = $wp_uid and parent = 0 order by name";
                        $result = $wpdb->get_results($sql);
                        foreach ($result as $client) {
                            echo "<option value='$client->menu_id'>$client->name</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!--            <div class="control-group">
                <label for="select_menu">Select Child:</label>

                <div class="controls">
                    <select id="select_item_child" name="select_item_child" class="input-xxlarge">

                    </select>
                </div>
            </div>-->

            <div class="control-group">
                <div class="controls">
                    <div id="message_item" style="display: none;">

                    </div>

                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div id="message2" style="display: none;">

                    </div>

                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="controls" id="bottoms_item">
                        <a href="#" id="submit_item" data-id="add" class="btn btn-info">Add Menu</a>
                    </div>
                </div>
            </div>
        </form>

        <div id="service_table" class="table table-bordered admin_profile">

            <?php
            $qry = "select * from tbl_menu where site_id = '$id' and wp_uid = '$wp_uid' and parent = 0";
            $res = $wpdb->get_results($qry);

            foreach ($res as $menu_data) {
                ?>
                <div class="row table table-bordered admin_profile"
                     style="margin-left:
                -1px;
                margin-bottom: 0px;"
                     id="tds-<?php echo
                     $menu_data->menu_id;?>">
                    <div class="span1 showhide" data-mid='<?php echo $menu_data->menu_id ?>'><i
                            class="icon-chevron-down"></i></div>
                    <div class="span7"><span><?php echo $menu_data->name;?> : </span><span><?php echo
                    $menu_data->description;
                        ?></span></div>
                    <div class="span1" style="margin-left: 80px;">
                    <span><a href="#" class="delete"
                             data-id="<?php echo $menu_data->menu_id;?>"><i
                            class="icon-remove"></i></a></span>
                    <span>
                        <a href="#" class="edit" data-id="<?php echo $menu_data->menu_id;?>"
                           data-isitem='<?php echo $menu_data->is_item; ?>'
                           data-name="<?php echo $menu_data->name;?>"
                           data-parent="<?php echo $menu_data->parent;?>"
                           data-text="<?php echo htmlspecialchars($menu_data->description);?>">
                            <i class="icon-pencil"></i></a></span>
                    </div>
                </div>
                <?php
                echo render($menu_data->menu_id);
            }
            ?>

        </div>
    </div>
</div>

<div class="modal hide_modal" id="deleteModal">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>

        <h3 style="position: relative;left: 10px;">Are you sure you want to delete this menu?</h3>
    </div>
    <div class="delete-modal-body">

    </div>
    <div class="modal-footer">
        <a href="#" class="btn close-bottom">Close</a>
        <a href="#" id="delete" class="btn btn-primary">Delete</a>
    </div>
</div>

<script type="text/javascript">

function clear_form_elements(ele) {
    jQuery(ele).find(':input').each(function () {
        switch (this.type) {
            case 'password' :
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                jQuery(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });
}

jQuery(document).ready(function () {
    jQuery("#menu_category").css({
        'display':'none'
    });
    jQuery("li").removeClass('active');
    jQuery("#list_menu").addClass('active');
});
jQuery("#item").on('change', function () {
    jQuery("#menu_category").hide('fast');
    jQuery("#menu_item").show('fast');
});

jQuery("#category").on('change', function () {
    jQuery("#menu_item").hide('fast');
    jQuery("#menu_category").show('fast');
});


jQuery('#submit').unbind("click").on('click', function () {
    service_table = jQuery("#service_table");
    service_table.show(500);
    var sid = jQuery(this).attr('data-id');
    var id = <?php echo $id = $_SESSION['id'] ?>;
    var opts = {
        url:"<?php echo bloginfo('url') . "/ajax/?do=menu&action=addCat"?>&id=" + id + "&sid=" + sid,
        type:'POST',
        dataType:'JSON',
        data:jQuery("#menu_category").serialize(),
        success:function (data) {
            jQuery('#message').removeClass().addClass(
                    (data.error === true) ? 'error'
                            : 'success').text(data.message)
                    .fadeIn(500).delay(1500);//.fadeOut(1000);
            if (data.error === false) {
                clear_form_elements(jQuery("#service_form"));
                jQuery("#service_title").focus();
                location.reload();
            }
        }
    };
    jQuery.ajax(opts);
    return false;
});

jQuery('#submit_item').unbind("click").on('click', function () {
    service_table = jQuery("#service_table");
    service_table.show(500);
    var sid = jQuery(this).attr('data-id');
    var id = <?php echo $id = $_SESSION['id'] ?>;
    var opts = {
        url:"<?php echo bloginfo('url') . "/ajax/?do=menu&action=addItem"?>&id=" + id + "&sid=" + sid,
        type:'POST',
        dataType:'JSON',
        data:jQuery("#menu_item").serialize(),
        success:function (data) {
            jQuery('#message2').removeClass().addClass(
                    (data.error === true) ? 'error'
                            : 'success').text(data.message)
                    .fadeIn(500).delay(1500);//.fadeOut(1000);
            if (data.error === false) {
                clear_form_elements(jQuery("#service_form"));
                jQuery("#service_title").focus();
                location.reload();
            }
        }
    };
    jQuery.ajax(opts);
    return false;
});

var uploader = new qq.FileUploader({
    // pass the dom node (ex. $(selector)[0] for jQuery users)
    element:document.getElementById('file-uploader'),
    // path to server-side upload script
    // set to true to output server response to console
    //debug: false,
    action:'../wp-content/themes/jqmobile/admin/ajaxupload/server/php.php',
    onComplete:function (id, fileName, responseJSON) {
        if (jQuery('#service_image').val()) {
            jQuery.ajax({
                url:"<?php echo bloginfo('url') . "/ajax/?do=file&action=delete"?>&id=" + jQuery('#service_image').val(),
                cache:false
            });
            jQuery('.qq-upload-list li:first-child').remove();
        }

        jQuery('#item_photo').val(responseJSON.filename);

    }
});


jQuery("#select_item").on('change', function () {
    var parent_id = jQuery(this).val();
    var opts = {
        url:"<?php echo bloginfo('url') . "/ajax/?do=menu&action=loadChild"?>&pid=" + parent_id,
        type:'POST',
        dataType:'JSON',
        data:parent_id,
        success:function (ret) {
            jQuery("#select_item_child").html('');
            jQuery.each(ret, function (key, item) {
                jQuery("#select_item_child").append('<option value="' + item.menu_id + '">' + item.child_name + '</option>');
            });
        }
    };
    jQuery.ajax(opts);
    return false;
    jQuery("#select_item_child").html('');

    //
});
var show;
jQuery(".showhide").unbind("click").on('click', function () {

    if (!show || show == 0) {
        jQuery(".sh" + jQuery(this).attr('data-mid')).hide('slow');
        show = 1;
    } else if (show == 1) {
        jQuery(".sh" + jQuery(this).attr('data-mid')).show('slow');
        show = 0;
    }
    //jQuery(this).attr('data-mid')
});

jQuery(".delete").on("click", function () {
    var id = jQuery(this).attr('data-id');
    jQuery("#deleteModal").removeClass("hide_modal");
    jQuery(".delete-modal-body p").remove();
    jQuery("#delete").attr('data-id', jQuery(this).attr('data-id'));

});


/*
*
* @ Delete the menu
*
* */

jQuery("#delete").on("click", function () {
    //alert('delete');
    var id = jQuery(this).attr('data-id');
    // check that if the menu is parent or not
    //console.log(id);
    jQuery.ajax({
        url:"<?php echo bloginfo('url') . "/ajax/?do=menu&action=delete"?>&id=" + id,
        cache:false,
        success:function (html) {
            jQuery("#tds-" + id).remove();
            jQuery("#deleteModal").addClass("hide_modal");
            location.reload();
        }
    });
});

var reset_c = 0;
var reset_i = 0;

// Editing the menu.
jQuery(".edit").on("click", function () {
    if (jQuery(this).attr('data-isitem') == 0) {
        jQuery("#menu_item").hide('fast');
        jQuery("#menu_category").show('fast');
        if (reset_c == 0) {
            jQuery("#bottoms").append("<a href='#' class='btn btn-info'  id = 'reset_c'>Cancel</a>");
            reset_c = 1;
        }
        jQuery("#menu_name").val(jQuery(this).attr('data-name'));
        jQuery("#menu_text").val(jQuery(this).attr('data-text'));
        jQuery("#select_menu").val(jQuery(this).attr('data-parent'));
        jQuery("#submit").attr('data-id', jQuery(this).attr('data-id'));
        jQuery("#select_menu").val(jQuery(this).attr('data-parent'));


    } else {
        jQuery("#menu_item").show('fast');
        jQuery("#menu_category").hide('fast');
        if (reset_i == 0) {
            jQuery("#bottoms_item").append("<a href='#' class='btn btn-info'  id = 'reset_i''>Cancel</a>");
            reset_i = 1;
        }
        var data_id = (jQuery(this).attr('data-parent'));
        var opts = {
            url:"<?php echo bloginfo('url') . "/ajax/?do=menu&action=getParent"?>&did=" + data_id,
            dataType:'JSON',
            success:function (ret) {
                console.log(ret);
                if (ret.parent == 0) {
                    jQuery("#select_item").val(data_id);
                } else {
                    jQuery("#select_item").val(ret.parent);

                    var opts = {
                        url:"<?php echo bloginfo('url') . "/ajax/?do=menu&action=loadChild"?>&pid=" + ret.parent,
                        type:'POST',
                        dataType:'JSON',
                        success:function (ret) {
                            jQuery("#select_item_child").html('');
                            jQuery.each(ret, function (key, item) {
                                jQuery("#select_item_child").append('<option value="' + item.menu_id + '">' + item.child_name + '</option>');
                            });
                        }
                    };
                    jQuery.ajax(opts);

                    jQuery("#select_item_child").val(data_id);
                }
            }
        };
        jQuery.ajax(opts);

        jQuery("#item_name").val(jQuery(this).attr('data-name'));
        jQuery("#item_price").val(jQuery(this).attr('data-price'));
        jQuery("#item_description").val(jQuery(this).attr('data-desc'));
        jQuery("#item_description").val(jQuery(this).attr('data-desc'));
        jQuery("#submit_item").attr('data-id', jQuery(this).attr('data-id'));

    }

});
jQuery("#bottoms").delegate("#reset_c", "click", function () {
    //service_table = jQuery("#service_table");
    //service_table.show(500);

    clear_form_elements(jQuery("#menu_category"));
    jQuery("#item_name").val();
    //jQuery("#menu_text").insertHtml();
    //jQuery("#select_menu").val();
    jQuery("#reset_i").remove();
    jQuery("#reset_c").remove();
    reset_c = 0;
    reset_i = 0;
});

jQuery("#bottoms_item").delegate("#reset_i", "click", function () {
    //service_table = jQuery("#service_table");
    //service_table.show(500);
    //jQuery("#menu_name").val();
    //jQuery("#menu_text").insertHtml();
    //jQuery("#select_menu").val();
    clear_form_elements(jQuery("#menu_item"));
    jQuery("#reset_i").remove();
    jQuery("#reset_c").remove();
    reset_c = 0;
    reset_i = 0;
});

jQuery(".close").on("click", function () {
    jQuery("#deleteModal").addClass("hide_modal");
});

jQuery(".close-bottom").on("click", function () {
    jQuery("#deleteModal").addClass("hide_modal");
});
</script>

<?php
function render($parent)
{
    global $wpdb;
    $id = $_SESSION['id'];
    $wp_uid = get_current_user_id();

    $qry = "select *from tbl_menu where site_id = '$id' and wp_uid = '$wp_uid' and parent = '$parent'";
    $res = $wpdb->get_results($qry);

    if (!$res)
        return;

    $html = "<div data-mid='$parent' id='service_table' class='sh$parent table table-bordered admin_profile' style='margin-left: -1px; margin-bottom: 0px;'>";
    foreach ($res as $menu_data) {
        if ($menu_data->is_item == 1)
            $html .= renderItem($menu_data);
        else {
            $html .= renderCatagory($menu_data);
        }
    }

    $html .= "</div>";
    return $html;
}

function renderItem($menu_data)
{
    $photo = get_bloginfo('template_directory') . '/admin/ajaxupload/server/uploads/' . $menu_data->photo;
    $html = "<div data-mid='$menu_data->menu_id' id='service_table' class='$menu_data->parent table table-bordered admin_profile' style='margin-left: -1px;
        margin-bottom: 0px;' >";

    $html .= "<div class='row table table-bordered admin_profile' style='margin-left: -1px; margin-bottom: 0px;'
                     id=tds-'$menu_data->menu_id'>";
    $html .= "<br>";
    $html .= "<div class='span1 showhide' data-mid='$menu_data->menu_id'>--</div>";
    $html .= "<div class='span2'><img src='$photo' alt='a'/></div>";
    $html .= "<div class='span2'><div> $menu_data->name </div><div>$menu_data->price</div></div>";
    $html .= "<div class='span3'><span>$menu_data->description</span></div>";
    $html .= "<div class='span1' style='margin-left: 80px;'>
                    <span><a href='#' class='delete' data-id='$menu_data->menu_id''><i
                            class='icon-remove'></i></a></span>";
    $html .= "<span><a href='#' class='edit' data-id=' $menu_data->menu_id'
                           data-id='$menu_data->menu_id'
                           data-isitem='$menu_data->is_item'
                           data-price='$menu_data->price'
                           data-name='$menu_data->name'
                           data-parent='$menu_data->parent'
                           data-father='$menu_data->father'
                           data-desc='$menu_data->description'><i
                        class='icon-pencil'></i></a></span>
                            </div></div>";
    $html .= "</div>";
    return $html;
}

function renderCatagory($menu_data)
{
    $html = "<div data-mid='$menu_data->menu_id' id='service_table' class='$menu_data->parent table table-bordered admin_profile'
 style='margin-left: -1px; margin-bottom: 0px;' >";
    $html .= "<div class='row table table-bordered admin_profile' style='margin-left: -1px; margin-bottom: 0px;'
                     id=tds-'$menu_data->menu_id'>";
    $html .= "<div class='span1 showhide' data-mid='$menu_data->menu_id'>-</div>";
    $html .= "<div class='span7'><span> <strong>$menu_data->name :</strong> </span><span>$menu_data->description</span></div>";
    $html .= "<div class='span1' style='margin-left: 80px;'>
                    <span><a href='#' class='delete' data-id='$menu_data->menu_id''><i
                            class='icon-remove'></i></a></span>";
    $html .= "<span><a href='#' class='edit' data-id=' $menu_data->menu_id'
                         data-id='$menu_data->menu_id'
                        data-isitem='$menu_data->is_item'
                           data-name='$menu_data->name'
                           data-parent='$menu_data->parent'
                           data-text='$menu_data->description'><i
                        class='icon-pencil'></i></a></span>
                            </div></div>";
    $html .= "</div>";

    global $wpdb;
    $id = $_SESSION['id'];
    $wp_uid = get_current_user_id();

    $qry = "select * from tbl_menu where site_id = '$id' and wp_uid = '$wp_uid'
             and parent = '$menu_data->menu_id' and is_item=1";
    $res = $wpdb->get_results($qry);

    if ($res) {
        foreach ($res as $menu_data) {
            $html .= renderItem($menu_data);
        }
    }
    return $html;
}

?>

