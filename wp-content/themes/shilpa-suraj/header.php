<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php
$ss_about   = get_page_by_path('the-author');
$ss_updates = get_page_by_path('updates');
$ss_blog    = get_page_by_path('blog');
$ss_books   = get_post_type_archive_link('book') ?: home_url('/books/');
$ss_about_u = $ss_about ? get_permalink($ss_about) : home_url('/the-author/');
$ss_upd_u   = $ss_updates ? get_permalink($ss_updates) : home_url('/updates/');
$ss_blog_u  = get_permalink(get_option('page_for_posts')) ?: ($ss_blog ? get_permalink($ss_blog) : home_url('/blog/'));
$ss_news    = ss_option('newsletter_url', 'http://eepurl.com/dt-Br9');
$ss_ig      = ss_option('instagram', 'https://www.instagram.com/shilpa.suraj/');
$ss_email   = ss_option('email', 'shilpa@shilpasuraj.com');
?>
<div id="page-container">
    <header id="main-header" data-height-onload="66">
        <div class="container clearfix et_menu_container">
            <div class="logo_container">
                <span class="logo_helper"></span>
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo esc_url(ss_url('/wp-content/uploads/2022/12/logg.png')); ?>" id="logo" alt="<?php bloginfo('name'); ?>" />
                </a>
            </div>
            <div id="et-top-navigation" data-height="66" data-fixed-height="59">
                <nav id="top-menu-nav">
                    <ul id="top-menu" class="nav">
                        <li class="<?php echo is_post_type_archive('book') || is_singular('book') ? 'current-menu-item' : ''; ?>">
                            <a href="<?php echo esc_url($ss_books); ?>" style="font-weight: bolder;">BOOKS</a>
                        </li>
                        <li class="<?php echo is_page('the-author') ? 'current-menu-item' : ''; ?>">
                            <a href="<?php echo esc_url($ss_about_u); ?>" style="font-weight: bolder;">THE AUTHOR</a>
                        </li>
                        <li class="<?php echo is_page('updates') ? 'current-menu-item' : ''; ?>">
                            <a href="<?php echo esc_url($ss_upd_u); ?>" style="font-weight: bolder;">UPDATES</a>
                        </li>
                        <li class="<?php echo is_home() || is_singular('post') ? 'current-menu-item' : ''; ?>">
                            <a href="<?php echo esc_url($ss_blog_u); ?>" style="font-weight: bolder;">BLOG</a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url($ss_news); ?>" style="font-weight: bolder;" target="_blank" rel="noopener">NEWSLETTER</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a style="font-weight: bolder;">CONTACT</a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo esc_url($ss_ig); ?>">Connect On Instagram</a></li>
                                <li><a href="mailto:<?php echo esc_attr($ss_email); ?>">Email Me</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div id="et_mobile_nav_menu">
                    <div class="mobile_nav closed">
                        <span class="select_page">Select a page</span>
                        <span class="mobile_menu_bar mobile_menu_bar_toggle"></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="et-main-area">
        <div id="main-content">
