<?php
/**
 * Shilpa Suraj theme.
 */

define('SS_THEME_VERSION', '1.8.2');

require get_template_directory() . '/inc/cpt.php';
require get_template_directory() . '/inc/meta-boxes.php';
require get_template_directory() . '/inc/settings.php';
require get_template_directory() . '/inc/setup.php';

function ss_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array('search-form', 'gallery', 'caption', 'style', 'script'));
    add_image_size('book-cover', 510, 638, true);
    register_nav_menus(array(
        'primary' => 'Primary Menu',
    ));
}
add_action('after_setup_theme', 'ss_setup');

function ss_assets() {
    wp_enqueue_style(
        'ss-fonts-google',
        'https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@400;500;600;700;800&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Inter:wght@400;500;600;700;800&family=Open+Sans:wght@400;700&display=swap',
        array(),
        null
    );
    wp_enqueue_style('ss-fonts', get_template_directory_uri() . '/assets/css/fonts.css', array('ss-fonts-google'), SS_THEME_VERSION);
    wp_enqueue_style('ss-style', get_stylesheet_uri(), array('ss-fonts'), SS_THEME_VERSION);
    wp_enqueue_style('ss-divi', get_template_directory_uri() . '/assets/css/divi-core.css', array('ss-style'), SS_THEME_VERSION);
    wp_enqueue_style('ss-original', get_template_directory_uri() . '/assets/css/extracted.css', array('ss-divi'), SS_THEME_VERSION);
    wp_enqueue_style('ss-layout', get_template_directory_uri() . '/assets/css/layout.css', array('ss-original'), SS_THEME_VERSION);
    wp_enqueue_script('ss-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), SS_THEME_VERSION, true);
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'ss_assets');

function ss_body_class($classes) {
    $classes[] = 'et_vertical_nav';
    $classes[] = 'et_vertical_fixed';
    $classes[] = 'et_show_nav';
    $classes[] = 'et_divi_theme';
    $classes[] = 'et_header_style_left';
    $classes[] = 'et_cover_background';
    $classes[] = 'et_no_sidebar';
    $classes[] = 'et_pb_gutters3';
    $classes[] = 'et_pb_pagebuilder_layout';
    $classes[] = 'et_button_no_icon';
    $classes[] = 'et_pb_button_helper_class';
    $classes[] = 'divi-hacks-mobile-reverse';
    $classes[] = 'et-db';
    if (is_page('the-author')) {
        $classes[] = 'page-the-author';
        $classes[] = 'page-template-page-the-author';
    }
    if (is_page('updates')) {
        $classes[] = 'page-updates';
        $classes[] = 'page-template-page-updates';
    }
    return $classes;
}
add_filter('body_class', 'ss_body_class');

function ss_fix_nav_urls($items) {
    $books = get_post_type_archive_link('book');
    if (!$books) {
        $books = home_url('/books/');
    }
    foreach ($items as $item) {
        if (strcasecmp($item->title, 'Books') === 0 || strpos($item->url, 'local-wp') !== false || strpos($item->url, '8080com') !== false) {
            $item->url = $books;
        }
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'ss_fix_nav_urls');

function ss_option($key, $default = '') {
    $options = get_option('ss_site_settings', array());
    return isset($options[$key]) && $options[$key] !== '' ? $options[$key] : $default;
}

function ss_url($path) {
    if (!$path) {
        return '';
    }
    if (preg_match('#^https?://#i', $path) || strpos($path, '//') === 0) {
        return $path;
    }
    return home_url($path);
}

function ss_book_cover($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $image   = get_the_post_thumbnail_url($post_id, 'book-cover');
    if ($image) {
        return $image;
    }
    return ss_url(get_post_meta($post_id, '_book_cover_url', true));
}

function ss_fallback_menu() {
    $about   = get_page_by_path('the-author');
    $updates = get_page_by_path('updates');
    $blog    = get_page_by_path('blog');
    echo '<ul id="top-menu" class="nav">';
    echo '<li><a href="' . esc_url(home_url('/books/')) . '">BOOKS</a></li>';
    echo '<li><a href="' . esc_url($about ? get_permalink($about) : home_url('/the-author/')) . '">THE AUTHOR</a></li>';
    echo '<li><a href="' . esc_url($updates ? get_permalink($updates) : home_url('/updates/')) . '">UPDATES</a></li>';
    echo '<li><a href="' . esc_url($blog ? get_permalink($blog) : home_url('/blog/')) . '">BLOG</a></li>';
    echo '<li><a href="' . esc_url(ss_option('newsletter_url', 'http://eepurl.com/dt-Br9')) . '">NEWSLETTER</a></li>';
    echo '<li class="menu-item-has-children"><a>CONTACT</a><ul class="sub-menu">';
    echo '<li><a href="' . esc_url(ss_option('instagram', 'https://www.instagram.com/shilpa.suraj/')) . '">Connect On Instagram</a></li>';
    echo '<li><a href="mailto:' . esc_attr(ss_option('email', 'shilpa@shilpasuraj.com')) . '">Email Me</a></li>';
    echo '</ul></li></ul>';
}

function ss_rating_links($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $gr      = get_post_meta($post_id, '_book_goodreads', true);
    $amz     = get_post_meta($post_id, '_book_amazon', true);
    $gr_r    = get_post_meta($post_id, '_book_goodreads_rating', true);
    $amz_r   = get_post_meta($post_id, '_book_amazon_rating', true);
    if (!$gr && !$amz) {
        return;
    }
    echo '<p><strong>';
    if ($gr) {
        echo '<a href="' . esc_url($gr) . '" style="text-decoration: underline;color:#632a15;" target="_blank" rel="noopener">Goodreads</a>';
    }
    if ($gr && $amz) {
        echo ' <span style="color: #554e46;">|</span> ';
    }
    if ($amz) {
        echo '<a href="' . esc_url($amz) . '" style="text-decoration: underline;color:#632a15;" target="_blank" rel="noopener">Amazon</a>';
    }
    echo '</strong></p>';
}

function ss_read_more($url, $label = 'Read More') {
    echo '<a class="et_pb_button et_pb_button_0" href="' . esc_url($url) . '" style="background-color:inherit !important; border-radius: 20px; font-size: 13px; box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;font-family: \'Inter\', sans-serif;border: 0.5px solid black !important;padding: 10px 20px !important;"><span style="color: black;">' . esc_html($label) . '</span></a>';
}

function ss_learn_more($url, $label = 'Learn more') {
    echo '<div class="et_pb_button_module_wrapper"><a class="et_pb_button et_pb_button_0 learn-more-btn" href="' . esc_url($url) . '">' . esc_html($label) . '</a></div>';
}

function ss_post_image($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $image   = get_the_post_thumbnail_url($post_id, 'large');
    if ($image) {
        return $image;
    }
    return ss_url(get_post_meta($post_id, '_thumbnail_url', true));
}

add_filter('the_content', 'ss_fix_content_urls');
function ss_fix_content_urls($content) {
    return str_replace('src="/wp-content/', 'src="' . home_url('/wp-content/'), $content);
}

function ss_blog_query($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_home()) {
        $query->set('posts_per_page', 20);
    }
}
add_action('pre_get_posts', 'ss_blog_query');

function ss_featured_books() {
    return new WP_Query(array(
        'post_type'      => 'book',
        'posts_per_page' => 12,
        'meta_key'       => '_book_featured',
        'meta_value'     => '1',
        'orderby'        => 'menu_order date',
        'order'          => 'ASC',
    ));
}

