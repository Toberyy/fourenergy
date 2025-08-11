<?php
$title = get_sub_field('title');
$icon = get_sub_field('icon');

$block_1 = get_sub_field('block_1');
$name_1 = $block_1['name'] ?? '';
$content_1 = $block_1['content'] ?? '';

$block_2 = get_sub_field('block_2');
$name_2 = $block_2['name'] ?? '';
$content_2 = $block_2['content'] ?? '';

$block_3 = get_sub_field('block_3');
$name_3 = $block_3['name'] ?? '';
$text = $block_3['text'] ?? '';
?>

<section class="guarantee">
    <div class="container">
        <?php if ( $title || ( is_array($icon) && ! empty($icon['url']) ) ): ?>
            <div class="guarantee__title">
                <?php if ( $title ): ?>
                    <h2 class="title">
                        <?= esc_html( $title ); ?>
                    </h2>
                <?php endif; ?>
                <?php if ( is_array($icon) && ! empty($icon['url']) ): ?>
                    <img src="<?= esc_url( $icon['url'] ); ?>" alt="<?= esc_attr( $icon['alt'] ?? '' ); ?>">
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="guarantee__content">
            <?php if ( $name_1 || $content_1 ): ?>
                <div class="guarantee__content_block">
                    <?php if ( $name_1 ): ?>
                        <span class="name"><?= esc_html( $name_1 ); ?></span>
                    <?php endif; ?>
                    <?php if ( $content_1 ): ?>
                        <span class="content">
                            <?= esc_html( $content_1 ); ?>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ( $name_2 || $content_2 ): ?>
                <div class="guarantee__content_block">
                    <?php if ( $name_2 ): ?>
                        <span class="name"><?= esc_html( $name_2 ); ?></span>
                    <?php endif; ?>
                    <?php if ( $content_2 ): ?>
                        <div class="content">
                            <?= $content_2; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ( $name_3 || $text ): ?>
                <div class="guarantee__content_block">
                    <?php if ( $name_3 ): ?>
                        <span class="name"><?= esc_html( $name_3 ); ?></span>
                    <?php endif; ?>
                    <?php if ( $text ): ?>
                        <div class="content">
                            <?= wp_kses_post( $text ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
