<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Salir si se accede directamente
}

function simple_search_shortcode() {
    // HTML del formulario de búsqueda
    $search_form = '
    <form role="search" method="get" class="simple-search-form" action="' . home_url( '/' ) . '">
        <label>
            <span class="screen-reader-text">Buscar por:</span>
            <input type="search" class="simple-search-field" placeholder="Buscar..." value="' . get_search_query() . '" name="s" title="Buscar:" />
        </label>
        <button type="submit" class="simple-search-submit">Buscar</button>
    </form>';

    return $search_form;
}

// Registrar el shortcode
add_shortcode('simple_search', 'simple_search_shortcode');
?>
