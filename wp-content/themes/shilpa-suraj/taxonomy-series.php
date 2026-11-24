<?php get_header(); ?>
<article class="page">
    <div class="entry-content page-inner">
        <div class="et_pb_module et_pb_text et_pb_text_align_center">
            <div class="et_pb_text_inner editable">
                <h1 style="font-size: 3em;font-family: 'Inter', sans-serif;"><?php echo esc_html(single_term_title('', false)); ?></h1>
            </div>
        </div>
        <?php if (term_description()) : ?>
            <div class="book-description"><?php echo wp_kses_post(term_description()); ?></div>
        <?php endif; ?>
        <?php
        while (have_posts()) :
            the_post();
            $cover = ss_book_cover();
            ?>
            <div class="row">
                <?php if ($cover) : ?>
                    <img src="<?php echo esc_url($cover); ?>" alt="<?php the_title_attribute(); ?>">
                <?php endif; ?>
                <div class="text">
                    <h1><?php the_title(); ?></h1>
                    <?php
                    $sub = get_post_meta(get_the_ID(), '_book_subtitle', true);
                    if ($sub) {
                        echo '<h2>' . esc_html($sub) . '</h2>';
                    }
                    ?>
                    <?php echo wpautop(wp_trim_words(wp_strip_all_tags(get_the_content()), 80)); ?>
                    <div class="buttons">
                        <a href="<?php the_permalink(); ?>">Read More</a>
                        <?php if (get_post_meta(get_the_ID(), '_book_amazon', true)) : ?>
                            <a href="<?php echo esc_url(get_post_meta(get_the_ID(), '_book_amazon', true)); ?>" target="_blank" rel="noopener">Buy on Amazon</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</article>
<?php get_footer(); ?>
