<?php
/**
 * vab functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package vab
 */

if ( ! defined( 'VAB_VERSION' ) ) {
    define( 'VAB_VERSION', '0.1.0' );
}

if ( ! defined( 'VAB_TYPOGRAPHY_CLASSES' ) ) {
    define(
        'VAB_TYPOGRAPHY_CLASSES',
        'prose prose-neutral max-w-none prose-a:text-primary'
    );
}

function vab_setup() {
    load_theme_textdomain( 'vab', get_template_directory() . '/languages' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'responsive-embeds' );
    add_editor_style( 'style-editor.css' );
    add_editor_style( 'style-editor-extra.css' );

    register_nav_menus(
        array(
            'menu-1' => __( 'Primary', 'vab' ),
            'menu-2' => __( 'Footer Menu', 'vab' ),
        )
    );
}
add_action( 'after_setup_theme', 'vab_setup' );

function vab_widgets_init() {
    register_sidebar(
        array(
            'name'          => __( 'Footer', 'vab' ),
            'id'            => 'sidebar-1',
            'description'   => __( 'Add widgets here to appear in your footer.', 'vab' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'vab_widgets_init' );

function vab_enqueue_scripts() {
    // Enqueue main stylesheet
    $style_path = get_template_directory() . '/style.css';
    wp_enqueue_style( 'vab-style', get_stylesheet_uri(), [], file_exists( $style_path ) ? filemtime( $style_path ) : null );

    // Enqueue main script
    $script_path = get_template_directory() . '/js/script.min.js';
    wp_enqueue_script( 'vab-script', get_theme_file_uri( '/js/script.min.js' ), [], file_exists( $script_path ) ? filemtime( $script_path ) : null, true );

    // Enqueue block editor styles
    $editor_style_path = get_template_directory() . '/style-editor.css';
    wp_enqueue_style( 'vab-style-editor', get_theme_file_uri( '/style-editor.css' ), [], file_exists( $editor_style_path ) ? filemtime( $editor_style_path ) : null );

    $editor_extra_style_path = get_template_directory() . '/style-editor-extra.css';
    wp_enqueue_style( 'vab-style-editor-extra', get_theme_file_uri( '/style-editor-extra.css' ), [], file_exists( $editor_extra_style_path ) ? filemtime( $editor_extra_style_path ) : null );

    // Enqueue block editor scripts
    $block_editor_path = get_template_directory() . '/js/block-editor.min.js';
    wp_enqueue_script(
        'vab-block-editor',
        get_theme_file_uri( '/js/block-editor.min.js' ),
        [ 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ],
        file_exists( $block_editor_path ) ? filemtime( $block_editor_path ) : null,
        true
    );

    // Enqueue hero block script
    $hero_block_path = get_template_directory() . '/js/hero.min.js';
    wp_enqueue_script(
        'vab-hero-block',
        get_theme_file_uri( '/js/hero.min.js' ),
        [ 'wp-blocks', 'wp-i18n', 'wp-block-editor', 'wp-components' ],
        file_exists( $hero_block_path ) ? filemtime( $hero_block_path ) : VAB_VERSION,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'vab_enqueue_scripts' );
add_action( 'enqueue_block_editor_assets', 'vab_enqueue_scripts' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function vab_tinymce_add_class( $settings ) {
    $settings['body_class'] = VAB_TYPOGRAPHY_CLASSES;
    return $settings;
}
add_filter( 'tiny_mce_before_init', 'vab_tinymce_add_class' );

/**
 * Limit the block editor to heading levels supported by Tailwind Typography.
 *
 * @param array  $args Array of arguments for registering a block type.
 * @param string $block_type Block type name including namespace.
 * @return array
 */
function vab_modify_heading_levels( $args, $block_type ) {
    if ( 'core/heading' !== $block_type ) {
        return $args;
    }

    // Remove <h1>, <h5> and <h6>.
    $args['attributes']['levelOptions']['default'] = array( 2, 3, 4 );

    return $args;
}
add_filter( 'register_block_type_args', 'vab_modify_heading_levels', 10, 2 );

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/blocks.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/tw-navwalker.php';