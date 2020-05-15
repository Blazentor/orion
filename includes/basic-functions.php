<?php
/**
 * check for direct access to script
 * @since v1.0
 */
function isDefined(){
    defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
}