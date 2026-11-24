            <footer class="ss-site-footer" style="background-color: #2c2b38; padding: 40px; text-align: center; color: white;">
                <p style="font-family: Arial, sans-serif; font-size: 18px; margin: 0;">Follow me on Social Media</p>
                <hr style="border: 1px solid #39a62b; width: 160px; margin: 10px auto;">
                <div class="ss-socials" style="display: flex; justify-content: center; gap: 15px; margin-top: 10px;">
                    <?php if (ss_option('instagram')) : ?>
                        <a href="<?php echo esc_url(ss_option('instagram')); ?>" style="text-decoration: none;padding: 10px;" target="_blank" rel="noopener">
                            <img src="<?php echo esc_url(ss_url('/wp-content/uploads/2022/12/instagram.png')); ?>" alt="Instagram" style="width: 30px; height: 30px;">
                        </a>
                    <?php endif; ?>
                    <?php if (ss_option('goodreads')) : ?>
                        <a href="<?php echo esc_url(ss_option('goodreads')); ?>" style="text-decoration: none;padding: 10px;" target="_blank" rel="noopener">
                            <img src="<?php echo esc_url(ss_url('/wp-content/uploads/2022/12/goodread2.png')); ?>" alt="Goodreads" style="width: 30px; height: 30px;">
                        </a>
                    <?php endif; ?>
                    <?php if (ss_option('twitter')) : ?>
                        <a href="<?php echo esc_url(ss_option('twitter')); ?>" style="text-decoration: none;padding: 11px;" target="_blank" rel="noopener">
                            <img src="<?php echo esc_url(ss_url('/wp-content/uploads/2022/12/twitter (1).png')); ?>" alt="X" style="width: 25px; height: 25px;">
                        </a>
                    <?php endif; ?>
                </div><br>
                <div class="ss-footer-meta" style="display: flex; justify-content: space-between; align-items: center;">
                    <span id="rights" style="font-weight: 200;font-size: 12px;">© 2018 - <?php echo esc_html(date('Y')); ?> Shilpa Suraj⋅ All Rights Reserved.</span>
                    <span id="email">Reach me at: <?php echo esc_html(ss_option('email', 'shilpa@shilpasuraj.com')); ?></span>
                </div>
            </footer>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>
