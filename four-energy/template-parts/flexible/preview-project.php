<?php
$title = get_sub_field('title');
$project_post = get_sub_field('project_output'); // Post Object

// Проверка, что получили объект WP_Post
if ( $project_post && is_a( $project_post, 'WP_Post' ) ) {
    // Чтобы ACF работал внутри, временно переключаем глобальный $post
    $orig_post = get_post();
    setup_postdata( $project_post );

    // Получаем нужные поля из связанной записи проекта
    $duration       = get_field( 'duration', $project_post->ID );
    $client         = get_field( 'client', $project_post->ID );
    $logo           = get_field( 'logo', $project_post->ID ); // массив (return_format = array)
    $objective      = get_field( 'objective', $project_post->ID );
    $result         = get_field( 'result', $project_post->ID );
    $what_we_did    = get_field( 'what_we_did', $project_post->ID );
    $client_comment = get_field( 'comment', $project_post->ID );
    $name_client    = get_field( 'name_client', $project_post->ID );
    $position       = get_field( 'position', $project_post->ID );
    $gallery        = get_field( 'gallery', $project_post->ID ); // массив изображений

    // Возвращаем глобальный пост к оригиналу после использования
    wp_reset_postdata();
} else {
    // На случай, если нет связанной записи
    $duration = $client = $logo = $objective = $result = $what_we_did = $client_comment = $name_client = $position = $gallery = null;
}
?>

<section class="preview-project  mb-120" aria-label="Превью проекта" id="preview-project">
    <div class="container">
        <?php if ( $title ) : ?>
            <h2 class="title"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>

        <div class="preview-project__content">
            <div class="preview-project__header">
                <div class="preview-project__header_text">
                <?php if ( $project_post ) : ?>
                    <h3 class="preview-project__subtitle">
                    <?php echo esc_html( get_the_title( $project_post ) ); ?>
                    </h3>
                <?php endif; ?>

                <div class="preview-project__meta">
                    <?php if ( $duration ) : ?>
                    <div class="preview-project__meta-item">
                        <span class="meta-label">Срок:</span>
                        <span class="meta-value"><?php echo esc_html( $duration ); ?></span>
                    </div>
                    <?php endif; ?>

                    <?php if ( $client ) : ?>
                    <div class="preview-project__meta-item">
                        <span class="meta-label">Клиент:</span>
                        <span class="meta-value"><?php echo esc_html( $client ); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                </div>

                <?php if ( $logo && is_array( $logo ) ) : ?>
                <div class="preview-project__header_img">
                    <?php
                    // Аватар / логотип клиента
                    $alt = isset( $logo['alt'] ) && $logo['alt'] ? $logo['alt'] : esc_attr__( 'Логотип клиента', 'your-text-domain' );
                    echo wp_get_attachment_image(
                        $logo['ID'],
                        false,
                        [
                        'loading' => 'lazy',
                        'alt'     => $alt,
                        'class'   => 'client-logo',
                        ]
                    );
                    ?>
                </div>
                <?php endif; ?>
            </div> <!-- .preview-project__header -->

            <div class="preview-project__body">
                <?php if ( $objective ) : ?>
                <div class="preview-project__body-block">
                    <span class="block-title">Задача проекта</span>
                    <div class="preview-project__body-text">
                    <?php echo wp_kses_post( $objective ); ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $result ) : ?>
                <div class="preview-project__body-block">
                    <span class="block-title">Результат</span>
                    <div class="preview-project__body-text">
                    <?php echo wp_kses_post( $result ); ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $what_we_did ) : ?>
                <div class="preview-project__body-block">
                    <span class="block-title">Что сделали</span>
                    <div class="preview-project__body-text">
                    <?php echo wp_kses_post( $what_we_did ); ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $client_comment || $name_client || $position ) : ?>
                <div class="preview-project__body-block">
                    <span class="block-title">Комментарий клиента</span>
                    <?php if ( $client_comment ) : ?>
                    <div class="preview-project__body-text">
                        <?php echo wp_kses_post( $client_comment ); ?>
                    </div>
                    <?php endif; ?>
                    <?php if ( $name_client || $position ) : ?>
                    <div class="preview-project__body-client">
                        <?php if ( $name_client ) : ?>
                        <span class="client-name"><?php echo esc_html( $name_client ); ?></span>
                        <?php endif; ?>
                            &bull;
                        <?php if ( $position ) : ?>
                        <span class="client-position"><?php echo esc_html( $position ); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div> <!-- .preview-project__body -->

            <button class="btn btn-project" aria-label="Открыть полностью информацию о проекте">
                <span>Открыть полностью</span>
            </button>

            <?php if ( ! empty( $gallery ) && is_array( $gallery ) ) : ?>
                <div class="preview-project__slider swiper-container">
                    <div class="swiper-wrapper">
                    <?php foreach ( $gallery as $index => $image ) : ?>
                        <div class="swiper-slide">
                        <?php
                            $img_alt = isset( $image['alt'] ) && $image['alt'] ? $image['alt'] : esc_attr__( 'Изображение галереи', 'your-text-domain' );
                            $full_src = wp_get_attachment_image_url( $image['ID'], 'full' );
                            $thumb_src = wp_get_attachment_image_url( $image['ID'], 'thumbnail' );
                        ?>
                        <div class="slide-image-wrapper">
                            <img
                            class="swiper-lazy"
                            data-src="<?php echo esc_url( $full_src ); ?>"
                            src="<?php echo esc_url( $full_src ); ?>"  
                            alt="<?php echo esc_attr( $img_alt ); ?>"
                            loading="lazy"
                            />
                            <div class="swiper-lazy-preloader"></div>
                        </div>
                        </div>
                    <?php endforeach; ?>
                    </div>

                    <div class="swiper-button-prev" aria-label="Предыдущий слайд"></div>
                    <div class="swiper-button-next" aria-label="Следующий слайд"></div>
                </div>
            <?php endif; ?>
        </div> 

        <button class="btn btn-white modal-open" aria-label="Показать больше проектов">
            <span>Показать больше проектов</span>
        </button>
    </div>
</section>
