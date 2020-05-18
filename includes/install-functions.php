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
    global $orion_db_version;
    global $wpdb;
    // table name
    $table_name =  $wpdb->prefix . 'orionNebu';

    // table collate
    $charset_collate = $wpdb->get_charset_collate();
    /**
     * check for table exists
     */
    if ($wpdb->get_var('SHOW TABLES LIKE "' . $table_name . '"')) {
        return;
    } else {
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id mediumint NOT NULL AUTO_INCREMENT,
	customName text NOT NULL,
	dashiIcon varchar(254) NOT NULL DEFAULT 'dashicons-welcome-view-site',
	description varchar(254) NOT NULL DEFAULT 'simple post type',
	singName varchar(254) NOT NULL DEFAULT 'custom post',
	menuName varchar(254) NOT NULL DEFAULT 'custom post',
	adminNameBar varchar(254) NOT NULL DEFAULT 'custom post',
	addNew varchar(254) NOT NULL DEFAULT 'add new',
	addNewItem varchar(254) NOT NULL DEFAULT 'add new item',
	newItem varchar(254) NOT NULL DEFAULT 'new item',
	editItem varchar(254) NOT NULL DEFAULT 'edit item',
	viewItem varchar(254) NOT NULL DEFAULT 'view item',
	allItem varchar(254) NOT NULL DEFAULT 'all item',
	searchItem varchar(254) NOT NULL DEFAULT 'search item',
	notFound varchar(254) NOT NULL DEFAULT 'not found',
	featImage varchar(254) NOT NULL DEFAULT 'featured image',
	setFeatImage varchar(254) NOT NULL DEFAULT 'set featured image',
	remFeatImage varchar(254) NOT NULL DEFAULT 'remove featured image',
	useFeatImage varchar(254) NOT NULL DEFAULT 'use featured image',
	itemsList varchar(254) NOT NULL DEFAULT 'items list',
	filterItemList varchar(254) NOT NULL DEFAULT 'filter item list',
	public boolean NOT NULL DEFAULT 1,
	showUi boolean NOT NULL DEFAULT 1,
	showInMenu boolean NOT NULL DEFAULT 1,
	showInAdmin boolean NOT NULL DEFAULT 1,
	showInNav boolean NOT NULL DEFAULT 1,
	excFromSearch boolean NOT NULL DEFAULT 0,
	pubQuery boolean NOT NULL DEFAULT 1,
	menuPos INT NOT NULL DEFAULT 50,
	hierarchical boolean NOT NULL DEFAULT 1,
	taxonomies varchar(254) NOT NULL DEFAULT 'none',
	supports varchar(254) NOT NULL DEFAULT 'all',
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
