<?php

/**
 * WooCommerceの連携を有効化
 */
function woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'woocommerce_support');

/**
 * WooCommerceのcssを無効化
 */
add_filter('woocommerce_enqueue_styles', '__return_false');

/**
 * WooCommerce商品一覧のカートボタンを非表示
 */
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);



// Remove the first menu item (the dashboard)
add_filter('woocommerce_account_menu_items', 'account_menu_items_callback');
function account_menu_items_callback($items)
{
    foreach ($items as $key => $item) {
        unset($items[$key]);
        break;
    }
    return $items;
}

// Redirect default my account dashboard to the first my account enpoint (after dashboard)
add_action('template_redirect', 'template_redirect_callback');
function template_redirect_callback()
{
    if (is_account_page() && is_user_logged_in() && ! is_wc_endpoint_url()) {
        $first_myaccount_endpoint = 'orders';
        wp_redirect(wc_get_account_endpoint_url($first_myaccount_endpoint));
    }
}


/**
 * 投稿ラベルを「お知らせ」に変更
 */
function post_has_archive($args, $post_type)
{
    if ('post' == $post_type) {
        $args['rewrite'] = true;
        $args['has_archive'] = 'news';
        $args['label'] = 'お知らせ';
    }
    return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);

/**
 * カスタムフィールドを取得
 */
function get_custom_field($field_name, $page_slug)
{
    $page = get_page_by_path($page_slug);
    $id = $page->ID;
    return get_field_object($field_name, $id);
}


function the_product_html($product_id)
{
    ?>
<a class="prod-link"
    href="<?php echo get_permalink($product_id); ?>">
    <div class="prod-img"><img
            src="<?php echo get_the_post_thumbnail_url($product_id, 'medium'); ?>"
            alt="<?php echo $product->slug ?>"></div>

    <div class="prod-titl"><?php echo get_the_title($product_id); ?>
    </div>
    <?php
    $price = get_post_meta($product_id, '_price', true);
    $taxRate = 1.1;
    $taxPrice = $price * $taxRate;
    if (! empty($taxPrice)) {
        $formatprice = number_format($taxPrice);
    } else {
        $formatprice = 0;
    } ?>
    <div class="prod-price">￥<?php echo $formatprice; ?>円（税込）</div>
</a>
<?php
}

/**
* 開発用デバッグを表示
*/
function debug_print()
{
    // echo "[get_theme_root] = " . get_theme_root();
  // echo '<br>';
  // echo "[get_stylesheet] = " . get_stylesheet();
  // echo "<br>";
  // echo "[get_stylesheet_directory_uri] = " . get_stylesheet_directory_uri();
}
add_action('wp_head', 'debug_print');

function clog($data)
{
    echo '<script>';
    echo 'console.log('. json_encode($data) .')';
    echo '</script>';
}
