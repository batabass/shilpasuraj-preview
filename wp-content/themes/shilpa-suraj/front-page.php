<?php get_header(); ?>

<?php
$hero = ss_option('hero_image');
if (!$hero) {
    $hero = get_the_post_thumbnail_url(get_option('page_on_front'), 'full');
}
if (!$hero) {
    $hero = ss_url('/wp-content/uploads/2022/12/shilpa1.jpeg');
} else {
    $hero = ss_url($hero);
}
$updates = array_filter(array(
    ss_option('update_1', '/wp-content/uploads/2022/12/Latest Updates/The Promise of a traitor.jpeg'),
    ss_option('update_2', '/wp-content/uploads/2022/12/Latest Updates/The Scars of a Saint.jpeg'),
    ss_option('update_3', '/wp-content/uploads/2022/12/Latest Updates/The Heart of a storm.jpg'),
    ss_option('update_4', "/wp-content/uploads/2022/12/Latest Updates/Kabir's geet.jpeg"),
    ss_option('update_5', '/wp-content/uploads/2022/12/Latest Updates/Flames of Fate.jpg'),
    ss_option('update_6', '/wp-content/uploads/2022/12/Latest Updates/Wrath of War.jpg'),
    ss_option('update_7', '/wp-content/uploads/2022/12/Latest Updates/Death of Destiny.jpg'),
));
$hero_title = ss_option('hero_title', 'Shilpa Suraj');
$hero_lines = preg_split('/\s+/', trim($hero_title));
if (count($hero_lines) < 2) {
    $hero_lines = array('Shilpa', 'Suraj');
}
$about_page = get_page_by_path('the-author');
$about_link = $about_page ? get_permalink($about_page) : home_url('/the-author/');
$about_bg   = ss_url('/wp-content/uploads/2022/12/bookback.avif');
?>

<article class="post-208697 page type-page status-publish has-post-thumbnail hentry">
    <div class="entry-content">
        <div class="et-l et-l--post">
            <div class="et_builder_inner_content et_pb_gutters3">
                <div class="et_pb_section et_pb_section_0 et_pb_with_background et_section_regular" style="background-image: url('<?php echo esc_url($hero); ?>');">
                    <div class="et_pb_row et_pb_row_0">
                        <div class="et_pb_column et_pb_column_2_3 et_pb_column_0">
                            <div class="et_pb_module et_pb_text et_pb_text_0 et_pb_text_align_left et_pb_bg_layout_light">
                                <div class="et_pb_text_inner">
                                    <h1>Shilpa<br> Suraj</h1>
                                </div>
                            </div>
                            <div class="et_pb_module et_pb_text et_pb_text_1 et_pb_text_align_left et_pb_bg_layout_light">
                                <div class="et_pb_text_inner">
                                    <p class="ss-hero-author"><?php echo esc_html(ss_option('hero_subtitle', 'Author')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="et_pb_section et_pb_section_1 et_pb_fullwidth_section et_section_regular">
                    <div class="et_pb_module et_pb_fullwidth_image et_pb_fullwidth_image_0">
                        <img fetchpriority="high" decoding="async" src="<?php echo esc_url($hero); ?>" alt="<?php echo esc_attr($hero_title); ?>" class="wp-image-220194" style="box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.66);" />
                        <div class="overlay-text" style="position: absolute; top: 50%; left: 30%; transform: translate(-30%, -50%); color: white; text-align: center; font-family: Arial, sans-serif; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8); opacity: 0; animation: slide-in 1.2s ease-out forwards;">
                            <h1 style="color: white;text-align: left;font-size: 3em;font-family: 'Abhaya Libre', Georgia, serif;font-weight: 500;text-shadow: 2px 4px 6px rgba(0, 0, 0, 1) !important;"><?php echo implode('<br>', array_map('esc_html', $hero_lines)); ?></h1>
                            <p style="text-align: left;font-size:0.7em;opacity: 0;animation: slide-from-left 1.2s ease-out 0.5s forwards;text-shadow: 2px 4px 6px rgba(0, 0, 0, 1) !important;font-weight: bolder !important;font-family: Inter, Arial, sans-serif;letter-spacing: 0.18em;"><?php echo esc_html(ss_option('hero_subtitle', 'AUTHOR')); ?></p>
                        </div>
                        <style>
                          @keyframes slide-in {
                            0% { transform: translate(10%, -50%); opacity: 0; }
                            100% { transform: translate(-30%, -50%); opacity: 1; }
                          }
                          @keyframes slide-from-left {
                            0% { transform: translate(-50%, 0); opacity: 0; }
                            100% { transform: translate(0, 0); opacity: 1; }
                          }
                        </style>
                    </div>
                </div>

                <div class="et_pb_row et_pb_row_2">
                    <div class="et_pb_column et_pb_column_4_4">
                        <br><br>
                        <div class="et_pb_module et_pb_text et_pb_text_3 et_pb_text_align_left et_pb_bg_layout_light">
                            <div class="et_pb_text_inner editable" style="text-align: center;font-weight: bold;color: #554e46;"><br>
                                <p style="
                              display: inline-block;
                              border-bottom: 2px solid #ac7758;
                              padding: 10px 0;
                              margin: 0;
                              font-size: 1.5em;
                              font-family: 'Inter', sans-serif;
                              ">Author's Note</p>
                            </div>
                            <br><br>
                            <blockquote style="font-size: 25px;border-left: 0px;text-align: center;font-family: 'Inter', sans-serif;">
                                <p><strong><?php echo wp_kses_post(ss_option('author_note', 'To spread joy with every turn of a page is both a privilege and an honour.')); ?></strong></p>
                            </blockquote>
                        </div>
                    </div>
                </div>

                <div class="et_pb_module et_pb_text et_pb_text_17 et_pb_text_align_center et_pb_bg_layout_light">
                    <div class="et_pb_text_inner editable">
                        <h2 style="font-family: 'Inter', sans-serif;font-size: 50px;">Latest Updates</h2>
                    </div>
                </div>

                <?php if ($updates) : ?>
                    <div class="carousel">
                        <div class="image-container">
                            <?php foreach ($updates as $image) : ?>
                                <img src="<?php echo esc_url(ss_url($image)); ?>" alt="Latest update">
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <br><br><br>
                <div class="et_pb_text_inner editable" style="text-align: center;font-weight: bold;color: #554e46;"><br>
                    <p style="
                      display: inline-block;
                      padding: 10px 0;
                      margin: 0;
                      font-size: 3em;
                      font-family: 'Inter', sans-serif;
                      ">Must Reads</p>
                </div>

                <?php
                $featured = ss_featured_books();
                $i = 0;
                if ($featured->have_posts()) :
                    while ($featured->have_posts()) :
                        $featured->the_post();
                        $cover = ss_book_cover();
                        $sub   = get_post_meta(get_the_ID(), '_book_subtitle', true);
                        $left  = ($i % 2 === 0);
                        $i++;
                        ?>
                        <div id="forside" class="et_pb_section et_section_regular">
                            <div class="et_pb_row <?php echo $left ? '' : 'custom_row'; ?> et_pb_gutters2">
                                <?php if ($left) : ?>
                                    <div class="et_pb_column et_pb_column_1_2 second-on-mobile">
                                        <div class="et_pb_module et_pb_image">
                                            <span class="et_pb_image_wrap">
                                                <?php if ($cover) : ?>
                                                    <img loading="lazy" decoding="async" width="510" height="638" src="<?php echo esc_url($cover); ?>" alt="<?php the_title_attribute(); ?>" style="box-shadow: 10px 5px 5px rgba(0, 0, 0, 0.569);" />
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="et_pb_column et_pb_column_1_2 <?php echo $left ? 'first-on-mobile' : 'second-on-mobile'; ?>">
                                    <div class="et_pb_module et_pb_text et_pb_text_align_left et_pb_bg_layout_light">
                                        <div class="et_pb_text_inner editable">
                                            <h2 style="font-family: 'Inter', sans-serif;font-size: 50px;"><?php the_title(); ?></h2>
                                            <?php if ($sub) : ?>
                                                <h3 style="font-family: 'Inter', sans-serif;"><?php echo esc_html($sub); ?></h3>
                                            <?php endif; ?>
                                        </div>
                                        <div class="et_pb_module et_pb_text et_pb_text_align_left et_pb_bg_layout_light">
                                            <div class="et_pb_text_inner editable">
                                                <?php ss_rating_links(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="et_pb_module et_pb_text et_pb_text_align_left et_pb_bg_layout_light">
                                        <div class="et_pb_text_inner desktop-text" style="font-family: 'Inter', sans-serif;font-weight: 500;">
                                            <?php the_content(); ?>
                                        </div>
                                        <div class="et_pb_text_inner mobile-text" style="font-family: 'Inter', sans-serif; font-weight: 500;">
                                            <?php echo wpautop(wp_trim_words(wp_strip_all_tags(get_the_content()), 55)); ?>
                                        </div>
                                    </div>
                                    <br>
                                    <?php ss_read_more(get_permalink()); ?>
                                </div>
                                <?php if (!$left) : ?>
                                    <div class="et_pb_column et_pb_column_1_2 first-on-mobile">
                                        <div class="et_pb_module et_pb_image">
                                            <span class="et_pb_image_wrap">
                                                <?php if ($cover) : ?>
                                                    <img loading="lazy" decoding="async" width="510" height="638" src="<?php echo esc_url($cover); ?>" alt="<?php the_title_attribute(); ?>" style="box-shadow: 10px 5px 5px rgba(0, 0, 0, 0.569);" />
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p style="text-align:center;padding:40px;">No featured books yet. In wp-admin go to <strong>Books → Add Book</strong> and tick <em>Show on homepage</em>.</p>';
                endif;
                ?>

                <div class="et_pb_section et_pb_section_4 et_pb_with_background et_section_regular" style="box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 4px;background-image: url(<?php echo esc_url($about_bg); ?>);">
                    <div class="et_pb_row et_pb_row_4 et_pb_gutters2">
                        <div class="et_pb_column et_pb_column_1_2">
                            <div class="et_pb_module et_pb_image">
                                <span class="et_pb_image_wrap">
                                    <img loading="lazy" decoding="async" width="510" height="765" src="<?php echo esc_url(ss_url(ss_option('about_image', '/wp-content/uploads/2022/12/DSC00568.jpg'))); ?>" alt="<?php echo esc_attr(ss_option('about_heading', 'Shilpa Suraj')); ?>" style="width: 400px;" />
                                </span>
                            </div>
                        </div>
                        <div class="et_pb_column et_pb_column_1_2">
                            <div class="et_pb_module et_pb_text et_pb_text_align_left">
                                <div class="et_pb_text_inner editable">
                                    <h2 style="font-family: 'Inter', sans-serif;font-size: 40px;"><?php echo esc_html(ss_option('about_heading', 'Shilpa Suraj')); ?></h2>
                                </div>
                            </div>
                            <div class="et_pb_module et_pb_text et_pb_text_align_left">
                                <div class="et_pb_text_inner editable">
                                    <h4 style="color: black;font-family: 'Inter', sans-serif;">Author</h4>
                                </div>
                            </div>
                            <div class="et_pb_module et_pb_text et_pb_text_align_left">
                                <div class="et_pb_text_inner editable">
                                    <p style="font-family: 'Inter', sans-serif;font-weight: 400;"><?php echo nl2br(esc_html(ss_option('about_text'))); ?></p>
                                </div>
                            </div>
                            <div class="et_pb_button_module_wrapper et_pb_button_1_wrapper et_pb_module">
                                <a class="et_pb_button et_pb_button_1" style="font-family: 'Inter', sans-serif;border-radius: 50px;background-color: #1b1d1e;border: none;" href="<?php echo esc_url($about_link); ?>"><strong style="color: white;padding: 20px;">Read More</strong></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="et_pb_section et_pb_section_10 et_pb_with_background et_section_regular" style="background-color: inherit !important;">
                    <div class="et_pb_row et_pb_row_11">
                        <div class="et_pb_column et_pb_column_4_4">
                            <div class="et_pb_module et_pb_text et_pb_text_align_center">
                                <div class="et_pb_text_inner editable">
                                    <h2 style="font-family: 'Inter', sans-serif;font-weight: 600;font-size: 40px;">If you want the inside scoop ...  </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="newsletter-signup">
                        <button class="signup-button" style="border-radius: 10px;background-color:#1b1d1e;" onclick="window.location.href='<?php echo esc_js(ss_option('newsletter_url', 'http://eepurl.com/dt-Br9')); ?>';"><span style="color: white;">Sign Up to my Newsletter</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

<?php get_footer(); ?>
