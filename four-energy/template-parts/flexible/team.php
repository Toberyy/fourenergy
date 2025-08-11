<?php
  // Основные поля
  $title        = get_sub_field( 'title' );
  $subtitle     = get_sub_field( 'subtitle' );
  $specialists  = get_sub_field( 'specialists' ); // Relationship или Post Object (массив WP_Post)
?>

<section class="team">
  <div class="container">

    <div class="team__text">
      <?php if ( $title ) : ?>
        <h2 class="title"><?php echo esc_html( $title ); ?></h2>
      <?php endif; ?>

      <div class="team__text_content">
        <?php if ( $subtitle ) : ?>
          <div class="team__text_text"><?php echo wp_kses_post( $subtitle ); ?></div>
        <?php endif; ?>

        <?php if ( have_rows( 'blocks_info' ) ) : ?>
          <div class="team__text_info">
            <?php while ( have_rows( 'blocks_info' ) ) : the_row();
              $number = get_sub_field( 'number' );
              $text   = get_sub_field( 'text' );
            ?>
              <div>
                <?php if ( $number ) : ?><span><?php echo esc_html( $number ); ?></span><?php endif; ?>
                <?php if ( $text )   : ?><p><?php echo wp_kses_post( $text ); ?></p><?php endif; ?>
              </div>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="team__content">

      <?php if ( $specialists && is_array( $specialists ) ) : ?>
        <div class="team__content_slider">
          <div class="swiper-wrapper">
            <?php foreach ( $specialists as $spec ) :
              // Если это WP_Post из Relationship/Repeater
              if ( is_object( $spec ) && isset( $spec->ID ) ) {
                $id       = $spec->ID;
                $photo    = get_field( 'photo',    $id );       // поле-изображение
                $spec_experience = get_field('experience', $spec_id); // например "10 лет"
                $spec_stage = get_field('stage', $spec_id); // например "Руководитель отдела"
                // название — из заголовка записи
                $name     = get_the_title( $id );
              } else {
                continue;
              }
            ?>
              <div class=" swiper-slide">
                <div class="team__content_slide">
                    <?php if ( is_array( $photo ) && ! empty( $photo['url'] ) ) : ?>
                        <div class="team__content_slide-img">
                            <img
                                src="<?php echo esc_url( $photo['url'] ); ?>"
                                alt="<?php echo esc_attr( $photo['alt'] ); ?>"
                            >
                        </div>
                   
                    <?php endif; ?>

                    <h4><?php echo esc_html( $name ); ?></h4>

                    <?php if ( $spec_stage ) : ?>
                        <p><?php echo esc_html( $spec_stage ); ?></p>
                  
                    <?php endif; ?>
                    <?php if ( $spec_experience ) : ?>
                        <span><?php echo esc_html( $spec_experience ); ?></span>
                    <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- Навигация и пагинация -->
          <div class="swiper-button-prev"  aria-label="Previous team member"></div>
          <div class="swiper-button-next"  aria-label="Next team member"></div>
        </div>
      <?php endif; ?>

      <?php if ( have_rows( 'list' ) ) : ?>
        <div class="team__content_list">
          <?php while ( have_rows( 'list' ) ) : the_row();
            $item = get_sub_field( 'item' );
          ?>
            <?php if ( $item ) : ?>
              <div class="team__content_list-item">
                <span><?php echo esc_html( $item ); ?></span>
              </div>
            <?php endif; ?>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>
