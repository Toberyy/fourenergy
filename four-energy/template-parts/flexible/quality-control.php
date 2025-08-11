<?php
$text = get_sub_field('text');
$name_spec = get_sub_field('name_spec');
$specialists = get_sub_field('specialists'); // relationship, массив WP_Post объектов
?>

<section class="quality-control">
    <div class="container">
        <div class="quality-control__top">
            <?php if ( $text ) : ?>
                <div class="quality-control__top-text">
                    <?= wp_kses_post( $text ); ?>
                </div>
            <?php endif; ?>
            <?php if ( $name_spec ) : ?>
                <div class="quality-control__addition">
                    <?= wp_kses_post( $name_spec ); ?>
                </div>
            <?php endif; ?>
            <?php if ( $specialists && is_array($specialists) ): ?>
                <div class="quality-control__specialists">
                    <?php foreach ( $specialists as $spec_post ):
                        // глобально не назначаем, работаем по объекту
                        $spec_id = $spec_post->ID;
                        $spec_name = get_the_title( $spec_id );
                        // Примерные ACF-поля у специалиста:
                        $spec_photo = get_field('photo', $spec_id); // можно заменить на нужное поле
                        $spec_experience = get_field('experience', $spec_id); // например "10 лет"
                        $spec_stage = get_field('stage', $spec_id); // например "Руководитель отдела"
                        ?>
                        <div class="quality-control__specialist">
                            <?php if ( is_array( $spec_photo ) && ! empty( $spec_photo['ID'] ) ): ?>
                                <div class="specialist__photo">
                                    <?= wp_get_attachment_image( $spec_photo['ID'], 'full', false, ['alt' => esc_attr( $spec_name )] ); ?>
                                </div>
                            <?php elseif ( has_post_thumbnail( $spec_id ) ): ?>
                                <div class="specialist__photo">
                                    <?= get_the_post_thumbnail( $spec_id, 'full', ['alt' => esc_attr( $spec_name )] ); ?>
                                </div>
                            <?php endif; ?>
                            <div class="specialist__info">
                                <?php if ( $spec_name ): ?>
                                    <span class="name"><?= esc_html( $spec_name ); ?></span>
                                <?php endif; ?>
                                <?php if ( $spec_stage ): ?>
                                    <span class="stage"><?= esc_html( $spec_stage ); ?></span>
                                <?php endif; ?>
                                <?php if ( $spec_experience ): ?>
                                    <span class="exp"><?= esc_html( $spec_experience ); ?></span>
                                <?php endif; ?>
                               
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if ( have_rows( 'quality-control-list' ) ) : ?>
            <div class="quality-control__down">
                <?php while ( have_rows( 'quality-control-list' ) ) : the_row();
                    $img = get_sub_field( 'img' ); 
                    $text_item = get_sub_field( 'text' );
                    ?>
                    <div class="quality-control__block">
                        <?php if ( is_array($img) && ! empty($img['url']) ): ?>
                            <img src="<?= esc_url( $img['url'] ); ?>" alt="<?= esc_attr( $img['alt'] ?? '' ); ?>">
                        <?php endif; ?>
                        <?php if ( $text_item ): ?>
                            <p><?= wp_kses_post( $text_item ); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
