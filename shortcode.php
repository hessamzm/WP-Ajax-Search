<?php

defined('ABSPATH') || exit;

// Register shortcode [wp_ajax_search]
function wp_ajax_search_shortcode($atts) {
    $atts = shortcode_atts([
        'deep_search' => 'false',
        'placeholder' => 'جستجو...',
        'button_text' => 'جستجو',
        'deep_button_text' => 'جستجوی عمیق‌تر',
    ], $atts);

    ob_start();
    ?>

    <div class="wp-ajax-search-container">
        <input type="text" id="ajax-search-input" placeholder="<?php echo esc_attr($atts['placeholder']); ?>">
        <button class="ajax-search-btn" data-deep-search="false"><?php echo esc_html($atts['button_text']); ?></button>
        <button class="ajax-search-btn" data-deep-search="true"><?php echo esc_html($atts['deep_button_text']); ?></button>
        <div id="ajax-search-results"></div>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('wp_ajax_search', 'wp_ajax_search_shortcode');
