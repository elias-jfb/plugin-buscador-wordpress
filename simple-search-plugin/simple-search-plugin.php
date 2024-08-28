<?php
/*
Plugin Name: Simple Search Plugin
Description: Un plugin sencillo de buscador hecho en HTML y CSS.
Version: 1.0
Author: Tu Nombre
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Salir si se accede directamente
}

// Incluir el archivo del shortcode
require_once plugin_dir_path( __FILE__ ) . 'includes/shortcode.php';

// Encolar el estilo CSS
function simple_search_enqueue_styles() {
    wp_enqueue_style('simple-search-styles', plugin_dir_url(__FILE__) . 'assets/css/simple-search.css');
}
add_action('wp_enqueue_scripts', 'simple_search_enqueue_styles');
?>
