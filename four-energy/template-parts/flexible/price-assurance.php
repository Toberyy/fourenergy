<?php
  $title = get_sub_field( 'title' );
?>
<section class="price-assurance mb-120" id="price-assurance">
  <div class="container">
    <?php if ( $title ) : ?>
      <h2 class="title"><?php echo esc_html( $title ); ?></h2>
    <?php endif; ?>

    <div class="price-assurance__wrapper">

      <?php if ( have_rows( 'left_cards' ) ) : ?>
        <div class="price-assurance__column price-assurance__column--left">
          <?php while ( have_rows( 'left_cards' ) ) : the_row();
            $item_title = get_sub_field( 'title' );
            $item_text  = get_sub_field( 'text' );
          ?>
            <div class="price-assurance__item">
              <span class="price-assurance__item-title"><?php echo esc_html( $item_title ); ?></span>
              <div   class="price-assurance__item-text"><?php echo wp_kses_post( $item_text ); ?></div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>


      <?php if ( have_rows( 'right_cards' ) ) : ?>
        <div class="price-assurance__column price-assurance__column--right">
          <?php while ( have_rows( 'right_cards' ) ) : the_row();
            $img            = get_sub_field( 'img' );
            $text = get_sub_field( 'text' );
            $column_1_name  = $text['column_1_name'];
            $column_1       = $text['column_1'];
            $column_2_name  = $text['column_2_name'];
            $column_2       = $text['column_2'];
          ?>
            <div class="price-assurance__item">

              <?php if (is_array( $img ) ) : ?>
                <img
                  class="price-assurance__screenshot"
                  src="<?php echo esc_url( $img['url'] ); ?>"
                  alt="<?php echo esc_attr( $img['alt'] ); ?>"
                >

              <?php else : ?>
                <span class="price-assurance__item-title">Не берём всю сумму сразу</span>
                <div class="price-assurance__columns">
                  <div class="price-assurance__column-block">
                    <span class="price-assurance__column-title"><?php echo esc_html( $column_1_name ); ?></span>
                    <?php echo wp_kses_post( $column_1 ); ?>
                  </div>
                  <div class="price-assurance__column-block">
                    <span class="price-assurance__column-title"><?php echo esc_html( $column_2_name ); ?></span>
                    <?php echo wp_kses_post( $column_2 ); ?>
                  </div>
                </div>
              <?php endif; ?>

            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>

<style>
  .price-assurance__item:nth-child(1){
      grid-area: 1 / 1 / 2 / 3;
      padding-bottom: 41px;
}
.price-assurance__item:nth-child(4){
  grid-area: 2 / 2 / 4 / 3;
}

</style>