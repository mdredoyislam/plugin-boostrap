<?php

namespace Pixoten\Addons;

/**
 * Ajax handler class
 */
class Ajax {

    /**
     * Class constructor
     */
    function __construct() {
        add_action( 'wp_ajax_pa_pixoten_enquiry', [ $this, 'submit_enquiry'] );
        add_action( 'wp_ajax_nopriv_pa_pixoten_enquiry', [ $this, 'submit_enquiry'] );

        add_action( 'wp_ajax_pa-pixoten-delete-contact', [ $this, 'delete_contact'] );
    }

    /**
     * Handle Enquiry Submission
     *
     * @return void
     */
    public function submit_enquiry() {

        if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'pa-enquiry-form' ) ) {
            wp_send_json_error( [
                'message' => 'Nonce verification failed!'
            ] );
        }

        wp_send_json_success([
            'message' => 'Enquiry has been sent successfully!'
        ]);
    }

    /**
     * Handle contact deletion
     *
     * @return void
     */
    public function delete_contact() {
        if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'pa-admin-nonce' ) ) {
            wp_send_json_error( [
                'message' => __( 'Nonce verification failed!', 'pixoten-addons' )
            ] );
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( [
                'message' => __( 'No permission!', 'pixoten-addons' )
            ] );
        }

        $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;
        pa_delete_address( $id );

        wp_send_json_success();
    }
}