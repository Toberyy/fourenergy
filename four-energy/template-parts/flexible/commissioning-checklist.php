<?php
$block_1 = get_sub_field('block_1');
$block_2 = get_sub_field('block_2');
$block_3 = get_sub_field('block_3');
?>

<section class="commissioning-checklist">
  <div class="container">
    <div class="commissioning-checklist__wrapper">

      <?php if ( $block_1 ) :
        $top_text    = $block_1['top_text'];
        $name1       = $block_1['name'];
        $list_name1  = $block_1['name_list'];
        $items1      = $block_1['list'];
        $bottom_text = $block_1['text_bottom'];
        $button_text = $block_1['text_button'];
        $button_link = $block_1['link_button'];
      ?>
      <div class="commissioning-checklist__block">
        <?php if ( $top_text ) : ?>
          <span class="commissioning-checklist__top-text"><?php echo esc_html( $top_text ); ?></span>
        <?php endif; ?>

        <?php if ( $name1 ) : ?>
          <h3 class="commissioning-checklist__title"><?php echo esc_html( $name1 ); ?></h3>
        <?php endif; ?>

        <?php if ( $list_name1 ) : ?>
          <span class="commissioning-checklist__list-title"><?php echo esc_html( $list_name1 ); ?></span>
        <?php endif; ?>

        <?php if ( $items1 ) : ?>
            <ul class="commissioning-checklist__list">
                <?php foreach ( $items1 as $item ) : ?>
                    <?php if ( ! empty( $item['item'] ) ) : ?>
                        <li><span><?php echo esc_html( $item['item'] ); ?></span></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if ( $bottom_text || $button_text ) : ?>
          <div class="commissioning-checklist__block_button">
            <?php if ( $bottom_text ) : ?>
              <p class="commissioning-checklist__bottom-text"><?php echo esc_html( $bottom_text ); ?></p>
            <?php endif; ?>

            <?php if ( $button_text ) : ?>
              <?php if ( $button_link ) : ?>
                <a href="<?php echo esc_url( $button_link ); ?>" class="btn btn-white">
                  <span><?php echo esc_html( $button_text ); ?></span>
                </a>
              <?php else : ?>
                <button class="btn btn-white modal-open">
                  <span><?php echo esc_html( $button_text ); ?></span>
                </button>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
      <?php endif; ?>

      <?php if ( $block_2 ) :
        $top2       = $block_2['top_text'];
        $name2      = $block_2['name'];
        $list_name2 = $block_2['name_list'];
        $items2     = $block_2['list'];
        $bottom2    = $block_2['text_bottom'];
      ?>
      <div class="commissioning-checklist__block">
        <?php if ( $top2 ) : ?>
          <span class="commissioning-checklist__top-text"><?php echo esc_html( $top2 ); ?></span>
        <?php endif; ?>

        <?php if ( $name2 ) : ?>
          <h3 class="commissioning-checklist__title"><?php echo esc_html( $name2 ); ?></h3>
        <?php endif; ?>

        <?php if ( $list_name2 ) : ?>
          <span class="commissioning-checklist__list-title"><?php echo esc_html( $list_name2 ); ?></span>
        <?php endif; ?>

        <?php if ( $items2 ) : ?>
          <ul class="commissioning-checklist__list">
            <?php foreach ( $items2 as $item2 ) : ?>
              <?php if ( ! empty( $item2['item'] ) ) : ?>
                <li><?php echo esc_html( $item2['item'] ); ?></li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <?php if ( $bottom2 ) : ?>
          <div class="commissioning-checklist__block_button">
            <p class="commissioning-checklist__bottom-text"><?php echo esc_html( $bottom2 ); ?></p>
          </div>
        <?php endif; ?>
      </div>
      <?php endif; ?>

      <?php if ( $block_3 ) :
        $name3 = $block_3['name'];
        $icon3 = $block_3['icon'];
        $img3  = $block_3['img'];
      ?>
      <div class="commissioning-checklist__block">
        <?php if ( $name3 ) : ?>
          <span class="commissioning-checklist__top-text"><?php echo esc_html( $name3 ); ?></span>
        <?php endif; ?>

        <?php if ( is_array( $icon3 ) && ! empty( $icon3['url'] ) ) : ?>
          <img
            src="<?php echo esc_url( $icon3['url'] ); ?>"
            alt="<?php echo esc_attr( $icon3['alt'] ); ?>"
          >
        <?php endif; ?>

        <?php if ( is_array( $img3 ) && ! empty( $img3['url'] ) ) : ?>
          <div class="commissioning-checklist__block_img">
            <img
              src="<?php echo esc_url( $img3['url'] ); ?>"
              alt="<?php echo esc_attr( $img3['alt'] ); ?>"
            >
          </div>
        <?php endif; ?>
      </div>
      <?php endif; ?>

    </div><!-- .commissioning-checklist__wrapper -->
  </div><!-- .container -->
</section>
