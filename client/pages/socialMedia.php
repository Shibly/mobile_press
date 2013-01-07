<?php
$id = $_SESSION['id'];
$wp_uid = get_current_user_id();
?>
<div class="row">
    <div class="span10">
        <form enctype="multipart/form-data" class="client_form" action="" method="post"
              id="socialMedia_form">
            <fieldset>
                <legend>Select your social media and submit the link</legend>
                <div class="control-group">
                    <label for="social-media" class="control-label">Social media name:</label>

                    <div class="controls">
                        <select name="social_name" id="social-media">
                            <option value="facebook">Facebook</option>
                            <option value="twitter">Twitter</option>
                            <option value="linkedin">Linkedin</option>
                            <option value="youtube">Youtube</option>
                            <option value="yelp">Yelp</option>
                            <option value="googleplus">google+</option>
                            <option value="myspace">Myspace</option>
                            <option value="flickr">Flickr</option>
                            <option value="picasa">Picasa</option>
                            <option value="blog">Blog</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label for="title" class="control-label">Title: </label>

                    <div class="controls">
                        <input id="title" type="text" name="title" class="input-xxlarge"
                               value=""/>
                    </div>
                </div>
                <div class="control-group">
                    <label for="url" class="control-label">Social Url: </label>

                    <div class="controls">
                        <input id="url" type="text" name="url" class="input-xxlarge"
                               value=""/>
                    </div>
                </div>


                <div class="control-group">
                    <div class="controls" id="bottoms">
                        <a href="#" class="btn btn-info" data-id='add' id="submit">Add Social media</a>
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
        <table class="table table-bordered admin_profile" id="socialMedia_table">
            <thead>
            <tr>
                <th>Social Media Name</th>
                <th>Social Media Title</th>
                <th>URL</th>
                <th>Action</th>
            </tr>
            </thead>
            <?php
            $qry = "SELECT * FROM tbl_social_media where site_id = '$id' AND wp_uid = $wp_uid";
            $res = $wpdb->get_results($qry);
            foreach ($res as $social_media) {
                ?>
                        <tbody>
                            <tr id="tds-<?php echo $social_media->social_media_id;?>">
                                <td><?php echo $social_media->social_media_name;?></td>
                                <td><?php echo $social_media->social_media_title;?></td>
                                <td><?php echo $social_media->social_media_url;?></td>
                                <th>
                                    <li><a href="#" class="delete_social_media"
                                           data-id="<?php echo $social_media->social_media_id;?>"><i
                                        class="icon-edit
        icon-black"></i>Delete</a></li>
                                    <li>
                                        <a href="#" class="edit_social_media"
                                           data-app_id="<?php echo $social_media->site_id; ?>"
                                           data-social_media_name="<?php echo $social_media->social_media_name; ?>"
                                           data-social_media_title="<?php echo $social_media->social_media_title; ?>"
                                           data-social_media_url="<?php echo $social_media->social_media_url;?>"
                                           data-id="<?php echo $social_media->social_media_id;?>"><i
                                            class="icon-edit
        icon-black"></i>Edit</a></li>
                                </th>
                            </tr>
                <?php
            }?>
        </tbody>
        </table>
    </div>
</div>
<div class="modal hide_modal" id="deleteModal">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>

        <h3 style="position: relative;left: 10px;">Confirm delete selected URL ?</h3>
    </div>
    <div class="delete-modal-body">

    </div>
    <div class="modal-footer">
        <a href="#" class="btn close-bottom">Close</a>
        <a href="#" id="delete_social_media" class="btn btn-primary">Delete</a>
    </div>
</div>

<script type="text/javascript">

    jQuery(".close").on("click", function () {
        jQuery("#deleteModal").addClass("hide_modal");
    });
    jQuery(".close-bottom").on("click", function () {
        jQuery("#deleteModal").addClass("hide_modal");
    });


    jQuery(".delete_social_media").on("click", function () {
        var id = jQuery(this).attr('data-id');
        //alert(id);
        jQuery("#deleteModal").removeClass("hide_modal");
        jQuery(".delete-modal-body p").remove();
        jQuery("#delete_social_media").attr('data-id', jQuery(this).attr('data-id'));

    });

    jQuery(document).ready(function () {
        jQuery("#social-media").select2();
        jQuery("li").removeClass('active');
        jQuery("#socialMedia").addClass('active');
    })
    jQuery('#submit').on('click', function () {
        var sid = jQuery(this).attr('data-id');
        var id = <?php echo $_SESSION['id'];?>;
        jQuery('#message').hide(30);
        var opts = {
            url:"<?php echo bloginfo('url') . "/ajax/?do=socialMedia&action=add"?>&id=" + id + "&sid=" + sid,
            type:'POST',
            dataType:'JSON',
            data:jQuery("#socialMedia_form").serialize(),
            success:function (data) {
                jQuery('#message').removeClass().addClass(
                    (data.error === true) ? 'error'
                        : 'success').text(data.message)
                    .fadeIn(500).delay(1500).fadeOut(1000);
                if (data.error === false) {
                    location.reload();
                }

            }
        };
        jQuery.ajax(opts);
        return false;
    });

    jQuery("#delete_social_media").on("click", function () {
        var id = jQuery(this).attr('data-id');
        //alert(id);
        jQuery.ajax({
            url:"<?php echo bloginfo('url') . "/ajax/?do=socialMedia&action=delete"?>&id=" + id,
            cache:false,
            success:function (html) {
                jQuery("#tds-" + id).remove();
                jQuery("#deleteModal").addClass("hide_modal");
            }
        });
    });


    var reset = 0;
    jQuery(".edit_social_media").on("click", function () {
        var id = jQuery(this).attr('data-id');
        jQuery("#submit").attr('data-id', jQuery(this).attr('data-id'));
        jQuery("#submit").html('Update Social Media');
        if (reset == 0) {
            jQuery("#bottoms").append("<a href='#' class='btn btn-primary'  id = 'reset''>Cancel</a>");
            reset = 1;
        }
        jQuery("#title").val(jQuery(this).attr('data-social_media_title'));
        jQuery("#url").val(jQuery(this).attr('data-social_media_url'));
    });
    jQuery("#bottoms").delegate("#reset", "click", function () {
        jQuery("#submit").attr('data-id', 'add');
        jQuery("#submit").html('Add Social Media');
        jQuery("#title").val("");
        jQuery("#url").val("");
        jQuery("#reset").remove();
        reset = 0;
    });

</script>