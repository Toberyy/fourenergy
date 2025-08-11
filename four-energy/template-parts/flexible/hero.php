<?php
// Основные sub поля
$img = get_sub_field('img');
$text = get_sub_field('text');
$text_above = get_sub_field('text_above');
$form_title = get_sub_field('form_title');
$form_text_after = get_sub_field('form_text_after');

// Опции
$tel_raw = get_field('telefon', 'options');
$telegram = get_field('telegram', 'options');
$whatsapp = get_field('whatsapp', 'options');

$politic_link = get_field('politic_link','options');

// Обработка фонового изображения
$bg_url = '';
if ( is_array( $img ) && ! empty( $img['url'] ) ) {
    $bg_url = esc_url( $img['url'] );
} elseif ( is_string( $img ) ) {
    $bg_url = esc_url( $img );
}

// Приведение телефона
$tel_clean = $tel_raw ? preg_replace( '/\D+/', '', $tel_raw ) : '';
?>

<section class="hero mb-100" id="hero" <?= $bg_url ? 'style="background-image: url(' . $bg_url . ');"' : ''; ?>>

    <div class="container">
        <div class="hero__wrapper">
            <div class="hero__text">
                <?php if ( $text ) : ?>
                    <div class="hero__description">
                        <?= wp_kses_post( $text ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( have_rows( 'special' ) ) : ?>
                    <div class="hero__special">
                        <?php while ( have_rows( 'special' ) ) : the_row();
                            $item = get_sub_field( 'item' );
                        ?>
                            <div class="hero__special-item">
                                <span><?= esc_html( $item ); ?></span>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <?php if ( have_rows( 'advantages' ) ) : ?>
                    <div class="hero__advantages">
                        <?php while ( have_rows( 'advantages' ) ) : the_row();
                            $icon = get_sub_field( 'icon' );
                            $name = get_sub_field( 'name' );
                            $text_adv = get_sub_field( 'text' );
                        ?>
                            <div class="hero__advantage">
                                <?php
                                if ( $icon && is_array( $icon ) ) :
                                    $icon_url = ! empty( $icon['url'] ) ? esc_url( $icon['url'] ) : '';
                                    $icon_alt = ! empty( $icon['alt'] ) ? esc_attr( $icon['alt'] ) : '';
                                    if ( $icon_url ) :
                                ?>
                                        <img src="<?= $icon_url; ?>" alt="<?= $icon_alt; ?>" loading="lazy">
                                <?php
                                    endif;
                                endif;
                                ?>
                                <div class="hero__advantage-text">
                                    <div class="hero__advantage-name"><?= wp_kses_post( $name ); ?></div>
                                    <div class="hero__advantage-desc"><?= wp_kses_post( $text_adv ); ?></div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="hero__form">
                <?php if ( $text_above ) : ?>
                    <span class="hero__form-pretitle"><?= esc_html( $text_above ); ?></span>
                <?php endif; ?>
                <div class="hero__form_content">
                    <?php if ( $form_title ) : ?>
                        <h3 class="hero__form-title"><?= esc_html( $form_title ); ?></h3>
                    <?php endif; ?>

                    <form action="" method="post" enctype="multipart/form-data" class="js-lead-form hero-form" id="hero-form">
                        <input type="hidden" name="form_id" value="hero">
                        <?php wp_nonce_field( 'lead_form_nonce', 'nonce' ); ?>
                        <div class="cta__form-field form-field">
                            <label for="hero-email" class="cta-form__label">Электронная почта</label>
                            <input
                                type="email"
                                 id="hero-email"
                                name="cta_email"
                                class="cta-form__input"
                                placeholder="example@site.com"
                                required
                            >
                        </div>
                        <div class="cta__form-field form-field">
                            <label for="hero-tel"  class="cta-form__label">Телефон для получения ответа</label>
                            <input
                                type="tel"
                                id="hero-tel"
                                name="cta_phone"
                                class="cta-form__input modal-phone"
                                placeholder="+7 (999) 123-45-67"
                                required
                            >
                        </div>
                        <div class="cta__form-field">
                            <div class="file-upload-wrapper" data-upload-block>
                                <!-- placeholder -->
                                <label class="file-upload-placeholder" for="hero-file" aria-label="Прикрепить файлы ТЗ">
                                    <div class="file-upload-inner">
                                        <div class="file-upload-icon">
                                            <!-- иконка скрепки -->
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M19.9993 9.99939L9.58579 20.5858C9.21071 20.9609 9 21.4696 9 22C9 22.5304 9.21071 23.0391 9.58579 23.4142C9.96086 23.7893 10.4696 24 11 24C11.5304 24 12.0391 23.7893 12.4142 23.4142L24.8277 10.8278C25.1991 10.4564 25.4938 10.0154 25.6948 9.53012C25.8958 9.04482 25.9993 8.52468 25.9993 7.99939C25.9993 7.4741 25.8958 6.95396 25.6948 6.46866C25.4938 5.98335 25.1991 5.5424 24.8277 5.17096C24.4563 4.79953 24.0153 4.50489 23.53 4.30387C23.0447 4.10285 22.5246 3.99939 21.9993 3.99939C21.474 3.99939 20.9538 4.10285 20.4685 4.30387C19.9832 4.50489 19.5423 4.79953 19.1708 5.17096L6.75736 17.7574C5.63214 18.8826 5 20.4087 5 22C5 23.5913 5.63214 25.1174 6.75736 26.2426C7.88258 27.3679 9.4087 28 11 28C12.5913 28 14.1174 27.3679 15.2426 26.2426L25.4993 15.9994" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>

                                        </div>
                                        <div class="file-upload-text">
                                            <div class="subtitle">Техническое задание проекта</div>
                                            <div class="title">Прикрепить файлы ТЗ</div>
                                           
                                        </div>
                                    </div>
                                    <input
                                        type="file"
                                        id="hero-file"
                                        name="cta_file"
                                        class="file-upload-input"
                                        accept=".pdf,.doc,.docx"
                                    >
                                </label>

                                <!-- превью файла -->
                                <div class="file-upload-preview" aria-live="polite" hidden>
                                    <div class="preview-info">
                                        <div class="preview-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                            <path d="M16.5 7.5V11.25C16.5 15 15 16.5 11.25 16.5H6.75C3 16.5 1.5 15 1.5 11.25V6.75C1.5 3 3 1.5 6.75 1.5H10.5" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M16.5 7.5H13.5C11.25 7.5 10.5 6.75 10.5 4.5V1.5L16.5 7.5Z" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5.25 9.75H9.75" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5.25 12.75H8.25" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        </div>
                                        <div class="preview-text">
                                            <div class="file-name" data-file-name>Имя_файла.pdf</div>
                                            <div class="file-meta" data-file-meta>Файл PDF — 105 kb</div>
                                        </div>
                                    </div>
                                    <button type="button" class="file-remove" aria-label="Удалить файл" title="Удалить файл" data-remove-file>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                            <path d="M15.75 4.48499C13.2525 4.23749 10.74 4.10999 8.235 4.10999C6.75 4.10999 5.265 4.18499 3.78 4.33499L2.25 4.48499" stroke="#A9A9A9" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M6.375 3.7275L6.54 2.745C6.66 2.0325 6.75 1.5 8.0175 1.5H9.9825C11.25 1.5 11.3475 2.0625 11.46 2.7525L11.625 3.7275" stroke="#A9A9A9" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M14.1373 6.85501L13.6498 14.4075C13.5673 15.585 13.4998 16.5 11.4073 16.5H6.5923C4.4998 16.5 4.4323 15.585 4.3498 14.4075L3.8623 6.85501" stroke="#A9A9A9" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M7.74756 12.375H10.2451" stroke="#A9A9A9" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M7.125 9.375H10.875" stroke="#A9A9A9" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                      
                        <div class="form-field-cheack">
                            <input
                                    type="checkbox"
                                    id="hero-policy"
                                    name="cta_policy"
                                    required
                                >
                            <label for="hero-policy">
                                Принимаю <a href="<?=$politic_link;?>" target="_blank" rel="noopener">условия обработки</a> персональных данных
                            </label>
                        </div>
                        <div class="cta__form-field">
                            <button type="submit" class="button btn">
                                <span>Получить КП</span>
                            </button>
                        </div>
                        
                    </form>

                    <div class="hero__form_content_links">
                        <?php if ( $telegram ) : ?>
                            <a href="<?= esc_url( $telegram ); ?>" class="telegram" target="_blank" aria-label="Telegram">
                                <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                                    <rect width="44" height="44" rx="22" fill="#24A1DD"/>
                                    <path d="M18.8475 24.9845L18.5167 29.6378C18.99 29.6378 19.195 29.4345 19.4409 29.1903L21.66 27.0695L26.2584 30.437C27.1017 30.907 27.6959 30.6595 27.9234 29.6612L30.9417 15.5178L30.9425 15.517C31.21 14.2703 30.4917 13.7828 29.67 14.0887L11.9284 20.8812C10.7175 21.3512 10.7359 22.0262 11.7225 22.332L16.2584 23.7428L26.7942 17.1503C27.29 16.822 27.7409 17.0037 27.37 17.332L18.8475 24.9845Z" fill="white"/>
                                </svg>
                            </a>
                        <?php endif; ?>

                        <?php if ( $whatsapp ) : ?>
                            <a href="<?= esc_url( $whatsapp ); ?>" class="whatsapp" target="_blank" aria-label="WhatsApp">
                                <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                                    <rect width="44" height="44" rx="22" fill="#25D366"/>
                                    <path d="M12 32.0001C12.215 31.2141 12.4195 30.4678 12.6232 29.7211C12.869 28.8203 13.1178 27.92 13.3561 27.0172C13.3794 26.92 13.3682 26.8178 13.3244 26.7279C12.3644 24.9849 11.947 23.1158 12.1139 21.1407C12.3531 18.3133 13.5961 15.9909 15.7912 14.1906C17.0121 13.1852 18.4645 12.5003 20.0169 12.198C24.655 11.2756 29.1161 13.6489 31.0274 17.822C31.7407 19.3818 32.0111 21.0222 31.8784 22.7247C31.5449 27.0068 28.3781 30.6515 24.185 31.5864C21.8213 32.1132 19.5603 31.8039 17.4019 30.7099C17.3056 30.6653 17.1972 30.6542 17.0939 30.6782C15.4798 31.0956 13.8674 31.518 12.255 31.94C12.1832 31.9575 12.111 31.9733 12 32.0001ZM14.3942 29.6326C14.4893 29.6096 14.5611 29.5934 14.6325 29.5746C15.509 29.3454 16.3856 29.1209 17.2621 28.8821C17.4391 28.8341 17.5731 28.8612 17.7275 28.9527C19.6379 30.0846 21.681 30.4198 23.8494 29.9319C28.4825 28.8884 31.2878 24.0049 29.8599 19.4786C28.5589 15.3556 24.4421 12.9673 20.2072 13.8855C16.7145 14.6448 13.9471 17.7034 13.7727 21.5623C13.7005 23.1575 14.0507 24.6685 14.8854 26.0334C15.1497 26.4654 15.196 26.8265 15.0411 27.2964C14.792 28.0553 14.6108 28.837 14.3942 29.6326Z" fill="white"/>
                                    <path d="M16.9396 19.6826C16.9542 18.8545 17.2777 18.1733 17.8624 17.6052C17.9474 17.5179 18.0492 17.4488 18.1617 17.4021C18.2743 17.3554 18.3951 17.332 18.5169 17.3335C18.6559 17.3335 18.7961 17.3544 18.9343 17.3406C19.2265 17.3118 19.3934 17.4554 19.4957 17.7037C19.7703 18.3615 20.0542 19.016 20.3096 19.6813C20.3559 19.802 20.3288 19.9948 20.2595 20.1071C20.0715 20.3977 19.8657 20.6765 19.6435 20.9419C19.5107 21.1063 19.4999 21.2524 19.6071 21.4327C20.4156 22.7901 21.5397 23.7772 23.0135 24.3595C23.213 24.4384 23.3758 24.4071 23.5123 24.2343C23.7577 23.9246 24.0132 23.6232 24.2527 23.3081C24.3905 23.1257 24.5516 23.0577 24.7561 23.152C25.4657 23.4859 26.1702 23.8198 26.8702 24.17C26.9437 24.2067 27.0117 24.3311 27.0146 24.4175C27.043 25.1542 26.8289 25.7711 26.1723 26.2006C25.3551 26.7349 24.4969 26.7816 23.5845 26.5254C21.2442 25.8684 19.5061 24.405 18.1108 22.4733C17.6516 21.8347 17.2284 21.1769 17.0498 20.3972C16.9938 20.1647 16.9746 19.9218 16.9396 19.6826Z" fill="white"/>
                                </svg>
                            </a>
                        <?php endif; ?>

                        <?php if ( $tel_clean ) : ?>
                            <a href="tel:<?= esc_attr( $tel_clean ); ?>" class="telefon" aria-label="Phone">
                                <span><?= esc_html( $tel_raw ); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>

                    <?php if ( $form_text_after ) : ?>
                        <div class="hero__form_content_text">
                            <?= esc_html( $form_text_after ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
