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


/**
 * アカウントページのメニューをカスタマイズ
 */
add_filter('woocommerce_account_menu_items', function ($menus) {
    // $menusを知りたかったら、下の行をコメントアウトを外してください。
    //var_dump($menus);

    // メニュー情報を変更
    $menus = array(
        'dashboard'          => 'マイページ',
        'orders'             => '購入履歴',
        'edit-address'       => '住所',
        'edit-account'       => 'お客様情報',
        'payment-methods'    => '決済方法',
        'customer-logout'    => 'ログアウト',
    );
    return $menus;
});

/**
 * ページタイトルの変更
 */
function my_the_title($title, $id)
{
    if (is_wc_endpoint_url('orders') && in_the_loop()) {
        $title = '購入履歴';
    } elseif (is_wc_endpoint_url('edit-account') && in_the_loop()) {
        $title = 'お客様情報';
    } elseif (is_wc_endpoint_url('edit-address') && in_the_loop()) {
        $title = '住所';
    } elseif (is_wc_endpoint_url('payment-methods') && in_the_loop()) {
        $title = '決済方法';
    } elseif (is_wc_endpoint_url('lost-password') && in_the_loop()) {
        $title = 'パスワードをお忘れの方';
    }
    return $title;
}
add_filter('the_title', 'my_the_title', 20, 2);


/**
 * WooCommerceのサムネ画像を取得
 */
function get_wc_thumb_url($term_id)
{
    $thumb_id = get_woocommerce_term_meta($term_id, 'thumbnail_id', true);
    return wp_get_attachment_thumb_url($thumb_id);
}


/**
 * 商品リンクのHTMLを表示
 */
function the_product_html($product_id)
{
    ?>
<a class="prodLink" href="<?php echo get_permalink($product_id); ?>">
    <div class="prodImg"><img
            src="<?php echo get_the_post_thumbnail_url($product_id, 'medium'); ?>"
            alt="<?php echo $product->slug ?>"></div>
    <div class="prodTitl"><?php echo get_the_title($product_id); ?>
    </div>
    <?php clog($product_id); ?>
    <div class="prodPrice">￥<?php echo get_product_taxPrice($product_id); ?>円（税込）</div>
</a>
<?php
}

/**
 * 商品価格を取得
 */
function get_product_taxPrice($product_id)
{
    $price = get_post_meta($product_id, '_price', true);
    $taxRate = 1.1;
    $taxPrice = $price * $taxRate;
    if (! empty($taxPrice)) {
        return number_format($taxPrice);
    } else {
        return 0;
    }
}


/**
 * メダカカテゴリーのURLを取得
 */
function get_medaka_cat_url($cat_slug)
{
    return  home_url()."/products/#".$cat_slug;
}

/**
 * メダカのカテゴリーリストを取得
 */
function get_medaka_categories()
{
    $args = array(
        'type'        => 'post',
        'parent'      => 51,        // 親：medakaカテゴリ(51)
        'orderby'     => 'name',
        'order'       => 'ASC',
        'taxonomy'    => 'product_cat',
    );
    return get_categories($args);
}

function wc_my_account_top()
{
    echo 'wc_my_account_top';
}
add_filter('woocommerce_my_account', 'wc_my_account_top', 100);






// Account Edit Adresses: Remove and reorder addresses fields
add_filter('woocommerce_default_address_fields', 'custom_default_address_fields', 10, 1);
function custom_default_address_fields($fields)
{
    // Only on account pages
    if (! is_account_page()) {
        return $fields;
    }
    // echo '--------------------------------------- $fields ------------------------------';
    // var_dump($fields);
    // echo 'custom_default_address_fields';
    ## ---- 1.  Remove 'address_2' field ---- ##

    unset($fields['address_2']);

    ## ---- 2.  Sort Address fields ---- ##

    // Set the order (sorting fields) in the array below
    $sorted_fields = array('first_name','last_name','company','address_1','country','postcode','city','state');

    $new_fields = array();
    $priority = 0;

    // Reordering billing and shipping fields
    foreach ($sorted_fields as $key_field) {
        $priority += 10;

        if ($key_field == 'company') {
            $priority += 20;
        } // keep space for email and phone fields

        $new_fields[$key_field] = $fields[$key_field];
        $new_fields[$key_field]['priority'] = $priority;
    }
    // echo '--------------------------------------- $new_fields ------------------------------';
    // var_dump($new_fields);
    return $new_fields;
}

// Account Edit Adresses: Reorder billing email and phone fields
add_filter('woocommerce_billing_fields', 'custom_billing_fields', 20, 1);
function custom_billing_fields($fields)
{
    // Only on account pages
    if (! is_account_page()) {
        return $fields;
    }

    ## ---- 2.  Sort billing email and phone fields ---- ##

    $fields['billing_email']['priority'] = 30;
    $fields['billing_email']['class'] = array('form-row-first');
    $fields['billing_phone']['priority'] = 40;
    $fields['billing_phone']['class'] = array('form-row-last');

    return $fields;
}

// Account Displayed Addresses : Remove 'address_2'
add_filter('woocommerce_my_account_my_address_formatted_address', 'my_account_address_formatted_addresses', 20, 3);
function my_account_address_formatted_addresses($address, $customer_id, $address_type)
{
    // echo 'my_account_address_formatted_addresses';
    unset($address['address_2']); // remove Address 2

    return $address;
}

// remove the filter
remove_filter('woocommerce_default_address_fields', 'filter_woocommerce_default_address_fields', 10, 1);
