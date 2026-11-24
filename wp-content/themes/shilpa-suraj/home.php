<?php get_header(); ?>
<article class="page">
    <div class="entry-content">
        <div class="et-l et-l--post">
            <div class="et_builder_inner_content et_pb_gutters3">
                <div class="et_pb_module et_pb_text et_pb_text_17 et_animated et_pb_text_align_center et_pb_bg_layout_light">
                    <div class="et_pb_text_inner">
                        <h1 style="font-size: 4.5em;font-family: 'Inter', sans-serif;color: black;">Blogs</h1>
                    </div>
                </div>

                <?php
                $live_order = array(
                    'Women can have it all - Myth or Fiction',
                    'Flying Kites - Childhood Memories',
                    'Reading Romance - Escapist or Cathartic?',
                    'His Reluctant Princess',
                    'Self Publishing',
                    'What do you want to be when you grow up?',
                    'Double-Edged Sword (Book Spotlight)',
                    'Bewitched by Ruchi Singh',
                    'Princess & Prejudice by Alisha Kay',
                    'Forever Yours - A Novel in Three Parts',
                    'Insta Reddy - Available on Storytel India',
                    "The Flatshare by Beth O'Leary",
                    'Blood Trail by Ruchi Singh',
                    'Strategies to Stitch a Spectacular Short Story',
                );
                $live_authors = array(
                    'Self Publishing' => 'Ruchi Singh',
                    'Strategies to Stitch a Spectacular Short Story' => 'Inderpreet Kaur Uppal',
                );
                $norm = static function ($title) {
                    $title = html_entity_decode((string) $title, ENT_QUOTES, 'UTF-8');
                    $title = str_replace(array('–', '—', '−', '’', '‘', '“', '”'), array('-', '-', '-', "'", "'", '"', '"'), $title);
                    $title = preg_replace('/\s+/', ' ', $title);
                    return strtolower(trim($title));
                };
                $by_title = array();
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        $item = array(
                            'url'   => get_permalink(),
                            'title' => get_the_title(),
                            'image' => ss_post_image(),
                        );
                        $by_title[$norm($item['title'])] = $item;
                    }
                }
                $posts = array();
                foreach ($live_order as $title) {
                    $key = $norm($title);
                    if (isset($by_title[$key])) {
                        $posts[] = $by_title[$key];
                        unset($by_title[$key]);
                    }
                }
                foreach ($by_title as $item) {
                    $posts[] = $item;
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
                                <?php $author = isset($live_authors[$item['title']]) ? $live_authors[$item['title']] : 'Shilpa Suraj'; ?>
                                <div class="blog-item small">
                                    <a href="<?php echo esc_url($item['url']); ?>">
                                        <?php if ($item['image']) : ?>
                                            <img src="<?php echo esc_url($item['image']); ?>" alt="" class="blog-image">
                                        <?php endif; ?>
                                        <div class="blog-content">
                                            <p class="category">Author - <?php echo esc_html($author); ?></p>
                                            <h3><?php echo esc_html($item['title']); ?></h3>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="center-blog">
                            <?php if ($center) : ?>
                                <?php $author = isset($live_authors[$center['title']]) ? $live_authors[$center['title']] : 'Shilpa Suraj'; ?>
                                <div class="blog-item large">
                                    <a href="<?php echo esc_url($center['url']); ?>">
                                        <?php if ($center['image']) : ?>
                                            <img src="<?php echo esc_url($center['image']); ?>" alt="" class="blog-image">
                                        <?php endif; ?>
                                        <div class="blog-content">
                                            <p class="category">Author - <?php echo esc_html($author); ?></p>
                                            <h3><?php echo esc_html($center['title']); ?></h3>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="right-blogs">
                            <?php foreach ($right as $item) : ?>
                                <?php $author = isset($live_authors[$item['title']]) ? $live_authors[$item['title']] : 'Shilpa Suraj'; ?>
                                <div class="blog-item small">
                                    <a href="<?php echo esc_url($item['url']); ?>">
                                        <?php if ($item['image']) : ?>
                                            <img src="<?php echo esc_url($item['image']); ?>" alt="" class="blog-image">
                                        <?php endif; ?>
                                        <div class="blog-content">
                                            <p class="category">Author - <?php echo esc_html($author); ?></p>
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
