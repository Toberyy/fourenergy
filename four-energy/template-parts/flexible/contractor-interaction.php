<?php
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');

?>

<section class="contractor-interaction">
    <div class="container">
        <?php if ( $title ) : ?>
            <h2 class="title"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>
        <?php if ( $subtitle ) : ?>
            <div class="subtitle">
                <?= wp_kses_post( $subtitle ); ?>
            </div>
        <?php endif; ?>
        <?php if ( have_rows( 'blocks' ) ) : ?>
            <div class="contractor-interaction__slider swiper-container">
                <div class="swiper-wrapper">
                <?php while ( have_rows( 'blocks' ) ) : the_row();
                    $icon = get_sub_field( 'icon' );
                    $name = get_sub_field( 'name' );
                    $text = get_sub_field( 'text' );
                ?>
                    <div class="swiper-slide ">
                        <div class="contractor-interaction__block">
                            <div class="contractor-interaction__block_name">
                                <?php if ( $name ) : ?>
                                <span><?php echo esc_html( $name ); ?></span>
                                <?php endif; ?>

                                <?php if ( is_array( $icon ) && ! empty( $icon['url'] ) ) : ?>
                                <img
                                    src="<?php echo esc_url( $icon['url'] ); ?>"
                                    alt="<?php echo esc_attr( $icon['alt'] ?? '' ); ?>"
                                />
                                <?php endif; ?>
                            </div>

                            <?php if ( $text ) : ?>
                                <div class="contractor-interaction__block_text">
                                    <?php echo wp_kses_post( $text ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                <?php endwhile; ?>
                </div>

                <div class="swiper-button-prev" aria-label="Предыдущий"></div>
                <div class="swiper-button-next" aria-label="Следующий"></div>
            </div>
        <?php endif; ?>
    </div>
</section>