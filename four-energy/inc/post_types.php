<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



function register_reviews_cpt() {
    $labels = array(
        'name'                  => _x( 'Отзывы', 'Post Type General Name', 'test' ),
        'singular_name'         => _x( 'Отзыв', 'Post Type Singular Name', 'test' ),
        'menu_name'             => __( 'Отзывы', 'test' ),
        'name_admin_bar'        => __( 'Отзыв', 'test' ),
        'add_new'               => __( 'Добавить отзыв', 'test' ),
        'add_new_item'          => __( 'Добавить новый отзыв', 'test' ),
        'edit_item'             => __( 'Редактировать отзыв', 'test' ),
        'new_item'              => __( 'Новый отзыв', 'test' ),
        'view_item'             => __( 'Просмотреть отзыв', 'test' ),
        'all_items'             => __( 'Все отзывы', 'test' ),
        'search_items'          => __( 'Искать отзывы', 'test' ),
        'not_found'             => __( 'Отзывы не найдены', 'test' ),
        'not_found_in_trash'    => __( 'В корзине нет отзывов', 'test' ),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => false,    // не публичный
        'publicly_queryable' => false,    // нет публичного запроса
        'show_ui'            => true,     // отображается в админке
        'show_in_menu'       => true,
        'capability_type'    => 'post',
        'has_archive'        => false,    // без архива
        'rewrite'            => false,    // без URL пере­писи
        'supports'           => array( 'title', 'editor' ),
        'show_in_rest'       => false,     // для Gutenberg
    );
    register_post_type( 'review', $args );
}
add_action( 'init', 'register_reviews_cpt' );


function register_specialist_cpt() {
    $labels = array(
        'name'                  => _x( 'Специалисты', 'Post Type General Name', 'textdomain' ),
        'singular_name'         => _x( 'Специалист', 'Post Type Singular Name', 'textdomain' ),
        'menu_name'             => __( 'Специалисты', 'textdomain' ),
        'name_admin_bar'        => __( 'Специалист', 'textdomain' ),
        'add_new'               => __( 'Добавить специалиста', 'textdomain' ),
        'add_new_item'          => __( 'Добавить нового специалиста', 'textdomain' ),
        'edit_item'             => __( 'Редактировать специалиста', 'textdomain' ),
        'new_item'              => __( 'Новый специалист', 'textdomain' ),
        'view_item'             => __( 'Просмотреть специалиста', 'textdomain' ),
        'all_items'             => __( 'Все специалисты', 'textdomain' ),
        'search_items'          => __( 'Искать специалистов', 'textdomain' ),
        'not_found'             => __( 'Специалисты не найдены', 'textdomain' ),
        'not_found_in_trash'    => __( 'В корзине нет специалистов', 'textdomain' ),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'rewrite'            => false,
        'supports'           => array( 'title', 'editor', 'thumbnail' ), // можно добавить нужные
        'show_in_rest'       => false,
    );
    register_post_type( 'specialist', $args );
}
add_action( 'init', 'register_specialist_cpt' );


function register_faq_cpt() {
    $labels = array(
        'name'                  => _x( 'Вопросы и ответы', 'Post Type General Name', 'test' ),
        'singular_name'         => _x( 'Вопрос и ответ', 'Post Type Singular Name', 'test' ),
        'menu_name'             => __( 'FAQ', 'test' ),
        'name_admin_bar'        => __( 'Вопрос и ответ', 'test' ),
        'add_new'               => __( 'Добавить Вопрос/Ответ', 'test' ),
        'add_new_item'          => __( 'Добавить новый Вопрос/Ответ', 'test' ),
        'edit_item'             => __( 'Редактировать Вопрос/Ответ', 'test' ),
        'new_item'              => __( 'Новый Вопрос/Ответ', 'test' ),
        'view_item'             => __( 'Просмотреть Вопрос/Ответ', 'test' ),
        'all_items'             => __( 'Все Вопросы и ответы', 'test' ),
        'search_items'          => __( 'Искать Вопросы и ответы', 'test' ),
        'not_found'             => __( 'Не найдено', 'test' ),
        'not_found_in_trash'    => __( 'В корзине нет', 'test' ),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'rewrite'            => false,
        'supports'           => array( 'title', 'editor' ),
        'show_in_rest'       => false,
    );
    register_post_type( 'faq', $args );
}
add_action( 'init', 'register_faq_cpt' );




add_action( 'init', function(){
    register_post_type( 'lead', [
        'labels'             => [
            'name'          => 'Заявки',
            'singular_name' => 'Заявка',
        ],
        'public'             => false,
        'has_archive'        => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'supports'           => [ 'title' ],
        'capability_type'    => 'post',
    ] );
} );


function register_project_cpt_internal() {
    $labels = array(
        'name'                  => _x( 'Проекты', 'Post Type General Name', 'textdomain' ),
        'singular_name'         => _x( 'Проект', 'Post Type Singular Name', 'textdomain' ),
        'menu_name'             => __( 'Проекты', 'textdomain' ),
        'name_admin_bar'        => __( 'Проект', 'textdomain' ),
        'add_new'               => __( 'Добавить проект', 'textdomain' ),
        'add_new_item'          => __( 'Добавить новый проект', 'textdomain' ),
        'edit_item'             => __( 'Редактировать проект', 'textdomain' ),
        'new_item'              => __( 'Новый проект', 'textdomain' ),
        'view_item'             => __( 'Просмотреть проект', 'textdomain' ),
        'all_items'             => __( 'Все проекты', 'textdomain' ),
        'search_items'          => __( 'Искать проекты', 'textdomain' ),
        'not_found'             => __( 'Проекты не найдены', 'textdomain' ),
        'not_found_in_trash'    => __( 'В корзине нет проектов', 'textdomain' ),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => false, 
        'publicly_queryable' => false,
        'show_ui'            => true,  
        'show_in_menu'       => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'rewrite'            => false,
        'supports'           => array( 'title'),
        'show_in_rest'       => false,
        'menu_icon'          => 'dashicons-portfolio',
    );
    register_post_type( 'project', $args );
}
add_action( 'init', 'register_project_cpt_internal' );
