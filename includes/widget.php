<?php
class WP_Ajax_Search_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'wp_ajax_search_widget',
            __('WP Ajax Search', 'wp-ajax-search'),
            ['description' => __('فرم جستجوی Ajax برای ابزارک‌ها', 'wp-ajax-search')]
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];

        // مقادیر تنظیم‌شده در ابزارک
        $placeholder = !empty($instance['placeholder']) ? $instance['placeholder'] : 'جستجو...';
        $button_text = !empty($instance['button_text']) ? $instance['button_text'] : 'جستجو';
        $deep_search = !empty($instance['deep_search']) && $instance['deep_search'] === 'true' ? 'true' : 'false';

        ?>
        <div class="hessamsearch-container" style="margin: 0;">
            <form class="hessamsearch-form" method="get" action="<?php echo esc_url(home_url('/ajax-search-results/')); ?>" style="display: flex; flex-direction: column; gap: 5px;">
                <input type="text" name="search_term" class="hessamsearch-input" placeholder="<?php echo esc_attr($placeholder); ?>" required autocomplete="off" style="width: 100%; padding: 6px; font-size: 14px;">
                <input type="hidden" name="deep_search" value="<?php echo esc_attr($deep_search); ?>">
                <button type="submit" class="hessamsearch-btn" style="font-size: 14px; padding: 6px;"><?php echo esc_html($button_text); ?></button>
            </form>
        </div>
        <?php

        echo $args['after_widget'];
    }

    public function form($instance) {
        $placeholder = !empty($instance['placeholder']) ? $instance['placeholder'] : 'جستجو...';
        $button_text = !empty($instance['button_text']) ? $instance['button_text'] : 'جستجو';
        $deep_search = !empty($instance['deep_search']) ? $instance['deep_search'] : 'false';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('placeholder'); ?>">متن داخل فیلد:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('placeholder'); ?>" name="<?php echo $this->get_field_name('placeholder'); ?>" type="text" value="<?php echo esc_attr($placeholder); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('button_text'); ?>">متن دکمه:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo esc_attr($button_text); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('deep_search'); ?>">نوع جست‌وجو:</label>
            <select class="widefat" id="<?php echo $this->get_field_id('deep_search'); ?>" name="<?php echo $this->get_field_name('deep_search'); ?>">
                <option value="false" <?php selected($deep_search, 'false'); ?>>جست‌وجوی معمولی (فقط عنوان)</option>
                <option value="true" <?php selected($deep_search, 'true'); ?>>جست‌وجوی عمیق (تمام محتوا)</option>
            </select>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        return [
            'placeholder' => sanitize_text_field($new_instance['placeholder']),
            'button_text' => sanitize_text_field($new_instance['button_text']),
            'deep_search' => $new_instance['deep_search'] === 'true' ? 'true' : 'false',
        ];
    }
}