
<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
    <div class="stm_contact__info">
        <?php if( $big_address ){ ?>
            <span class="stmicon-address"></span>
            <strong><?php _e( 'Address', 'pearl' ); ?></strong>
            <?php echo sanitize_text_field( $big_address ); ?>
        <?php } ?>
        <?php if( $big_phone ){ ?>
            <div class="stm_contact__row stm_contact__row_phone">
                <span class="stmicon-phone-call"></span>
                <strong><?php _e( 'Contact Us', 'pearl' ); ?></strong>
                <?php echo sanitize_text_field( $big_phone ); ?>
            </div>
        <?php } ?>
        <?php if( $big_email ){ ?>
            <div class="stm_contact__row stm_contact__row_email">
                <span class="stmicon-message"></span>
                <strong><?php _e( 'Email', 'pearl' ); ?></strong>
                <?php echo sanitize_text_field( $big_email ); ?>
            </div>
        <?php } ?>
    </div>
</div>
