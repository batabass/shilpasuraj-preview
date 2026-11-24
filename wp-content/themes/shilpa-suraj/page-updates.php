<?php
/*
Template Name: Updates
*/
get_header();
$phoenix = get_term_link('the-phoenix-series', 'series');
if (is_wp_error($phoenix) || !$phoenix) {
    $phoenix = get_post_type_archive_link('book');
}
?>
<article class="page">
    <div class="entry-content">
        <div class="et-l et-l--post">
            <div class="et_builder_inner_content et_pb_gutters3">
                <div class="et_pb_module et_pb_text et_pb_text_17 et_animated et_pb_text_align_center et_pb_bg_layout_light">
                    <div class="et_pb_text_inner">
                        <h1 style="font-size: 4.5em;font-family: 'Inter', sans-serif;color: black;">Latest Updates</h1>
                    </div>
                </div>
                <section id="updates-section" style="background: linear-gradient(120deg, #1d1f33, #a46949, #f4e2d8, #cbbaa1, #301f24)">
                    <div class="update-cards-container">
                        <div class="update-card">
                            <div class="card-image">
                                <video autoplay muted loop playsinline>
                                    <source src="<?php echo esc_url(ss_url('/wp-content/uploads/2022/12/phoenix_updates.mp4')); ?>" type="video/mp4">
                                </video>
                            </div>
                            <div class="card-content">
                                <h3>The Phoenix Series</h3>
                                <p>Three men—Amay, Ishaan, and Virat—broken by love, rise from their pain to reclaim what was stolen. Their bond, forged in loss, leads them through journeys of revenge and redemption. Fierce women will forever haunt their hearts.</p>
                                <a href="<?php echo esc_url($phoenix); ?>" style="color: #0056b3; text-decoration: underline;">Live Now</a>
                            </div>
                        </div>
                        <div class="update-card">
                            <div class="card-image">
                                <video autoplay muted loop playsinline>
                                    <source src="<?php echo esc_url(ss_url('/wp-content/uploads/2022/12/bornInRuinVid.mp4')); ?>" type="video/mp4">
                                </video>
                            </div>
                            <div class="card-content">
                                <h3>Born In Ruin</h3>
                                <p>Ishaan Adajania, a ruthless CEO, built his empire from the ruins of his past, only to have it threatened by Mayukhi Chatterjee, who accuses him of stealing her father's trade secrets. As their battle for power intensifies, Ishaan seeks revenge, determined to take everything from her, including her father’s prized possession: her. In a dangerous game of ambition, betrayal, and simmering tension, love and vengeance collide. Will either survive the razor’s edge of their rivalry?</p>
                                <button class="read-more-btn" onclick="window.location.href='https://www.amazon.in/Born-Ruin-Phoenix-Book-2-ebook/dp/B0DVZRLZ2F';">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="update-cards-container">
                        <div class="update-card">
                            <div class="card-image">
                                <video autoplay muted loop playsinline>
                                    <source src="<?php echo esc_url(ss_url('/wp-content/uploads/2022/12/announcement3.mp4')); ?>" type="video/mp4">
                                </video>
                            </div>
                            <div class="card-content">
                                <h3>Born In Grief</h3>
                                <p>Dr. Amay Aatre, a stoic trauma surgeon, is haunted by his past and his mother’s death. When Dhrithi Sahay, a survivor of domestic abuse and his lost love, lands in his ER, old wounds reopen. As Amay fights to save her, police investigations reveal dangerous secrets from her past. Amay must confront his emotions and decide if he’s willing to risk his heart to protect the woman he still loves.</p>
                                <button class="read-more-btn" onclick="window.location.href='https://www.amazon.in/Born-Grief-Phoenix-Book-1-ebook/dp/B0DRZSNH5Q';">Buy Now</button>
                            </div>
                        </div>
                        <div class="update-card">
                            <div class="card-image">
                                <img src="<?php echo esc_url(ss_url('/wp-content/uploads/2022/12/bookreading.jpeg')); ?>" alt="Beyond The Box">
                            </div>
                            <div class="card-content">
                                <h3>Beyond The Box</h3>
                                <p>I did a fun event with Beyond the Box where we talked about everything from weaving relatable conflict into stories to how peer pressure has evolved into a whole new demon in recent times. So, when your teens say 'You don't understand what it's like for me!', they're actually right. We really need to make an effort to understand what it's like for them. It's sure not the same as what it was like for us!</p>
                            </div>
                        </div>
                    </div>
                    <br><br>
                </section>
            </div>
        </div>
    </div>
</article>
<?php get_footer(); ?>
