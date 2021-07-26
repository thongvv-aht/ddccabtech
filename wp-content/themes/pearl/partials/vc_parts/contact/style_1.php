
<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
    <?php if( ! empty( $image ) ){ ?>
        <div class="stm_contact__image">
            <?php echo wp_kses_post( $image); ?>
        </div>
    <?php } ?>
    <div class="stm_contact__info">
        <h5 class="no_line stm_mgb_5"><?php echo sanitize_text_field( $name ); ?></h5>
        <?php if( $job ){ ?>
            <div class="stm_contact__job"><?php echo sanitize_text_field( $job ); ?></div>
        <?php } ?>
        <?php if( $phone ){ ?>
            <div class="stm_contact__row stm_contact__row_phone">
                <span><?php _e( 'Phone: ', 'pearl' ); ?></span><strong><?php echo sanitize_text_field( $phone ); ?></strong>
            </div>
        <?php } ?>
        <?php if( $email ){ ?>
            <div class="stm_contact__row stm_contact__row_email">
                <span><?php _e( 'Email: ', 'pearl' ); ?></span>
                <a href="mailto:<?php echo sanitize_text_field( $email ); ?>">
                    <?php echo sanitize_text_field( $email ); ?>
                </a>
            </div>
        <?php } ?>
        <?php if( $skype ){ ?>
            <div class="stm_contact__row stm_contact__row_skype">
                <span><?php _e( 'Skype: ', 'pearl' ); ?></span><?php echo sanitize_text_field( $skype ); ?>
            </div>
        <?php } ?>
    </div>
</div>
