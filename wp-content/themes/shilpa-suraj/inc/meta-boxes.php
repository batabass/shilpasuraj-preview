<?php

function ss_book_meta_boxes() {
    add_meta_box(
        'ss_book_details',
        'Book details',
        'ss_book_details_html',
        'book',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ss_book_meta_boxes');

function ss_book_details_html($post) {
    wp_nonce_field('ss_save_book', 'ss_book_nonce');
    $subtitle = get_post_meta($post->ID, '_book_subtitle', true);
    $amazon   = get_post_meta($post->ID, '_book_amazon', true);
    $gr       = get_post_meta($post->ID, '_book_goodreads', true);
    $amz_r    = get_post_meta($post->ID, '_book_amazon_rating', true);
    $gr_r     = get_post_meta($post->ID, '_book_goodreads_rating', true);
    $cover    = get_post_meta($post->ID, '_book_cover_url', true);
    $featured = get_post_meta($post->ID, '_book_featured', true);
    ?>
    <p>Use the <strong>Featured image</strong> box on the right for the cover. Title and blurb go in the fields above.</p>
    <p>
        <label>Subtitle / genre<br>
            <input type="text" name="ss_book_subtitle" value="<?php echo esc_attr($subtitle); ?>" class="widefat" placeholder="Romantic Suspense">
        </label>
    </p>
    <p>
        <label>Amazon link<br>
            <input type="url" name="ss_book_amazon" value="<?php echo esc_attr($amazon); ?>" class="widefat">
        </label>
    </p>
    <p>
        <label>Goodreads link<br>
            <input type="url" name="ss_book_goodreads" value="<?php echo esc_attr($gr); ?>" class="widefat">
        </label>
    </p>
    <p>
        <label>Amazon rating</label>
        <input type="text" name="ss_book_amazon_rating" value="<?php echo esc_attr($amz_r); ?>" placeholder="4.5/5">
        &nbsp;
        <label>Goodreads rating</label>
        <input type="text" name="ss_book_goodreads_rating" value="<?php echo esc_attr($gr_r); ?>" placeholder="4.3/5">
    </p>
    <p>
        <label>Cover image URL <em>(only if you are not using Featured image)</em><br>
            <input type="url" name="ss_book_cover_url" value="<?php echo esc_attr($cover); ?>" class="widefat">
        </label>
    </p>
    <p>
        <label>
            <input type="checkbox" name="ss_book_featured" value="1" <?php checked($featured, '1'); ?>>
            Show on homepage (Must Reads)
        </label>
    </p>
    <?php
}

function ss_save_book_meta($post_id) {
    if (!isset($_POST['ss_book_nonce']) || !wp_verify_nonce($_POST['ss_book_nonce'], 'ss_save_book')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        '_book_subtitle'         => 'ss_book_subtitle',
        '_book_amazon'           => 'ss_book_amazon',
        '_book_goodreads'        => 'ss_book_goodreads',
        '_book_amazon_rating'    => 'ss_book_amazon_rating',
        '_book_goodreads_rating' => 'ss_book_goodreads_rating',
        '_book_cover_url'        => 'ss_book_cover_url',
    );

    foreach ($fields as $meta => $field) {
        $value = isset($_POST[$field]) ? sanitize_text_field(wp_unslash($_POST[$field])) : '';
        if (in_array($meta, array('_book_amazon', '_book_goodreads', '_book_cover_url'), true)) {
            $value = esc_url_raw(wp_unslash($_POST[$field] ?? ''));
        }
        update_post_meta($post_id, $meta, $value);
    }

    update_post_meta($post_id, '_book_featured', isset($_POST['ss_book_featured']) ? '1' : '');
}
add_action('save_post_book', 'ss_save_book_meta');
