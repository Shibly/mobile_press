<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Shibly
 * Date: 8/7/12
 * Time: 5:01 PM
 * To change this template use File | Settings | File Templates.
 */
$id = get_current_user_id();
print_r($id);
?>

<div class="row">
    <div class="span10">
        <legend>Select a Site to edit</legend>
        <?php
        $sql = "select * from tbl_sites where wp_uid = '$id'";
        $res = $wpdb->get_results($sql);
        $count = 0;
        foreach ($res as $all_pages) {
            $count++;
            ?>
            <div class="app_outer_cont">
                <a href="#" class="select_page"
                   data-id="<?php echo $all_pages->page_id; ?>"><?php echo $all_pages->page_name;?></a>


            </div>
            <?php
        }
        ?>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery(".select_page").unbind('click').on('click', function () {
            var id = jQuery(this).attr('data-id');
            console.log(id);
            var opts = {
                url:"<?php echo bloginfo('url') . "/ajax/?do=page&action=setpage"?>",
                cache:false,
                type:"POST",
                data:"id=" + id,
                success:function (html) {
                    function redirect(url) {
                        if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
                            var referLink = document.createElement('a');
                            referLink.href = url;
                            document.body.appendChild(referLink);
                            referLink.click();
                        } else {
                            location.href = url;
                        }
                    }

                    redirect("<?php echo bloginfo('url') . "/client/?do=home"?>")
                }

            };
            jQuery.ajax(opts);
            return false;

        })
    });
</script>