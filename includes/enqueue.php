<?php
defined('ABSPATH') || exit;

function wp_ajax_search_scripts() {
    wp_enqueue_script(
        'wp-ajax-search',
        plugins_url('../js/search.js', __FILE__),
        ['jquery'],
        '1.1',
        true
    );

    wp_localize_script(
        'wp-ajax-search',
        'ajaxsearch',
        ['ajaxurl' => admin_url('admin-ajax.php')]
    );
}
add_action('wp_enqueue_scripts', 'wp_ajax_search_scripts');
