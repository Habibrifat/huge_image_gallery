<?php
/**
 * Plugin Name: Huge Advanced Image Gallery
 * Description: Simple Huge Advanced Image Gallery widgets for Elementor.
 * Version:     1.0.0
 * Author:      Rifat
 * Author URI:  https://developers.elementor.com/
 * Text Domain: huge_image_gallery
 * Requires Plugins: elementor
 * Elementor tested up to: 3.24.0
 * Elementor Pro tested up to: 3.24.0
 */


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
function register_huge_advanced_image_gallery_widgets($widgets_manager)
{

    require_once(__DIR__ . '/widgets/advance_image_gallery_widgets.php');

    $widgets_manager->register(new \Elementor_Advance_Image_Gallery_widgets());

}

add_action('elementor/widgets/register', 'register_huge_advanced_image_gallery_widgets');

function register_huge_advanced_image_gallery_assets() {
    // Register huge_imagesloaded.js
    wp_register_script(
        'huge_imagesloaded',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/5.0.0/imagesloaded.pkgd.min.js',
        ['jquery'], 
        '5.0.0',
        true
    );

    // Register Masonry (from CDN)
    wp_register_script(
        'huge_masonry',
        'https://unpkg.com/masonry-layout@4.2.2/dist/masonry.pkgd.min.js', 
        ['jquery', 'huge_imagesloaded'], 
        '4.2.2',
        true
    );

    wp_register_script(
        'huge_advanced_image_gallery_js',
        plugin_dir_url(__FILE__) . 'assets/js/script.js',
        ['jquery', 'huge_masonry', 'huge_imagesloaded'], 
        '1.0.0',
        true
    );

    wp_register_style(
        'huge_advanced_image_gallery_css',
        plugin_dir_url(__FILE__) . 'assets/css/style.css',
        [],
        '1.0.0'
    );
}

// Enqueue scripts and styles for frontend
add_action('wp_enqueue_scripts', 'register_huge_advanced_image_gallery_assets');

// Enqueue scripts and styles for Elementor editor
function enqueue_masonry_for_elementor_editor() {
    // Enqueue only in the Elementor editor
    if (defined('ELEMENTOR_VERSION') && is_admin()) {
        wp_enqueue_script('huge_imagesloaded');
        wp_enqueue_script('huge_masonry');
        wp_enqueue_script('huge_advanced_image_gallery_js');
        wp_enqueue_style('huge_advanced_image_gallery_css');

        // Debugging: Log script enqueuing
        error_log('Masonry scripts enqueued in Elementor editor');
    }
}

add_action('admin_enqueue_scripts', 'enqueue_masonry_for_elementor_editor');











 