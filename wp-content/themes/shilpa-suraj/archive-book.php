<?php get_header(); ?>
<?php
if (!function_exists('ss_series_more')) {
function ss_series_more($name) {
    $term = get_term_by('name', $name, 'series');
    if ($term && !is_wp_error($term)) {
        $link = get_term_link($term);
        if (!is_wp_error($link)) {
            return $link;
        }
    }
    $page = ss_find_by_title($name, 'book');
    if ($page) {
        return get_permalink($page);
    }
    return get_post_type_archive_link('book') ?: home_url('/books/');
}

function ss_card_blurb($title, $book) {
    $blurbs = array(
        "Kabir's Geet" => "When the cool guy on campus hits Geetika Alaparthy on the head with a football, thinks she’s a boy, and falls in love with her sister, her life rolls from misery to hell. And then Kabir Sodhi moves in next door. When he proposes a trade, her tutoring for his social influence, study dates turn into secret midnight meetings and dislike flips into love. But love has terrible timing. Will the truth destroy them before their story ever truly begins?",
        'The Right Kind Of Wrong' => "He's dangerous, damaged and doomed but he's hers... With no name, no medical history, multiple gunshot wounds and enough security to rival the Prime Minister’s, Dr Aria Dubey’s new patient is something more than she asked for. And everything she might just need.",
        'All Kinds Of Wrong' => "Alia Dubey is being stalked. The problem is no one believes her. Not the cops, not her family…and well, she doesn’t really have any friends. Until the day her sister calls in a favour and asks her friend from the Intelligence Bureau to check on Alia and the gifts she’s been receiving.",
        'Hey Kitty' => "When Misha Banerjee’s mother marries Katyayani Shankar’s father, a fierce rivalry begins. Katya, the new girl at Misha’s school, struggles as the underdog in a battle of wills. With power shifting between them, their story unfolds with unexpected twists. It's a fight for dominance, but the true outcome remains uncertain.",
        'Wrong' => "Ananya Saxena is the good girl who has always done the right thing. She is a dutiful wife, faithful daughter-in-law, fierce champion of the law. Except, in her heart was another phrase—reckless lover. An impossible choice for a good Indian girl. Duty had Ananya marry her best friend only to end up with a bitter, vengeful husband.",
        'Driven By Desire' => "He wants a perfect restoration. She's about to wreck his carefully controlled world. When brooding pharmaceutical tycoon Krish Mehra hires vintage car restorer Maxine Sheridan to restore his late father's prized 1947 MG TC, he expects craftsmanship, not motor oil, mischief, and mayhem. As sparks fly and secrets surface, an unexpected accident threatens to destroy their fragile bond. Will love be the one thing they can't rebuild?",
        'Forever Yours' => "Three love stories, three oddball couples, one epic weekend in Goa… Will they find their heart’s twisted path or focus on the brain’s straight-but-boring one? Will they gamble on their happily-ever-after or choose to leave Goa as they came, single and not ready to mingle?",
        'Bad Girl Gone Wicked' => "Tara Wadhwa, Captain of the Indian Women’s Cricket team, was living the dream. She got to play the sport she loved and to live close to her friends, the family of her heart. But when her friends start to fall in love, a sliver of loneliness works its way into her heart pushing her to make a reckless mistake.",
        'Insta Reddy' => "What happens when an Instagrammer and an IIT student fall in love? Sparks fly, insults are traded, and some very interesting content is generated! Vasudha Reddy aka Insta Reddy has some interesting collaborations lined up. She can’t wait to get started, until she gets stuck with Avyukt Davuluri as a chaperone!",
        "My Heart's Regret" => "Samaira Reddy, the girl in the big house, the Bade Sahib's daughter, only wants one thing and one person...a life with her childhood sweetheart, her Rags. Raghav Cherukuri has always been known as the driver's son. And has also always loved his Sam, the girl he can never have and never forget",
        'My Heart’s Regret' => "Samaira Reddy, the girl in the big house, the Bade Sahib's daughter, only wants one thing and one person...a life with her childhood sweetheart, her Rags. Raghav Cherukuri has always been known as the driver's son. And has also always loved his Sam, the girl he can never have and never forget",
        'A Barren Heart' => "An affluent, educated couple, Aman and Rhea have it all – a happy home, successful careers and most importantly, each other. Their marriage is what dreams are made of. Until the day Rhea miscarries… When their baby journey starts to take a severe toll on them and their marriage, Aman isn’t sure if having a child will complete them or destroy them.",
        'The Girl He Left Behind' => "The only guy Sia Sharma, a romantic fiction editor, had loved had left six years ago. Ryan Mathur has now become a well-known entrepreneur and his advertising company has been chosen to create the marketing campaign for Sia's publishing firm",
        'Rescued By Love' => "When Naina Ahuja is kidnapped as hostage days before her father, a Supreme Court Chief Justice, must sentence a terrorist, the stakes are very high. Lt. Colonel Arjun Rathore and his team are the only ones who can be trusted with the mission of saving her.",
    );
    if (isset($blurbs[$title])) {
        return $blurbs[$title];
    }
    return wp_trim_words(wp_strip_all_tags($book->post_content), 55);
}

function ss_render_series_block($name, $covers, $desc = '', $heading_style = '') {
    $style = $heading_style ?: "font-size: 3em;font-family: 'Inter', sans-serif;";
    ?>
    <div class="et_pb_module et_pb_text et_pb_text_17 et_animated et_pb_text_align_center et_pb_bg_layout_light">
        <div class="et_pb_text_inner">
            <h2 style="<?php echo esc_attr($style); ?>"><?php echo esc_html($name); ?></h2>
        </div>
    </div>
    <div class="book-section">
        <div class="book-covers">
            <?php foreach ($covers as $file) : ?>
                <img src="<?php echo esc_url(ss_url('/wp-content/uploads/2022/12/' . $file)); ?>" alt="<?php echo esc_attr($name); ?>">
            <?php endforeach; ?>
        </div><br><br>
        <div class="book-description">
            <?php if ($desc) : ?>
                <p><?php echo esc_html($desc); ?></p>
            <?php endif; ?>
        </div>
        <?php ss_learn_more(ss_series_more($name)); ?>
    </div>
    <br>
    <?php
}

function ss_render_book_card($title, $card_style = '', $img_style = '', $lead_br = true) {
    $book = ss_find_by_title($title, 'book');
    if (!$book) {
        return;
    }
    $cover = ss_book_cover($book->ID);
    $blurb = ss_card_blurb($title, $book);
    ?>
    <div class="card" style="<?php echo esc_attr($card_style); ?>">
        <?php if ($lead_br) : ?><br><?php endif; ?>
        <h2 style="font-weight: bold;font-family: 'Inter', sans-serif;font-size: 2em;"><?php echo esc_html($book->post_title); ?></h2>
        <?php if (!$lead_br) : ?><br><?php endif; ?>
        <?php if ($cover) : ?>
            <img src="<?php echo esc_url($cover); ?>" alt="<?php echo esc_attr($book->post_title); ?>"<?php echo $img_style ? ' style="' . esc_attr($img_style) . '"' : ''; ?>>
        <?php endif; ?>
        <br><br>
        <p style="font-family: 'Inter', sans-serif;"><?php echo esc_html($blurb); ?></p>
        <?php ss_learn_more(get_permalink($book)); ?>
    </div>
    <?php
}
}
?>
<article class="page">
    <div class="entry-content">
        <div class="et-l et-l--post">
            <div class="et_builder_inner_content et_pb_gutters3">
                <div class="et_pb_row et_pb_row_2">
                    <div class="et_pb_column et_pb_column_4_4 et-last-child">
                        <br><br>
                    </div>
                </div>

                <?php
                ss_render_series_block('IL Cuore Heirs Series', array('ilh1.jpg', 'ilh2.jpeg', 'ilh3.jpeg'));
                ?>

                <div class="grid">
                    <?php ss_render_book_card("Kabir's Geet", 'border-right: none;', 'max-width: 30%; height: auto;', false); ?>
                </div>
                <br>

                <?php
                ss_render_series_block('Karma Series', array(
                    'Latest Updates/Flames of Fate.jpg',
                    'Latest Updates/Wrath of War.jpg',
                    'Latest Updates/Death of Destiny.jpg',
                ));
                ss_render_series_block('The Phoenix Series', array('Phoenix1.jpg', 'Phoenix2.jpg', 'Phoenix3.jpg'));
                ss_render_series_block(
                    'Dynasty Rebels',
                    array('rebel1.jpg', 'rebel2.jpg', 'rebel3.jpg', 'rebels4.jpg'),
                    'In a high-stakes world of politics, media, and real estate, three influential families and their ambitious heirs clash on multiple fronts, where love veiled in betrayal and desire masked as dislike ignites a fierce battle for dominance. Will they ever find their way to true love, or will they sacrifice their happiness at the altar of their family’s enmity?'
                );
                ss_render_series_block(
                    'IL Cuore',
                    array('cuore1.jpg', 'cuore2.jpg', 'cuore3.jpg', 'cuore4.jpg'),
                    'Five friends head out for a night of drunken revelry with catastrophic consequences. A devastating car crash leaves one friend dead and four other lives shattered in its wake. Scarred, broken, and scared, they must find their path again...Will love pave the way?'
                );
                ss_render_series_block(
                    'Shades of Night',
                    array('shade1.jpg', 'shade2.jpg', 'shade3.jpg'),
                    'When drama, desire, and duty collide, the Shades of Night are born. A trilogy of lust, love, and loyalty, Shades of Night is darkly dramatic and delicious.'
                );
                ?>

                <div class="grid">
                    <?php ss_render_book_card('The Right Kind Of Wrong', 'box-shadow: 10px 0 10px -5px rgba(0, 0, 0, 0.3);'); ?>
                    <?php ss_render_book_card('All Kinds Of Wrong', 'border-right: none;'); ?>
                </div>
                <br>

                <?php
                ss_render_series_block(
                    'In Disgrace',
                    array('disg1.jpg', 'disg2.jpg', 'disg3.jpg'),
                    'When you fall from grace, your true self comes to the surface. For it is in disgrace that strength is unearthed and grit is sharpened...'
                );
                ss_render_series_block(
                    'The Kapoor Brothers',
                    array('KapporBook1.jpg', 'KapoorBook2.jpg', 'KapoorBook3.jpg'),
                    'Three brothers, the unlikely women they fall in love with, and their roller coaster romances that set their worlds on fire.',
                    "font-size: 3em;font-family: 'Inter', sans-serif;color: black;"
                );
                ?>

                <div class="grid">
                    <?php ss_render_book_card('Hey Kitty', 'box-shadow: 10px 0 10px -5px rgba(0, 0, 0, 0.3);'); ?>
                    <?php ss_render_book_card('Wrong', 'border-right: none;'); ?>
                </div>
                <div class="grid">
                    <?php ss_render_book_card('Driven By Desire', 'border-right: none;', 'max-width: 30%; height: auto;', false); ?>
                </div>
                <br>
                <div class="grid">
                    <?php ss_render_book_card('Forever Yours', 'box-shadow: 10px 0 10px -5px rgba(0, 0, 0, 0.3);'); ?>
                    <?php ss_render_book_card('Bad Girl Gone Wicked', 'border-right: none;'); ?>
                </div>
                <br>
                <div class="grid">
                    <?php ss_render_book_card('Insta Reddy', 'box-shadow: 10px 0 10px -5px rgba(0, 0, 0, 0.3);'); ?>
                    <?php ss_render_book_card('My Heart’s Regret', 'border-right: none;'); ?>
                </div>
                <br>
                <div class="grid">
                    <?php ss_render_book_card('A Barren Heart', 'border-right: none;', '', false); ?>
                </div>
                <br>
                <div class="grid">
                    <?php ss_render_book_card('The Girl He Left Behind', 'box-shadow: 10px 0 10px -5px rgba(0, 0, 0, 0.3);'); ?>
                    <?php ss_render_book_card('Rescued By Love', 'border-right: none;'); ?>
                </div>
            </div>
        </div>
    </div>
</article>
<?php get_footer(); ?>
