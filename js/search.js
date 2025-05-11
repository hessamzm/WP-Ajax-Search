jQuery(document).ready(function($) {
    $(document).on('submit', '.ajax-search-form', function(e) {
        e.preventDefault();

        let container = $(this).closest('.wp-ajax-search-container');
        let search_term = container.find('.ajax-search-input').val();
        let deep_search = $(document.activeElement).val(); // توجه به مقدار دکمه

        $.ajax({
            url: ajaxsearch.ajaxurl,
            method: 'POST',
            data: {
                action: 'wp_ajax_search',
                search_term: search_term,
                deep_search: deep_search
            },
            success: function(response) {
                if (response.success) {
                    window.location.href = container.find('.ajax-search-form').attr('action') + '?search_term=' + encodeURIComponent(search_term) + '&deep_search=' + deep_search;
                } else {
                    alert('نتیجه‌ای یافت نشد.');
                }
            },
            error: function() {
                alert('خطا در جستجو.');
            }
        });
    });
});
jQuery(document).ready(function($) {
    $(document).on('input', '.hessamsearch-input', function() {
        let btns = $(this).closest('.hessamsearch-form').find('.hessamsearch-buttons');
        if ($(this).val().trim().length > 0) {
            btns.fadeIn();
        } else {
            btns.fadeOut();
        }
    });
});
jQuery(document).ready(function($) {
    $(document).on('submit', '.hessamsearch-form', function(e) {
        let input = $(this).find('.hessamsearch-input');
        let search_term = input.val().trim();

        if (search_term.length === 0) {
            e.preventDefault();
            alert('لطفاً یک عبارت برای جست‌وجو وارد کنید.');
            return false;
        }

        // دکمه درست کلیک‌شده رو دریافت کن
        let deep_search = $(document.activeElement).val();

        // اجازه بده فرم طبق action به صفحه بره
        return true;
    });
});
