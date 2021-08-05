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

// woocomerceの注文フォームのplaceholder, class名の変更と
// 必要な入力フォーム（名前のフリガナ）の追加
function custom_override_checkout_fields($fields)
{
    //placeholder, class名の変更
    $fields['billing']['billing_first_name']['placeholder'] = '山田';
    $fields['billing']['billing_first_name']['class'] = ['col', 'col-6'];
    $fields['billing']['billing_last_name']['placeholder'] = '太郎';
    $fields['billing']['billing_last_name']['class'] = ['col', 'col-6'];
    $fields['billing']['billing_company']['placeholder'] = '株式会社ジメダカ';
    $fields['billing']['billing_address_1']['placeholder'] = '2-3-11';
    $fields['billing']['billing_address_2']['placeholder'] = 'アパート名、棟名、部屋番号など（オプション）';
    $fields['billing']['billing_address_2']['required'] = false;
    $fields['billing']['billing_city']['placeholder'] = '東京都錦町';
    $fields['billing']['billing_postcode']['placeholder'] = '123-4567';
    $fields['billing']['billing_postcode']['class'] = ['col', 'col-6'];
    $fields['billing']['billing_country']['placeholder'] = '日本';
    $fields['billing']['billing_state']['placeholder'] = '東京都';
    $fields['billing']['billing_state']['class'] = ['col', 'col-6'];
    $fields['billing']['billing_email']['placeholder'] = 'tarou@gmail.com';
    $fields['billing']['billing_phone']['placeholder'] = '000-000-0000';

    //入力フォームの追加
    $fields['billing']['billing_kana_first_name'] = [
    'label'     => __('セイ', 'woocommerce'),
    'placeholder'   => _x('ヤマダ', 'placeholder', 'woocommerce'),
    'required'  => true,
    'class'     => ['col', 'col-6'],
    'clear'     => true];
    $fields['billing']['billing_kana_last_name'] = [
    'label'     => __('ナマエ', 'woocommerce'),
    'placeholder'   => _x('タロウ', 'placeholder', 'woocommerce'),
    'required'  => true,
    'class'     => ['col', 'col-6'],
    'clear'     => true];

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields', 12);
