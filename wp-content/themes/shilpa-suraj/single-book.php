<?php get_header(); ?>
<article class="page">
    <div class="entry-content page-inner">
        <?php while (have_posts()) : the_post(); ?>
            <div class="row">
                <?php $cover = ss_book_cover(); ?>
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
                    <?php the_content(); ?>
                    <div class="buttons">
                        <?php if (get_post_meta(get_the_ID(), '_book_amazon', true)) : ?>
                            <a href="<?php echo esc_url(get_post_meta(get_the_ID(), '_book_amazon', true)); ?>" target="_blank" rel="noopener">Buy on Amazon</a>
                        <?php endif; ?>
                        <?php if (get_post_meta(get_the_ID(), '_book_goodreads', true)) : ?>
                            <a href="<?php echo esc_url(get_post_meta(get_the_ID(), '_book_goodreads', true)); ?>" target="_blank" rel="noopener">Goodreads</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</article>
<?php get_footer(); ?>
