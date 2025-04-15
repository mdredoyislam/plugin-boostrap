<?php

namespace Pixoten\Addons\Admin;

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * List Table Class
 */
class Address_List extends \WP_List_Table {

    function __construct() {
        parent::__construct( [
            'singular' => 'contact',
            'plural'   => 'contacts',
            'ajax'     => false
        ] );
    }

    /**
     * Message to show if no designation found
     *
     * @return void
     */
    function no_items() {
        _e( 'No address found', 'pixoten-addons' );
    }

    /**
     * Get the column names
     *
     * @return array
     */
    public function get_columns() {
        return [
            'cb'         => '<input type="checkbox" />',
            'name'       => __( 'Name', 'pixoten-addons' ),
            'created_by' => __( 'Author', 'pixoten-addons' ),
            'address'    => __( 'Address', 'pixoten-addons' ),
            'phone'      => __( 'Phone', 'pixoten-addons' ),
            'created_at' => __( 'Date', 'pixoten-addons' ),
        ];
    }

    /**
     * Get sortable columns
     *
     * @return array
     */
    function get_sortable_columns() {
        $sortable_columns = [
            'name'       => [ 'name', true ],
            'created_at' => [ 'created_at', true ],
        ];

        return $sortable_columns;
    }

    /**
     * Set the bulk actions
     *
     * @return array
     */
    function get_bulk_actions() {
        $actions = array(
            'trash'  => __( 'Move to Trash', 'pixoten-addons' ),
        );

        return $actions;
    }

    /**
     * Default column values
     *
     * @param  object $item
     * @param  string $column_name
     *
     * @return string
     */
    protected function column_default( $item, $column_name ) {

        switch ( $column_name ) {

            case 'created_at':
                return wp_date( get_option( 'date_format' ), strtotime( $item->created_at ) );

            default:
                return isset( $item->$column_name ) ? $item->$column_name : '';
        }
    }

    /**
     * Render the "name" column
     *
     * @param  object $item
     *
     * @return string
     */
    public function column_name( $item ) {
        $actions = [];

        $actions['view']   = sprintf( '<a href="%s" title="%s">%s</a>', admin_url( 'admin.php?page=pixoten-addons&action=view&id=' . $item->id ), $item->id, __( 'View', 'pixoten-addons' ), __( 'View', 'pixoten-addons' ) );
        $actions['edit']   = sprintf( '<a href="%s" title="%s">%s</a>', admin_url( 'admin.php?page=pixoten-addons&action=edit&id=' . $item->id ), $item->id, __( 'Edit', 'pixoten-addons' ), __( 'Edit', 'pixoten-addons' ) );
        $actions['delete'] = sprintf( '<a href="%s" class="submitdelete" onclick="return confirm(\'Are you sure?\');" title="%s">%s</a>', wp_nonce_url( admin_url( 'admin-post.php?action=pa-delete-address&id=' . $item->id ), 'wd-ac-delete-address' ), $item->id, __( 'Delete', 'pixoten-addons' ), __( 'Delete', 'pixoten-addons' ) );

        return sprintf(
            '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url( 'admin.php?page=pixoten-addons&action=view&id' . $item->id ), $item->name, $this->row_actions( $actions )
        );
    }

    /**
     * Render the "created_by" column
     *
     * @param  object $item
     *
     * @return string
     */
    protected function column_created_by( $item ) {
        $user_info = get_userdata( $item->created_by );
        
        if ( $user_info ) {
            return sprintf(
                '<p>%s</p>',
                esc_html( $user_info->user_login )
            );
        }
    
        return '<p><em>User not found</em></p>';
    }

    /**
     * Render the "cb" column
     *
     * @param  object $item
     *
     * @return string
     */
    protected function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="address_id[]" value="%d" />', $item->id
        );
    }

    /**
     * Prepare the address items
     *
     * @return void
     */
    public function prepare_items() {
        $column   = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [ $column, $hidden, $sortable ];

        $per_page     = 20;
        $current_page = $this->get_pagenum();
        $offset       = ( $current_page - 1 ) * $per_page;

        $args = [
            'number' => $per_page,
            'offset' => $offset,
        ];

        if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
            $args['orderby'] = $_REQUEST['orderby'];
            $args['order']   = $_REQUEST['order'] ;
        }

        $this->items = pa_get_addresses( $args );

        $this->set_pagination_args( [
            'total_items' => pa_address_count(),
            'per_page'    => $per_page
        ] );
    }
}