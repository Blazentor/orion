<?php

/**
 * @param array $arg
 */
function orion_save_post_type($arg = array()){
    wp_redirect(site_url());
    if (isset($arg['customName'])){
        echo $arg['customName'];
    }
}


orion_save_post_type(array($_POST['customName']));