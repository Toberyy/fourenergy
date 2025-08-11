<?php
$img = get_sub_field('img');
$text_before = get_sub_field('text_before');


$block_btn = get_sub_field('block_btn');
$title = $block_btn['title'];
$text_btn = $block_btn['text_btn'];
$link_btn = $block_btn['link_btn'];
$bottom_text = $block_btn['bottom_text'];

$bg_url = '';
if ( is_array( $img ) && ! empty( $img['url'] ) ) {
    $bg_url = esc_url( $img['url'] );
} elseif ( is_string( $img ) ) {
    $bg_url = esc_url( $img );
}
?>
<section class="workflow" id="workflow">
    <div class="container">
        <div class="workflow__wrapper" <?= $bg_url ? 'style="background-image: url(' . $bg_url . ');"' : ''; ?>>
            <div class="workflow__text">
                <?php if ( $text_before ) : ?>
                    <div class="workflow__text_text">
                        <?= wp_kses_post( $text_before ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( have_rows( 'list' ) ) : ?>
                    <ul class="workflow__text_list">
                        <?php while ( have_rows( 'list' ) ) : the_row();
                            $item = get_sub_field( 'item' );
                            ?>
                            <li><span><?= $item; ?></span> </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="workflow__block">
                <div class="workflow__block_text">
                    <?= $title; ?>
                </div>
                <?php if ( ! empty( $block_btn['list'] ) && is_array( $block_btn['list'] ) ): ?>
                    <ul class="workflow__block_list">
                        <?php foreach ( $block_btn['list'] as $row ): 
                            $item = isset($row['item']) ? $row['item'] : '';
                            if ( ! $item ) {
                                continue;
                            }
                        ?>
                            <li class="workflow__block_item">
                                <span><?= esc_html( $item ); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?php if ($link_btn ): ?>
                    <a href="<?= esc_url($link_btn); ?>" class=" btn">
                        <?= esc_html($text_btn); ?>
                    </a>
                <?php else : ?>
                    <button type="button"  class="btn modal-open">
                        <?= esc_html($text_btn); ?>
                    </button>
                <?php endif; ?>
                <div class="bottom_text">
                    <?= $bottom_text; ?>
                </div>
            </div>
        </div>
    </div>
</section>