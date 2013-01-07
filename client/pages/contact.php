<?php
$id = $_SESSION['id'];
$wp_uid = get_current_user_id();
$sql = "select * from tbl_contact_info where site_id = '$id' and wp_uid = '$wp_uid'";
$res = $wpdb->get_row($sql);
if (!$res) {
    $sql = "insert into tbl_contact_info(site_id,wp_uid) values ('$id', '$wp_uid');";
    $res = $wpdb->get_row($sql);
}
?>

<div class="row">
    <div class="span10">
        <form action="" method="post" id="contact_form" class="form_client">
            <Legend>Insert your contact information</Legend>
            <?php
            $qry = "select * from tbl_contact_info where site_id = '$id' and wp_uid = '$wp_uid'";
            $res = $wpdb->get_results($qry);
            foreach ($res as $contact) {
                ?>

                <div class="control-group">
                    <label for="phone_number">Phone Number</label>

                    <div class="controls"></div>
                    <input type="text" name="phone_number" id="phone_number" class="input-xxlarge"
                           value="<?php echo $contact->contact_phone;?>"/>
                </div>
                <div class="control-group">
                    <label for="email_address">Email Address</label>

                    <div class="controls"></div>
                    <input type="text" name="email_address" id="email_address" class="input-xxlarge"
                           value="<?php echo $contact->email_address;?>"/>
                </div>
                <div class="control-group">
                    <label for="web_address">WebSite URL</label>

                    <div class="controls"></div>
                    <input type="text" name="web_address" id="web_address" class="input-xxlarge"
                           value="<?php echo $contact->web_address;?>"/>
                </div>
                <?php
            }
            ?>
            <div class="control-group">
                <div class="controls">
                    <div id="message" style="display: none;">

                    </div>

                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <a href="#" id="submit" class="btn btn-info">Update Contact Information</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("li").removeClass('active');
        jQuery("#contact").addClass('active');

    });

    jQuery('#submit').unbind("click").on('click', function () {
        var page_id = <?php echo $_SESSION['id']?>;
        var opts = {
            url:"<?php echo bloginfo('url') . "/ajax/?do=contact&action=update&id="?>" + page_id,
            type:'POST',
            dataType:'JSON',
            data:jQuery("#contact_form").serialize(),
            success:function (data) {
                jQuery('#message').removeClass().addClass(
                    (data.error === true) ? 'error'
                        : 'success').text(data.message)
                    .fadeIn(500).delay(1500).fadeOut(1000);
            }
        };
        jQuery.ajax(opts);
        return false;
    });

</script>