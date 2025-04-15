<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e( 'Address Book', 'pixoten-addons' ); ?></h1>

    <a href="<?php echo admin_url( 'admin.php?page=pixoten-addons&action=new' ); ?>" class="page-title-action"><?php _e( 'Add New', 'pixoten-addons' ); ?></a>

    <?php if ( isset( $_GET['inserted'] ) ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Address has been added successfully!', 'pixoten-addons' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['address-deleted'] ) && $_GET['address-deleted'] == 'true' ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Address has been deleted successfully!', 'pixoten-addons' ); ?></p>
        </div>
    <?php } ?>

    <form action="" method="post">
        <?php
        $table = new Pixoten\Addons\Admin\Address_List();
        $table->prepare_items();
        $table->search_box( 'search', 'search_id' );
        $table->display();
        ?>
    </form>
</div>