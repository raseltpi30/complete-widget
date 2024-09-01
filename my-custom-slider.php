<?php
/**
 * Plugin Name: Dynamic Carousel Widget
 * Description: A custom Elementor widget for a dynamic carousel.
 * Version: 1.0
 * Author: Your Name
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Register the widget
function register_dynamic_carousel_widget( $widgets_manager ) {
    require_once( __DIR__ . '/widgets/slider-widget.php' );
    $widgets_manager->register( new \Elementor\Slider_Widget() );
}
add_action( 'elementor/widgets/register', 'register_dynamic_carousel_widget' );

// Enqueue scripts and styles
function dynamic_carousel_enqueue_scripts() {
    wp_enqueue_style( 'dynamic-carousel-style', plugins_url( 'assets/style.css', __FILE__ ) );
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'dynamic-carousel-script', plugins_url( 'assets/script.js', __FILE__ ), array( 'jquery' ), null, true );

}
add_action( 'wp_enqueue_scripts', 'dynamic_carousel_enqueue_scripts' );
