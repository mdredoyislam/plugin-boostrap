<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e( 'Display Address', 'pixoten-addons' ); ?></h1>
    <a href="<?php echo admin_url( 'admin.php?page=pixoten-addons' ); ?>" class="page-title-action"><?php _e( 'All Address', 'pixoten-addons' ); ?></a>
    <p style="height: 0px;"></p>
    <table class="widefat striped">
        <tbody>
            <tr class="row">
                <th scope="row">
                    <label><?php _e( 'Name', 'pixoten-addons' ); ?></label>
                </th>
                <td><?php echo esc_html( $address->name ); ?></td>
            </tr>
            <tr class="row">
                <th scope="row">
                    <label><?php _e( 'Author', 'pixoten-addons' ); ?></label>
                </th>
                <td>
                <?php 
                    $user_info = get_userdata( $address->created_by );
                    echo esc_html( $user_info->user_login ); 
                ?>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label><?php _e( 'Address', 'pixoten-addons' ); ?></label>
                </th>
                <td><?php echo esc_html( $address->address ); ?></td>
            </tr>
            <tr class="row">
                <th scope="row">
                    <label><?php _e( 'Phone', 'pixoten-addons' ); ?></label>
                </th>
                <td><?php echo esc_html( $address->phone ); ?></td>
            </tr>
        </tbody>
    </table>
</div>