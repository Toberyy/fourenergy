<?php
/**
 * Template Name: Страница без Gutenberg
 */

get_header(); ?>

<main id="primary" class="site-main">

  <?php
  // Если вы используете Flexible Content с key = layout_blocks
  if ( have_rows( 'layout_blocks' ) ) :

    while ( have_rows( 'layout_blocks' ) ) : the_row();

      // Пример одного лейаута
      if ( get_row_layout() === 'hero_block' ) : 
        $heading = get_sub_field( 'heading' );
        $subtitle = get_sub_field( 'subtitle' );
        ?>
        <section class="hero">
          <div class="container">
            <?php if ( $heading ) : ?><h1 class="hero__title"><?= esc_html( $heading ) ?></h1><?php endif; ?>
            <?php if ( $subtitle ) : ?><p class="hero__subtitle"><?= esc_html( $subtitle ) ?></p><?php endif; ?>
          </div>
        </section>
      <?php

      // Другой блок
      elseif ( get_row_layout() === 'text_with_image' ) :
        $text  = get_sub_field( 'text' );
        $image = get_sub_field( 'image' );
        ?>
        <section class="text-image">
          <div class="container">
            <div class="text-image__row">
              <div class="text-image__col text-image__col--text">
                <?= wp_kses_post( $text ) ?>
              </div>
              <?php if ( $image ): ?>
              <div class="text-image__col text-image__col--image">
                <img src="<?= esc_url( $image['url'] ) ?>"
                     alt="<?= esc_attr( $image['alt'] ) ?>">
              </div>
              <?php endif; ?>
            </div>
          </div>
        </section>
      <?php

      // ... и так далее для всех ваших блоков

      endif;

    endwhile;

  else:
    // Если нет ни одного блока — подрубаем классический контент
    while ( have_posts() ) : the_post();
      ?>
      <section class="page-default">
        <div class="container">
          <?php the_content(); ?>
        </div>
      </section>
      <?php
    endwhile;

  endif;
  ?>

</main>

<?php
get_sidebar();
get_footer();
