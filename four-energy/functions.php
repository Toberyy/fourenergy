<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

 $theme_version = '1.0.16';

function add_custom_body_class( $classes ) {
    // Add class site-main
    $classes[] = 'site-main';
    return $classes;
}
add_filter( 'body_class', 'add_custom_body_class' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */

 foreach (glob(TEMPLATEPATH . "/inc/*.php") as $filename){
    include $filename;
}

 add_action('acf/init', function() {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title'    => 'Опции сайта',
            'menu_title'    => 'Опции сайта',
            'menu_slug'     => 'site-options',
            'capability'    => 'manage_options',
            'redirect'      => false
        ));
    }
});
function fourenergy_setup() {


	register_nav_menus( array( 'primary-menu' => __( 'Шапка', 'fourenergy' ) ) );
	register_nav_menus( array( 'footer-menu-one' => __( 'Подвал слева', 'fourenergy' ) ) );
	register_nav_menus( array( 'footer-menu-two' => __( 'Подвал справа', 'fourenergy' ) ) );

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 133,
			'width'       => 130,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
}
add_action( 'after_setup_theme', 'fourenergy_setup' );




/**
 * Enqueue scripts and styles.
 */
function fourenergy_scripts() {

	global $theme_version;
	$template_uri = get_template_directory_uri();

	wp_enqueue_script( 'jquery' );

	wp_enqueue_style(
		'theme-base',
		$template_uri . '/style.css',
		[],
		$theme_version
	);

	
	if( is_404() ){
		wp_enqueue_style( '404', $template_uri . '/assets/css/404.css', [], $theme_version );
	}

	$app_js_uri = '/assets/js/main.js';
	$app_js_time = filemtime(TEMPLATEPATH . $app_js_uri);
	wp_enqueue_script(
		'theme-script',
		$template_uri . $app_js_uri,
		['jquery'],
		$app_js_time,
		true
	);

    wp_enqueue_style( 'fonts-style', get_template_directory_uri() . '/assets/fonts/fonts.css', array(), $theme_version );
    wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css', [], '10.0.0' );
    wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', [], '10.0.0', true );

    wp_enqueue_style(
		'fancybox-css',
		'https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0/dist/fancybox/fancybox.css',
		[],
		'3.5.7'
	);
	wp_enqueue_script(
		'fancybox-js', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0/dist/fancybox/fancybox.umd.js'	);


	wp_enqueue_style( 'global-style', get_template_directory_uri() . '/assets/css/global.css', array(), $theme_version );
	wp_enqueue_script( 'fourenergy-main', get_template_directory_uri() . '/assets/js/main.js', array(), $theme_version, true );

	wp_enqueue_script( 'fourenergy-navigation', get_template_directory_uri() . '/js/navigation.js', array(), $theme_version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


	wp_enqueue_script(
        'lead-form-script',
        get_template_directory_uri() . '/assets/js/lead-form.js',
        ['jquery'],
        null,
        true
    );
    wp_localize_script('lead-form-script','leadFormAjax',[
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('lead_form_nonce'),
      ]);
	
}
add_action( 'wp_enqueue_scripts', 'fourenergy_scripts' );



add_action( 'add_meta_boxes', function() {
    add_meta_box(
        'lead_details',            // ID метабокса
        'Детали заявки',           // Заголовок
        'render_lead_meta_box',    // Колбек для вывода полей
        'lead',                    // CPT
        'normal',                  // Контекст
        'default'                  // Приоритет
    );
} );

// 2) Колбек: выводим поля
function render_lead_meta_box( WP_Post $post ) {
    // Безопасность
    wp_nonce_field( 'save_lead_meta', 'lead_meta_nonce' );

    // Достаем ранее сохранённые значения
    $name       = get_post_meta( $post->ID, 'lead_name',    true );
    $phone      = get_post_meta( $post->ID, 'lead_phone',   true );
    $message    = get_post_meta( $post->ID, 'lead_message', true );

    // Новые мета-поля
    $file_url   = get_post_meta( $post->ID, 'file_url',     true );
    $file_id    = get_post_meta( $post->ID, 'file_id',      true );
    ?>

    <p>
      <label for="lead-name"><strong>Имя:</strong></label><br>
      <input type="text"
             name="lead_name"
             id="lead-name"
             value="<?php echo esc_attr( $name ); ?>"
             class="widefat">
    </p>

    <p>
      <label for="lead-phone"><strong>Телефон:</strong></label><br>
      <input type="tel"
             name="lead_phone"
             id="lead-phone"
             value="<?php echo esc_attr( $phone ); ?>"
             class="widefat">
    </p>

    <p>
      <label for="lead-message"><strong>Сообщение:</strong></label><br>
      <textarea name="lead_message"
                id="lead-message"
                rows="4"
                class="widefat"><?php echo esc_textarea( $message ); ?></textarea>
    </p>

    <?php $file_url = get_post_meta( $post->ID, 'file_url', true );
if ( $file_url ) : ?>
  <p>
    <strong>Файл ТЗ:</strong><br>
    <a href="<?php echo esc_url( $file_url ); ?>" target="_blank">
      <?php echo basename( $file_url ); ?>
    </a>
  </p>
<?php endif; ?>

    <?php if ( $file_id ) : ?>
    <p>
      <strong>Attachment ID в медиатеке:</strong>
      <?php echo intval( $file_id ); ?>
    </p>
    <?php endif; ?>

    <?php
}

// 3) Сохраняем данные при сохранении поста
add_action( 'save_post_lead', function( $post_id ) {
    // Проверяем nonce
    if ( empty( $_POST['lead_meta_nonce'] ) ||
         ! wp_verify_nonce( $_POST['lead_meta_nonce'], 'save_lead_meta' )
    ) {
        return;
    }

    // Не при автосохранении
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return;
    }

    // Права
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Сохраняем
    if ( isset( $_POST['lead_name'] ) ) {
        update_post_meta( $post_id, 'lead_name', sanitize_text_field( $_POST['lead_name'] ) );
    }
    if ( isset( $_POST['lead_phone'] ) ) {
        update_post_meta( $post_id, 'lead_phone', sanitize_text_field( $_POST['lead_phone'] ) );
    }
    if ( isset( $_POST['lead_message'] ) ) {
        update_post_meta( $post_id, 'lead_message', sanitize_textarea_field( $_POST['lead_message'] ) );
    }
} );



/**
 * Выводит хлебные крошки
 */
function theme_breadcrumbs() {
    // Не на главной странице
    if ( is_front_page() ) {
        return;
    }

    echo '<nav class="breadcrumb" aria-label="breadcrumb">';
    // Ссылка на главную
    echo '<a href="' . esc_url( home_url('/') ) . '">' . esc_html__( 'Главная', 'fourenergy' ) . '</a>';

    // Разделитель
    echo '<svg class="breadcrumb__sep" xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" fill="none"><path d="M2.96973 6.63999L5.14306 4.46665C5.39973 4.20999 5.39973 3.78999 5.14306 3.53332L2.96973 1.35999" stroke="#ADB0B9" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg>';

    if ( is_singular('post') ) {
        // запись блога
        $cat = get_the_category(); 
        if ( $cat ) {
            // выберем первую категорию
            $cat = $cat[0];
            // и её цепочку родителей
            $ancestors = array_reverse( get_ancestors( $cat->term_id, 'category' ) );
            foreach ( $ancestors as $ancestor_id ) {
                $term = get_term( $ancestor_id, 'category' );
                echo '<a href="' . esc_url( get_category_link($term) ) . '">' . esc_html( $term->name ) . '</a>';
                echo '<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" fill="none">
<path d="M2.96973 6.63999L5.14306 4.46665C5.39973 4.20999 5.39973 3.78999 5.14306 3.53332L2.96973 1.35999" stroke="#ADB0B9" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg>';
            }
            // сама категория
            echo '<a href="' . esc_url( get_category_link($cat) ) . '">' . esc_html( $cat->name ) . '</a>';
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" fill="none">
<path d="M2.96973 6.63999L5.14306 4.46665C5.39973 4.20999 5.39973 3.78999 5.14306 3.53332L2.96973 1.35999" stroke="#ADB0B9" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg>';
        }
        // сам пост
        echo '<span>' . get_the_title() . '</span>';

    } elseif ( is_page() ) {
        // вложенные страницы
        global $post;
        if ( $post->post_parent ) {
            $anc = array_reverse( get_post_ancestors( $post->ID ) );
            foreach ( $anc as $parent_id ) {
                echo '<a href="' . esc_url( get_permalink($parent_id) ) . '">' . esc_html( get_the_title($parent_id) ) . '</a>';
                echo '<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" fill="none">
<path d="M2.96973 6.63999L5.14306 4.46665C5.39973 4.20999 5.39973 3.78999 5.14306 3.53332L2.96973 1.35999" stroke="#ADB0B9" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg>';
            }
        }
        // текущая страница
        echo '<span>' . get_the_title() . '</span>';

    } elseif ( is_category() || is_tax() ) {
        // архив рубрики или таксономии
        $term = get_queried_object();
        if ( $term->parent ) {
            $ancestors = array_reverse( get_ancestors( $term->term_id, $term->taxonomy ) );
            foreach ( $ancestors as $ancestor_id ) {
                $ancestor = get_term( $ancestor_id, $term->taxonomy );
                echo '<a href="' . esc_url( get_term_link($ancestor) ) . '">' . esc_html( $ancestor->name ) . '</a>';
                echo '<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8" fill="none">
<path d="M2.96973 6.63999L5.14306 4.46665C5.39973 4.20999 5.39973 3.78999 5.14306 3.53332L2.96973 1.35999" stroke="#ADB0B9" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg>';
            }
        }
        echo '<span>' . esc_html( $term->name ) . '</span>';

    } elseif ( is_search() ) {
        echo '<span>' . sprintf( esc_html__( 'Результаты поиска по запросу: %s', 'fourenergy' ), get_search_query() ) . '</span>';

    } elseif ( is_404() ) {
        echo '<span>' . esc_html__( 'страница не найдена', 'fourenergy' ) . '</span>';

    } else {
        // все остальные архивы (датные, авторы и т.д.)
        echo '<span>' . wp_kses_post( get_the_archive_title() ) . '</span>';
    }

    echo '</nav>';
}


function disable_all_gutenberg() {
    // Отключает Gutenberg для любых постов
    add_filter( 'use_block_editor_for_post', '__return_false', 10 );
    // Отключает Gutenberg для любых таксономий (страницы, произв. типы и пр.)
    add_filter( 'use_block_editor_for_post_type', '__return_false', 10 );
    // Убираем поддержку паттернов (по желанию)
    remove_theme_support( 'core-block-patterns' );
}
add_action( 'init', 'disable_all_gutenberg', 1 );