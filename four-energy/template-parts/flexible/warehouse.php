<?php
  $title     = get_sub_field( 'title' );
  $subtitle  = get_sub_field( 'subtitle' );
  $number    = get_sub_field( 'number' );
  $num_text  = get_sub_field( 'text' );
?>
<section class="warehouse mb-120">
  <div class="container">
    <div class="warehouse__wrapper">

      <div class="warehouse__content">

        <?php if ( have_rows( 'blocks' ) ) : ?>
        <div class="warehouse__content_blocks">
          <?php while ( have_rows( 'blocks' ) ) : the_row();
            $block_name = get_sub_field( 'name' );
            $block_icon = get_sub_field( 'icon' );
            $block_text = get_sub_field( 'text' );
          ?>
            <div class="warehouse__block">
              <div class="warehouse__block_name">
                <?php if ( $block_name ) : ?>
                  <span class="warehouse__block-name-text"><?php echo esc_html( $block_name ); ?></span>
                <?php endif; ?>
                <?php if ( is_array( $block_icon ) && ! empty( $block_icon['url'] ) ) : ?>
                  <img
                    class="warehouse__block-icon"
                    src="<?php echo esc_url( $block_icon['url'] ); ?>"
                    alt="<?php echo esc_attr( $block_icon['alt'] ); ?>"
                  >
                <?php endif; ?>
              </div>
              <?php if ( $block_text ) : ?>
              <div class="warehouse__block_text">
                <?php echo wp_kses_post( $block_text ); ?>
              </div>
              <?php endif; ?>
            </div>
          <?php endwhile; ?>
        </div>
        <?php endif; ?>

        <div class="warehouse__content_title">
          <div class="warehouse__title_text">
            <?php if ( $title ) : ?>
              <h2 class="title"><?php echo esc_html( $title ); ?></h2>
            <?php endif; ?>
            <?php if ( $subtitle ) : ?>
              <p class="warehouse__subtitle"><?php echo wp_kses_post( $subtitle ); ?></p>
            <?php endif; ?>
          </div>
          <?php if ( $number || $num_text ) : ?>
          <div class="warehouse__title_numbers">
            <?php if ( $number ) : ?>
              <span class="warehouse__number"><?php echo esc_html( $number ); ?></span>
            <?php endif; ?>
            <?php if ( $num_text ) : ?>
              <p class="warehouse__number-text"><?php echo esc_html( $num_text ); ?></p>
            <?php endif; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <?php
      // Gallery slider
      $gallery = get_sub_field( 'gallery' ); // ACF Gallery field returning array
      if ( $gallery ) : ?>
        <div class="warehouse__slider swiper-container">
          <div class="swiper-wrapper">
            <?php foreach ( $gallery as $img ) : ?>
              <div class="swiper-slide">
                <div class="warehouse-img">
                    <img
                    src="<?php echo esc_url( $img['url'] ); ?>"
                    alt="<?php echo esc_attr( $img['alt'] ); ?>"
                    >
                </div>
               
              </div>
            <?php endforeach; ?>
          </div>
          <div class="swiper-button-prev" aria-label="Previous slide"></div>
          <div class="swiper-button-next" aria-label="Next slide"></div>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>
