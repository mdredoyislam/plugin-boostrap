<div class="pixoten-enquiry-form" id="pixoten-enquiry-form">

    <form action="" method="post">

        <div class="form-row">
            <label for="name"><?php _e( 'Name', 'pixoten-addons' ); ?></label>

            <input type="text" id="name" name="name" value="" required>
        </div>

        <div class="form-row">
            <label for="email"><?php _e( 'E-Mail', 'pixoten-addons' ); ?></label>

            <input type="email" id="email" name="email" value="" required>
        </div>

        <div class="form-row">
            <label for="message"><?php _e( 'Message', 'pixoten-addons' ); ?></label>

            <textarea name="message" id="message" required></textarea> 
        </div>

        <div class="form-row">

            <?php wp_nonce_field( 'pa-enquiry-form' ); ?>

            <input type="hidden" name="action" value="pa_pixoten_enquiry">
            <input type="submit" name="send_enquiry" value="<?php esc_attr_e( 'Send Enquiry', 'pixoten-addons' ); ?>">
        </div>

    </form>
</div>