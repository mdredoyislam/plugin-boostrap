<?php

namespace Pixoten\Addons\Admin;

/**
 * The Menu handler class
 */
class Menu {

    /**
     * Initialize the class
     */
    function __construct() {
        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
    }

    /**
     * Register admin menu
     *
     * @return void
     */
    public function admin_menu() {
        add_menu_page( __( 'Pixoten Addons', 'pixoten-addons' ), __( 'Pixoten', 'pixoten-addons' ), 'manage_options', 'pixoten-addons', [ $this, 'plugin_page' ], 'dashicons-plugins-checked' );
    }

    /**
     * Render the plugin page
     *
     * @return void
     */
    public function plugin_page() {
        echo 'Hello Pixoten Addons';
    }
    
}
