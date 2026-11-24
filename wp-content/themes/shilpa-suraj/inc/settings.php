<?php

function ss_register_settings() {
    register_setting('ss_site_settings_group', 'ss_site_settings', array(
        'sanitize_callback' => 'ss_sanitize_settings',
    ));
}
add_action('admin_init', 'ss_register_settings');

function ss_sanitize_settings($input) {
    $clean = array();
    $keys  = array(
        'hero_title', 'hero_subtitle', 'hero_image', 'author_note', 'about_heading',
        'about_text', 'about_image', 'newsletter_url', 'instagram',
        'goodreads', 'twitter', 'email', 'update_1', 'update_2', 'update_3', 'update_4',
    );
    $url_keys = array('newsletter_url', 'instagram', 'goodreads', 'twitter', 'hero_image', 'about_image', 'update_1', 'update_2', 'update_3', 'update_4');
    foreach ($keys as $key) {
        $raw = isset($input[$key]) ? $input[$key] : '';
        if (in_array($key, $url_keys, true)) {
            $clean[$key] = $raw === '' ? '' : esc_url_raw($raw);
        } elseif ($key === 'author_note' || $key === 'about_text') {
            $clean[$key] = wp_kses_post($raw);
        } else {
            $clean[$key] = sanitize_text_field($raw);
        }
    }
    return $clean;
}

function ss_settings_menu() {
    add_menu_page(
        'Homepage & site',
        'Homepage & site',
        'edit_pages',
        'ss-site-settings',
        'ss_settings_page',
        'dashicons-admin-home',
        3
    );
}
add_action('admin_menu', 'ss_settings_menu');

function ss_admin_assets($hook) {
    if ($hook !== 'toplevel_page_ss-site-settings') {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script(
        'ss-admin',
        get_template_directory_uri() . '/assets/js/admin.js',
        array('jquery'),
        SS_THEME_VERSION,
        true
    );
}
add_action('admin_enqueue_scripts', 'ss_admin_assets');

function ss_image_field($name, $value, $label) {
    $value = esc_attr($value);
    echo '<tr><th>' . esc_html($label) . '</th><td>';
    echo '<div class="ss-image-field">';
    if ($value) {
        echo '<p><img src="' . esc_url($value) . '" alt="" style="max-width:180px;height:auto;display:block;margin-bottom:8px;"></p>';
    }
    echo '<input type="text" class="large-text ss-image-url" name="ss_site_settings[' . esc_attr($name) . ']" value="' . $value . '"> ';
    echo '<button type="button" class="button ss-upload">Upload image</button>';
    echo '</div></td></tr>';
}

function ss_settings_page() {
    if (!current_user_can('edit_pages')) {
        return;
    }
    $o = get_option('ss_site_settings', array());
    $get = function ($key, $default = '') use ($o) {
        return isset($o[$key]) && $o[$key] !== '' ? $o[$key] : $default;
    };
    ?>
    <div class="wrap">
        <h1>Homepage & site</h1>
        <p>Change the landing page here. Use <strong>Upload image</strong> to pick a photo. Books and blogs are in the left menu.</p>
        <form method="post" action="options.php">
            <?php settings_fields('ss_site_settings_group'); ?>
            <table class="form-table" role="presentation">
                <tr>
                    <th>Hero title</th>
                    <td><input class="regular-text" name="ss_site_settings[hero_title]" value="<?php echo esc_attr($get('hero_title', 'SHILPA SURAJ')); ?>"></td>
                </tr>
                <tr>
                    <th>Hero subtitle</th>
                    <td><input class="regular-text" name="ss_site_settings[hero_subtitle]" value="<?php echo esc_attr($get('hero_subtitle', 'AUTHOR')); ?>"></td>
                </tr>
                <?php ss_image_field('hero_image', $get('hero_image', '/wp-content/uploads/2022/12/shilpa1.jpeg'), 'Hero photo'); ?>
                <tr>
                    <th>Author's note</th>
                    <td><textarea class="large-text" rows="3" name="ss_site_settings[author_note]"><?php echo esc_textarea($get('author_note')); ?></textarea></td>
                </tr>
                <tr>
                    <th>About heading</th>
                    <td><input class="regular-text" name="ss_site_settings[about_heading]" value="<?php echo esc_attr($get('about_heading', 'Shilpa Suraj')); ?>"></td>
                </tr>
                <tr>
                    <th>About text</th>
                    <td><textarea class="large-text" rows="6" name="ss_site_settings[about_text]"><?php echo esc_textarea($get('about_text')); ?></textarea></td>
                </tr>
                <?php ss_image_field('about_image', $get('about_image'), 'About photo'); ?>
                <?php ss_image_field('update_1', $get('update_1'), 'Latest update 1'); ?>
                <?php ss_image_field('update_2', $get('update_2'), 'Latest update 2'); ?>
                <?php ss_image_field('update_3', $get('update_3'), 'Latest update 3'); ?>
                <?php ss_image_field('update_4', $get('update_4'), 'Latest update 4'); ?>
                <tr>
                    <th>Newsletter URL</th>
                    <td><input class="large-text" name="ss_site_settings[newsletter_url]" value="<?php echo esc_attr($get('newsletter_url', 'http://eepurl.com/dt-Br9')); ?>"></td>
                </tr>
                <tr>
                    <th>Instagram</th>
                    <td><input class="large-text" name="ss_site_settings[instagram]" value="<?php echo esc_attr($get('instagram')); ?>"></td>
                </tr>
                <tr>
                    <th>Goodreads</th>
                    <td><input class="large-text" name="ss_site_settings[goodreads]" value="<?php echo esc_attr($get('goodreads')); ?>"></td>
                </tr>
                <tr>
                    <th>X / Twitter</th>
                    <td><input class="large-text" name="ss_site_settings[twitter]" value="<?php echo esc_attr($get('twitter')); ?>"></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input class="regular-text" name="ss_site_settings[email]" value="<?php echo esc_attr($get('email', 'shilpa@shilpasuraj.com')); ?>"></td>
                </tr>
            </table>
            <?php submit_button('Save changes'); ?>
        </form>
    </div>
    <?php
}
