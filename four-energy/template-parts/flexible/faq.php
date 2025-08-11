<?php
    $title = get_sub_field('title');
    $faq = get_sub_field('faq'); 
    $text = get_sub_field('text'); 
?>

<section class="faq">
    <div class="container">
        <?php if ( $title ) : ?>
            <h2 class="title">
                <?=$title;?>
            </h2>
        <?php endif; ?>
        <div class="faq__wrapper">
            <div class="faq__content">
                <?php foreach ( $faq as $block_id ): 
                    // подтягиваем данные отзыва
                    $item_title = get_the_title( $block_id );
                    $text_faq = apply_filters( 'the_content', get_post_field( 'post_content', $block_id ) );
                    ?>
                    <div class="faq__content-item">
                        <div class="faq__content-quest">
                            <p><?= wp_kses_post( $item_title ) ?></p>
                            <span class="faq__content-quest-icon">

                            </span>
                        </div>
                        <div class="faq__content-answer">
                            <?= wp_kses_post( $text_faq ) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
           
            <?php if ( $text ) : ?>
                <div class="faq__text">
                    <?= wp_kses_post( $text ); ?>
                </div>
            <?php endif; ?>
        </div>
       
    </div>
</section>