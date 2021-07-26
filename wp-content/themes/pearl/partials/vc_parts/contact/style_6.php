
<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
    <div class="row">

        <div class="col col-lg-4">
            <?php if( ! empty( $image ) ){ ?>
            <div class="stm_contact__image">
                <?php echo wp_kses_post( $image); ?>
            </div>
            <?php } ?>
        </div>
        
        <div class="col col-lg-4">
            <div class="stm_contact__info">
                <h3><?php echo sanitize_text_field( $name ); ?></h3>
                <?php if( $address ){ ?>
                    <div class="stm_contact__address"><?php echo sanitize_text_field( $address ); ?></div>
                <?php } ?>
                <?php if( $open_hours ){ ?>
                    <div class="stm_contact__open_hours"><?php echo sanitize_text_field( $open_hours ); ?></div>
                <?php } ?>
            </div>
        </div>
        <div class="col col-lg-4">
            <div class="stm_contact__info">
                <?php if( $phone ): ?>
                <div class="stm_contact__row stm_contact__row_phone">
                    <a href="tel:<?php echo sanitize_text_field( $phone ); ?>">
                        <?php echo sanitize_text_field( $phone ); ?>
                    </a>
                </div>
                <?php endif; ?>
                <?php if( $email ): ?>
                    <div class="stm_contact__row stm_contact__row_email">
                        <a href="mailto:<?php echo sanitize_text_field( $email ); ?>">
                            <?php echo sanitize_text_field( $email ); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>    

</div>
