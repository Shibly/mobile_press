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
        <form method="post" action="" id="create_site">
            <fieldset>
                <legend>Create A New Mobile Site</legend>
                <div class="control-group">
                    <label for="site_name">Insert Your Site Name</label>

                    <div class="controls">
                        <input type="text" id="site_name" name="site_name" class="input-xxlarge"/>
                    </div>
                </div>
                <div class="control-group">
                    <label for="client" class="control-label">Client :</label>

                    <div class="controls">
                        <select id="client" name="client" class="input-xxlarge">
                            <option value="Select Client">Select Client</option>
                            <?php
                            $sql = "select wp_uid, client_name  from tbl_clients order by client_name";
                            $result = $wpdb->get_results($sql);
                            foreach ($result as $client) {
                                echo "<option value='$client->wp_uid'>$client->client_name</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <a href="#" class="btn btn-info" id="submit">Create A New Site</a>
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
        jQuery("#client").select2();
        jQuery("li").removeClass('active');
        jQuery("#page").addClass('active');
    });

    jQuery('#submit').unbind("click").on('click', function () {
        jQuery('#waiting').show(500);
        jQuery('#message').hide(0);
        var opts = {
            url:"<?php echo bloginfo('url') . "/ajax/?do=page&action=add"?>",
            type:'POST',
            dataType:'JSON',
            data:jQuery("#create_site").serialize(),
            success:function (data) {
                jQuery('#waiting').hide(500);
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