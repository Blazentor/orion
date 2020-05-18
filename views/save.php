<?php

global $wpdb;
$table_name = $wpdb->prefix . 'orionNebu';

if (!empty($_POST["customName"])) {
    $customName = $_POST["customName"];
    $sql = "INSERT INTO $table_name (customName, dashiIcon, description, singName, menuName, adminNameBar, addNew, addNewItem, newItem, editItem, viewItem, allItem, searchItem, notFound, featImage, setFeatImage, remFeatImage, useFeatImage, itemsList, filterItemList, public, showUi, showInMenu, showInAdmin, showInNav, excFromSearch, pubQuery, menuPos, hierarchical, taxonomies, supports) 
VALUES ('$customName','dashicons-welcome-view-site','this is post type','post','post','post','add new','add new item','new item','edit item','view item','all item','search item','not found','featured image','set featured image','remove featured image','use featured image','item list','filter item list',1,1,1,1,1,0,1,50,1,'none','none');";
    $wpdb->query($sql);
}
/**
 * loop through post data and save into database
 * @todo fix this shit
 */
$sec_sql = array();
foreach ($_POST as $key => $value) {
    if (!empty($value)) {
        if ($key == "title" or $key == "editor" or $key == "author" or $key == "thumbnail" or $key == "comments") {
            array_push($sec_sql, $key);
        }
        if (!$key == "title" or $key == "editor" or $key == "author" or $key == "thumbnail" or $key == "comments") {
            $wpdb->query("UPDATE $table_name SET $key = 1 WHERE customName='$customName';");
        } else {
            $wpdb->query("UPDATE $table_name SET $key = 0 WHERE customName='$customName';");
        }

    }
}
