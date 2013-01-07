<?php
$id = $_SESSION['id'];
$wp_uid = get_current_user_id();
?>

<div class="row">
    <div class="span10">
        <form enctype="multipart/form-data" action="" method="post" id="member_form" class="form_client">
            <Legend>Insert member's information</Legend>
            <div class="control-group">
                <label for="member_name">Member's name</label>

                <div class="controls">
                    <input type="text" name="member_name" id="member_name" class="input-xxlarge"/>
                </div>
            </div>
            <div class="control-group">
                <label for="member_image">Member's Image</label>

                <div class="controls">
                    <div id="file-uploader">
                        <noscript>
                            <p>Please enable JavaScript to use file uploader.</p>

                        </noscript>
                    </div>
                    <input type="hidden" name="member_image" id="member_image"/>
                </div>
            </div>
            <div class="control-group">
                <label for="member_bio">Member's Bio</label>

                <div class="controls">
                    <textarea name="member_bio" id="member_bio" class="input-xxlarge"></textarea>
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
                        <a href="#" id="submit" data-id="add" class="btn btn-info">Add Member Information</a>
                    </div>
                </div>
            </div>
        </form>
        <table class="table table-bordered admin_profile" id="service_table">
            <thead>
            <tr>
                <th>Member Name</th>
                <th>Member Bio</th>
                <th>Member Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $qry = "select * from tbl_members where site_id = '$id' and wp_uid = '$wp_uid'";
            $res = $wpdb->get_results($qry);
            foreach ($res as $service_data) {


                ?>
            <tr id="tds-<?php echo $service_data->member_id;?>">
                <td id="service-<?php echo $service_data->member_id;?>"><?php echo $service_data->member_name;?></td>
                <td><?php echo $service_data->member_bio;?></td>
                <td><?php if ($service_data->member_image != null) { ?>
                    <img style="position: relative;height: 75px;width: 75px;"
                         src="<?php bloginfo('template_directory')?>/admin/ajaxupload/server/uploads/<?php echo $service_data->member_image;?>"
                         alt="<?php echo $service_data->member_image;?>">
                    <?php } ?>
                </td>
                <th>
                    <li><a href="#" class="delete" data-id="<?php echo $service_data->member_id;?>"><i
                        class="icon-edit icon-black"></i>Delete</a></li>
                    <li>
                        <a href="#" class="edit" data-id="<?php echo $service_data->member_id;?>"
                           data-name="<?php echo $service_data->member_name;?>"
                           data-image="<?php echo $service_data->member_image;?>"
                           data-bio="<?php echo htmlspecialchars($service_data->member_bio);?>"><i
                            class="icon-edit icon-black"></i>Edit</a></li>
                    </li>
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

        <h3 style="position: relative;left: 10px;">Are you sure you want to delete this member?</h3>
    </div>
    <div class="delete-modal-body">

    </div>
    <div class="modal-footer">
        <a href="#" class="btn close-bottom">Close</a>
        <a href="#" id="delete" class="btn btn-primary">Delete</a>
    </div>
</div>

<script type="text/javascript">

    jQuery(document).ready(function () {
        jQuery("#member_bio").redactor();
        jQuery("li").removeClass('active');
        jQuery("#member").addClass('active');

    });

    var uploader = new qq.FileUploader({
        // pass the dom node (ex. $(selector)[0] for jQuery users)
        element:document.getElementById('file-uploader'),
        // path to server-side upload script
        // set to true to output server response to console
        //debug: false,
        action:'../wp-content/themes/jqmobile/admin/ajaxupload/server/php.php',
        onComplete:function (id, fileName, responseJSON) {
            if (jQuery('#member_image').val()) {
                jQuery.ajax({
                    url:"<?php echo bloginfo('url') . "/ajax/?do=file&action=delete"?>&id=" + jQuery('#member_image').val(),
                    cache:false,
                    success:function (html) {
                        jQuery("#tds-" + id).remove();
                        jQuery("#deleteModal").addClass("hide_modal");
                    }
                });
                jQuery('.qq-upload-list li:first-child').remove();
            }

            jQuery('#member_image').val(responseJSON.filename);

        }
    });

    jQuery('#submit').unbind("click").on('click', function () {
        var sid = jQuery(this).attr('data-id');
        var id = <?php echo $id = $_SESSION['id'] ?>;
        var opts = {
            url:"<?php echo bloginfo('url') . "/ajax/?do=member&action=add"?>&id=" + id + "&sid=" + sid,
            type:'POST',
            dataType:'JSON',
            data:jQuery("#member_form").serialize(),
            success:function (data) {
                jQuery('#message').removeClass().addClass(
                    (data.error === true) ? 'error'
                        : 'success').text(data.message)
                    .fadeIn(500).delay(1500).fadeOut(1000);//.fadeOut(500);
                if (data.error === false) {
                    clear_form_elements(jQuery("#member_form"));
                    jQuery("#service_title").focus();
                    location.reload();
                }
            }
        };
        jQuery.ajax(opts);
        return false;
    });

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
        var id = jQuery(this).attr('data-id');
        jQuery.ajax({
            url:"<?php echo bloginfo('url') . "/ajax/?do=member&action=delete"?>&id=" + id,
            cache:false,
            success:function (html) {
                jQuery("#tds-" + id).remove();
                jQuery("#deleteModal").addClass("hide_modal");
            }
        });
    });

    jQuery(document).ready(function () {
        jQuery("li").removeClass('active');
        jQuery("#member").addClass('active');
        jQuery("#service_description").redactor();
    });

    var reset = 0;
    jQuery(".edit").on("click", function () {
        var id = jQuery(this).attr('data-id');
        jQuery("#submit").attr('data-id', jQuery(this).attr('data-id'));
        jQuery("#submit").html('Update Member');
        if (reset == 0) {
            jQuery("#bottoms").append("<a href='#' class='btn btn-info'  id = 'reset''>Cancel</a>");
            reset = 1;
        }
        console.log(jQuery(this).attr('data-bio'));
        jQuery("#member_name").val(jQuery(this).attr('data-name'));
        var member_bio = (jQuery(this).attr('data-bio'));
        jQuery("#member_bio").insertHtml(member_bio);
        jQuery("#member_image").val(jQuery(this).attr('data-image'));
    });

    jQuery("#bottoms").delegate("#reset", "click", function () {
        jQuery("#submit").attr('data-id', 'add');
        jQuery("#submit").html('Add Member Information');
        jQuery("#member_name").val('');
        jQuery("#member_bio").insertHtml('');
        jQuery("#reset").remove();
        location.reload();
        reset = 0;
    });


</script>





