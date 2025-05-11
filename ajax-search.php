<?php
/**
 * Plugin Name: WP Ajax Search
 * Description: Modular Ajax-based search plugin with title-based and deep search functionalities.
 * Version: 0.8.0
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
