<?php

function ss_theme_activate() {
    ss_register_books();
    flush_rewrite_rules();
    ss_create_pages();
    ss_seed_defaults();
    ss_seed_books();
    ss_seed_blogs();
    ss_seed_series_copy();
    ss_refresh_about_page();
    update_option('ss_content_version', '4');
}
add_action('after_switch_theme', 'ss_theme_activate');

function ss_maybe_seed() {
    if (get_option('ss_content_version') === '4') {
        return;
    }
    ss_register_books();
    ss_create_pages();
    ss_seed_defaults();
    ss_seed_books();
    ss_seed_blogs();
    ss_seed_series_copy();
    ss_refresh_about_page();
    $settings = get_option('ss_site_settings', array());
    if (!is_array($settings)) {
        $settings = array();
    }
    $settings['update_1'] = '/wp-content/uploads/2022/12/Latest Updates/The Promise of a traitor.jpeg';
    $settings['update_2'] = '/wp-content/uploads/2022/12/Latest Updates/The Scars of a Saint.jpeg';
    $settings['update_3'] = '/wp-content/uploads/2022/12/Latest Updates/The Heart of a storm.jpg';
    $settings['update_4'] = "/wp-content/uploads/2022/12/Latest Updates/Kabir's geet.jpeg";
    $settings['update_5'] = '/wp-content/uploads/2022/12/Latest Updates/Flames of Fate.jpg';
    $settings['update_6'] = '/wp-content/uploads/2022/12/Latest Updates/Wrath of War.jpg';
    $settings['update_7'] = '/wp-content/uploads/2022/12/Latest Updates/Death of Destiny.jpg';
    $settings['hero_subtitle'] = 'Author';
    update_option('ss_site_settings', $settings);
    update_option('ss_content_version', '4');
}
add_action('init', 'ss_maybe_seed');

function ss_data($file) {
    $path = get_template_directory() . '/inc/data/' . $file;
    if (!file_exists($path)) {
        return array();
    }
    $json = json_decode(file_get_contents($path), true);
    return is_array($json) ? $json : array();
}

function ss_find_by_title($title, $type) {
    $found = get_posts(array(
        'post_type'      => $type,
        'title'          => $title,
        'posts_per_page' => 1,
        'post_status'    => 'any',
    ));
    return $found ? $found[0] : null;
}

function ss_about_html() {
    return <<<HTML
<div style="background-color: rgb(244, 243, 243); background-image: url('/wp-content/uploads/2022/12/whiteback.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center; padding: 20px;">
    <h1 style="font-size: 40px; text-align: center; padding: 30px; font-weight: bold; font-family: 'Inter', sans-serif;">A Hermione Granger type Student</h1>
    <div class="content">
        <img src="/wp-content/uploads/2022/12/hermoine.jpeg" alt="Shilpa Suraj" style="width: 100%; max-width: 500px; height: auto; padding: 10px; display: block; margin: 0 auto;">
        <p style="width: 100%; max-width: 500px; margin: 20px auto; text-align: center; padding: 10px; font-size: 1em; font-family: 'Inter', sans-serif;">A dreamer, an introvert, a bookworm, and a storyteller—Shilpa Suraj wears many hats with ease. With Hermione Granger-level smarts and sadly, Ron Weasley's sporting acumen, she finds her true "happy place" at her desk, weaving stories out of thin air. Whether it's spinning heartfelt tales or dragging her characters through deliciously angsty chaos—simply because she can—Shilpa lives for the magic of storytelling.</p>
    </div>
</div>
<br>
<div style="background-color: rgb(244, 243, 243); background-image: url('/wp-content/uploads/2022/12/MothBack.avif'); background-size: cover; background-repeat: no-repeat; background-position: center; padding: 20px;">
    <br>
    <h1 style="font-size: 40px; text-align: center; padding: 10px; font-weight: bold; color: black; font-family: 'Inter', sans-serif;">Frazzled mother,<br> Goody Two Shoes daughter</h1>
    <div class="content">
        <p style="width: 100%; max-width: 600px; margin: 10px auto; text-align: center; padding: 10px; font-size: 1.1em; color: black; font-family: 'Inter', sans-serif;">A frazzled mother to a fabulous daughter and a goody-two-shoes daughter to her own parents, with friends that are family, Shilpa keeps her circle small but close. Small or not, her circle always has room for her loyal readers.</p>
        <img src="/wp-content/uploads/2022/12/ShilpaZoe.png" alt="Shilpa and family" style="width: 100%; max-width: 350px; height: auto; padding: 10px; display: block; margin: 0 auto;">
    </div>
</div>
<br>
<div style="background-color: rgb(244, 243, 243);">
    <div class="content2">
        <img src="/wp-content/uploads/2022/12/Pantster.jpg" alt="The Pantser Writer" style="width: 100%; max-width: 300px; height: auto; margin-bottom: 20px;">
        <div style="display: block; text-align: center;">
            <h1 id="pantser-title" style="font-size: 40px; text-align: center; padding: 20px; font-weight: bold; font-family: 'Inter', sans-serif;">The Pantser Writer</h1>
            <p style="width: 100%; max-width: 500px; margin: 0 auto; text-align: center; padding: 20px; font-size: 1em; font-family: 'Inter', sans-serif;">Shilpa was a year and a half when she was first introduced to the world of books. Her mother would park her with a picture book on the floor of the kitchen while she finished her cooking for the day. While it’s no longer the kitchen floor, you can still find her tucked away in a cosy nook somewhere with her nose buried in a book. While books in all genres interest her, it was romance that captured her heart. While racing through every romantic fiction book she could beg, borrow or buy, her overactive imagination started to work overtime and weave its own stories. Years in the corporate world followed by a stint of entrepreneurship crystallised her belief that all she really wanted to do was give life to the stories bubbling inside of her.</p>
        </div>
    </div>
</div>
HTML;
}

function ss_refresh_about_page() {
    $about = get_page_by_path('the-author');
    if ($about) {
        wp_update_post(array(
            'ID'           => $about->ID,
            'post_content' => ss_about_html(),
        ));
    }
}

function ss_seed_series_copy() {
    $copy = array(
        'Dynasty Rebels' => 'In a high-stakes world of politics, media, and real estate, three influential families and their ambitious heirs clash on multiple fronts, where love veiled in betrayal and desire masked as dislike ignites a fierce battle for dominance. Will they ever find their way to true love, or will they sacrifice their happiness at the altar of their family’s enmity?',
        'IL Cuore' => 'Five friends head out for a night of drunken revelry with catastrophic consequences. A devastating car crash leaves one friend dead and four other lives shattered in its wake. Scarred, broken, and scared, they must find their path again...Will love pave the way?',
        'Shades of Night' => 'When drama, desire, and duty collide, the Shades of Night are born. A trilogy of lust, love, and loyalty, Shades of Night is darkly dramatic and delicious.',
        'In Disgrace' => 'When you fall from grace, your true self comes to the surface. For it is in disgrace that strength is unearthed and grit is sharpened...',
        'The Kapoor Brothers' => 'Three brothers, the unlikely women they fall in love with, and their roller coaster romances that set their worlds on fire.',
        'IL Cuore Heirs Series' => '',
        'Karma Series' => '',
    );
    foreach ($copy as $name => $description) {
        $term = get_term_by('name', $name, 'series');
        if ($term && !is_wp_error($term)) {
            wp_update_term($term->term_id, 'series', array('description' => $description));
        }
    }
}

function ss_create_pages() {
    $about = ss_about_html();

    $pages = array(
        'home'    => array('title' => 'Home', 'slug' => 'home', 'content' => ''),
        'about'   => array('title' => 'The Author', 'slug' => 'the-author', 'content' => $about),
        'updates' => array('title' => 'Updates', 'slug' => 'updates', 'content' => '<p>Add news and release updates here.</p>'),
        'blog'    => array('title' => 'Blog', 'slug' => 'blog', 'content' => ''),
    );

    $created = array();
    foreach ($pages as $key => $page) {
        $existing = get_page_by_path($page['slug']);
        if ($existing) {
            $created[$key] = $existing->ID;
            continue;
        }
        $created[$key] = wp_insert_post(array(
            'post_title'   => $page['title'],
            'post_name'    => $page['slug'],
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => $page['content'],
        ));
    }

    if (!empty($created['home']) && !empty($created['blog'])) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $created['home']);
        update_option('page_for_posts', $created['blog']);
    }

    $menu_name = 'Primary';
    $menu      = wp_get_nav_menu_object($menu_name);
    if ($menu) {
        return;
    }
    $menu_id = wp_create_nav_menu($menu_name);
    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title'  => 'Books',
        'menu-item-url'    => get_post_type_archive_link('book') ?: home_url('/books/'),
        'menu-item-status' => 'publish',
    ));
    foreach (array('about' => 'The Author', 'updates' => 'Updates', 'blog' => 'Blog') as $key => $label) {
        if (empty($created[$key])) {
            continue;
        }
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'     => $label,
            'menu-item-object'    => 'page',
            'menu-item-object-id' => $created[$key],
            'menu-item-type'      => 'post_type',
            'menu-item-status'    => 'publish',
        ));
    }
    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title'  => 'Newsletter',
        'menu-item-url'    => 'http://eepurl.com/dt-Br9',
        'menu-item-status' => 'publish',
    ));
    $contact = wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title'  => 'Contact',
        'menu-item-url'    => '#',
        'menu-item-status' => 'publish',
    ));
    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title'     => 'Connect On Instagram',
        'menu-item-url'       => 'https://www.instagram.com/shilpa.suraj/',
        'menu-item-status'    => 'publish',
        'menu-item-parent-id' => $contact,
    ));
    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title'     => 'Email Me',
        'menu-item-url'       => 'mailto:shilpa@shilpasuraj.com',
        'menu-item-status'    => 'publish',
        'menu-item-parent-id' => $contact,
    ));
    $locations            = get_theme_mod('nav_menu_locations', array());
    $locations['primary'] = $menu_id;
    set_theme_mod('nav_menu_locations', $locations);
}

function ss_seed_defaults() {
    $defaults = array(
        'hero_title'     => 'SHILPA SURAJ',
        'hero_subtitle'  => 'AUTHOR',
        'hero_image'     => '/wp-content/uploads/2022/12/shilpa1.jpeg',
        'author_note'    => 'To spread joy with every turn of a page is both a privilege and an honour.',
        'about_heading'  => 'Shilpa Suraj',
        'about_text'     => "A published hybrid author, Shilpa Suraj’s books have consistently hit the bestseller lists on Amazon.\n\nOver the years, she has been published by Harlequin India, Mills & Boon, Juggernaut, Rupa Publications, Storytel and Om Publications amongst others.\nShe was also part of the Flipped Anthology by Harper Collins and had an audiobook, Insta Reddy, release with Storytel.\n\nHer Young Adult novel ‘Hey Kitty’ released on September 2024 with Om Publications.\nShe has also had several blockbuster romance releases on Amazon, The Dynasty Rebel series, being the largest success of them all.",
        'about_image'    => '/wp-content/uploads/2022/12/DSC00568.jpg',
        'newsletter_url' => 'http://eepurl.com/dt-Br9',
        'instagram'      => 'https://www.instagram.com/shilpa.suraj/',
        'goodreads'      => 'https://www.goodreads.com/author/show/8436864.Shilpa_Suraj',
        'twitter'        => 'https://x.com/shilpaauthor',
        'email'          => 'shilpa@shilpasuraj.com',
        'update_1'       => '/wp-content/uploads/2022/12/Latest Updates/The Heart of a storm.jpg',
        'update_2'       => '/wp-content/uploads/2022/12/Latest Updates/Flames of Fate.jpg',
        'update_3'       => '/wp-content/uploads/2022/12/Latest Updates/Wrath of War.jpg',
        'update_4'       => '/wp-content/uploads/2022/12/Latest Updates/Death of Destiny.jpg',
    );
    $current = get_option('ss_site_settings', array());
    if (!is_array($current)) {
        $current = array();
    }
    update_option('ss_site_settings', array_merge($defaults, $current));
}

function ss_seed_books() {
    $order = 0;
    foreach (ss_data('books.json') as $book) {
        $existing = ss_find_by_title($book['title'], 'book');
        if ($existing) {
            $id = $existing->ID;
            wp_update_post(array(
                'ID'           => $id,
                'menu_order'   => $order++,
                'post_content' => $book['content'] ?? $existing->post_content,
            ));
        } else {
            $id = wp_insert_post(array(
                'post_title'   => $book['title'],
                'post_status'  => 'publish',
                'post_type'    => 'book',
                'post_content' => $book['content'] ?? '',
                'menu_order'   => $order++,
            ));
        }
        if (!$id || is_wp_error($id)) {
            continue;
        }
        if (!empty($book['series'])) {
            wp_set_object_terms($id, $book['series'], 'series');
        }
        update_post_meta($id, '_book_subtitle', $book['subtitle'] ?? '');
        update_post_meta($id, '_book_amazon', $book['amazon'] ?? '');
        update_post_meta($id, '_book_goodreads', $book['goodreads'] ?? '');
        update_post_meta($id, '_book_amazon_rating', $book['amazon_rating'] ?? '');
        update_post_meta($id, '_book_goodreads_rating', $book['goodreads_rating'] ?? '');
        update_post_meta($id, '_book_cover_url', $book['cover'] ?? '');
        update_post_meta($id, '_book_featured', $book['featured'] ?? '');
        update_post_meta($id, '_book_is_series', !empty($book['is_series_page']) ? '1' : '');
    }
}

function ss_seed_blogs() {
    $date = strtotime('2024-01-15');
    foreach (ss_data('blogs.json') as $post) {
        if (ss_find_by_title($post['title'], 'post')) {
            continue;
        }
        $id = wp_insert_post(array(
            'post_title'   => $post['title'],
            'post_status'  => 'publish',
            'post_type'    => 'post',
            'post_content' => $post['content'] ?? '',
            'post_date'    => date('Y-m-d H:i:s', $date),
        ));
        $date += DAY_IN_SECONDS * 20;
        if (is_wp_error($id) || empty($post['image'])) {
            continue;
        }
        update_post_meta($id, '_thumbnail_url', $post['image']);
    }
}
