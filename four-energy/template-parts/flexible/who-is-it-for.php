<?php
    $title = get_sub_field('title');
?>

<section class="who-is-it-for mb-100" id="who-is-it-for">
    <div class="container">
        <?php if ( $title ) : ?>
            <h2><?= esc_html( $title ); ?></h2>
        <?php endif; ?>
        <?php if ( have_rows( 'blocks' ) ) : ?>
            <div class="who-is-it-for__wrapper">
                <?php while ( have_rows( 'blocks' ) ) : the_row();
                    $text = get_sub_field('text');
                ?>
                    <div class="who-is-it-for__item">
                        <?= wp_kses_post( $text ); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>