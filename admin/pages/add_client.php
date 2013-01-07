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
        <form method="post" action="" class="admin_form" id="add_client">
            <fieldset>
                <legend>Add A New Client</legend>
                <div class="control-group">
                    <label for="client-name" class="control-label">Client Name :</label>

                    <div class="controls">
                        <input id="client-name" type="text" name="clientname" class="input-xxlarge"/>
                    </div>
                </div>
                <div class="control-group">
                    <label for="usr_pass" class="control-label">Client's Password: </label>

                    <div class="controls">
                        <input id="usr_pass" type="password" name="password" class="input-xxlarge"/>
                    </div>
                </div>
                <div class="control-group">
                    <label for="user-login-name" class="control-label">Client's Login Name: </label>

                    <div class="controls">
                        <input id="user-login-name" type="text" name="loginname" class="input-xxlarge"/>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <a href="#" class="btn btn-info" id="submit">Create New Client</a>
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
        jQuery("li").removeClass('active');
        jQuery("#client").addClass('active');
        // No idea, why these classes are added automatically on page load.
        jQuery("#usr_pass").removeClass('ui-input-text ui-body-[object Object] ui-corner-all ui-shadow-inset');

    });

    jQuery('#submit').unbind("click").on('click', function () {
        jQuery('#waiting').show(500);
        jQuery('#message').hide(0);
        var opts = {
            url:"<?php echo bloginfo('url') . "/ajax/?do=client&action=add"?>",
            type:'POST',
            dataType:'JSON',
            data:jQuery("#add_client").serialize(),
            success:function (data) {
                jQuery('#waiting').hide(500);
                jQuery('#message').removeClass().addClass(
                    (data.error === true) ? 'error'
                        : 'success').text(data.message)
                    .fadeIn(500).delay(1500).fadeOut(1000);
                clear_form_elements(jQuery("#add_client"));
                jQuery("#client-name").focus();
            }

        };
        jQuery.ajax(opts);
        return false;
    });

</script>