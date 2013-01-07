<?php
$id = $_SESSION['id'];
$wp_uid = get_current_user_id();
$sql = "select * from tbl_about where site_id = '$id' and wp_uid = '$wp_uid'";
$res = $wpdb->get_row($sql);
if (!$res) {
    $sql = "insert into tbl_about(site_id,wp_uid) values ('$id', '$wp_uid');";
    $res = $wpdb->get_row($sql);
}
?>
<div class="row">
    <div class="span10">
        <form method="post" action="" id="form_about" class="form_client">
            <Legend>Business Information</Legend>
            <?php
            $qry = "select * from tbl_about where site_id = '$id' and wp_uid = '$wp_uid'";
            $res = $wpdb->get_results($qry);
            foreach ($res as $about) {
                ?>
                <div class="control-group">
                    <label for="business_info">Insert your business information</label>

                    <div class="controls">
                        <textarea name="business_info" id="business_info"><?php echo $about->about_desc;?></textarea>
                    </div>
                </div>
                <?php
            }?>
            <div class="control-group">
                <div class="controls">
                    <a href="#" id="submit" class="btn btn-info">Update Business Information</a>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div id="message" style="display: none;">

                    </div>

                </div>
            </div>

        </form>
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
        jQuery("#business_info").redactor();
        jQuery("li").removeClass('active');
        jQuery("#about").addClass('active');
    });

    jQuery('#submit').unbind("click").on('click', function () {
        var page_id = <?php echo $_SESSION['id'] ?>;
        var opts = {
            url:"<?php echo bloginfo('url') . "/ajax/?do=about&action=update&id="?>" + page_id,
            type:'POST',
            dataType:'JSON',
            data:jQuery("#form_about").serialize(),
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
</script>
