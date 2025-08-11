<?php
  $title = get_sub_field( 'title' );

  $subtitle = get_sub_field( 'subtitle' );
?>
<section class="own-equipment mb-120">
    <div class="container">
        <?php if ( $title ) : ?>
            <div class="title"><?php echo wp_kses_post( $title ); ?></div>
        <?php endif; ?>

        <div class="subtitle">
            <?php echo esc_html( $subtitle ); ?>
        </div>
        <?php if ( have_rows('equipment') ) : ?>
            <div class="own-equipment-slider swiper-container">
                <div class="swiper-wrapper">
                <?php while ( have_rows('equipment') ) : the_row();
                    $img  = get_sub_field('img');
                    $icon = get_sub_field('icon');
                    $name = get_sub_field('name');
                    $desc = get_sub_field('desc');
                ?>
                    <div class="own-equipment-slide swiper-slide">
                        <div class="own-equipment-block">
                            <?php if ( is_array($img) && ! empty($img['url']) ) : ?>
                                <img
                                    class="own-equipment-block__img"
                                    src="<?php echo esc_url($img['url']); ?>"
                                    alt="<?php echo esc_attr($img['alt']); ?>"
                                >
                            <?php endif; ?>
                            <div class="own-equipment-block_text">
                                <div class="own-equipment-block_name">
                                    <?php if ( $name ) : ?>
                                        <h4 class="own-equipment-block__name"><?php echo esc_html($name); ?></h4>
                                    <?php endif; ?>
                                    <?php if ( is_array($icon) && ! empty($icon['url']) ) : ?>
                                        <img
                                            class="own-equipment-block__icon"
                                            src="<?php echo esc_url($icon['url']); ?>"
                                            alt="<?php echo esc_attr($icon['alt']); ?>"
                                        >
                                    <?php endif; ?>
                                </div>
                                <?php if ( $desc ) : ?>
                                    <p class="own-equipment-block__desc"><?php echo esc_html($desc); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        <?php endif; ?>
    </div>
</section>