<?php
$title          = get_sub_field('title');
$subtitle       = get_sub_field('subtitle');
$text           = get_sub_field('text');
$number         = $text['number'];
$text_text      = $text['text'];
$reviews_output = get_sub_field('reviews_output');
?>

<section class="reviews" id="reviews">
    <div class="container">
        <div class="reviews__title">
            <div>
                <?php if ( $title ) : ?>
                    <h2 class="title"><?php echo esc_html( $title ); ?></h2>
                <?php endif; ?>

                <?php if ( $subtitle ) : ?>
                    <div class="subtitle">
                        <?php echo wp_kses_post( $subtitle ); ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ( $number ) : ?>
                <div class="text_number">
                    <span><?php echo esc_html( $number ); ?></span>
                    <p><?php echo esc_html( $text_text ); ?></p>
                </div>
            <?php endif; ?>
        </div>
       
    
    

    <?php if ( ! empty( $reviews_output ) ) : ?>
      <div class="reviews__slider swiper-container">
        <div class="swiper-wrapper">
          <?php foreach ( $reviews_output as $block_id ) :
            // подтягиваем данные отзыва
            $item_title   = get_the_title( $block_id );
            $task         = get_field( 'task', $block_id->ID );
            $name         = get_field( 'name', $block_id->ID );
            $img          = get_field( 'img', $block_id->ID );
            $text_reviews = apply_filters( 'the_content', get_post_field( 'post_content', $block_id ) );
          ?>
            <div class="swiper-slide reviews__slide">
                <div class="reviews__content-item">
                    <div class="reviews__content-text">
                        <div class="reviews__content-head">
                            <img
                            src="<?php echo esc_url( get_template_directory_uri() . '/assets/svg/quote.svg' ); ?>"
                            alt="Quote icon"
                            >
                            <div>
                            <span><?php echo esc_html( $task ); ?></span>
                            <p><?php echo esc_html( $name ); ?></p>
                            </div>
                        </div>
                        <?php echo wp_kses_post( $text_reviews ); ?>
                    </div>
                <?php if ( $img ) : ?>
                    <a href="<?php echo esc_url( $img['url'] ); ?>" data-fancybox class="reviews__content-img">
                        <img
                            src="<?php echo esc_url( $img['url'] ); ?>"
                            alt="<?php echo esc_attr( $img['alt'] ); ?>"
                        >
                    </a>
                  
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <!-- Navigation buttons -->
        <div class="swiper-button-prev" aria-label="Previous review"></div>
        <div class="swiper-button-next" aria-label="Next review"></div>

      </div>
    <?php endif; ?>
  </div>
</section>
