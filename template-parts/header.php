<header>

    <a href="<?php echo esc_url(home_url()); ?>" class="header-head">
        <img class="header-head-logo"
            src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg"
            alt="ロゴ">
        <img class='header-head-campany'
            src='<?php echo get_template_directory_uri(); ?>/assets/img/company_text.png'
            alt='会社名'>
        <div class="header-head-mark">
            <?php
            $domain = $_SERVER['SERVER_NAME'];
            clog('domain=>'.$domain);
            switch ($domain) :
                case ('medakashopping.local'):
                    echo 'テスト環境';
                    break;
                case ('xs537807.xsrv.jp'):
                    echo 'ステージング環境';
                    break;
                default:
            endswitch;
            ?>
        </div>
    </a>

    <nav class="header-body">
        <ul>
            <li><a href="<?php echo esc_url(home_url()); ?>">ホーム</a>
            </li>
            <li><a
                    href="<?php echo esc_url(home_url().'/products'); ?>">メダカ一覧</a>
            </li>
            <li><a
                    href="<?php echo esc_url(home_url().'/contact'); ?>">お問い合わせ</a>
            </li>
            <li><a
                    href="<?php echo esc_url(home_url().'/guide'); ?>">ご利用案内</a>
            </li>
        </ul>
    </nav>

    <div class="header-foot">
        <?php get_search_form(); ?>

        <!-- <a href="<?php //echo home_url();?>/my-account"
        class="header-foot-item"> -->
        <?php //if (is_user_logged_in()) :?>
        <!-- ログイン状態 -->
        <!-- <img class="item-img"
                src="<?php //echo get_template_directory_uri();?>/assets/img/user.svg"
        alt="マイページ"> -->
        <!-- <div class="item-text">マイページ</div> -->
        <?php //else :?>
        <!-- ログアウト状態 -->
        <!-- <img class="item-img"
                src="<?php //echo get_template_directory_uri();?>/assets/img/login.svg"
        alt="サインアウト">
        <div class="item-text">ログイン</div> -->
        <?php //endif;?>
        <!-- </a> -->

        <a href="<?php echo esc_url(home_url().'/cart');?>"
            class="header-foot-item">
            <div class="headerCart">
                <img class="headerCart-img"
                    src="<?php echo esc_url(get_template_directory_uri().'/assets/img/cart-btn.svg'); ?>"
                    alt="お買い物カゴ">
                <div class="headerCart-alert">
                    <?php echo WC()->cart->get_cart_contents_count(); ?>
                </div>
            </div>
        </a>
        <img class='header-foot-hamburgerMenu'
            src='<?php echo get_template_directory_uri(); ?>/assets/img/menu.svg'
            alt='ハンバーガーメニュー'>
    </div>
</header>

<div class="smHeader">
    <nav class="smHeader-body">
        <ul>
            <li><a href="<?php echo esc_url(home_url()); ?>">ホーム</a>
            </li>
            <li><a
                    href="<?php echo esc_url(home_url().'/products'); ?>">メダカ一覧</a>
            </li>
            <li><a
                    href="<?php echo esc_url(home_url().'/contact'); ?>">お問い合わせ</a>
            </li>
            <li><a
                    href="<?php echo esc_url(home_url().'/guide'); ?>">ご利用案内</a>
            </li>
        </ul>
    </nav>
    <div class="smHeader-foot">
        <?php get_search_form(); ?>
    </div>
</div>