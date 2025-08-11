<?php
$title = get_sub_field('title');
?>

<section class="deadlines mb-120">
    <div class="container">
        <?php if ( $title ) : ?>
            <h2 class="title"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>
        <?php if ( have_rows( 'deadlines_blocks' ) ) : ?> 
            <div class="deadlines__content">
                <?php while ( have_rows( 'deadlines_blocks' ) ) : the_row();
                    $icon = get_sub_field( 'icon' );
                    $name = get_sub_field( 'name' );
                    $text = get_sub_field( 'text' );
                    ?>
                    <div class="deadlines__block ">
                        <div class="deadlines__block_name">
                            <?php if ( $name ) : ?>
                                <span>
                                    <?=$name;?>
                                </span>
                            <?php endif; ?>
                            <?php if ( is_array($icon) && ! empty($icon['url']) ): ?>
                                <img src="<?= esc_url( $icon['url'] ); ?>" alt="<?= esc_attr( $icon['alt'] ?? '' ); ?>">
                            <?php endif; ?>
                        </div>
                        <?php if ( $text ) : ?>
                            <div class="deadlines__block_text">
                                <?= wp_kses_post( $text ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>