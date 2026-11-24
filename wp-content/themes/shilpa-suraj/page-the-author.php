<?php
/*
Template Name: The Author
*/
get_header();
$hero = ss_url('/wp-content/uploads/2022/12/abtAuthor.jpeg');
$postit = ss_url('/wp-content/uploads/2022/12/postit2.png');
?>
<article class="page">
    <div class="entry-content">
        <div class="et-l et-l--post">
            <div class="et_builder_inner_content et_pb_gutters3">
                <div class="et_pb_section et_pb_section_0 et_pb_with_background et_section_regular" style="background-image: url('<?php echo esc_url($hero); ?>') !important;">
                    <div class="et_pb_row et_pb_row_1">
                        <div class="et_pb_column et_pb_column_2_3 et_pb_column_0">
                            <div class="et_pb_module et_pb_text et_pb_text_0 et_pb_text_align_left et_pb_bg_layout_light">
                                <div class="et_pb_text_inner" style="text-align: left;">
                                    <h1 style="font-size: 60px;padding-top: 250px !important;">Who Is<br><span style="font-size: 90px; "> Shilpa Suraj?</span></h1>
                                </div>
                            </div>
                        </div>
                        <div class="et_pb_column et_pb_column_1_3 et-last-child et_pb_column_empty"></div>
                    </div>
                    <div class="overlay"></div>
                </div>
                <div class="et_pb_section et_pb_section_1 et_pb_fullwidth_section et_section_regular">
                    <div class="et_pb_module et_pb_fullwidth_image et_pb_fullwidth_image_0">
                        <img fetchpriority="high" decoding="async" src="<?php echo esc_url($hero); ?>" alt="Who is Shilpa Suraj?" style="box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.66);" />
                        <div class="overlay"></div>
                        <div class="overlay-text about-hero" style="position: absolute; top: 50%; left: 30%; transform: translate(-30%, -50%); color: white; text-align: center; font-family: Arial, sans-serif; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8); opacity: 0; animation: slide-in 1.2s ease-out forwards;">
                            <h1 style="color: white;text-align: left;font-size: 3em; padding-top: 250px !important;">Who is <br>Shilpa Suraj?</h1>
                        </div>
                        <style>
                          @keyframes slide-in {
                            0% { transform: translate(10%, -50%); opacity: 0; }
                            100% { transform: translate(-30%, -50%); opacity: 1; }
                          }
                        </style>
                    </div>
                </div>
                <div style="background: url('<?php echo esc_url($postit); ?>') no-repeat center center;background-size: cover;width: 100%;height: auto; aspect-ratio: 3 / 2;"></div>
                <?php while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</article>
<?php get_footer(); ?>
