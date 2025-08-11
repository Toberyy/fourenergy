<?php
  // Основные поля
  $title       = get_sub_field('title');
  $subtitle    = get_sub_field('subtitle');
  $name_block  = get_sub_field('name_block');
  $right_img   = get_sub_field('img');
  $right_name  = get_sub_field('name');
  $right_text  = get_sub_field('text');
?>

<section class="documentation mb-120">
    <div class="container">

        <?php if ( $title ) : ?>
            <h2 class="title"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>

        <?php if ( $subtitle ) : ?>
            <div class="subtitle"><?php echo wp_kses_post( $subtitle ); ?></div>
        <?php endif; ?>

       
        <div class="documentation__wrapper">
            <?php if ( $name_block ) : ?>
                <h3><?php echo esc_html( $name_block ); ?></h3>
            <?php endif; ?>
            
            <div class="documentation__wrapper_content">
                <?php if ( have_rows( 'blocks' ) ) : ?>
                    <div class="documentation__wrapper_list">
                        <?php
                            $i = 1;
                            while ( have_rows( 'blocks' ) ) : the_row();
                            $item = get_sub_field( 'item' );
                            if ( $item ) :
                            ?>
                            <div class="documentation__wrapper_block">
                                <?php echo wp_kses_post( $item ); ?>
                                <span><?= esc_html( sprintf( '%02d', $i ) ); ?></span>
                            </div>
                        <?php
                            $i++;
                            endif;
                            endwhile;
                        ?>
                    </div>
                <?php endif; ?>
                <div class="documentation__wrapper_right">

                    <?php if ( is_array( $right_img ) && ! empty( $right_img['url'] ) ) : ?>
                        <img
                        src="<?php echo esc_url( $right_img['url'] ); ?>"
                        alt="<?php echo esc_attr( $right_img['alt'] ); ?>"
                        loading="lazy"
                        >
                    <?php endif; ?>

                    <?php if ( $right_name ) : ?>
                        <span><?php echo esc_html( $right_name ); ?></span>
                    <?php endif; ?>

                    <?php if ( $right_text ) : ?>
                        <div><?php echo wp_kses_post( $right_text ); ?></div>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>
</section>
