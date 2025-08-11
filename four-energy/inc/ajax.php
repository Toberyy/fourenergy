<?php
/**
 * AJAX обработчик отправки лид-формы
 * Совместим с разметкой header/footer/cta и разными именами полей (modal_*, cta_*, lead_*).
 * Требуется локализация скрипта:
 *   wp_localize_script('lead-form-script','leadFormAjax',[
 *     'ajax_url' => admin_url('admin-ajax.php'),
 *     'nonce'    => wp_create_nonce('lead_form_nonce'),
 *   ]);
 *
 * На фронте нужно отправлять:
 *   action=submit_lead
 *   nonce=leadFormAjax.nonce
 */

add_action('wp_ajax_submit_lead',    'fe_submit_lead');
add_action('wp_ajax_nopriv_submit_lead', 'fe_submit_lead');

if ( ! function_exists('fe_submit_lead') ) :
function fe_submit_lead() {
    // 1) Проверка метода и nonce
    if ( strtoupper($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST' ) {
        wp_send_json_error(['message' => 'Неверный метод'], 405);
    }
    if ( empty($_POST['nonce']) || ! wp_verify_nonce( $_POST['nonce'], 'lead_form_nonce' ) ) {
        wp_send_json_error(['message' => 'Сессия устарела, обновите страницу.'], 403);
    }

    // 2) Нормализуем вход
    $post = wp_unslash($_POST);

    // Маппинг разных имён
    $name    = trim( (string)($post['lead_name']    ?? $post['modal_name'] ?? $post['cta_name'] ?? '') );
    $phone   = trim( (string)($post['lead_phone']   ?? $post['modal_phone'] ?? $post['cta_phone'] ?? '') );
    $email   = trim( (string)($post['lead_email']   ?? $post['modal_email'] ?? $post['cta_email'] ?? '') );
    $message = trim( (string)($post['lead_message'] ?? $post['modal_message'] ?? $post['cta_message'] ?? '') );

    // чекбокс политики (любое из имён)
    $policy  = (
        isset($post['lead_policy']) ||
        isset($post['modal_policy']) ||
        isset($post['cta_policy'])
    );

    // UTM/URL, если есть
    $utm_source   = trim( (string)($post['utm_source']   ?? '') );
    $utm_medium   = trim( (string)($post['utm_medium']   ?? '') );
    $utm_campaign = trim( (string)($post['utm_campaign'] ?? '') );
    $utm_content  = trim( (string)($post['utm_content']  ?? '') );
    $utm_term     = trim( (string)($post['utm_term']     ?? '') );
    $page_url     = trim( (string)($post['url']          ?? '') );

    // 3) Валидация
    if ( $phone === '' ) {
        wp_send_json_error(['message' => 'Укажите телефон'], 422);
    }
    if ( ! $policy ) {
        wp_send_json_error(['message' => 'Подтвердите согласие с политикой'], 422);
    }

    // 4) Заголовок и контент лида
    $title_bits = array_filter([$name, $phone]);
    $post_title = $title_bits ? implode(' — ', $title_bits) : $phone;

    $content_lines = [];
    if ($message)  $content_lines[] = "Сообщение:\n" . $message;
    if ($email)    $content_lines[] = "Email: " . $email;
    if ($page_url) $content_lines[] = "Страница: " . $page_url;
    $post_content = implode("\n\n", $content_lines);

    // 5) Создаём лид
    $lead_id = wp_insert_post([
        'post_type'   => 'lead',
        'post_status' => 'publish',
        'post_title'  => $post_title,
        'post_content'=> $post_content,
    ], true);

    if ( is_wp_error($lead_id) ) {
        wp_send_json_error(['message' => 'Не удалось создать лид'], 500);
    }

    // 6) Обработка файла: поддержка разных имён и опечатки
    $file_field_names = ['lead_file','modal_file','cta_file','mdoal_file'];
    $file_id  = 0;
    $file_url = '';

    foreach ($file_field_names as $ffn) {
        if ( ! empty($_FILES[$ffn]) && is_array($_FILES[$ffn]) && ! empty($_FILES[$ffn]['name']) ) {
            // Подключаем API загрузки
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';
            require_once ABSPATH . 'wp-admin/includes/image.php';

            // ВАЖНО: привязываем сразу к $lead_id
            $attachment_id = media_handle_upload($ffn, $lead_id);

            if ( ! is_wp_error($attachment_id) && $attachment_id ) {
                $file_id  = (int) $attachment_id;
                $file_url = wp_get_attachment_url($file_id);
            } else {
                // Фолбэк — попробуем «вручную»
                $overrides = ['test_form' => false];
                $moved = wp_handle_upload($_FILES[$ffn], $overrides);
                if ( $moved && empty($moved['error']) ) {
                    $filetype = wp_check_filetype( $moved['file'], null );
                    $attachment = [
                        'guid'           => $moved['url'],
                        'post_mime_type' => $filetype['type'],
                        'post_title'     => sanitize_file_name( basename($moved['file']) ),
                        'post_content'   => '',
                        'post_status'    => 'inherit',
                        'post_parent'    => $lead_id,
                    ];
                    $attachment_id = wp_insert_attachment($attachment, $moved['file'], $lead_id);
                    if ( ! is_wp_error($attachment_id) ) {
                        $attach_data = wp_generate_attachment_metadata($attachment_id, $moved['file']);
                        wp_update_attachment_metadata($attachment_id, $attach_data);
                        $file_id  = (int) $attachment_id;
                        $file_url = wp_get_attachment_url($file_id);
                    }
                }
            }
            break; // нашли файл — дальше не идём
        }
    }

    // 7) Сохраняем мета
    if ($name !== '')    update_post_meta($lead_id, 'lead_name',    sanitize_text_field($name));
    if ($phone !== '')   update_post_meta($lead_id, 'lead_phone',   sanitize_text_field($phone));
    if ($email !== '')   update_post_meta($lead_id, 'lead_email',   sanitize_email($email));
    if ($message !== '') update_post_meta($lead_id, 'lead_message', sanitize_textarea_field($message));

    if ($file_id)  update_post_meta($lead_id, 'file_id',  $file_id);
    if ($file_url) update_post_meta($lead_id, 'file_url', esc_url_raw($file_url));

    if ($utm_source)   update_post_meta($lead_id, 'utm_source',   sanitize_text_field($utm_source));
    if ($utm_medium)   update_post_meta($lead_id, 'utm_medium',   sanitize_text_field($utm_medium));
    if ($utm_campaign) update_post_meta($lead_id, 'utm_campaign', sanitize_text_field($utm_campaign));
    if ($utm_content)  update_post_meta($lead_id, 'utm_content',  sanitize_text_field($utm_content));
    if ($utm_term)     update_post_meta($lead_id, 'utm_term',     sanitize_text_field($utm_term));
    if ($page_url)     update_post_meta($lead_id, 'url',          esc_url_raw($page_url));

    // 8) Ответ фронту
    wp_send_json_success([
        'message'   => 'Заявка отправлена. Спасибо!',
        'lead_id'   => $lead_id,
        'file_id'   => $file_id,
        'file_url'  => $file_url,
    ]);
}
endif;
