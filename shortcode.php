<?php
defined('ABSPATH') || exit;

function wp_ajax_search_shortcode($atts) {
    $atts = shortcode_atts([
        'placeholder' => 'جستجو...',
        'button_text' => 'جستجو',
        'deep_button_text' => 'جستجوی عمیق‌تر',
    ], $atts);

    ob_start(); ?>
    
    <div class="hessamsearch-container">
        <form class="hessamsearch-form" method="get" action="<?php echo esc_url(home_url('/ajax-search-results/')); ?>">
            <input type="text" name="search_term" class="hessamsearch-input" placeholder="<?php echo esc_attr($atts['placeholder']); ?>" autocomplete="off">
            <div class="hessamsearch-buttons" style="display: none;">
                <button type="submit" name="deep_search" value="false" class="hessamsearch-btn"><?php echo esc_html($atts['button_text']); ?></button>
                <button type="submit" name="deep_search" value="true" class="hessamsearch-btn"><?php echo esc_html($atts['deep_button_text']); ?></button>
            </div>
        </form>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('wp_ajax_search', 'wp_ajax_search_shortcode');
