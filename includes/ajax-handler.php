<?php
defined('ABSPATH') || exit;

function wp_ajax_search_handler() {
    $search_term = sanitize_text_field($_POST['search_term']);
    $deep_search = isset($_POST['deep_search']) && $_POST['deep_search'] === 'true';

    $args = [
        'post_type' => 'post',
        'posts_per_page' => 10,
    ];

    if (!empty($search_term)) {
        $args['s'] = $search_term;
    }

    if (!$deep_search) {
        add_filter('posts_search', 'search_titles_only', 500, 2);
    }

    $query = new WP_Query($args);

    remove_filter('posts_search', 'search_titles_only', 500);

    if ($query->have_posts()) {
        $results = [];
        while ($query->have_posts()) {
            $query->the_post();
            $results[] = [
                'title' => get_the_title(),
                'link' => get_permalink(),
            ];
        }
        wp_reset_postdata();
        wp_send_json_success($results);
    } else {
        wp_send_json_error('No results found.');
    }
}

function search_titles_only($search, $wp_query) {
    global $wpdb;

    if (empty($search)) return $search;

    $q = $wp_query->query_vars;
    $n = !empty($q['exact']) ? '' : '%';

    $search = $searchand = '';

    foreach ((array)$q['search_terms'] as $term) {
        $term = esc_sql($wpdb->esc_like($term));
        $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
        $searchand = ' AND ';
    }

    if (!empty($search)) {
        $search = " AND ({$search}) ";
        if (!is_user_logged_in())
            $search .= " AND ($wpdb->posts.post_password = '') ";
    }

    return $search;
}

add_action('wp_ajax_nopriv_wp_ajax_search', 'wp_ajax_search_handler');
add_action('wp_ajax_wp_ajax_search', 'wp_ajax_search_handler');