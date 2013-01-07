<?php
/**
 * Template Name: cpage
 */

if ($_GET['ajax']) {
    $site_id = $_GET['id'];
    switch ($_GET['ajax']) {
        case 'home':
            $qry = "select * from tbl_home where site_id = {$site_id}";
            $ret = $wpdb->get_results($qry);

            if ($ret != null) {
                $return['error'] = false;
                foreach ($ret as $return) {
                    $return->business_name;
                    $return->business_url;
                    $return->business_image;
                    $return->color_value;
                }
            } else {
                $return['error'] = true;
                $return['message'] = 'There is no information to fetch';
            }
            echo json_encode($return);
            break;
        case 'about':
            $qry = "SELECT * FROM tbl_about where site_id = {$site_id}";
            $ret = $wpdb->get_results($qry);
            if ($ret != null) {
                $return['error'] = false;
                foreach ($ret as $return) {
                    $return->about_desc;
                }
            } else {
                $return['error'] = true;
                $return['message'] = 'No descriptions available';
            }
            echo json_encode($return);
            break;
        case 'contact_info' :
            $qry = "SELECT * FROM tbl_contact_info where site_id = {$site_id}";
            $ret = $wpdb->get_results($qry);
            if ($ret != null) {
                $return['error'] = false;
                foreach ($ret as $return) {
                    $return->contact_phone;
                    $return->email_address;
                    $return->web_address;
                }
            } else {
                $return['error'] = true;
                $return['message'] = 'No contact information available';
            }
            echo json_encode($return);
            break;
        case 'location' :
            $qry = "SELECT * FROM tbl_location where site_id = {$site_id}";
            $ret = $wpdb->get_results($qry);
            if ($ret != null) {
                // $return['error'] = false;
                foreach ($ret as $key => $data) {
                    $return[$key]['location_name'] = $data->location_name;
                    $return[$key]['phone_number'] = $data->phone_number;
                    $return[$key]['address'] = $data->address;
                    $return[$key]['city'] = $data->city;
                    $return[$key]['state'] = $data->state;
                    $return[$key]['zip_code'] = $data->zip_code;
                }
            } else {
                $return['error'] = true;
                $return['message'] = 'No location information available';
            }
            echo json_encode($return);
            break;
        case 'member' :
            $qry = "SELECT * FROM tbl_members where site_id = {$site_id}";
            $ret = $wpdb->get_results($qry);
            if ($ret != null) {
                // $return['error'] = false;
                foreach ($ret as $key => $data) {
                    $return[$key]['member_name'] = $data->member_name;
                    if ($data->member_image == '') {
                        $return[$key]['member_image'] = 'The member has no image';
                    } else {
                        $return[$key]['member_image'] = $data->member_image;
                    }
                    $return[$key]['member_bio'] = $data->member_bio;
                }
            } else {
                $return['error'] = true;
                $return['message'] = 'No member information available';
            }
            echo json_encode($return);
            break;
        case 'social_media' :
            $qry = "SELECT * FROM tbl_social_media where site_id = {$site_id}";
            $ret = $wpdb->get_results($qry);
            if ($ret != null) {
                //$return['error'] = false;
                foreach ($ret as $key => $data) {
                    $return[$key]['social_media_url'] = $data->social_media_url;
                    $return[$key]['social_media_title'] = $data->social_media_title;
                    $return[$key]['social_media_name'] = $data->social_media_name;
                }
            } else {
                $return['error'] = true;
                $return['message'] = 'No social media information available';
            }
            echo json_encode($return);
            break;
        case 'services' :
            $qry = "SELECT * FROM tbl_services where site_id = {$site_id}";
            $ret = $wpdb->get_results($qry);
            if ($ret != null) {
                //$return['error'] = false;
                foreach ($ret as $key => $data) {
                    $return[$key]['service_title'] = $data->service_title;
                    if ($data->service_image == null) {
                        $return[$key]['service_image'] = 'This Service has no image';
                    } else {
                        $return[$key]['service_image'] = $data->service_image;
                    }
                    $return[$key]['service_description'] = $data->service_description;
                }
            } else {
                $return['error'] = true;
                $return['message'] = 'No social media information available';
            }
            echo json_encode($return);
            break;
        case 'menus':
            $id = $_GET['id'];
            $pid = $_GET['pid'];
            $qry = "select *from tbl_menu where parent = '$pid' and site_id = '$id'";
            $return = $wpdb->get_results($qry);
            echo json_encode($return);
            break;
        case 'menutext':
            $id = $_GET['id'];
            $pid = $_GET['pid'];
            $qry = "select *from tbl_menu where menu_id = '$pid' and site_id = '$id' and is_item = 1";
            $return = $wpdb->get_results($qry);
            echo json_encode($return);
            break;


    }
}