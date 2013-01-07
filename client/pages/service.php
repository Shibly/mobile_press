<?php
$id = $_SESSION['id'];
$wp_uid = get_current_user_id();
?>
<div class="row">
    <div class="span10">
        <form enctype="multipart/form-data" action="" method="post" id="service_form" class="form_client">
            <Legend>Insert your Service information</Legend>
            <div class="control-group">
                <label for="service_title">Service Title</label>

                <div class="controls">
                    <input type="text" name="service_title" id="service_title" class="input-xxlarge"/>
                </div>
            </div>
            <div class="control-group">
                <label for="service_image">Service Image</label>

                <div class="controls">
                    <div id="file-uploader">
                        <noscript>
                            <p>Please enable JavaScript to use file uploader.</p>
                        </noscript>
                    </div>
                    <input type="hidden" name="service_image" id="service_image"/>
                </div>
            </div>
            <div class="control-group">
                <label for="service_description">Service Description</label>

                <div class="controls">
                    <textarea name="service_description" id="service_description" class="input-xxlarge"></textarea>
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
                        <a href="#" id="submit" data-id="add" class="btn btn-info">Add Service Information</a>
                    </div>
                </div>
            </div>
        </form>
        <table class="table table-bordered admin_profile" id="service_table">
            <thead>
            <tr>
                <th>Service Title</th>
                <th>Description</th>
                <th>Service Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $qry = "select * from tbl_services where site_id = '$id' and wp_uid = '$wp_uid'";
            $res = $wpdb->get_results($qry);
            foreach ($res as $service_data) {


                ?>
            <tr id="tds-<?php echo $service_data->service_id;?>">
                <td id="service-<?php echo $service_data->service_id;?>"><?php echo $service_data->service_title;?></td>
                <td><?php echo $service_data->service_description;?></td>
                <td><?php if ($service_data->service_image != null) { ?>
                    <img style="position: relative;height: 75px;width: 75px; left: 33px;"
                         src="<?php bloginfo('template_directory')?>/admin/ajaxupload/server/uploads/<?php echo $service_data->service_image;?>"
                         alt="<?php echo $service_data->service_image;?>">
                    <?php } ?>
                </td>
                <th>
                    <li><a href="#" class="delete" data-id="<?php echo $service_data->service_id;?>"><i
                        class="icon-edit icon-black"></i>Delete</a></li>
                    <li>
                        <a href="#" class="edit" data-id="<?php echo $service_data->service_id;?>"
                           data-service_title="<?php echo $service_data->service_title;?>"
                           data-image="<?php echo $service_data->service_image;?>"
                           data-service_desc="<?php echo
                           htmlspecialchars($service_data->service_description);?>"><i class="icon-edit
        icon-black"></i>Edit</a></li>
                </th>
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

        <h3 style="position: relative;left: 10px;">Are you sure you want to delete this service?</h3>
    </div>
    <div class="delete-modal-body">

    </div>
    <div class="modal-footer">
        <a href="#" class="btn close-bottom">Close</a>
        <a href="#" id="delete_service" class="btn btn-primary">Delete</a>
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
        jQuery("#delete_service").attr('data-id', jQuery(this).attr('data-id'));

    });

    jQuery("#delete").on("click", function () {
        //alert('delete');
        var id = jQuery(this).attr('data-id');
        //console.log(id);
        jQuery.ajax({
            url:"<?php echo bloginfo('url') . "/ajax/?do=service&action=delete"?>&id=" + id,
            cache:false,
            success:function (html) {
                jQuery("#tds-" + id).remove();
                jQuery("#deleteModal").addClass("hide_modal");
            }
        });
    });

    jQuery(document).ready(function () {
        jQuery("li").removeClass('active');
        jQuery("#services").addClass('active');
        jQuery("#service_description").redactor();
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

            jQuery('#service_image').val(responseJSON.filename);

        }
    });

    jQuery('#submit').unbind("click").on('click', function () {
        service_table = jQuery("#service_table");
        service_table.show(500);
        var sid = jQuery(this).attr('data-id');
        var id = <?php echo $id = $_SESSION['id'] ?>;
        var opts = {
            url:"<?php echo bloginfo('url') . "/ajax/?do=service&action=add"?>&id=" + id + "&sid=" + sid,
            type:'POST',
            dataType:'JSON',
            data:jQuery("#service_form").serialize(),
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

        jQuery("#service_title").val(jQuery(this).attr('data-service_title'));
        var service_desc = jQuery(this).attr('data-service_desc');
        jQuery("#service_description").insertHtml(service_desc);
        jQuery("#service_image").val(jQuery(this).attr('data-image'));
    });
    jQuery("#bottoms").delegate("#reset", "click", function () {
        service_table = jQuery("#service_table");
        service_table.show(500);
        location.reload();
        jQuery("#submit").attr('data-id', 'add');
        jQuery("#submit").html('Add Service Information');
        jQuery("#service_title").val("");
        jQuery("#service_description").val("");
        jQuery("#service_image").val("");
        location.remove();
        jQuery("#reset").remove();
        reset = 0;
    });


</script>