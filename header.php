<!DOCTYPE html>
<html lang="ja">

<head>
    <title>MEDAKA</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/style.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script type="text/javascript" charset="UTF-8"
        src="<?php bloginfo('template_url'); ?>/js/common.js">
    </script>
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
    <?php //wp_nav_menu(array(
                    // 'theme_location'    => 'header',
                    // 'container_class'   => 'nav-menu',
                    // 'container_id'      => 'nav-header',
                    // 'items_wrap'        => '<ul>%3$s</ul>'
                    //));
 ?>
    <header>
        <!-- <label for="menu" class="open">🍔</label> -->
        <!-- <label for="menu" class="close">×</label> -->
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
                            <!-- <i class="fas fa-search fa-2x"></i> -->
                            <img src="<?php bloginfo('template_url'); ?>/images/icon_search.png"
                                alt="search">
                        </a></li>
                    <li><a
                            href="<?php echo home_url(); ?>/my-account/">
                            <!-- <i class="fas fa-user fa-2x"></i> -->
                            <img src="<?php bloginfo('template_url'); ?>/images/icon_account.png"
                                alt="account">
                            <div>アカウント</div>
                        </a></li>
                    <li><a href="<?php echo home_url(); ?>/cart/">
                            <!-- <i class="fas fa-shopping-cart fa-2x"></i> -->
                            <img src="<?php bloginfo('template_url'); ?>/images/icon_cart.png"
                                alt="cart">
                            <div>カート</div>
                        </a></li>
                    <!-- <li><a href="#"><label for="menu"><i class="fas fa-bars fa-2x"></i></label></a></li> -->
                    <li class="icon_humburger"><a href="#"><label for="menu">
                                <img src="<?php bloginfo('template_url'); ?>/images/icon_humburger.png"
                                    alt="humburger">
                            </label></a></li>
                </ul>
            </div>

            <!-- <input type="search" name="search" placeholder="キーワードを入力">
            <input type="submit" name="submit" value="検索"> -->
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