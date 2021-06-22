<!DOCTYPE html>
<html lang="ja">

<head>
    <title>MEDAKA</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/style.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <?php wp_head(); ?>
    <script>
        jQuery(function() {
            jQuery('a[href^="#"]').click(function() {
                var headerHeight = 30;
                var speed = 800;
                var href = jQuery(this).attr("href");
                var target = jQuery(href == "#" || href == "" ? 'html' : href);
                var position = target.offset().top - headerHeight;
                jQuery('body,html').animate({
                    scrollTop: position
                }, speed, 'swing');
                return false;
            });
        });
    </script>
</head>

<body>
    <header>
        <nav>
            <input id="menu" type="checkbox" />
            <label for="menu" class="back"></label>
            <div id="logo"><a
                    href="<?php echo home_url(); ?>">LOGO</a></div>
            <div class="nav-menu">
                <ul>
                    <li><a
                            href="<?php echo home_url(); ?>/product-list"><strong>商品一覧</strong></a>
                    </li>
                    <li><a href="#"><strong>お知らせ</strong></a></li>
                    <li><a href="#"><strong>ご利用案内</strong></a></li>
                    <li><a
                            href="<?php echo home_url(); ?>/contact"><strong>お問合せ</strong></a>
                    </li>
                </ul>
            </div>
            <div class="nav-icon">
                <ul>
                    <li><a href="#">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon_search.png"
                                alt="search">
                        </a></li>
                    <li><a
                            href="<?php echo home_url(); ?>/my-account/">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon_account.png"
                                alt="account">
                            <div>アカウント</div>
                        </a></li>
                    <li><a href="<?php echo home_url(); ?>/cart/">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon_cart.png"
                                alt="cart">
                            <div>カート</div>
                        </a></li>
                    <li class="icon_humburger"><a href="#"><label for="menu">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon_humburger.png"
                                    alt="humburger">
                            </label></a></li>
                </ul>
            </div>
            <div class="nav-category">
                <ul>
                    <li><a href="#">Ａ</a></li>
                    <li><a href="#">Ａ</a></li>
                    <li><a href="#">Ａ</a></li>
                    <li><a href="#">Ａ</a></li>
                    <li><a href="#">Ａ</a></li>
                </ul>
            </div>
        </nav>
    </header>