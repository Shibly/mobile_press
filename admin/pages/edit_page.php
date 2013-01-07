<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Shibly
 * Date: 7/30/12
 * Time: 12:22 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<div class="row">
    <div class="span10">
        <legend>Select A Site To Edit</legend>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Page Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="approve">
            <?php
            $sql = "SELECT * FROM tbl_sites order by page_name;";
            $res = $wpdb->get_results($sql);
            foreach ($res as $page_list) {
                ?>
            <tr id="tds-<?php echo $page_list->page_name?>">
                <td id="page-<?php echo $page_list->page_id?>"><?php echo $page_list->page_name;?></td>
                <th>
                    <li><a href="#" class="edit_site"
                           data-id="<?php echo $page_list->page_id;?>"
                           data-name="<?php echo $page_list->page_name;?>"
                           data-wpuid="<?php echo $page_list->page_id;?>"><i
                        class="icon-edit icon-black"></i>Edit</a>
                    </li>
                    <li>
                        <a href="#" id="delete-site" class="delete_site"
                           data-id="<?php echo $page_list->sites_id;?>"
                           data-name="<?php echo $page_list->page_name;?>"><i class="icon-edit
        icon-black"></i>Delete</a></li>
                </th>
            </tr>
                <?php
            }?>
            </tbody>
        </table>
        <div class="modal hide_modal" id="myModal">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">x</a>

                <h3>Edit Site Name</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="post" id="edit_site">
                    <fieldset>
                        <div class="control-group">
                            <label for="site_name" class="control-label">Site name :</label>

                            <div class="controls">
                                <input type="text" name="site_name" id="site_name" class="input-xlarge"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <div id="waiting" style="display: none;">
                                    Please wait...
                                    <br/>
                                    <!-- <img src="bootstrap/img/ajax-loader.gif" title="Loader" alt="Loader"/>-->
                                </div>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <div id="message" style="display: none;">

                                </div>

                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn close-bottom">Close</a>
                <a href="#" class="btn btn-primary" id="update_site">Update Site Name</a>
            </div>
        </div>

        <div class="modal hide_modal" id="deleteModal">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>

                <h3>Confirm Delete the user ?</h3>
            </div>
            <div class="delete-modal-body">

            </div>
            <div class="modal-footer">
                <a href="#" class="btn close-bottom">Close</a>
                <a href="#" id="delete_site" class="btn btn-primary">Delete</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    jQuery(document).ready(function () {
        jQuery("li").removeClass('active');
        jQuery("#edit_page").addClass('active');
    });

    jQuery(".edit_site").unbind("click").on("click", function () {
        var site_name = jQuery(this).attr('data-name');
        jQuery("#site_name").val(site_name);
        jQuery("#myModal").removeClass("hide_modal");
        jQuery("#update_site").attr('data-id', jQuery(this).attr('data-id'));

    });


    jQuery("#edit_site").unbind("click").on("click", function () {
        var site_name = jQuery(this).attr('data-name');
        jQuery("#site_name").val(site_name);
        jQuery("#myModal").removeClass("hide_modal");
        jQuery("#update_site").attr('data-id', jQuery(this).attr('data-id'));
    });

    jQuery(".close").unbind("click").on("click", function () {
        jQuery("#deleteModal").addClass("hide_modal");
        jQuery("#myModal").addClass("hide_modal");
    });

    jQuery(".close-bottom").unbind("click").on("click", function () {
        jQuery("#deleteModal").addClass("hide_modal");
        jQuery("#myModal").addClass("hide_modal");
    });

    jQuery("#update_site").unbind("click").on("click", function () {
        jQuery('#message').hide(30);
        var id = jQuery(this).attr('data-id');
        alert(id);
        var opts = {
            url:"<?php echo bloginfo('url') . "/ajax/?do=page&action=update"?>&id=" + id,
            type:'POST',
            dataType:'JSON',
            data:jQuery("#edit_site").serialize(),
            success:function (data) {
                jQuery('#message').removeClass().addClass(
                    (data.error === true) ? 'error'
                        : 'success').text(data.message)
                    .fadeIn(500).delay(1500).fadeOut(1000);
                location.reload();
            }
        };
        jQuery.ajax(opts);
        return false;

    });


    jQuery(".delete_site").unbind("click").on("click", function () {
        var name = jQuery(this).attr('data-name');
        var id = jQuery(this).attr('data-id');
        jQuery("#deleteModal").removeClass("hide_modal");
        jQuery(".delete-modal-body p").remove();
        jQuery(".delete-modal-body").append("<p style='margin-left: 17px; '>Do you want to delete    "
            + "<strong>" + name + "</strong>" + " page  ? " + " </p>");
        jQuery("#delete_site").attr('data-name', jQuery(this).attr('data-name'));
    });

    jQuery("#delete_site").unbind("click").on("click", function () {
        var site_name = jQuery(this).attr('data-name');
        alert(site_name);
        var opts = {
            url:"<?php echo bloginfo('url') . "/ajax/?do=page&action=delete"?>&site_name=" + site_name,
            cache:false,
            success:function (html) {
                jQuery("#tds-" + site_name).remove();
                jQuery("#deleteModal").addClass("hide_modal");
            }

        };
        jQuery.ajax(opts);
        return false;
    });

    jQuery("#update_site").unbind("click").on("click", function () {
        jQuery('#waiting').show(500);
        jQuery('#message').hide(0);
        var id = jQuery(this).attr('data-id');
        //alert(id);
        var opts = {
            url:"<?php echo bloginfo('url') . "/ajax/?do=page&action=update"?>&id=" + id,
            type:'POST',
            dataType:'JSON',
            data:jQuery("#edit_site").serialize(),
            success:function (data) {
                jQuery('#waiting').hide(500);
                jQuery('#message').removeClass().addClass(
                    (data.error === true) ? 'error'
                        : 'success').text(data.message)
                    .fadeIn(500).delay(1500).fadeOut(500);
                location.reload();
            }
        };
        jQuery.ajax(opts);
        return false;
    });

</script>