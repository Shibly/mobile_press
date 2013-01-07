<?php
session_start();
/**
 * Template Name: Ajax
 */

$wp_uid = get_current_user_id();
$id = $_GET['id'];
global $wpdb;
/*Client add/delete page */
$current_user = wp_get_current_user();
if ('client' == $_GET['do']) {
    //$user_id = get_current_user_id();
    if ('add' == $_GET['action']) {
        extract($_POST);
        // we will use clientname as login name.
        if (empty($clientname)) {
            $return['error'] = true;
            $return['message'] = 'Please insert the client name';
        } else if (empty($loginname)) {
            $return['error'] = true;
            $return['message'] = 'Please insert login name';
        } else {
            $last_registered_user = $wpdb->get_results("SELECT ID as max_id FROM wp_users where user_login = '$loginname'");

            if ($last_registered_user[0]->max_id) {
                $return['error'] = true;
                $return['message'] = 'The user name already exists in the database';
            } else {
                $user_data = array('user_pass' => $password, 'user_login' => $loginname, 'display_name' => $clientname);
                $res = wp_insert_user($user_data);
                $last_registered_user = $wpdb->get_results("SELECT ID as max_id FROM wp_users where user_login = '$loginname'");
                $max_id = $last_registered_user[0]->max_id;
                if ($res) {
                    $return['error'] = false;
                    $return['message'] = 'A new client has been successfully created !';
                }
                $values = "(NULL,'$clientname','$loginname','$max_id')";
                $sql = "INSERT INTO tbl_clients (client_id, client_name, client_login_name, wp_uid) VALUES $values ;";
                $res = $wpdb->query($sql);
                // Get the ID of the newly created user.
                $last_id = $wpdb->query("SELECT MAX(ID) from wp_users");
                if ($res) {
                    $return['error'] = false;
                    $return['message'] = 'A new client has been successfully created !';
                } else {
                    $return['error'] = true;
                    $return['message'] = 'Unable to create a new client' . $res;
                }

            }
            echo json_encode($return);
        }
    }
    if ('delete' == $_GET['action']) {
        $id = $_GET['id'];

        // Delete the client from the custom table.
        $sql = "DELETE FROM tbl_clients where wp_uid = '$id'";
        $res = $wpdb->query($sql);

        // delete the client from WordPress's wp_users table
        $sql_wp_user = "delete from wp_users where ID = '$id'";
        $wp_sql = $wpdb->query($sql_wp_user);

        // delete data from the the tbl_about table
        $about = "delete from tbl_about where wp_uid = '$id'";
        $delete_apps = $wpdb->query($about);

        // delete data from  tbl_contact_info table
        $contact_info = "delete from tbl_contact_info where wp_uid = '$id'";
        $delete_app_info = $wpdb->query($contact_info);

        // delete data from tbl_home
        $home = "delete from tbl_home where wp_uid = '$id'";
        $delete_attorney = $wpdb->query($home);

        // delete data from tbl_location

        $location = "delete from tbl_location where wp_uid = '$id'";
        $delete_contact = $wpdb->query($location);

        // delete data from tbl_main_menu
        $main_menu = "delete from tbl_main_menu where wp_uid = '$id'";
        $delete_location = $wpdb->query($main_menu);

        // delete data from tbl_members

        $members = "delete from tbl_members where wp_uid = '$id'";
        $delete_practice_area = $wpdb->query($members);

        // delete data from tbl_services

        $services = "delete from tbl_services where wp_uid = '$id'";
        $delete_social_media = $wpdb->query($services);

        // delete data from the tbl_social_media table
        $social_media = "delete from  tbl_social_media where wp_uid = '$id'";
        $delete_notification = $wpdb->query($social_media);

        // delete the data from the tbl_sites table

        $sites = "delete from tbl_sites where wp_uid = '$id'";
        $delete_sites = $wpdb->query($sites);
        $return['error'] = false;
        $return['message'] = 'The client has been deleted from the database with all information';
    }
    if ('update' == $_GET['action']) {
        extract($_POST);
        $id = $_GET['id'];
        if ($password) {
            if ($password === $password2) {
                $new_pass = wp_hash_password($password);
                $sql = "Update wp_users set user_pass = '$new_pass' where ID = '$id'";
                $res = $wpdb->query($sql);
            }
        }
        $sql = "Update wp_users set user_login = '$loginname',  user_nicename = '$clientname'  where ID = '$id'";
        $res1 = $wpdb->query($sql);
        $qry = "UPDATE tbl_clients SET  client_name = '$clientname', client_login_name =  '$loginname' WHERE  wp_uid = '$id';";
        $res2 = $wpdb->query($qry);
        if ($res1 or $res2 or $res) {
            $return['error'] = false;
            $return['message'] = 'Client information updated';
        } else {
            $return['error'] = true;
            $return['message'] = $sql;
        }
        echo json_encode($return);
    }
}


if ('page' == $_GET['do']) {
    extract($_POST);
    if ('add' == $_GET['action']) {
        // global $user_ID is a super global value that also stores the user_id of currently logged in user.
        if (empty($site_name)) {
            $return['error'] = true;
            $return['message'] = 'Please insert the site name';
        } else if (empty($client)) {
            $return['error'] = true;
            $return['message'] = 'Please select a client';
        } else if ('Select Client' == $client) {
            $return['error'] = true;
            $return['message'] = 'Please select a valid client';
        } else {
            $check_page = $wpdb->get_results("SELECT ID as max_id FROM wp_posts where post_name = '$site_name'");
            if ($check_page[0]->max_id) {
                $return['error'] = true;
                $return['message'] = 'Sorry, but the page name is already exists in the database. Please try with another one';
            } else {
                $site = array(
                    'post_type' => 'page',
                    'post_parent' => 0,
                    'post_author' => $user_ID,
                    'post_status' => 'publish',
                    'post_title' => $site_name,
                );
                $pageid = wp_insert_post($site);
                $last_page_id = $wpdb->get_results("SELECT ID as max_id FROM wp_posts where post_name = '$site_name'");
                $max_id = $last_page_id[0]->max_id;
                $sql = "INSERT INTO tbl_sites (sites_id ,page_id ,page_name ,wp_uid) VALUES (NULL , '$max_id', '$site_name', '$client')";
                $res = $wpdb->query($sql);
                if ($pageid && $res) {
                    $return['error'] = false;
                    $return['message'] = 'A new page has successfully created';
                } else {
                    $return['error'] = true;
                    $return['message'] = 'Error occurs while creating the page';
                }
            }
        }
    }
    if ('delete' == $_GET['action']) {
        $site_name = $_GET['site_name'];

        // delete the site from the custom table and we also need to delete the table from the WordPress database
        $sql = "delete from tbl_sites where page_name = '$site_name'";
        $res = $wpdb->query($sql);
        if ($res) {
            $return['error'] = false;
            $return['message'] = 'The site has been deleted from the database';
            $delete_from_wp_post = $wpdb->query("DELETE FROM wp_posts WHERE post_name = '$site_name'");
        } else {
            $return['error'] = true;
            $return['message'] = 'Unable to delete the selected site ' . $sql;
        }
    }

    if ('update' == $_GET['action']) {
        // update the custom table.
        $id = $_GET['id'];
        $sql = "update tbl_sites set page_name = '$site_name' where page_id = '$id'";
        $res = $wpdb->query($sql);
        // also we need to update the WordPress's wp_posts table
        $sql1 = "update wp_posts set post_name = '$site_name' where ID = '$id'";
        $res1 = $wpdb->query($sql1);

        if ($res) {
            $return['error'] = false;
            $return['message'] = 'The site name has been updated in the database';
        } else {
            $return['error'] = true;
            $return['message'] = 'There was an error while updating the site name';
        }

    }


    if ('setpage' == $_GET['action']) {
        $_SESSION['page'] = true;
        $_SESSION['id'] = $_POST['id'];
        echo($_POST['id']);

    }
    echo json_encode($return);
}


if ('about' == $_GET['do']) {
    if ('update' == $_GET['action']) {
        extract($_POST);
        $page_id = $_GET['id'];
        if (empty($business_info)) {
            $return['error'] = true;
            $return['message'] = 'Please insert your business information';
        } else {
            $qry = "update tbl_about set about_desc = '$business_info' where site_id = '$page_id' and wp_uid = '$wp_uid'";
            $res = $wpdb->query($qry);
            if ($res) {
                $return['error'] = false;
                $return['message'] = 'Information updated successfully';
            } else {
                $return['error'] = true;
                $return['message'] = "There was an error" . $sql;
            }
        }
    }
    echo json_encode($return);
}

if ('home' == $_GET['do']) {
    if ('update' == $_GET['action']) {
        extract($_POST);
        if (empty($business_name)) {
            $return['error'] = true;
            $return['message'] = 'Please insert your business name';
        } else if (empty($business_url)) {
            $return['error'] = true;
            $return['message'] = 'Please insert your business url';
        } else {
            $sql = "UPDATE tbl_home SET
            business_name = '$business_name',
            business_image = '$client_image',
            business_url = '$business_url',
            color_value = '$color_code'
            where wp_uid = '$wp_uid' and site_id = '$site_id';";
            $res = $wpdb->query($sql);
            if ($res) {
                $return['error'] = false;
                $return['message'] = "Information has been updated into the database";
            } else {
                $return['error'] = true;
                $return['message'] = 'There was an error updating the information' . $sql;
            }
        }
    }
    echo json_encode($return);
}

if ('contact' == $_GET['do']) {
    if ('update' == $_GET['action']) {
        extract($_POST);
        $page_id = $_GET['id'];
        if (empty($phone_number)) {
            $return['error'] = true;
            $return['message'] = 'Please insert a valid phone number';
        } else if (empty($email_address)) {
            $return['error'] = true;
            $return['message'] = 'Please insert an email address';
        } else if (empty($web_address)) {
            $return['error'] = true;
            $return['message'] = 'Please insert the URL address';
        } else {
            $qry = "update tbl_contact_info set
                    contact_phone = '$phone_number',
                    email_address = '$email_address',
                    web_address = '$web_address' where
                    site_id = '$page_id' and wp_uid = '$wp_uid'";
            $res = $wpdb->query($qry);
            if ($res) {
                $return['error'] = false;
                $return['message'] = 'Contact information updated successfully';
            } else {
                $return['error'] = true;
                $return['message'] = "There was an error" . $sql;
            }
        }
    }

    echo json_encode($return);
}

if ('service' == $_GET['do']) {
    if ('add' == $_GET['action']) {
        extract($_POST);
        $service_id = $_GET['sid'];
        if (empty($service_title)) {
            $return['error'] = true;
            $return['message'] = 'Please insert a service title';
        } else if (empty($service_description)) {
            $return['error'] = true;
            $return['message'] = 'Please insert a service description';
        } else {
            if ('add' == $_GET['sid']) {
                $qry = "insert into tbl_services (service_id, service_title, service_image, service_description, wp_uid, site_id)
                        values(null, '$service_title', '$service_image', '$service_description', '$wp_uid', '$id');";
            } else {
                $qry = "update tbl_services set service_title = '$service_title',
                                                service_image = '$service_image',
                                                service_description = '$service_description' where service_id = '$service_id'";
            }
            $res = $wpdb->query($qry);
            if ($res) {
                $return['error'] = false;
                $return['message'] = 'Service Information has been inserted/updated into the database';
            } else {
                $return['error'] = true;
                $return['message'] = "There was an error inserting service information" . $qry;
            }

        }
    }

    if ('delete' == $_GET['action']) {
        $id = $_GET['id'];
        $qry = "Delete from tbl_services where service_id= '$id'";
        $res = $wpdb->query($qry);
    }
    echo json_encode($return);
}

if ('location' == $_GET['do']) {
    if ('add' == $_GET['action']) {
        extract($_POST);
        $id = $_GET['id'];
        if (empty($location_name)) {
            $return['error'] = true;
            $return['message'] = 'Please insert the location name';
        } else if (empty($address)) {
            $return['error'] = true;
            $return['message'] = 'Please Insert an address';
        } else {
            $lid = $_GET['lid'];
            if ($lid != 'add') {
                $sql = "UPDATE tbl_location set
                location_name = '$location_name',
                phone_number = '$phone_number',
                address = '$address',
                city = '$city',
                state = '$state',
                zip_code = '$zip_code',
                site_id = '$id',
                lat = '$latitude',
                lng = '$longitude'
                where location_id = '$lid'";

            } elseif ($_GET['lid'] == 'add') {
                $sql = "INSERT INTO tbl_location
                (location_id ,
                location_name,
                phone_number,
                address,
                city,
                state,
                zip_code,
                wp_uid,
                site_id,
                lat, lng)
                VALUES
                (NULL ,
                '$location_name',
                 '$phone_number',
                 '$address',
                 '$city',
                 '$state',
                 '$zip_code',
                 '$wp_uid',
                 '$id',
                 '$latitude',
                 '$longitude')";
            }

            $res = $wpdb->query($sql);
            if ($res) {
                $return['error'] = false;
                $return['message'] = 'A new page has successfully created';
            } else {
                $return['error'] = true;
                $return['message'] = $sql;
                //$return['message'] = 'Error occurs while creating the page';
            }
        }
    }
    if ('delete' == $_GET['action']) {
        $lid = $_GET['lid'];
        $sql = "delete from tbl_location where location_id = '$id'";
        $res = $wpdb->query($sql);
        if ($res) {
            $return['error'] = false;
            $return['message'] = 'A loaction has successfully deleted';
        } else {
            $return['error'] = true;
            $return['message'] = 'Error occurs while Deleting the location';
        }

    }
    echo json_encode($return);
}


if ('socialMedia' == $_GET['do']) {
    if ('add' == $_GET['action']) {
        $id = $_GET['id'];
        $social_id = $_GET['sid'];
        extract($_POST);
        if (empty($title)) {
            $return['error'] = true;
            $return['message'] = 'Please insert a title' . $title;
        } else if (empty($url)) {
            $return['error'] = true;
            $return['message'] = 'Please insert a valid URL address';
        } else {
            if ('add' == $_GET['sid']) {
                $sql = "insert into tbl_social_media
                (social_media_id,
                social_media_url,
                social_media_title,
                social_media_name,
                wp_uid,
                site_id)
                values
                (null,
                '$url',
                '$title',
                '$social_name',
                '$wp_uid',
                '$id');";
                $res = $wpdb->query($sql);
                if ($res) {
                    $return['error'] = false;
                    $return['message'] = 'Social media information has been added';
                } else {
                    $return['error'] = true;
                    $return['message'] = 'There was an error inserting social media information';
                }
            } else {
                $sql = "update tbl_social_media set
                social_media_url = '$url',
                social_media_title = '$title',
                social_media_name = '$social_name'
                where social_media_id = '$social_id'";
                $res = $wpdb->query($sql);
                if ($res) {
                    $return['error'] = false;
                    $return['message'] = 'Social media information has been updated';
                } else {
                    $return['error'] = true;
                    $return['message'] = 'There was an error updating social media information';
                }
            }
        }
    }

    if ('delete' == $_GET['action']) {
        $social_id = $_GET['id'];
        $sql = "delete from tbl_social_media where social_media_id = '$social_id'";
        $res = $wpdb->query($sql);
        if ($res) {
            $return['error'] = false;
            $return['message'] = 'The selected social media information has been deleted successfully';
        } else {
            $return['error'] = true;
            $return['message'] = 'There was an error deleting the social media information';
        }
    }
    echo json_encode($return);
}

if ('member' == $_GET['do']) {
    if ('add' == $_GET['action']) {
        extract($_POST);
        $member_id = $_GET['sid'];
        if (empty($member_name)) {
            $return['error'] = true;
            $return['message'] = "Please insert Member's name";
        } else if (empty($member_bio)) {
            $return['error'] = true;
            $return['message'] = "Please insert Member's Bio";
        } else {
            if ('add' == $_GET['sid']) {
                $qry = "insert into tbl_members
                        (member_id,
                        member_name,
                        member_image,
                        member_bio,
                        wp_uid,
                        site_id)
                        values
                        (null,
                        '$member_name',
                        '$member_image',
                        '$member_bio',
                        '$wp_uid',
                        '$id');";
            } else {
                $qry = "update tbl_members set
                        member_name = '$member_name',
                        member_image = '$member_image',
                        member_bio = '$member_bio'
                        where member_id = '$member_id'";
            }
            $res = $wpdb->query($qry);
            if ($res) {
                $return['error'] = false;
                $return['message'] = 'Member Information has been inserted/updated into the database';
            } else {
                $return['error'] = true;
                $return['message'] = "There was an error inserting member information" . $qry;
            }

        }
    }

    if ('delete' == $_GET['action']) {
        $id = $_GET['id'];
        $qry = "Delete from tbl_members where member_id= '$id'";
        $res = $wpdb->query($qry);
    }
    echo json_encode($return);
}

if ('file' == $_GET['do']) {
    $id = $_GET['id'];
    echo $id;
    if ('delete' == $_GET['action']) {
        $File = __DIR__ . "/admin/ajaxupload/server/uploads/{$id}";
        unlink($File);
    }
}

if ('menu' == $_GET['do']) {
    if ('addCat' == $_GET['action']) {
        extract($_POST);
        $site_id = $_GET['id'];
        $menu_id = $_GET['sid'];
        if (empty($name)) {
            $return['error'] = true;
            $return['message'] = "Please insert Menu's name";
        } else {
            if ('add' == $_GET['sid']) {
                $qry = "insert into tbl_menu (menu_id, wp_uid, site_id, name, description, parent, is_item)
                        values(null, '$wp_uid', '$site_id', '$menu_name', '$menu_text', '$select_menu', 0);";
            } else {
                $qry = "update tbl_menu set name = '$menu_name', description = '$menu_text'
                        where menu_id = '$menu_id' and wp_uid = '$wp_uid'";
            }
            $res = $wpdb->query($qry);
            if ($res) {
                $return['error'] = false;
                $return['message'] = 'Menu Information has been inserted/updated into the database';
            } else {
                $return['error'] = true;
                $return['message'] = "There was an error updating menu information information" . $qry;
            }

        }
    }

    if ('addItem' == $_GET['action']) {
        extract($_POST);
        $site_id = $_GET['id'];
        $cat_id = $_GET['sid'];
        if (empty($name)) {
            $return['error'] = true;
            $return['message'] = "Please insert Menu's name";
        } else {
            if (!empty($select_item_child))
                $parent = $select_item_child;
            else
                $parent = $select_menu;
            if ('add' == $_GET['sid']) {
                $qry = "insert into tbl_menu (menu_id, wp_uid, site_id, name, description, parent, is_item, photo, price)
                        values(null, '$wp_uid', '$site_id', '$item_name', '$item_description', '$parent', 1,
                         '$item_photo', '$item_price');";
            } else {
                $qry = "update tbl_menu set
                        name = '$item_name',
                        description = '$item_description',
                        parent = '$parent',
                        photo = '$item_photo',
                        price = '$item_price'
                        where menu_id = '$cat_id' and wp_uid = '$wp_uid'";
            }
            $res = $wpdb->query($qry);
            if ($res) {
                $return['error'] = false;
                $return['message'] = 'Menu Information has been inserted/updated into the database';
            } else {
                $return['error'] = true;
                $return['message'] = "There was an error inserting member information" . $qry;
            }

        }
    }

    if ('delete' == $_GET['action']) {
        $id = $_GET['id'];
        $qry1 = "delete from tbl_menu where menu_id = '$id' and wp_uid = '$wp_uid'";
        $res = $wpdb->query($qry1);
    }


    // Load the child items on the select box when click on the appropiate parent.
    if ('loadChild' == $_GET['action']) {
        $id = $_GET['pid'];
        $sql = "SELECT c.name AS child_name,c.parent as parent_id, c.menu_id as menu_id
                FROM tbl_menu p
                INNER JOIN tbl_menu c ON p.menu_id = c.parent where p.menu_id = '$id';";
        $res = $wpdb->get_results($sql);

        foreach ($res as $key => $ret_data) {
            $return[$key]['child_name'] = $ret_data->child_name;
            $return[$key]['menu_id'] = $ret_data->menu_id;
        }
    }
    if ('getParent' == $_GET['action']) {
        $id = $_GET['did'];
        $qry = "select parent from tbl_menu where menu_id = '$id'";
        $res = $wpdb->get_results($qry);
        $return = $res[0];
    }
    echo json_encode($return);
}