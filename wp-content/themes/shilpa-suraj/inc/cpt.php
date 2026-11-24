<?php

function ss_register_books() {
    register_post_type('book', array(
        'labels' => array(
            'name'               => 'Books',
            'singular_name'      => 'Book',
            'add_new'            => 'Add Book',
            'add_new_item'       => 'Add New Book',
            'edit_item'          => 'Edit Book',
            'new_item'           => 'New Book',
            'view_item'          => 'View Book',
            'search_items'       => 'Search Books',
            'not_found'          => 'No books found',
            'all_items'          => 'All Books',
        ),
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'books'),
        'menu_icon'    => 'dashicons-book-alt',
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'show_in_rest' => true,
        'capability_type' => 'post',
    ));

    register_taxonomy('series', 'book', array(
        'labels' => array(
            'name'          => 'Series',
            'singular_name' => 'Series',
            'add_new_item'  => 'Add New Series',
        ),
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => array('slug' => 'series'),
        'show_in_rest' => true,
        'show_admin_column' => true,
    ));
}
add_action('init', 'ss_register_books');
