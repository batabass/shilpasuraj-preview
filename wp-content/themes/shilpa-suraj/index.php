<?php get_header(); ?>
<article class="page">
    <div class="entry-content">
        <div class="et-l et-l--post">
            <div class="et_builder_inner_content et_pb_gutters3 page-inner">
                <div class="et_pb_module et_pb_text et_pb_text_align_center">
                    <div class="et_pb_text_inner editable">
                        <h1 style="font-size: 4.5em;font-family: 'Inter', sans-serif;color: black;">Blogs</h1>
                    </div>
                </div>

                <?php
                $posts = array();
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        $posts[] = array(
                            'url'   => get_permalink(),
                            'title' => get_the_title(),
                            'image' => ss_post_image(),
                        );
                    }
                }
                $chunks = array_chunk($posts, 5);
                foreach ($chunks as $chunk) :
                    $left   = array_slice($chunk, 0, 2);
                    $center = isset($chunk[2]) ? $chunk[2] : null;
                    $right  = array_slice($chunk, 3, 2);
                    if (!$center && $left) {
                        $center = array_shift($left);
                    }
                    ?>
                    <div class="blog-section">
                        <div class="left-blogs">
                            <?php foreach ($left as $item) : ?>
                                <div class="blog-item small">
                                    <a href="<?php echo esc_url($item['url']); ?>">
                                        <?php if ($item['image']) : ?>
                                            <img src="<?php echo esc_url($item['image']); ?>" alt="" class="blog-image">
                                        <?php endif; ?>
                                        <div class="blog-content">
                                            <p class="category">Author - Shilpa Suraj</p>
                                            <h3><?php echo esc_html($item['title']); ?></h3>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="center-blog">
                            <?php if ($center) : ?>
                                <div class="blog-item large">
                                    <a href="<?php echo esc_url($center['url']); ?>">
                                        <?php if ($center['image']) : ?>
                                            <img src="<?php echo esc_url($center['image']); ?>" alt="" class="blog-image">
                                        <?php endif; ?>
                                        <div class="blog-content">
                                            <p class="category">Author - Shilpa Suraj</p>
                                            <h3><?php echo esc_html($center['title']); ?></h3>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="right-blogs">
                            <?php foreach ($right as $item) : ?>
                                <div class="blog-item small">
                                    <a href="<?php echo esc_url($item['url']); ?>">
                                        <?php if ($item['image']) : ?>
                                            <img src="<?php echo esc_url($item['image']); ?>" alt="" class="blog-image">
                                        <?php endif; ?>
                                        <div class="blog-content">
                                            <p class="category">Author - Shilpa Suraj</p>
                                            <h3><?php echo esc_html($item['title']); ?></h3>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <br>
                    <?php
                endforeach;
                if (!$posts) {
                    echo '<p style="text-align:center;padding:40px;">No blog posts yet. In wp-admin go to <strong>Posts → Add New</strong>.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</article>
<?php get_footer(); ?>
