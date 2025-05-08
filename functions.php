<?php


function blogpress_enqueue_scripts() {
    wp_enqueue_style('blogpress-style', get_stylesheet_uri());
    wp_enqueue_script('blogpress-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'blogpress_enqueue_scripts');


function blogpress_setup() {
    // Support for featured images
    add_theme_support('post-thumbnails');

    // Custom navigation menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'blogpress'),
    ));

    // HTML5 support for search forms, comment forms, etc.
    add_theme_support('html5', array('search-form', 'comment-form', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'blogpress_setup');


function blogpress_customize_register($wp_customize) {
    // Adding a new section for theme options
    $wp_customize->add_section('blogpress_color_scheme', array(
        'title'    => __('Color Scheme', 'blogpress'),
        'priority' => 30,
    ));

    // Add a setting for the background color
    $wp_customize->add_setting('background_color_setting', array(
        'default'   => '#ffffff',
        'transport' => 'refresh',
    ));

    // Add a control to select a background color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'background_color_control', array(
        'label'    => __('Background Color', 'blogpress'),
        'section'  => 'blogpress_color_scheme',
        'settings' => 'background_color_setting',
    )));
}
add_action('customize_register', 'blogpress_customize_register');