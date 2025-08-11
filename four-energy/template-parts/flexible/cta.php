<?php
$text = get_sub_field('text');

$telegram = get_field('telegram', 'options');
$whatsapp = get_field('whatsapp', 'options');

$tel = get_field('telefon','options');
$mail_main = get_field('mail_main','options');

$adress = get_field('adress','options');
$work_time = get_field('work_time','options');

$tel_icon = get_field('tel_icon','options');
$adress_icon = get_field('adress_icon','options');

$politic_link = get_field('politic_link','options');

$link_map = get_field('link_map','options');

$select_view = get_sub_field('select_view'); // form, bg-block, img-block, no-form, no-form-full
$color_border = get_sub_field('color-border'); // строка с цветом или класс

// Базовые классы
$section_classes = ['cta'];
$show_form = false;
$with_bg = false;
$with_image = false;
$extra_content = false; // для no-form-full, например
$no_free = false;


// Привязка по типу
switch ($select_view) {
    case 'form':
        $show_form = true;
        if ($color_border) {
            $section_classes[] = 'has-border';
        }
        break;

    case 'bg-block':
        $show_form = true;
        $with_bg = true;
        $section_classes[] = 'cta--with-bg';
        break;

    case 'img-block':
        $show_form = true;
        $with_image = true;
        $section_classes[] = 'cta--with-image';
        if ($color_border) {
            $section_classes[] = 'has-border';
        }
        break;

    case 'no-form':
        $show_form = false;
        $section_classes[] = 'cta--no-form';
        if ($color_border) {
            $section_classes[] = 'has-border';
        }
        break;

    case 'no-form-full':
        $extra_content = true;
        $section_classes[] = 'cta--no-form-full';
        // здесь можно подтянуть соцсети/адрес/карту из других полей
        break;

    case 'no-free':
        $no_free = true;
        $section_classes[] = 'cta--no-free';
        // здесь можно подтянуть соцсети/адрес/карту из других полей
        break;

    default:
        // fallback: стандартный с формой
        $show_form = true;
        if ($color_border) {
            $section_classes[] = 'has-border';
        }
        break;
}


$unique = uniqid(); 
$form_id = "cta-form-{$unique}";
$file_input_id = "cta-file-{$unique}";
$phone_id = "cta-phone-{$unique}";
$email_id = "cta-email-{$unique}";
$policy_id = "cta-policy-{$unique}";

?>

<section class="<?= esc_attr(implode(' ', $section_classes)); ?>" id="cta">
    <div class="container">
        <div class="cta__wrapper">
            <div class="cta__text">
                <?= wp_kses_post($text); ?>
                <?php if ( $extra_content ): ?>
                    <button class="modal-open btn">
                        <span>Запишитесь на удобное время посещения</span>
                    </button>
                <?php endif; ?>
                <?php if ($no_free): ?>
                    <p class="no_free_text">
                        На заявку в течение 30 минут ответит технически подготовленный специалист, а не просто менеджер
                    </p>
                    <form action="" method="post" enctype="multipart/form-data" class="js-lead-form cta-form" id="<?= esc_attr($form_id); ?>" data-cta-instance="<?= esc_attr($unique); ?>">
                    <input type="hidden" name="form_id" value="cta-<?= esc_attr($unique); ?>">
                    <?php wp_nonce_field( 'lead_form_nonce', 'nonce' ); ?>
                        <div class="cta__form-field form-field">
                            <label for="<?= esc_attr($phone_id); ?>"  class="cta-form__label">Телефон для связи</label>
                            <input
                                type="tel"
                                id="<?= esc_attr($phone_id); ?>"
                                name="cta_phone"
                                class="cta-form__input modal-phone"
                                placeholder="+7 (999) 123-45-67"
                                required
                            >
                        </div>
                        <div class="cta__form-field no_free-field">
                            <button type="submit" class="button btn">
                                <span>Получить консультацию</span>
                            </button>
                            <div class="cta__links">
                                <?php if ($telegram): ?>
                                    <a class="cta__links_item" href="<?= esc_url($telegram); ?>" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
                                            <rect width="60" height="60" rx="22" fill="#24A1DD"/>
                                            <path d="M25.7012 34.0694L25.2501 40.4149C25.8955 40.4149 26.1751 40.1376 26.5103 39.8047L29.5364 36.9126L35.8069 41.5047C36.9569 42.1456 37.7671 41.8081 38.0774 40.4467L42.1933 21.1604L42.1944 21.1592C42.5592 19.4592 41.5796 18.7944 40.4592 19.2115L16.266 28.474C14.6149 29.1149 14.6399 30.0354 15.9853 30.4524L22.1705 32.3763L36.5376 23.3865C37.2137 22.9388 37.8285 23.1865 37.3228 23.6342L25.7012 34.0694Z" fill="white"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                                <?php if ($whatsapp): ?>
                                    <a class="cta__links_item" href="<?= esc_url($whatsapp); ?>" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
                                            <rect width="60" height="60" rx="22" fill="#25D366"/>
                                            <path d="M16.3635 43.6363C16.6567 42.5645 16.9355 41.5468 17.2133 40.5286C17.5485 39.3003 17.8878 38.0726 18.2128 36.8414C18.2445 36.7089 18.2293 36.5695 18.1695 36.447C16.8604 34.0701 16.2912 31.5214 16.5189 28.828C16.845 24.9724 18.54 21.8055 21.5333 19.3507C23.1982 17.9797 25.1787 17.0457 27.2957 16.6334C33.6203 15.3756 39.7037 18.6119 42.3099 24.3025C43.2826 26.4295 43.6515 28.6664 43.4705 30.988C43.0157 36.8272 38.6974 41.7973 32.9794 43.0722C29.7562 43.7905 26.673 43.3687 23.7298 41.8769C23.5985 41.8162 23.4507 41.8009 23.3097 41.8337C21.1087 42.4029 18.91 42.9789 16.7113 43.5543C16.6134 43.5782 16.5149 43.5998 16.3635 43.6363ZM19.6283 40.4079C19.7581 40.3766 19.856 40.3544 19.9533 40.3288C21.1486 40.0163 22.3438 39.7101 23.5391 39.3845C23.7804 39.3191 23.9631 39.3561 24.1737 39.4807C26.7788 41.0243 29.565 41.4814 32.5218 40.816C38.8397 39.3931 42.6651 32.7337 40.7179 26.5616C38.9438 20.9393 33.33 17.6824 27.5552 18.9346C22.7924 19.97 19.0187 24.1409 18.7808 29.4029C18.6823 31.5783 19.1599 33.6387 20.2982 35.4999C20.6585 36.089 20.7217 36.5813 20.5105 37.2222C20.1707 38.257 19.9237 39.323 19.6283 40.4079V40.4079Z" fill="white"/>
                                            <path d="M23.0995 26.8406C23.1195 25.7114 23.5606 24.7825 24.358 24.0078C24.4738 23.8888 24.6127 23.7945 24.7661 23.7308C24.9196 23.6671 25.0843 23.6353 25.2505 23.6373C25.44 23.6373 25.6312 23.6658 25.8196 23.647C26.2181 23.6077 26.4457 23.8035 26.5852 24.1422C26.9597 25.0392 27.3467 25.9316 27.6951 26.8389C27.7582 27.0034 27.7212 27.2664 27.6268 27.4195C27.3703 27.8158 27.0898 28.196 26.7867 28.5578C26.6057 28.7821 26.5909 28.9813 26.7371 29.2272C27.8396 31.0781 29.3724 32.4242 31.3822 33.2182C31.6542 33.3258 31.8762 33.2831 32.0623 33.0475C32.397 32.6251 32.7453 32.2142 33.072 31.7845C33.2599 31.5357 33.4796 31.443 33.7585 31.5716C34.7261 32.0269 35.6868 32.4823 36.6413 32.9598C36.7415 33.0099 36.8343 33.1795 36.8383 33.2973C36.877 34.3019 36.585 35.1432 35.6897 35.7288C34.5752 36.4574 33.405 36.5211 32.1608 36.1717C28.9694 35.2758 26.5994 33.2803 24.6966 30.6461C24.0706 29.7753 23.4934 28.8783 23.2498 27.815C23.1735 27.498 23.1474 27.1667 23.0995 26.8406Z" fill="white"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                        <div class="cta__form-field no_free-text">
                            Заявка ни к чему не обязывает
                        </div>
                        <div class="form-field-cheack">
                            <input
                                    type="checkbox"
                                    id="<?= esc_attr($policy_id); ?>"
                                    name="cta_policy"
                                    required
                                >
                            <label for="<?= esc_attr($policy_id); ?>">
                                Принимаю <a href="<?=$politic_link;?>" target="_blank" rel="noopener">условия обработки</a> персональных данных
                            </label>
                        </div>
                        
                    </form>
                <?php endif; ?>
            </div>
            <?php if (!$with_image && $show_form): ?>
                <div class="cta__links">
                    <?php if ($whatsapp): ?>
                        <a class="cta__links_item" href="<?= esc_url($whatsapp); ?>" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
                                <rect width="60" height="60" rx="22" fill="#25D366"/>
                                <path d="M16.3635 43.6363C16.6567 42.5645 16.9355 41.5468 17.2133 40.5286C17.5485 39.3003 17.8878 38.0726 18.2128 36.8414C18.2445 36.7089 18.2293 36.5695 18.1695 36.447C16.8604 34.0701 16.2912 31.5214 16.5189 28.828C16.845 24.9724 18.54 21.8055 21.5333 19.3507C23.1982 17.9797 25.1787 17.0457 27.2957 16.6334C33.6203 15.3756 39.7037 18.6119 42.3099 24.3025C43.2826 26.4295 43.6515 28.6664 43.4705 30.988C43.0157 36.8272 38.6974 41.7973 32.9794 43.0722C29.7562 43.7905 26.673 43.3687 23.7298 41.8769C23.5985 41.8162 23.4507 41.8009 23.3097 41.8337C21.1087 42.4029 18.91 42.9789 16.7113 43.5543C16.6134 43.5782 16.5149 43.5998 16.3635 43.6363ZM19.6283 40.4079C19.7581 40.3766 19.856 40.3544 19.9533 40.3288C21.1486 40.0163 22.3438 39.7101 23.5391 39.3845C23.7804 39.3191 23.9631 39.3561 24.1737 39.4807C26.7788 41.0243 29.565 41.4814 32.5218 40.816C38.8397 39.3931 42.6651 32.7337 40.7179 26.5616C38.9438 20.9393 33.33 17.6824 27.5552 18.9346C22.7924 19.97 19.0187 24.1409 18.7808 29.4029C18.6823 31.5783 19.1599 33.6387 20.2982 35.4999C20.6585 36.089 20.7217 36.5813 20.5105 37.2222C20.1707 38.257 19.9237 39.323 19.6283 40.4079V40.4079Z" fill="white"/>
                                <path d="M23.0995 26.8406C23.1195 25.7114 23.5606 24.7825 24.358 24.0078C24.4738 23.8888 24.6127 23.7945 24.7661 23.7308C24.9196 23.6671 25.0843 23.6353 25.2505 23.6373C25.44 23.6373 25.6312 23.6658 25.8196 23.647C26.2181 23.6077 26.4457 23.8035 26.5852 24.1422C26.9597 25.0392 27.3467 25.9316 27.6951 26.8389C27.7582 27.0034 27.7212 27.2664 27.6268 27.4195C27.3703 27.8158 27.0898 28.196 26.7867 28.5578C26.6057 28.7821 26.5909 28.9813 26.7371 29.2272C27.8396 31.0781 29.3724 32.4242 31.3822 33.2182C31.6542 33.3258 31.8762 33.2831 32.0623 33.0475C32.397 32.6251 32.7453 32.2142 33.072 31.7845C33.2599 31.5357 33.4796 31.443 33.7585 31.5716C34.7261 32.0269 35.6868 32.4823 36.6413 32.9598C36.7415 33.0099 36.8343 33.1795 36.8383 33.2973C36.877 34.3019 36.585 35.1432 35.6897 35.7288C34.5752 36.4574 33.405 36.5211 32.1608 36.1717C28.9694 35.2758 26.5994 33.2803 24.6966 30.6461C24.0706 29.7753 23.4934 28.8783 23.2498 27.815C23.1735 27.498 23.1474 27.1667 23.0995 26.8406Z" fill="white"/>
                            </svg>
                            <span>Отправить в Whatsapp</span>
                        </a>
                    <?php endif; ?>
                    <?php if ($telegram): ?>
                        <a class="cta__links_item" href="<?= esc_url($telegram); ?>" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
                                <rect width="60" height="60" rx="22" fill="#24A1DD"/>
                                <path d="M25.7012 34.0694L25.2501 40.4149C25.8955 40.4149 26.1751 40.1376 26.5103 39.8047L29.5364 36.9126L35.8069 41.5047C36.9569 42.1456 37.7671 41.8081 38.0774 40.4467L42.1933 21.1604L42.1944 21.1592C42.5592 19.4592 41.5796 18.7944 40.4592 19.2115L16.266 28.474C14.6149 29.1149 14.6399 30.0354 15.9853 30.4524L22.1705 32.3763L36.5376 23.3865C37.2137 22.9388 37.8285 23.1865 37.3228 23.6342L25.7012 34.0694Z" fill="white"/>
                            </svg>
                            <span>Отправить в Телеграм</span>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if ($no_free) : ?>
                <?php if ( have_rows( 'list' ) ) : ?>
                    <div class="cta__list">
                        <?php while ( have_rows( 'list' ) ) : the_row();
                            $item = get_sub_field( 'item' );
                        ?>
                        <div class="cta__list_item">
                            <?=$item;?>
                        </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($show_form): ?>
                <div class="cta__form">

                    <?php if (!$with_image): ?>
                        <span>или</span>
                    <?php endif; ?>
                    <form action="" method="post" enctype="multipart/form-data" class="cta-form" id="<?= esc_attr($form_id); ?>" data-cta-instance="<?= esc_attr($unique); ?>">
                        <?php if (!$with_image): ?>
                        <div class="cta__form-field">
                            <div class="file-upload-wrapper" data-upload-block>
                                <!-- placeholder -->
                                <label class="file-upload-placeholder" for="<?= esc_attr($file_input_id); ?>" aria-label="Прикрепить файлы ТЗ">
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
                                        id="<?= esc_attr($file_input_id); ?>"
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
                        <?php endif; ?>
                       

                        <div class="cta__form-field form-field">
                            <label for="<?= esc_attr($phone_id); ?>"  class="cta-form__label">Телефон для получения ответа</label>
                            <input
                                type="tel"
                               id="<?= esc_attr($phone_id); ?>"
                                name="cta_phone"
                                class="cta-form__input modal-phone"
                                placeholder="+7 (999) 123-45-67"
                                required
                            >
                        </div>
                        <div class="cta__form-field form-field">
                            <label for="<?= esc_attr($email_id); ?>" class="cta-form__label">Электронная почта</label>
                            <input
                                type="email"
                                 id="<?= esc_attr($email_id); ?>"
                                name="cta_email"
                                class="cta-form__input"
                                placeholder="example@site.com"
                                required
                            >
                        </div>
                        <div class="cta__form-field">
                            <button type="submit" class="button btn">
                                <span><?= $with_image ? 'Запросить контакты' : 'Отправить файл'; ?></span>
                            </button>
                        </div>
                        <div class="form-field-cheack">
                            <input
                                    type="checkbox"
                                    id="<?= esc_attr($policy_id); ?>"
                                    name="cta_policy"
                                    required
                                >
                            <label for="<?= esc_attr($policy_id); ?>">
                                Принимаю <a href="<?=$politic_link;?>" target="_blank" rel="noopener">условия обработки</a> персональных данных
                            </label>
                        </div>
                        
                    </form>
                    <?php if ($with_image): ?>
                        <p>Предварительно у клиентов запрашиваем разрешение на передачу. Без него не раздаем, сохраняем конфиденциальность</p>
                    <?php else : ?>
                        <p>Заявка ни к чему не обязывает</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if ($with_image): ?>
                <div class="cta__image">
                    <?php 
                    $image = get_sub_field('img'); 
                    if ($image) {
                        echo wp_get_attachment_image($image['ID'], 'full', false, ['alt' => $image['alt'] ?: '']);
                    }
                    ?>
                </div>
            <?php endif; ?>
            <?php if (!$show_form && !$extra_content && !$no_free): ?>
                <div class="cta_button">
                    <p>Забронируйте удобное время созвона</p>
                    <button class="modal-open btn">
                        <span>Получить разбор</span>
                    </button>
                    <span>Заявка ни к чему не обязывает</span>
                </div>
            <?php endif; ?>


            <?php if ( $extra_content ): ?>
                <div class="cta__extra_content">
                    <div class="cta__extra_content-links">
                       
                        <?php if ($adress) : ?>
                            <div class="footer__content_conact footer__content_conact-adress">
                                <img src="<?=$adress_icon;?>" alt="иконка адреса">
                                <div class="footer__content_contact-text">
                                    <span ><?=$adress;?></span>
                                    <span><?=$work_time;?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($tel) : ?>
                            <div class="footer__content_conact">
                                <img src="<?=$tel_icon;?>" alt="иконка телефона">
                                <div class="footer__content_contact-text">
                                    <a href="tel:+<?=$tel;?>"><?=$tel;?></a>
                                    <a href="mailto:<?=$mail_main;?>"><?=$mail_main;?></a>
                                </div>
                                
                                <?php if ($telegram): ?>
                                    <a class="cta__links_item" href="<?= esc_url($telegram); ?>" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                                            <rect width="44" height="44" rx="22" fill="#24A1DD"/>
                                            <path d="M18.8475 24.9845L18.5167 29.6378C18.99 29.6378 19.195 29.4345 19.4409 29.1903L21.66 27.0695L26.2584 30.437C27.1017 30.907 27.6959 30.6595 27.9234 29.6612L30.9417 15.5178L30.9425 15.517C31.21 14.2703 30.4917 13.7828 29.67 14.0887L11.9284 20.8812C10.7175 21.3512 10.7359 22.0262 11.7225 22.332L16.2584 23.7428L26.7942 17.1503C27.29 16.822 27.7409 17.0037 27.37 17.332L18.8475 24.9845Z" fill="white"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                                <?php if ($whatsapp): ?>
                                    <a class="cta__links_item" href="<?= esc_url($whatsapp); ?>" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                                            <rect width="44" height="44" rx="22" fill="#25D366"/>
                                            <path d="M12 32.0001C12.215 31.2141 12.4195 30.4678 12.6232 29.7211C12.869 28.8203 13.1178 27.92 13.3561 27.0172C13.3794 26.92 13.3682 26.8178 13.3244 26.7279C12.3644 24.9849 11.947 23.1158 12.1139 21.1407C12.3531 18.3133 13.5961 15.9909 15.7912 14.1906C17.0121 13.1852 18.4645 12.5003 20.0169 12.198C24.655 11.2756 29.1161 13.6489 31.0274 17.822C31.7407 19.3818 32.0111 21.0222 31.8784 22.7247C31.5449 27.0068 28.3781 30.6515 24.185 31.5864C21.8213 32.1132 19.5603 31.8039 17.4019 30.7099C17.3056 30.6653 17.1972 30.6542 17.0939 30.6782C15.4798 31.0956 13.8674 31.518 12.255 31.94C12.1832 31.9575 12.111 31.9733 12 32.0001ZM14.3942 29.6326C14.4893 29.6096 14.5611 29.5934 14.6325 29.5746C15.509 29.3454 16.3856 29.1209 17.2621 28.8821C17.4391 28.8341 17.5731 28.8612 17.7275 28.9527C19.6379 30.0846 21.681 30.4198 23.8494 29.9319C28.4825 28.8884 31.2878 24.0049 29.8599 19.4786C28.5589 15.3556 24.4421 12.9673 20.2072 13.8855C16.7145 14.6448 13.9471 17.7034 13.7727 21.5623C13.7005 23.1575 14.0507 24.6685 14.8854 26.0334C15.1497 26.4654 15.196 26.8265 15.0411 27.2964C14.792 28.0553 14.6108 28.837 14.3942 29.6326Z" fill="white"/>
                                            <path d="M16.9396 19.6826C16.9542 18.8545 17.2777 18.1733 17.8624 17.6052C17.9474 17.5179 18.0492 17.4488 18.1617 17.4021C18.2743 17.3554 18.3951 17.332 18.5169 17.3335C18.6559 17.3335 18.7961 17.3544 18.9343 17.3406C19.2265 17.3118 19.3934 17.4554 19.4957 17.7037C19.7703 18.3615 20.0542 19.016 20.3096 19.6813C20.3559 19.802 20.3288 19.9948 20.2595 20.1071C20.0715 20.3977 19.8657 20.6765 19.6435 20.9419C19.5107 21.1063 19.4999 21.2524 19.6071 21.4327C20.4156 22.7901 21.5397 23.7772 23.0135 24.3595C23.213 24.4384 23.3758 24.4071 23.5123 24.2343C23.7577 23.9246 24.0132 23.6232 24.2527 23.3081C24.3905 23.1257 24.5516 23.0577 24.7561 23.152C25.4657 23.4859 26.1702 23.8198 26.8702 24.17C26.9437 24.2067 27.0117 24.3311 27.0146 24.4175C27.043 25.1542 26.8289 25.7711 26.1723 26.2006C25.3551 26.7349 24.4969 26.7816 23.5845 26.5254C21.2442 25.8684 19.5061 24.405 18.1108 22.4733C17.6516 21.8347 17.2284 21.1769 17.0498 20.3972C16.9938 20.1647 16.9746 19.9218 16.9396 19.6826Z" fill="white"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    

                    <?php if ($link_map):?>
                    <a href="<?=$link_map;?>" class="btn btn-white" target="_blank">Построить маршрут</a>
                    <?php endif; ?>
                </div>
                
                    
            <?php endif; ?>
            <?php if ($no_free): ?>

                <?php
                    $spec = get_sub_field('spec');    
                ?>
                <?php
                    if ( $spec) {
                        $photo      = get_field( 'photo',    $spec->ID );    
                        $name       = get_the_title( $spec );
                        $position   = get_field( 'stage', $spec->ID );
                        $experience = get_field( 'experience', $spec->ID );
                ?>
                <div class="cta__spec">
                    <?php if ( is_array( $photo ) && ! empty( $photo['url'] ) ) : ?>
                        <img
                        src="<?php echo esc_url( $photo['url'] ); ?>"
                        alt="<?php echo esc_attr( $photo['alt'] ); ?>"
                        loading="lazy"
                        >
                    <?php endif; ?>
                    <?php if ( $name ) : ?>
                        <span class="name"><?php echo esc_html( $name ); ?></span>
                    <?php endif; ?>

                    <?php if ( $position ) : ?>
                        <span class="position"><?php echo esc_html( $position ); ?></span>
                    <?php endif; ?>

                    <?php if ( $experience ) : ?>
                        <span class="experience"><?php echo esc_html( $experience ); ?></span>
                    <?php endif; ?>
                </div>
                <?php } ?>
            <?php endif; ?>

        </div>
    </div>
</section>