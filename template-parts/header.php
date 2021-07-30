<header>

    <a href="<?php echo home_url(); ?>" class="header-head">
        <img class="header-head-logo"
            src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg"
            alt="ロゴ">
        <img class='header-head-campany'
            src='<?php echo get_template_directory_uri(); ?>/assets/img/company_text.png'
            alt='会社名'>
        <!-- <div class="header-head-campany">じめだか</div> -->
    </a>

    <!-- <img class="separation"
        src="<?php echo get_template_directory_uri(); ?>/assets/img/separation.svg"
    alt="区切り"> -->

    <nav class="header-body">
        <ul>
            <li><a href="<?php echo home_url(); ?>">ホーム</a></li>
            <li><a
                    href="<?php echo home_url(); ?>/products">メダカ一覧</a>
            </li>
            <li><a
                    href="<?php echo home_url(); ?>/contact">お問い合わせ</a>
            </li>
            <li><a href="<?php echo home_url(); ?>/guide">ご利用案内</a>
            </li>
        </ul>
    </nav>

    <div class="header-foot">
        <?php get_search_form(); ?>

        <!-- <a href="<?php echo home_url(); ?>/my-account"
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
        <a href="<?php echo home_url(); ?>/cart"
            class="header-foot-item">
            <!-- <img class="item-img"
                src="<?php echo get_template_directory_uri(); ?>/assets/img/cart.svg"
            alt="カート">
            <div class="item-text">カート</div> -->
            <div class="headerCart">
                <img class="headerCart-img"
                    src='<?php echo get_template_directory_uri(); ?>/assets/img/cart-btn.svg'
                    alt='カート'>
                <div class="headerCart-alert">
                    <?php echo WC()->cart->get_cart_contents_count(); ?>
                </div>
            </div>
        </a>
    </div>

</header>