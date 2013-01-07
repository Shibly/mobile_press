<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Shibly
 * Date: 7/30/12
 * Time: 12:00 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<div class="row">
    <div class="span10">
        <h4 style="position: relative;top:20px;">Currently Registered Clients :</h4>
        <table style="position: relative;top:30px;" class="table table-bordered client_list">
            <thead>
            <tr>

                <th>Client Name</th>
                <th>Client LogIn Name</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $qry = "Select * from tbl_clients";
            $res = $wpdb->get_results($qry);
            foreach ($res as $all_clients) {
                ?>
            <tr>
                <td><?php echo $all_clients->client_name ?></td>
                <td><?php echo $all_clients->client_login_name;?></td>
            </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        </fieldset>

    </div>

    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery("li").removeClass('active');
            jQuery("#home").addClass('active');
        });
    </script>