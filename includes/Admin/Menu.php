<?php

namespace Pixoten\Addons\Admin;

/**
 * The Menu handler class
 */
class Menu {

    public $addressbook;

    /**
     * Initialize the class
     */
    function __construct( $addressbook ) {
        $this->addressbook = $addressbook;

        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
    }

    /**
     * Register admin menu
     *
     * @return void
     */
    public function admin_menu() {
        $parent_slug = 'pixoten-addons';
        $capability = 'manage_options';

        $hook = add_menu_page( __( 'Pixoten Addons', 'pixoten-addons' ), __( 'Pixoten', 'pixoten-addons' ), $capability, $parent_slug, [ $this->addressbook, 'plugin_page' ], 'dashicons-plugins-checked' );
        add_submenu_page( $parent_slug, __( 'Address Book', 'pixoten-addons' ), __( 'Address Book', 'pixoten-addons' ), $capability, $parent_slug, [ $this->addressbook, 'plugin_page' ] );
        add_submenu_page( $parent_slug, __( 'Settings', 'pixoten-addons' ), __( 'Settings', 'pixoten-addons' ), $capability, 'pixoten-addons-settings', [ $this, 'settings_page' ] );

        add_action( 'admin_head-' . $hook, [ $this, 'enqueue_assets' ] );
    }

    /**
     * Handles the settings page
     *
     * @return void
     */
    public function settings_page() {
        echo 'Settings Page';
    }

     /**
     * Enqueue scripts and styles
     *
     * @return void
     */
    public function enqueue_assets() {
        wp_enqueue_style( 'pixoten-admin-style' );
        wp_enqueue_script( 'pixoten-admin-script' );
    }
}
