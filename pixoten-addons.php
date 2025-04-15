<?php
/*
Plugin Name: Pixoten Addons
Plugin URI: https://pixoten.com/plugins/
Description: Pixoten Addons Plugins
Version: 1.0
Requires at least: 5.8
Requires PHP: 5.6.20
Author: Pixoten
Author URI: https://pixoten.com/
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: pixoten-addons
*/

if( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Tha Main Plugin Class
 */
final class Pixoten_Addons{

    /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0';

    /**
     * Class construct
     */
    private function __construct() {
        $this->define_constants();

        register_activation_hook( __FILE__, [ $this, 'activate' ] );

        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Initialize a Singleton instance
     *
     * @return \Pixoten_Addons
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'PIXOTEN_ADDONS_VERSION', self::version );
        define( 'PIXOTEN_ADDONS_FILE', __FILE__ );
        define( 'PIXOTEN_ADDONS_PATH', __DIR__ );
        define( 'PIXOTEN_ADDONS_URL', plugins_url( '', PIXOTEN_ADDONS_FILE ) );
        define( 'PIXOTEN_ADDONS_ASSETS', PIXOTEN_ADDONS_URL . '/assets' );
    }

    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate() {
        $installer = new Pixoten\Addons\Installer();
        $installer->run();
    }

     /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {

        new Pixoten\Addons\Assets();

        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            new Pixoten\Addons\Ajax();
        }

        if ( is_admin() ) {
            new Pixoten\Addons\Admin();
        } else {
            new Pixoten\Addons\Frontend();
        }

    }

}

/**
 * Initialize The Main Plugin
 *
 * @return \Pixoten_Addons
 */
function pixoten_addons() {
    return Pixoten_Addons::init();
}

// kick-off the plugin
pixoten_addons();


