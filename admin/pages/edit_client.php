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
        <div id="wapp-event-header">
            <div class="span8 cls_header"><h2>Select a Client to Edit:</h2>
            </div>
            <div class="span2 offset6">

            </div>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Client/Law Firm</th>
                <th>User Login</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody id="approve">
            <?php
            $sql = "Select * from tbl_clients order by client_name";
            $res = $wpdb->get_results($sql);
            foreach ($res as $client_list) {
                ?>
            <tr id="tds-<?php echo $client_list->wp_uid?>">
                <td id="client-<?php echo $client_list->wp_uid?>"><?php echo $client_list->client_name;?></td>
                <td><?php echo $client_list->client_login_name;?></td>
                <th>
                    <li><a href="#" id="edit-client" class="edit_client"
                           data-id="<?php echo $client_list->wp_uid;?>"
                           data-name="<?php echo $client_list->client_name;?>"
                           data-loginname="<?php echo $client_list->client_login_name;?>"
                           data-wpuid="<?php echo $client_list->wp_uid;?>"><i class="icon-edit
        icon-black"></i>Edit</a></li>
                    <li>
                        <a href="#" id="delete-client" class="delete_client"
                           data-id="<?php echo $client_list->wp_uid?>"
                           data-name="<?php echo $client_list->client_name;?>"><i class="icon-edit
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

                <h3>Edit Client</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="post" id="edit-client-info">
                    <fieldset>
                        <legend>
                            <div class="control-group">
                                <label for="client-name" class="control-label">Client name :</label>

                                <div class="controls">
                                    <input type="text" name="clientname" id="client-name" class="input-xlarge"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="login_name" class="control-label">Login name :</label>

                                <div class="controls">
                                    <input type="text" name="loginname" id="login_name" class="input-xlarge"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="password" class="control-label">Password :</label>

                                <div class="controls">
                                    <input type="password" name="password" id="password" class="input-xlarge"/>
                                </div>

                            </div>
                            <div class="control-group">
                                <label for="password" class="control-label">Retype Password :</label>

                                <div class="controls">
                                    <input type="password" name="password2" id="password2"
                                           class="input-xlarge"/>
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
                        </legend>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn close-bottom">Close</a>
                <a href="#" class="btn btn-primary" id="update_client">Update Client Data</a>
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
                <a href="#" id="delete_client" class="btn btn-primary">Delete</a>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("li").removeClass('active');
        jQuery("#edit_client").addClass('active');
        jQuery("#password").removeClass("input-xlarge ui-input-text ui-body-[object Object] ui-corner-all ui-shadow-inset");
        jQuery("#password2").removeClass("input-xlarge ui-input-text ui-body-[object Object] ui-corner-all ui-shadow-inset");
    });

    jQuery(".edit_client").unbind("click").on("click", function () {
        var client_name = jQuery(this).attr('data-name');
        var client_login_name = jQuery(this).attr('data-loginname');
        jQuery("#client-name").val(client_name);
        jQuery("#login_name").val(client_login_name);
        jQuery("#myModal").removeClass("hide_modal");
        jQuery("#update_client").attr('data-id', jQuery(this).attr('data-id'));

    });

    jQuery(".close").unbind("click").on("click", function () {
        jQuery("#deleteModal").addClass("hide_modal");
        jQuery("#myModal").addClass("hide_modal");
    });

    jQuery(".close-bottom").unbind("click").on("click", function () {
        jQuery("#deleteModal").addClass("hide_modal");
        jQuery("#myModal").addClass("hide_modal");
    });

    jQuery(".delete_client").unbind("click").on("click", function () {
        var name = jQuery(this).attr('data-name');
        var id = jQuery(this).attr('data-id');
        jQuery("#deleteModal").removeClass("hide_modal");
        jQuery(".delete-modal-body p").remove();
        jQuery(".delete-modal-body").append("<p style='margin-left: 17px; '>Do you want to delete  user  " + "<strong>" + name + "</strong>" + " ? " + " </p>");
        jQuery("#delete_client").attr('data-id', jQuery(this).attr('data-id'));

    });
    jQuery("#delete_client").unbind("click").on("click", function () {
        var id = jQuery(this).attr('data-id');
        console.log(id);
        //var client_id = jQuery("#client-" + id).text();
        //console.log(client_id);
        jQuery.ajax({
            url:"<?php echo bloginfo('url') . "/ajax/?do=client&action=delete"?>&id=" + id,
            cache:false,
            success:function (html) {
                jQuery("#tds-" + id).remove();
                jQuery("#deleteModal").addClass("hide_modal");
            }
        });
    });
    jQuery("#update_client").unbind("click").on("click", function () {
        jQuery('#waiting').show(500);
        jQuery('#message').hide(0);
        var id = jQuery(this).attr('data-id');
        var opts = {
            url:"<?php echo bloginfo('url') . "/ajax/?do=client&action=update"?>&id=" + id,
            type:'POST',
            dataType:'JSON',
            data:jQuery("#edit-client-info").serialize(),
            success:function (data) {
                jQuery('#waiting').hide(500);
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

</script>