<?php
$categories = get_medaka_categories();
$item = [
    'products' => 'メダカ一覧',
    'contact' => 'お問合せ',
    'guide' => 'ご利用案内',
    'my-account' => 'アカウント',
    'cart' => 'カート',
    '#1' => '特定商取引法に基づく表記',
    '#' => 'プライバシーポリシー',
];
?>
<footer class="footer">
    <div class="footer-body">
        <div class="footer-body-left">
            <a class="footerLogo" href="<?php home_url(); ?>">
                <img class="footerLogo-image"
                    src='<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg'
                    alt='logo'>
                <div class="footerLogo-text">じめだか</div>
            </a>
            <div class="catchphrase">
                <div class="catchphrase-body">
                    オンラインショップで<br>メダカを購入。
                </div>
                <div class="catchphrase-foot">
                    『じめだか』は様々なメダカを取り扱っています。
                </div>
            </div>
        </div>
        <div class="footer-body-right">
            <nav class="footerNav">
                <div class="footerNav-head">メニュー</div>
                <ul class="footerNav-body">
                    <?php foreach ($item as $key => $value): ?>
                    <li>
                        <a
                            href="<?php echo home_url() . '/' . $key; ?>">
                            <?php echo $value; ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                    <object class="footerSeparation"
                        data='<?php echo get_template_directory_uri(); ?>/assets/img/separationBC.svg'
                        type="image/svg+xml"></object>
                </ul>

            </nav>
            <nav class="footerNav">
                <div class="footerNav-head">メダカの種類</div>
                <ul class="footerNav-body">
                    <?php foreach ($categories as $cat): ?>
                    <?php $cat_thumb_url = get_wc_thumb_url($cat->term_id); ?>
                    <li><a
                            href="<?php echo get_medaka_cat_url($cat->slug); ?>"><?php echo $cat->name; ?></a></li>
                    <?php endforeach; ?>
                    <object class="footerSeparation"
                        data='<?php echo get_template_directory_uri(); ?>/assets/img/separationBC.svg'
                        type="image/svg+xml"></object>
                </ul>

            </nav>
        </div>
    </div>
    <div class="footer-foot">
        <?php get_template_part('template-parts/sns'); ?>
        <div class="copyright">Copyright © 株式会社AMENA Co.,Ltd. All Rights Reserved.</div>
    </div>

</footer>
<?php wp_footer(); ?>
</body>