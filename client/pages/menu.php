<?php
$id = $_SESSION['id'];
$wp_uid = get_current_user_id();
?>
<div class="row">
    <div class="span10">
        <form enctype="multipart/form-data" action="" method="post" id="menu_form" class="form_menu">
            <Legend>Add Menu</Legend>
            <div class="control-group">
                <label for="menu_name">Menu Name:</label>

                <div class="controls">
                    <input type="text" name="menu_name" id="menu_name" class="input-xxlarge"/>
                </div>
            </div>
            <div class="control-group">
                <label for="select_menu">Select Parent:</label>

                <div class="controls">
                    <select id="select_menu" name="select_menu" class="input-xxlarge">
                        <option value="select_menu">Select Parent</option>
                        <?php
                        $sql = "select cat_id, name  from tbl_main_menu order by name";
                        $result = $wpdb->get_results($sql);
                        foreach ($result as $client) {
                            echo "<option value='$client->cat_id'>$client->name</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label for="menu_text">Menu Text:</label>

                <div class="controls">
                    <textarea name="menu_text" id="menu_text" class="input-xxlarge"></textarea>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div id="message" style="display: none;">

                    </div>

                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="controls" id="bottoms">
                        <a href="#" id="submit" data-id="add" class="btn btn-info">Add Menu</a>
                    </div>
                </div>
            </div>
        </form>
        <table class="table table-bordered admin_profile" id="service_table">
            <thead>
            <tr>
                <th>Menu_name</th>
                <th>Parent</th>
                <th>menu text</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $qry = "select * from tbl_main_menu where site_id = '$id' and wp_uid = '$wp_uid' and parent_menu_item = 0";
            $res = $wpdb->get_results($qry);

            foreach ($res as $service_data) {
                ?>
            <tr id="tds-<?php echo $menu_data->cat_id;?>">
                <td><?php echo $menu_data->name;?></td>
                <td><?php echo $menu_data->parent_menu_item;?></td>
                <td><?php echo $menu_data->menu_text;?></td>
                <td>
                    <li><a href="#" class="delete" data-id="<?php echo $menu_data->cat_id;?>"><i
                        class="icon-edit icon-black"></i>Delete</a></li>
                    <li>
                        <a href="#" class="edit" data-id="<?php echo $menu_data->cat_id;?>"
                           data-name="<?php echo $menu_data->name;?>"
                           data-parent="<?php echo $menu_data->parent_menu_item;?>"
                           data-text="<?php echo htmlspecialchars($menu_data->menu_text);?>">
                            <i class="icon-edit icon-black"></i>Edit</a></li>
                </td>
            </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
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

    jQuery(".close").on("click", function () {
        jQuery("#deleteModal").addClass("hide_modal");
    });

    jQuery(".close-bottom").on("click", function () {
        jQuery("#deleteModal").addClass("hide_modal");
    });
    jQuery(".delete").on("click", function () {
        var id = jQuery(this).attr('data-id');
        jQuery("#deleteModal").removeClass("hide_modal");
        jQuery(".delete-modal-body p").remove();
        jQuery("#delete").attr('data-id', jQuery(this).attr('data-id'));

    });

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

    jQuery(document).ready(function () {
        jQuery("li").removeClass('active');
        jQuery("#list_menu").addClass('active');

    });

    jQuery('#submit').unbind("click").on('click', function () {
        service_table = jQuery("#service_table");
        service_table.show(500);
        var sid = jQuery(this).attr('data-id');
        var id = <?php echo $id = $_SESSION['id'] ?>;
        var opts = {
            url:"<?php echo bloginfo('url') . "/ajax/?do=menu&action=add"?>&id=" + id + "&sid=" + sid,
            type:'POST',
            dataType:'JSON',
            data:jQuery("#menu_form").serialize(),
            success:function (data) {
                jQuery('#message').removeClass().addClass(
                    (data.error === true) ? 'error'
                        : 'success').text(data.message)
                    .fadeIn(500).delay(1500).fadeOut(1000);
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

    var reset = 0;
    jQuery(".edit").on("click", function () {
        service_table = jQuery("#service_table");
        service_table.hide(500);
        var id = jQuery(this).attr('data-id');
        jQuery("#submit").attr('data-id', jQuery(this).attr('data-id'));
        jQuery("#submit").html('Update Service');
        if (reset == 0) {
            jQuery("#bottoms").append("<a href='#' class='btn btn-info'  id = 'reset''>Cancel</a>");
            reset = 1;
        }

        jQuery("#menu_name").val(jQuery(this).attr('data-name'));
        jQuery("#menu_text").insertHtml(jQuery(this).attr('data-text'));
        jQuery("#select_menu").val(jQuery(this).attr('data-parent'));
    });
    jQuery("#bottoms").delegate("#reset", "click", function () {
        service_table = jQuery("#service_table");
        service_table.show(500);
        location.reload();
        jQuery("#menu_name").val();
        jQuery("#menu_text").insertHtml();
        jQuery("#select_menu").val();
        location.remove();
        jQuery("#reset").remove();
        reset = 0;
    });


</script>