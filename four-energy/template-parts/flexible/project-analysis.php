<?php
$text = get_sub_field('text');
$text_block = get_sub_field('text_block'); 
?>

<section class="project-analysis">
    <div class="container">
        <div class="project-analysis__wrapper">
            <?php if ( $text ) : ?>
                <div class="project-analysis__text">
                    <?= wp_kses_post( $text ); ?>
                </div>
            <?php endif; ?>

            <div class="project-analysis__content">
                <?php 
                $analysis = get_sub_field('analysis'); // массив строк repeater
                if ( is_array($analysis) && count($analysis) ): 
                    $total = count($analysis);
                ?>
                    <ul class="project-analysis__list">
                        <?php foreach ( $analysis as $index => $row ):
                            $stage = isset($row['stage']) ? $row['stage'] : '';
                            $is_last = ($index === $total - 1);
                            ?>
                            <li>
                                <div>
                                    <?= wp_kses_post( $stage ); ?>
                                </div>
                                <span>
                                    <?php if ( $is_last ): ?>
                                        <img src="<?= esc_url( get_template_directory_uri() . '/assets/svg/last.svg' ); ?>" alt="Финальный шаг">
                                    <?php else: ?>
                                        <?= esc_html( sprintf( '%02d', $index + 1 ) ); ?>
                                    <?php endif; ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?php if ( $text_block ) : ?>
                <div class="project-analysis__block">
                    <?= wp_kses_post( $text_block ); ?>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>

</section>