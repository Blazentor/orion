<?php
/**
 * @since v1.0
 */
isDefined();
/**
 * create orion database for saving custom post types
 */
function install_orion_db()
{
    global $wpdb;
    global $orion_db_version;
    // table name
    $table_name = $wpdb->prefix . 'orionNebu';
    // table collate
    $charset_collate = $wpdb->get_charset_collate();
    /**
     * check for table exists
     */
    if ($wpdb->get_var('SHOW TABLES LIKE "' . $table_name . '"')) {
        return;
    } else {
        $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
	customName text NOT NULL,
	dashiIcon varchar(100) not NULL,
	description text NOT NULL,
	singName varchar(254) NOT NULL,
	menuName varchar(254) NOT NULL,
	adminNameBar varchar(254) NOT NULL,
	addNew varchar(254) NOT NULL,
	addNewItem varchar(254) NOT NULL,
	newItem varchar(254) NOT NULL,
	editItem varchar(254) NOT NULL,
	viewItem varchar(254) NOT NULL,
	allItem varchar(254) NOT NULL,
	searchItem varchar(254) NOT NULL,
	notFound varchar(254) NOT NULL,
	featImage varchar(254) NOT NULL,
	setFeatImage varchar(254) NOT NULL,
	remFeatImage varchar(254) NOT NULL,
	useFeatImage varchar(254) NOT NULL,
	itemsList varchar(254) NOT NULL,
	filterItemList varchar(254) NOT NULL,
	public boolean NOT NULL,
	showUi boolean NOT NULL,
	showInMenu boolean NOT NULL,
	showInAdmin boolean NOT NULL,
	showInNav boolean NOT NULL,
	excFromSearch boolean NOT NULL,
	pubQuery boolean NOT NULL,
	menuPos INT(11) NOT NULL,
	hierarchical boolean DEFAULT 0 NOT null,
	taxonomies text NOT NULL,
	supports text NOT NULL,
	PRIMARY KEY (id)
	
	)$charset_collate;";
    }


    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    add_option('orion_db_version', $orion_db_version);
}

/**
 * call the install functions inside this function
 */
function install_orion()
{
    install_orion_db();
}

/**
 * plugin menu
 */
function orion_menu()
{
    function add_orion_menu()
    {
        $page_title = __('easy custom post type and taxonomy', 'orion');
        $menu_title = 'orion';
        $capability = 'manage_options';
        $menu_slug = 'orion';
        $function = 'orion_main_menu';
        $icon_url = 'dashicons-welcome-add-page';
        $position = 25;
        add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
        add_submenu_page($menu_slug, $page_title, $menu_title, $capability, $menu_slug);
        add_submenu_page($menu_slug, __('create new post type', 'orion'), __('new post type', 'orion'), $capability, 'orion-new-post-type', 'orion_new_post_type');
    }

    /**
     * call the view functions
     * @todo: any better idea?
     */
    require VIEWS_PATH;

    add_action('admin_menu', 'add_orion_menu');

}

orion_menu();

function load_orion_textdomain()
{
    $path = dirname(plugin_basename(__DIR__)) . '/languages';

    load_plugin_textdomain('orion', false, $path);
}

add_action('init', 'load_orion_textdomain');
