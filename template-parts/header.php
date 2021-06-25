<header>

    <a href="<?php echo home_url(); ?>" class="header-head">
        <img class="header-head-logo"
            src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg"
            alt="ロゴ">
        <div class="header-head-campany">メダカのお宿</div>
    </a>

    <img class="separation"
        src="<?php echo get_template_directory_uri(); ?>/assets/img/separation.svg"
        alt="区切り">

    <nav class="header-body">
        <ul>
            <li><a href="<?php echo home_url(); ?>">ホーム</a></li>
            <li><a
                    href="<?php echo home_url(); ?>/product-list">メダカ一覧</a>
            </li>
            <li><a
                    href="<?php echo home_url(); ?>/contact">お問い合わせ</a>
            </li>
            <li><a href="">ご利用案内</a></li>
        </ul>
    </nav>

    <div class="header-foot">
        <form method="get" action="#" class="header-foot-searchForm">
            <input type="text" size="25" placeholder="キーワードを入力">
            <input type="submit" value="&#xf002">
        </form>
        <a href="#" class="header-foot-item">
            <img class="item-img"
                src="<?php echo get_template_directory_uri(); ?>/assets/img/signout.svg"
                alt="サインアウト">
            <div class="item-text">ログイン</div>
        </a>
        <a href="<?php echo home_url(); ?>/my-account"
            class="header-foot-item">
            <img class="item-img"
                src="<?php echo get_template_directory_uri(); ?>/assets/img/user.svg"
                alt="マイページ">
            <div class="item-text">マイページ</div>
        </a>
        <a href="<?php echo home_url(); ?>/cart"
            class="header-foot-item">
            <img class="item-img"
                src="<?php echo get_template_directory_uri(); ?>/assets/img/cart.svg"
                alt="カート">
            <div class="item-text">カート</div>
        </a>
    </div>

</header>