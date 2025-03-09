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


function register_huge_advanced_image_gallery_assets($widgets_manager)
{

    wp_register_style('huge_advanced_image_gallery_css', plugin_dir_url(__FILE__) . 'assets/css/style.css');
    wp_enqueue_style('huge_advanced_image_gallery_css');
    wp_register_script('huge_advanced_image_gallery_js', plugin_dir_url(__FILE__) . 'assets/js/script.js');
    wp_enqueue_script('huge_advanced_image_gallery_js');
    

}

add_action('elementor/widgets/register', 'register_huge_advanced_image_gallery_assets');








