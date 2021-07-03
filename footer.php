    <footer>
        <nav class="footer-nav">
            <div class="footer-nav-logo"><a
                    href="<?php home_url(); ?>">LOGO</a></div>
            <div class="footer-nav-menu">
                <strong>メニュー</strong>
                <ul>
                    <li><a
                            href="<?php home_url(); ?>/products">メダカ一覧</a>
                    </li>
                    <li><a
                            href="<?php home_url(); ?>/contact">お問合せ</a>
                    </li>
                    <li><a
                            href="<?php home_url(); ?>/guide">ご利用案内</a>
                    </li>
                    <li><a
                            href="<?php home_url(); ?>/my-account">アカウント</a>
                    </li>
                    <li><a href="<?php home_url(); ?>/cart">カート</a>
                    </li>
                    <li><a href="#">特定商取引法に基づく表記</a></li>
                    <li><a href="#">プライバシーポリシー</a></li>
                </ul>
            </div>
            <div class="footer-nav-medaka">
                <strong>メダカの種類</strong>
                <?php $categories = get_medaka_categories(); ?>
                <ul>
                    <?php foreach ($categories as $cat): ?>
                    <?php $cat_thumb_url = get_wc_thumb_url($cat->term_id); ?>
                    <li><a
                            href="<?php echo get_medaka_cat_url($cat->slug); ?>"><?php echo $cat->name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>
        <?php get_template_part('template_parts/sns'); ?>
        <div class="copyright">Copyright © 株式会社AMENA Co.,Ltd. All Rights Reserved.</div>
    </footer>
    <?php wp_footer(); ?>
    </body>