<?php

/**
 * squareプラグイン読み込み時（？）に「注文する」ボタンのテキストを変更
 * ※注）一般的なやり方だと、一時的に変更されるが、squareの情報を読み込む段階でもとに戻ってしまう
 */
function custom_available_payment_gateways($payment)
{
    if ($payment) {
        // var_dump($payment);
        $payment['square_credit_card']->order_button_text = '注文を確定する';
    } else {
        // echo 'empty';
    }
    return $payment;
}
add_filter('woocommerce_available_payment_gateways', 'custom_available_payment_gateways', 100);

//------------------- これまでの試行錯誤（忘備録） ---------------------
// function my_custom_place_order_text( $input ) {
//     $my_custom_text = "Custom Text";
//     return $my_custom_text;
// }
// add_filter( 'woocommerce_order_button_text', 'my_custom_place_order_text', 10, 2 );
// add_filter( 'wc_payment_gateway_square_credit_card_order_button_text', 'my_custom_place_order_text', 10, 2 );

// add_action('wp_enqueue_scripts', 'override_woo_frontend_scripts');
// function override_woo_frontend_scripts() {
//     wp_deregister_script('wc-checkout');
//     wp_enqueue_script('wc-checkout', get_template_directory_uri() . '/../storefront-child-theme-master/woocommerce/checkout.js', array('jquery', 'woocommerce', 'wc-country-select', 'wc-address-i18n'), null, true);
// }

// function my_woocommerce_order_button_html($order_button_html)
// {
//     $order_button_html = '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="注文を確定する" data-value="注文を確定する">注文を確定する</button>';
//     return $order_button_html;
// }
// add_filter('woocommerce_order_button_html', 'my_woocommerce_order_button_html');

// function my_woocommerce_order_button_text($order_button_text)
// {
//     $order_button_text = '注文を確定する';
//     return $order_button_text;
// }
// add_filter('woocommerce_order_button_text', 'my_woocommerce_order_button_text');
// -----------------------------------------------------------------------------------------------------------------



// woocomerceの注文フォームのplaceholder, class名の変更と
// 必要な入力フォーム（名前のフリガナ）の追加
function custom_override_checkout_fields($fields)
{
    //placeholder, class名の変更
    $fields['billing']['billing_last_name']['placeholder'] = '山田';
    $fields['billing']['billing_last_name']['class'] = ['col', 'col-6'];
    $fields['billing']['billing_first_name']['placeholder'] = '太郎';
    $fields['billing']['billing_first_name']['class'] = ['col', 'col-6'];
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
    $fields['billing']['billing_kana_last_name'] = [
    'label'     => __('セイ', 'woocommerce'),
    'placeholder'   => _x('ヤマダ', 'placeholder', 'woocommerce'),
    'required'  => true,
    'class'     => ['col', 'col-6'],
    'clear'     => true];
    $fields['billing']['billing_kana_first_name'] = [
    'label'     => __('ナマエ', 'woocommerce'),
    'placeholder'   => _x('タロウ', 'placeholder', 'woocommerce'),
    'required'  => true,
    'class'     => ['col', 'col-6'],
    'clear'     => true];

    $fields['shipping']['shipping_last_name']['placeholder'] = '山田';
    $fields['shipping']['shipping_last_name']['class'] = ['col', 'col-6'];
    $fields['shipping']['shipping_first_name']['placeholder'] = '太郎';
    $fields['shipping']['shipping_first_name']['class'] = ['col', 'col-6'];
    $fields['shipping']['shipping_address_1']['placeholder'] = '2-3-11';
    $fields['shipping']['shipping_address_2']['placeholder'] = 'アパート名、棟名、部屋番号など（オプション）';
    $fields['shipping']['shipping_address_2']['required'] = false;
    $fields['shipping']['shipping_city']['placeholder'] = '東京都錦町';
    $fields['shipping']['shipping_postcode']['placeholder'] = '123-4567';
    $fields['shipping']['shipping_postcode']['class'] = ['col', 'col-6'];
    $fields['shipping']['shipping_country']['placeholder'] = '日本';
    $fields['shipping']['shipping_state']['placeholder'] = '東京都';
    $fields['shipping']['shipping_state']['class'] = ['col', 'col-6'];
    $fields['shipping']['shipping_email']['placeholder'] = 'tarou@gmail.com';

    //入力フォームの追加
    $fields['shipping']['shipping_kana_last_name'] = [
    'label'     => __('セイ', 'woocommerce'),
    'placeholder'   => _x('ヤマダ', 'placeholder', 'woocommerce'),
    'required'  => true,
    'class'     => ['col', 'col-6'],
    'clear'     => true];
    $fields['shipping']['shipping_kana_first_name'] = [
    'label'     => __('ナマエ', 'woocommerce'),
    'placeholder'   => _x('タロウ', 'placeholder', 'woocommerce'),
    'required'  => true,
    'class'     => ['col', 'col-6'],
    'clear'     => true];

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields', 12);