<?php
$text = get_sub_field('text');

$text_down = get_sub_field('text_down');

?>
<section class="automation-benefits mb-120">
    <div class="container">
        <div class="automation-benefits__content">
            <?php if ( $text ) : ?>
                <div class="automation-benefits__title">
                    <?= wp_kses_post( $text ); ?>
                </div>
            <?php endif; ?>
            <?php if ( have_rows( 'blocks' ) ) : ?>
                <?php while ( have_rows( 'blocks' ) ) : the_row();
                    $img = get_sub_field( 'img' );
                    $name = get_sub_field( 'name' );
                    $text = get_sub_field( 'text' );
                    ?>
                    <div class="automation-benefits__block">
                        <div class="automation-benefits__block_name">
                            <span><?=$name;?></span>
                            <img src="<?=$img['url']?>" alt="<?=$img['alt']?>">
                        </div>
                        <?php if ( $text ) : ?>
                            <div class="automation-benefits__block_text">
                                <?=$text;?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <?php if ( $text_down ) : ?>  
            <div class="automation-benefits__down">
                <img src="<?= esc_url( get_template_directory_uri() . '/assets/svg/button.svg' ); ?>" alt="">
                <p><?=$text_down?></p>
            </div>
        <?php endif; ?>
    </div>
</section>