<?php

namespace Pixoten\Addons;

/**
 * Assets handlers class
 */
class Assets {

    /**
     * Class constructor
     */
    function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_assets' ] );
    }

    /**
     * All available scripts
     *
     * @return array
     */
    public function get_scripts() {
        return [
            'pixoten-script' => [
                'src'     => PIXOTEN_ADDONS_ASSETS . '/js/frontend.js',
                'version' => filemtime( PIXOTEN_ADDONS_PATH . '/assets/js/frontend.js' ),
                'deps'    => [ 'jquery' ]
            ],
            'pixoten-enquiry-script' => [
                'src'     => PIXOTEN_ADDONS_ASSETS . '/js/enquiry.js',
                'version' => filemtime( PIXOTEN_ADDONS_PATH . '/assets/js/enquiry.js' ),
                'deps'    => [ 'jquery' ]
            ],
            'pixoten-admin-script' => [
                'src'     => PIXOTEN_ADDONS_ASSETS . '/js/admin.js',
                'version' => filemtime( PIXOTEN_ADDONS_PATH . '/assets/js/admin.js' ),
                'deps'    => [ 'jquery', 'wp-util' ]
            ],
        ];
    }

    /**
     * All available styles
     *
     * @return array
     */
    public function get_styles() {
        return [
            'pixoten-style' => [
                'src'     => PIXOTEN_ADDONS_ASSETS . '/css/frontend.css',
                'version' => filemtime( PIXOTEN_ADDONS_PATH . '/assets/css/frontend.css' )
            ],
            'pixoten-admin-style' => [
                'src'     => PIXOTEN_ADDONS_ASSETS . '/css/admin.css',
                'version' => filemtime( PIXOTEN_ADDONS_PATH . '/assets/css/admin.css' )
            ]
        ];
    }

    /**
     * Register scripts and styles
     *
     * @return void
     */
    public function register_assets() {
        $scripts = $this->get_scripts();
        $styles  = $this->get_styles();

        foreach ( $scripts as $handle => $script ) {
            $deps = isset( $script['deps'] ) ? $script['deps'] : false;

            wp_register_script( $handle, $script['src'], $deps, $script['version'], true );
        }

        foreach ( $styles as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;

            wp_register_style( $handle, $style['src'], $deps, $style['version'] );
        }

        wp_localize_script( 'pixoten-enquiry-script', 'PixotenAddons', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'error'   => __( 'Something went wrong', 'pixoten-addons' ),
        ] );

        wp_localize_script( 'pixoten-admin-script', 'PixotenAddons', [
            'nonce' => wp_create_nonce( 'pa-admin-nonce' ),
            'confirm' => __( 'Are you sure?', 'pixoten-addons' ),
            'error' => __( 'Something went wrong', 'pixoten-addons' ),
        ] );
    }
}