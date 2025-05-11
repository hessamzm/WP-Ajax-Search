<?php
/**
 * Plugin Name: WP Ajax Search
 * Description: Modular Ajax-based search plugin with title-based and deep search functionalities.
 * Version: 0.8.8
 * Requires at least: 5.6
 * Author: hessamzm
 * Author URI: https://github.com/hessamzm/wp-ajax-search
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wp-ajax-search
 * Domain Path: /languages
 * Tags: search, ajax, search-engine, search-plugin, search-results, search-form, search-box, search-form, search-results, search-form, search-box, search-results, search-form, search-box, search-results, search-form, search-box, search-results, search-form, search-box, search-results, search-form, search-box, search-results, search-form, search-box, search-results, search-form, search-box, search-results, search-form, search-box, search-results, search-form, search-box, search-results, search-form, search-box, search-results, search-form, search-box, search-results,
 */

defined('ABSPATH') || exit;

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/enqueue.php';
require_once plugin_dir_path(__FILE__) . 'includes/ajax-handler.php';
require_once plugin_dir_path(__FILE__) . 'shortcode.php';
require_once plugin_dir_path(__FILE__) . 'includes/widget.php';

// Register rewrite rules for search results page
add_action('init', 'wp_ajax_search_register_rewrite_rules');
function wp_ajax_search_register_rewrite_rules() {
    add_rewrite_rule('^ajax-search-results/?', 'index.php?ajax_search_results=1', 'top');
}

// Add query vars
add_filter('query_vars', 'wp_ajax_search_custom_query_vars');
function wp_ajax_search_custom_query_vars($vars) {
    $vars[] = 'ajax_search_results';
    $vars[] = 'search_term';
    $vars[] = 'deep_search';
    return $vars;
}

// Load custom search results template from plugin
add_action('template_include', 'wp_ajax_search_template_loader');
function wp_ajax_search_template_loader($template) {
    if (get_query_var('ajax_search_results') == 1) {
        return plugin_dir_path(__FILE__) . 'includes/search-results.php';
    }
    return $template;
}
add_action('widgets_init', function() {
    register_widget('WP_Ajax_Search_Widget');
});