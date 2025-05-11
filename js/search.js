jQuery(document).ready(function($) {
    $('#ajax-search-btn').click(function() {
        let search_term = $('#ajax-search-input').val();
        let deep_search = $(this).data('deep-search') === true;

        $.ajax({
            url: ajaxsearch.ajaxurl,
            method: 'POST',
            data: {
                action: 'wp_ajax_search',
                search_term: search_term,
                deep_search: deep_search
            },
            success: function(response) {
                let result_container = $('#ajax-search-results');
                result_container.empty();

                if (response.success) {
                    $.each(response.data, function(i, post) {
                        result_container.append(`<div><a href="${post.link}">${post.title}</a></div>`);
                    });
                } else {
                    result_container.text(response.data);
                }
            },
            error: function() {
                alert('خطایی رخ داد، مجدد تلاش کنید.');
            }
        });
    });
});
