<?php get_header(); ?>
<article class="page">
    <div class="entry-content page-inner">
        <?php while (have_posts()) : the_post(); ?>
            <div class="row">
                <?php $img = ss_post_image(); ?>
                <?php if ($img) : ?>
                    <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>">
                <?php endif; ?>
                <div class="text">
                    <h1><?php the_title(); ?></h1>
                    <div class="entry-content"><?php the_content(); ?></div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</article>
<?php get_footer(); ?>
