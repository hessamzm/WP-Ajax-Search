<?php

defined('ABSPATH') || exit;

function wp_ajax_search_handler() {
    $search_term = sanitize_text_field($_POST['search_term']);
    $deep_search = isset($_POST['deep_search']) && $_POST['deep_search'] === 'true';

    $args = [
        'post_type' => 'post',
        's' => $search_term,
        'posts_per_page' => 10,
    ];

    if (!$deep_search) {
        $args['search_columns'] = ['post_title'];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $results = [];
        while ($query->have_posts()) {
            $query->the_post();
            $results[] = [
                'title' => get_the_title(),
                'link'  => get_permalink(),
            ];
        }
        wp_reset_postdata();
        wp_send_json_success($results);
    } else {
        wp_send_json_error('No results found.');
    }
}
add_action('wp_ajax_nopriv_wp_ajax_search', 'wp_ajax_search_handler');
add_action('wp_ajax_wp_ajax_search', 'wp_ajax_search_handler');
