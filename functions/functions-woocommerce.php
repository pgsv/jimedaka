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



// function misha_remove_fields($fields)
// {
//     echo 'misha_remove_fields';
//     unset($fields[ 'address_2' ]);
//     return $fields;
// }
// add_filter('woocommerce_default_address_fields', 'misha_remove_fields');

/**
 * 翻訳テキストを変更
 */
function my_gettext($translated_text, $text, $domain)
{
    if ($translated_text =='お買い物カゴを更新' && $domain == 'woocommerce') {
        $translated_text = 'カートを更新';
    }
    if ($translated_text =='お買い物カゴの合計' && $domain == 'woocommerce') {
        $translated_text = 'ご請求金額';
    }
    if ($translated_text =='お支払いへ進む' && $domain == 'woocommerce') {
        $translated_text = '購入手続きへ進む';
    }
    if ($translated_text =='注文する' && $domain == 'woocommerce') {
        $translated_text = '注文を確定する';
    }
    return $translated_text;
}
add_filter('gettext', 'my_gettext', 10, 3);

/**
 * カートページの送料表記を非表示
 */
function disable_shipping_calc_on_cart($show_shipping)
{
    if (is_cart()) {
        return false;
    }
    return $show_shipping;
}
add_filter('woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99);
