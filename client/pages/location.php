<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Shibly
 * Date: 7/24/12
 * Time: 11:46 PM
 * To change this template use File | Settings | File Templates.
 */
?>

<div class="row">
    <div class="span10">
        <div class="row">
            <div class="span10">
                <form action="" method="post" class="form_client" id="form_location">
                    <Legend>Add your location</Legend>
                    <div class="control-group">
                        <label for="location_name">Location Name</label>

                        <div class="controls">
                            <input type="text" name="location_name" id="location_name" class="input-xlarge"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="phone_number">Phone Number</label>

                        <div class="controls">
                            <input type="text" name="phone_number" id="phone_number" class="input-xlarge"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="address">Address</label>

                        <div class="controls">
                            <input type="text" name="address" id="address" class="input-xlarge"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="city">City</label>

                        <div class="controls">
                            <input type="text" name="city" id="city" class="input-xlarge"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="state">State</label>

                        <div class="controls">
                            <select type="text" name="state" id="state" class="input-xlarge">
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="DC">District of Columbia</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="zip_code">Zip Code</label>

                        <div class="controls">
                            <input type="text" name="zip_code" id="zip_code" class="input-xlarge"/>
                        </div>
                    </div>
                    <div class="span5">
                        <div class="control-group">
                            <div class="controls">
                                <div class="span5" style="height: 0px; width: 480px">
                                    <div id="map_canvas"
                                         style="width:100%; height:375px; position: relative; left: 280px; bottom: 392px;"></div>
                                    <input type="hidden" name="longitude" id="longitude" class="input-xlarge">
                                    <input type="hidden" name="latitude" id="latitude" class="input-xlarge">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="controls" id="bottoms">
                                <a href="#" id="submit" data-id="add" class="btn btn-info">Add
                                    your location</a>
                            </div>
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
    </div>
</div>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Location Name</th>
        <th>Address</th>
        <th>Action</th>
    </tr>
    </thead>

    <tbody id="approve">
    <?php
    $wp_uid = get_current_user_id();
    $sql = "Select * from tbl_location where wp_uid = {$wp_uid}";
    $res = $wpdb->get_results($sql);

    foreach ($res as $location) {
        ?>
    <tr id="tds-<?php echo $location->location_id?>">


        <td id="location-<?php echo $location->wp_uid?>"><?php echo $location->location_name;?></td>
        <td><?php echo $location->address;?></td>
        <th>
            <li><a href="#" id="edit-location" class="edit_location"
                   data-id="<?php echo $location->location_id;?>"
                   data-name="<?php echo $location->location_name;?>"
                   data-phone="<?php echo $location->phone_number;?>"
                   data-address="<?php echo $location->address;?>"
                   data-city="<?php echo $location->city;?>"
                   data-zip="<?php echo $location->zip_code;?>"
                   data-wpuid="<?php echo $location->wp_uid;?>"
                   data-site="<?php echo $location->site_id;?>"
                   data-state="<?php echo $location->state;?>"
                   data-lat="<?php echo $location->lat;?>"
                   data-lng="<?php echo $location->lng;?>"><i class="icon-edit
        icon-black"></i>Edit</a></li>
            <li>
                <a href="#" class="delete_location" data-id="<?php echo $location->location_id?>"
                   data-name="<?php echo $location->location_id;?>"><i class="icon-edit icon-black"></i>Delete</a></li>
        </th>
    </tr>

        <?php
    }?>
    </tbody>
</table>

<div class="modal hide_modal" id="deleteModal">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>

        <h3 style="position: relative;left: 10px;">Confirm delete selected URL ?</h3>
    </div>
    <div class="delete-modal-body">

    </div>
    <div class="modal-footer">
        <a href="#" class="btn close-bottom">Close</a>
        <a href="#" id="delete_location" class="btn btn-primary">Delete</a>
    </div>
</div>




<script type="text/javascript"
        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAQPHBtphW0KuBZHTaOLBjztyncdge7xlY&sensor=false"></script>
<script type="text/javascript">

    var geocoder;
    var map;
    var marker;
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);
        var myOptions = {
            zoom:8,
            center:latlng,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

        function placeMarker(location) {
            //console.log(location);
            jQuery('#longitude').val(location.Ya);
            jQuery('#latitude').val(location.Xa);
            if (marker) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                    position:location,
                    map:map
                });

            }
        }

        function addMarkers() {
            var bounds = map.getBounds();
            var southWest = bounds.getSouthWest();
            var northEast = bounds.getNorthEast();
            var lngSpan = northEast.lng() - southWest.lng();
            var latSpan = northEast.lat() - southWest.lat();

            var marker = new google.maps.Marker({
                position:latLng,
                map:map
            });

        }

        function codeLatLng() {
            var lat = jQuery('#latitude').val();
            var lng = jQuery('#longitude').val();
            var latlng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({'latLng':latlng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        map.setZoom(11);
                        if (marker) {
                            marker.setPosition(latlng);
                        } else {
                            marker = new google.maps.Marker({
                                position:latlng,
                                map:map
                            });
                        }
                        jQuery('#address').val(results[1].formatted_address);
                    } else {
                        alert("No results found");
                    }
                } else {
                    alert("Geocoder failed due to: " + status);
                }
            });
        }

        google.maps.event.addListener(map, 'click', function (event) {
            placeMarker(event.latLng);
            codeLatLng();
        });
    }
    function codeAddress() {
        var stateDD = document.getElementById("state");
        var state = stateDD.options[stateDD.selectedIndex].text;

        var city = document.getElementById("city").value;

        var zip = document.getElementById("zip_code").value;

        var address = document.getElementById("address").value + " " + city + ", " + state + " " + zip;
        geocoder.geocode({ 'address':address}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                if (marker) {
                    marker.setPosition(results[0].geometry.location);
                    jQuery('#longitude').val(results[0].geometry.location.lng());
                    jQuery('#latitude').val(results[0].geometry.location.lat());
                } else {
                    marker = new google.maps.Marker({
                        map:map,
                        position:results[0].geometry.location
                    });
                    jQuery('#longitude').val(results[0].geometry.location.lng());
                    jQuery('#latitude').val(results[0].geometry.location.lat());
                    //console.log(results[0].geometry.location);
                }
            } else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        });
    }
    window.onload = initialize();
</script>
<script type="text/javascript">

    jQuery(".close").on("click", function () {
        jQuery("#deleteModal").addClass("hide_modal");
    });
    jQuery(".close-bottom").on("click", function () {
        jQuery("#deleteModal").addClass("hide_modal");
    });

    function resetAllFields() {
        jQuery("#submit").attr('data-id', 'add');
        jQuery("#submit").html('Add Location');
        jQuery("#location_name").val("");
        jQuery("#phone_number").val("");
        jQuery("#address").val("");
        jQuery("#city").val("");
        jQuery("#state").val("AL");
        jQuery("#zip_code").val("");
        jQuery("#latitude").val("");
        jQuery("#longitude").val("");
        jQuery("#reset").remove();
    }
    jQuery(document).ready(function () {
        jQuery("li").removeClass('active');
        jQuery("#locations").addClass('active');
        jQuery("#state").select2();

        jQuery('#submit').unbind("click").on('click', function () {

            if (jQuery("#latitude").val() == '' || jQuery("#longitude").val() == '') {
                alert('Latitude & Longitude not defined. Please select "Preview Map" before adding your location.');
                return false;
            }
            var id = <?php echo $_SESSION['id'];?>;
            var aid = jQuery(this).attr('data-id');
            var opts = {
                url:"<?php echo bloginfo('url') . "/ajax/?do=location&action=add"?>&lid=" + aid + "&id=" + id,
                type:'POST',
                dataType:'JSON',
                data:jQuery("#form_location").serialize(),
                success:function (data) {
                    jQuery('#message').removeClass().addClass(
                        (data.error === true) ? 'error'
                            : 'success').text(data.message)
                        .fadeIn(1500).delay(1500).fadeOut(1000);
                    resetAllFields();
                    location.reload();
                }

            };
            jQuery.ajax(opts);
            return false;
        });

    });
    var reset = 0;
    jQuery(".edit_location").on("click", function () {
        var id = jQuery(this).attr('data-id');
        jQuery("#submit").attr('data-id', jQuery(this).attr('data-id'));
        jQuery("#submit").html('Update Location');
        if (reset == 0) {
            jQuery("#bottoms").append("<a href='#' class='btn btn-info'  id = 'reset''>Cancel</a>");
            reset = 1;
        }
        jQuery("#location_name").val(jQuery(this).attr('data-name'));
        jQuery("#phone_number").val(jQuery(this).attr('data-phone'));
        jQuery("#address").val(jQuery(this).attr('data-address'));
        jQuery("#city").val(jQuery(this).attr('data-city'));
        jQuery("#state").val(jQuery(this).attr('data-state'));
        jQuery("#zip_code").val(jQuery(this).attr('data-zip'));
        jQuery("#latitude").val(jQuery(this).attr('data-lat'));
        jQuery("#longitude").val(jQuery(this).attr('data-lng'));
        codeAddress();
    });
    jQuery("#bottoms").delegate("#reset", "click", function () {
        jQuery("#submit").attr('data-id', 'add');
        jQuery("#submit").html('Add Location');
        jQuery("#location_name").val("");
        jQuery("#phone_number").val("");
        jQuery("#address").val("");
        jQuery("#city").val("");
        jQuery("#state").val("AL");
        jQuery("#zip_code").val("");
        jQuery("#latitude").val("");
        jQuery("#longitude").val("");
        jQuery("#reset").remove();
        reset = 0;
    });

    jQuery(".delete_location").on("click", function () {
        var id = jQuery(this).attr('data-id');
        //alert(id);
        jQuery("#deleteModal").removeClass("hide_modal");
        jQuery(".delete-modal-body p").remove();
        jQuery("#delete_location").attr('data-id', jQuery(this).attr('data-id'));

    });
    jQuery("#delete_location").on("click", function () {
        //alert('delete');
        var id = jQuery(this).attr('data-id');
        //console.log(id);
        jQuery.ajax({
            url:"<?php echo bloginfo('url') . "/ajax/?do=location&action=delete"?>&id=" + id,
            cache:false,
            success:function (html) {
                jQuery("#tds-" + id).remove();
                jQuery("#deleteModal").addClass("hide_modal");
            }
        });
    });

</script>
