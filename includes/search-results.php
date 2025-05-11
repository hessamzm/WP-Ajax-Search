<?php
/**
 * Custom Ajax Search Results Template
 */

defined( 'ABSPATH' ) || exit;

get_header();

$search_term = trim(get_query_var('search_term', ''));
$deep_search = get_query_var('deep_search', 'false');

// اگر سرچ خالی بود، پیام نشان بده و خروج
if ( $search_term === '' ) {
    echo '<p class="no-results-msg">لطفاً ابتدا عبارتی برای جست‌وجو وارد کنید.</p>';
    get_sidebar();
    get_footer();
    exit;
}
?>

<div <?php tie_content_column_attr(); ?>>

    <div class="hessamsearch-container" style="margin-bottom: 30px;">
        <form class="hessamsearch-form" method="get" action="<?php echo esc_url(home_url('/ajax-search-results/')); ?>">
            <input type="text" name="search_term" class="hessamsearch-input" placeholder="عبارت جستجو..." value="<?php echo esc_attr($search_term); ?>" required autocomplete="off">
            <div class="hessamsearch-buttons" style="display: block; margin-top: 10px;">
                <button type="submit" name="deep_search" value="false" class="hessamsearch-btn">جستجو</button>
                <button type="submit" name="deep_search" value="true" class="hessamsearch-btn">جستجوی عمیق‌تر</button>
            </div>
        </form>
    </div>

    <?php
    $args = [
        'post_type' => 'post',
        's'         => sanitize_text_field($search_term),
        'posts_per_page' => -1,
    ];

    if ( $deep_search !== 'true' ) {
        $args['search_columns'] = ['post_title'];
    }

    $ajax_search_query = new WP_Query($args);
    ?>

    <?php if ( $ajax_search_query->have_posts() ) : ?>

        <header id="search-title-section" class="entry-header-outer container-wrapper archive-title-wrapper">

            <?php do_action( 'TieLabs/before_archive_title' ); ?>

            <h1 class="page-title">
                <?php printf( esc_html__( 'Search Results for: %s', TIELABS_TEXTDOMAIN ), '<span>' . esc_html( $search_term ) . '</span>' ); ?>
            </h1>

            <?php do_action( 'TieLabs/after_archive_title' ); ?>

        </header><!-- .entry-header-outer -->

        <?php
        global $wp_query;
        $original_query = $wp_query;
        $wp_query = $ajax_search_query;

        TIELABS_HELPER::get_template_part( 'templates/archives', '', array(
            'layout'          => tie_get_option( 'search_layout', 'excerpt' ),
            'excerpt'         => tie_get_option( 'search_excerpt' ),
            'excerpt_length'  => tie_get_option( 'search_excerpt_length' ),
            'read_more'       => tie_get_option( 'search_read_more' ),
            'read_more_text'  => tie_get_option( 'search_read_more_text' ),
        ));

        TIELABS_PAGINATION::show( array( 'type' => tie_get_option( 'search_pagination' ) ) );

        $wp_query = $original_query;
        wp_reset_postdata();

    else :

        TIELABS_HELPER::get_template_part( 'templates/not-found' );

    endif;
    ?>

</div><!-- .main-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
