<?php
/**
 * check for direct access
 */
isDefined();

function orion_admin_scripts( $hook_suffix ) {
    /**
     * check for url suffix
     */
    if ( $hook_suffix == 'toplevel_page_orion' or $hook_suffix == 'orion_page_orion-new-post-type' ) {
        wp_register_style( 'orionMatFont', 'https://fonts.googleapis.com/icon?family=Material+Icons' );
        wp_register_style( 'orionMat', plugin_dir_url( __DIR__ ) . 'assets/css/materialize.min.css' );
        wp_register_script( 'orionMatJs', plugin_dir_url( __DIR__ ) . 'assets/js/materialize.min.js' );
        wp_register_script( 'orionCustomJs', plugin_dir_url( __DIR__ ) . 'assets/js/custom.js' );

        wp_enqueue_style( 'orionMatFont' );
        wp_enqueue_style( 'orionMat' );

        /**
         * check for persian language to import custom fonts
         */
        if ( get_locale() == 'fa_IR' ) {
            wp_register_style( 'orionPersian', plugin_dir_url( __DIR__ ) . 'assets/css/style.css' );
            wp_register_style( 'orionMatRtl', plugin_dir_url( __DIR__ ) . 'assets/css/materialize-rtl.min.css' );
            wp_enqueue_style( 'orionMatRtl' );
            wp_enqueue_style( 'orionPersian' );
        }
        wp_enqueue_script( 'orionMatJs' );
        wp_enqueue_script( 'orionCustomJs' );
    }

}

add_action( 'admin_enqueue_scripts', 'orion_admin_scripts' );

function orion_main_menu() {
    ?>
    <div class="container">
        <div class="col s12 grey lighten-3 center-align">
            <div class="section">
                <h4> <?php _e( 'create custom post types and taxonomy without coding!', 'orion' ); ?> </h4>
            </div>

            <div class="divider"></div>
            <div class="row">
                <div class="col s6">
                    <div class="section">
                        <a href="<?php echo admin_url( 'admin.php?page=orion-new-post-type' ) ?>"
                           class="waves-effect waves-light btn purple darken-2"><i
                                    class="material-icons left">edit</i><?php _e( 'create post type', 'orion' ); ?></a>
                    </div>
                </div>
                <div class="col s6">
                    <div class="section">
                        <a class="waves-effect waves-light btn deep-purple darken-1"><i
                                    class="material-icons left">edit</i><?php _e( 'create taxonomy', 'orion' ); ?></a>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <?php
}

function orion_new_post_type() {
    ?>
    <div class="container">
        <div class="col s12 grey lighten-3 center-align">
            <div class="section">
                <h4> <?php _e( 'custom post type', 'orion' ); ?> </h4>
            </div>
            <div class="section">
                <h5><?php _e( 'Basic setting', 'orion' ); ?></h5>
                <div class="divider"></div>
            </div>

            <!-- Modal Trigger -->

            <a class="waves-effect waves-light btn modal-trigger" href="#helpmodal">
                <i class="material-icons left">help</i><?php _e( 'help', 'orion' ); ?></a>

            <!-- Modal Structure -->
            <div id="helpmodal" class="modal">
                <div class="modal-content">
                    <h4><?php _e( 'how to create post type?', 'orion' ); ?></h4>
                    <p>A bunch of text</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="modal-close waves-effect waves-light btn butt-close">
                        <?php _e( 'close', 'orion' ); ?></a>
                </div>
            </div>

            <div class="row">
                <form class="col s12" method="post" action="save.php">
                    <div class="row">
                        <div class="input-field col s6">
                            <input name="customName" id="customName" type="text" class="validate" required>
                            <label for="customName"><?php _e( 'post type name', 'orion' ); ?></label>
                        </div>
                        <div class="input-field col s6">
                            <input id="description" name="description" type="text" class="validate" required>
                            <label for="description"><?php _e( 'post type description', 'orion' ); ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input name="singName" id="singName" type="text" class="validate">
                            <label for="singName"><?php _e( 'singular name', 'orion' ); ?></label>
                        </div>
                        <div class="input-field col s6">
                            <input id="menuName" name="menuName" type="text" class="validate">
                            <label for="menuName"><?php _e( 'menu name', 'orion' ); ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input name="adminNameBar" id="adminNameBar" type="text" class="validate">
                            <label for="adminNameBar"><?php _e( 'admin bar name ', 'orion' ); ?></label>
                        </div>
                        <div class="input-field col s6">
                            <input name="dashiIcon" id="dashiIcon" type="text" class="validate">
                            <label for="dashiIcon"><?php _e( 'dash icon name ', 'orion' ); ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input name="menuPos" id="adminNameBar" type="number" class="validate">
                            <label for="menuPos"><?php _e( 'menu position ', 'orion' ); ?></label>
                        </div>
                        <!-- taxonomy -->
                        <?php
                        /**
                         * get taxonomies for this post type
                         */
                        $post_types = get_taxonomies([],'names');
                        $taxonomies = array();
                        foreach ($post_types as $post_type) {
                            if ($post_type == "nav_menu" or $post_type == "link_category" or $post_type == "post_format"){
                                continue;
                            }else{
                                $taxonomies[$post_type] = $post_type;
                            }
                        }
                        ?>
                        <div class="input-field col s6">
                            <select name="taxonomies">
                                <option value="" disabled selected><?php _e('Choose your option','orion'); ?></option>
                                <?php
                                foreach ($taxonomies as $taxonomy){
                                    echo '<option value="'. $taxonomy .'">'. $taxonomy.'</option>';
                                }
                                ?>
                            </select>
                            <label><?php _e('select taxonomy','orion'); ?></label>
                        </div>
                    </div>
                    <div class="section">
                        <h5><?php _e( 'translation (optional)', 'orion' ); ?></h5>
                        <div class="divider"></div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input name="addNew" id="addNew" type="text" class="validate">
                            <label for="addNew"><?php _e( 'add new', 'orion' ); ?></label>
                        </div>
                        <div class="input-field col s6">
                            <input id="addNewItem" name="addNewItem" type="text" class="validate">
                            <label for="addNewItem"><?php _e( 'add new item', 'orion' ); ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input name="newItem" id="newItem" type="text" class="validate">
                            <label for="newItem"><?php _e( 'new item', 'orion' ); ?></label>
                        </div>
                        <div class="input-field col s6">
                            <input id="editItem" name="editItem" type="text" class="validate">
                            <label for="editItem"><?php _e( 'edit item', 'orion' ); ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input name="viewItem" id="viewItem" type="text" class="validate">
                            <label for="viewItem"><?php _e( 'view item', 'orion' ); ?></label>
                        </div>
                        <div class="input-field col s6">
                            <input id="allItem" name="allItem" type="text" class="validate">
                            <label for="allItem"><?php _e( 'all item', 'orion' ); ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input name="searchItem" id="searchItem" type="text" class="validate">
                            <label for="searchItem"><?php _e( 'search item', 'orion' ); ?></label>
                        </div>
                        <div class="input-field col s6">
                            <input id="notFound" name="notFound" type="text" class="validate">
                            <label for="notFound"><?php _e( 'not found', 'orion' ); ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input name="featImage" id="featImage" type="text" class="validate">
                            <label for="featImage"><?php _e( 'featured image', 'orion' ); ?></label>
                        </div>
                        <div class="input-field col s6">
                            <input id="setFeatImage" name="setFeatImage" type="text" class="validate">
                            <label for="setFeatImage"><?php _e( 'set featured image', 'orion' ); ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input name="remFeatImage" id="remFeatImage" type="text" class="validate">
                            <label for="remFeatImage"><?php _e( 'remove featured image', 'orion' ); ?></label>
                        </div>
                        <div class="input-field col s6">
                            <input id="useFeatImage" name="useFeatImage" type="text" class="validate">
                            <label for="useFeatImage"><?php _e( 'use featured image', 'orion' ); ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input name="itemList" id="itemList" type="text" class="validate">
                            <label for="itemList"><?php _e( 'item list', 'orion' ); ?></label>
                        </div>
                        <div class="input-field col s6">
                            <input id="filterItemList" name="filterItemList" type="text" class="validate">
                            <label for="filterItemList"><?php _e( 'filter item list', 'orion' ); ?></label>
                        </div>
                    </div>
                    <div class="section right-align">
                        <h5><?php _e( 'advanced setting', 'orion' ); ?></h5>
                        <div class="divider"></div>
                    </div>
                    <!-- check boxes -->
                    <div class="row">
                        <div class="col s12 right-align">
                            <p>
                                <label>
                                    <input name="public" type="checkbox"/>
                                    <span><?php _e( 'public post type', 'orion' ); ?></span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="showUi" type="checkbox"/>
                                    <span><?php _e( 'show ui', 'orion' ); ?></span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="showInMenu" type="checkbox"/>
                                    <span><?php _e( 'show in menu', 'orion' ); ?></span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="showInAdmin" type="checkbox"/>
                                    <span><?php _e( 'show in admin', 'orion' ); ?></span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="showInNav" type="checkbox"/>
                                    <span><?php _e( 'show in navigation', 'orion' ); ?></span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="excFromSearch" type="checkbox"/>
                                    <span><?php _e( 'exclude From Search', 'orion' ); ?></span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="pubQuery" type="checkbox"/>
                                    <span><?php _e( 'public query', 'orion' ); ?></span>
                                </label>
                            </p>
                            <div class="section">
                                <h5><?php _e( 'supports', 'orion' ); ?></h5>
                                <div class="divider"></div>
                            </div>
                            <p>
                                <label>
                                    <input name="title" type="checkbox"/>
                                    <span><?php _e( 'title', 'orion' ); ?></span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="editor" type="checkbox"/>
                                    <span><?php _e( 'editor', 'orion' ); ?></span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="author" type="checkbox"/>
                                    <span><?php _e( 'author', 'orion' ); ?></span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="thumbnail" type="checkbox"/>
                                    <span><?php _e( 'thumbnail', 'orion' ); ?></span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="excerpt" type="checkbox"/>
                                    <span><?php _e( 'excerpt', 'orion' ); ?></span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="comments" type="checkbox"/>
                                    <span><?php _e( 'comments', 'orion' ); ?></span>
                                </label>
                            </p>
                        </div>
                    </div>

                    <button class="btn waves-effect waves-light" type="submit"><?php _e('save','orion'); ?></button>
                </form>
            </div>
        </div>
    </div>
    <?php

}


?>

