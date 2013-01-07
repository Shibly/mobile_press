<?php
$id = $_SESSION['id'];
$wp_uid = get_current_user_id();
print_r("<strong>Debug Info : </strong>" . "User ID is : " . $wp_uid . " and page ID is : " . $id);
$sql = "select *from tbl_home where site_id = '$id' and wp_uid = '$wp_uid'";
$res = $wpdb->get_row($sql);
if (!$res) {
    $sql = "insert into tbl_home(site_id, wp_uid) values ('$id', '$wp_uid')";
    $res = $wpdb->get_row($sql);
}
?>
<div class="row">
    <div class="span10">
        <form enctype="multipart/form-data" method="post" action="" id="add_home" class="form_client">
            <fieldset>
                <Legend>Home</Legend>
                <?php
                $qry = "select * from tbl_home where site_id = '$id' and wp_uid = '$wp_uid'";
                $res = $wpdb->get_results($qry);
                //var_dump($res);
                foreach ($res as $home) {
                    ?>

                    <div class="control-group">
                        <label for="business_name">Business Name</label>

                        <div class="controls">
                            <input type="text" id="business_name" name="business_name" class="input-xxlarge"
                                   value="<?php echo $home->business_name; ?>"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="business_url">Business URL</label>

                        <div class="controls">
                            <input type="text" id="business_url" name="business_url" class="input-xxlarge"
                                   value="<?php echo $home->business_url; ?>"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="client_image">Choose Image</label>

                        <div class="controls">
                            <div id="file-uploader">
                                <noscript>
                                    <p>Please enable JavaScript to use file uploader.</p>

                                </noscript>
                            </div>
                            <input type="hidden" name="client_image" id="client_image"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="choose_color">Click Here to Choose a color</label>

                        <div class="controls">
                            <p><input type="text" name="color_code" maxlength="6" size="6" id="choose_color"
                                      value="<?php echo $home->color_value; ?>"/></p>
                            <input type="hidden" name="site_id" value="<?php echo $id; ?>" id="site_id"/>
                        </div>
                    </div>
                    <input type="hidden" name="filename" id="file-name"
                           value="">
                    <?php }?>
                <div class="control-group">
                    <div class="controls">
                        <a href="#" class="btn btn-info" id="submit">Update Home Information</a>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div id="message" style="display: none;">

                        </div>

                    </div>
                </div>

    </div>
    </fieldset>
    </form>
</div>


<script type="text/javascript">
    var uploader = new qq.FileUploader({
        // pass the dom node (ex. $(selector)[0] for jQuery users)
        element:document.getElementById('file-uploader'),
        // path to server-side upload script
        action:'../wp-content/themes/jqmobile/admin/ajaxupload/server/php.php'
    });


    jQuery(document).ready(function () {
        jQuery("li").removeClass('active');
        jQuery("#home").addClass('active');
        jQuery('#choose_color').colorpicker({
            format:'hex'
        });
    });

    var uploader = new qq.FileUploader({
        // pass the dom node (ex. $(selector)[0] for jQuery users)
        element:document.getElementById('file-uploader'),
        // path to server-side upload script
        // set to true to output server response to console
        //debug: false,
        action:'../wp-content/themes/jqmobile/admin/ajaxupload/server/php.php',
        onComplete:function (id, fileName, responseJSON) {
            if (jQuery('#client_image').val()) {
                jQuery.ajax({
                    url:"<?php echo bloginfo('url') . "/ajax/?do=file&action=delete"?>&id=" + jQuery('#client_image').val(),
                    cache:false,
                    success:function (html) {
                        jQuery("#tds-" + id).remove();
                        jQuery("#deleteModal").addClass("hide_modal");
                    }
                });
                jQuery('.qq-upload-list li:first-child').remove();
            }

            jQuery('#client_image').val(responseJSON.filename);
            //alert(jQuery('#client_image').val(responseJSON.filename));

        }
    });


    jQuery('#submit').unbind("click").on('click', function () {
        var opts = {
            url:"<?php echo bloginfo('url') . "/ajax/?do=home&action=update"?>",
            type:'POST',
            dataType:'JSON',
            data:jQuery("#add_home").serialize(),
            success:function (data) {
                jQuery('#message').removeClass().addClass(
                    (data.error === true) ? 'error'
                        : 'success').text(data.message)
                    .fadeIn(500).delay(1500).fadeOut(1000);
                clear_form_elements(jQuery("#create_site"));
                jQuery("#site_name").focus();
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
</script>