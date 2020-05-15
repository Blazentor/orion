<?php

function orion_admin_scripts( $hook_suffix ) {
	/**
	 * check for url suffix
     * @todo check for language and submit form
	 */
	if ( $hook_suffix == 'toplevel_page_orion' or $hook_suffix == 'orion_page_orion-new-post-type' ) {
		wp_register_style( 'orionMatFont', 'https://fonts.googleapis.com/icon?family=Material+Icons' );
		wp_register_style( 'orionMat', plugin_dir_url( __DIR__ ) . 'assets/css/materialize.min.css' );
		wp_register_style( 'orionMatRtl', plugin_dir_url( __DIR__ ) . 'assets/css/materialize-rtl.min.css' );
		wp_register_script( 'orionMatJs', plugin_dir_url( __DIR__ ) . 'assets/js/materialize.min.js' );

		wp_enqueue_style( 'orionMatFont' );
		wp_enqueue_style( 'orionMat' );
		wp_enqueue_style( 'orionMatRtl' );
		wp_enqueue_script( 'orionMatJs' );
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
            <div class="divider"></div>
            <div class="row">
                <form class="col s12">
                    <div class="row">
                        <div class="input-field col s6">
                            <input placeholder="Placeholder" id="first_name" type="text" class="validate">
                            <label for="first_name">First Name</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="last_name" type="text" class="validate">
                            <label for="last_name">Last Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input disabled value="I am not editable" id="disabled" type="text" class="validate">
                            <label for="disabled">Disabled</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" type="password" class="validate">
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" class="validate">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            This is an inline input field:
                            <div class="input-field inline">
                                <input id="email_inline" type="email" class="validate">
                                <label for="email_inline">Email</label>
                                <span class="helper-text" data-error="wrong" data-success="right">Helper text</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>


	<?php
}

?>