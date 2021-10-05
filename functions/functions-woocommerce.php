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
 * WooCommerce商品一覧のお買い物カゴボタンを非表示
 */
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);


/**
 * アカウントページのメニューをカスタマイズ
 */
add_filter('woocommerce_account_menu_items', function ($menus) {
    // $menusを知りたかったら、下の行をコメントアウトを外してください。
    //var_dump($menus);

    // メニュー情報を変更
    $menus = [
        'orders'             => '購入履歴',
        'edit-address'       => '住所',
        'edit-account'       => 'お客様情報',
        'payment-methods'    => '決済方法',
        'customer-logout'    => 'ログアウト',
    ];
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
        $translated_text = 'お買い物カゴを更新';
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
 * squareプラグイン読み込み時（？）に「注文する」ボタンのテキストを変更　
 * ※注）一般的なやり方だと、一時的に変更されるが、squareの情報を読み込む段階でもとに戻ってしまう
 */
function custom_available_payment_gateways($payment) {
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


/**
 * お買い物カゴページの送料表記を非表示
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


/**
 * 注文画面にカナを表示
 */
function my_custom_checkout_field_display_admin_order_meta($order)
{
    echo '<p><strong>'.__('姓カナ').':</strong> ' . get_post_meta($order->get_id(), '_billing_kana_first_name', true) . '</p>';
}
// add_action('woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1);


/**
 * 個別販売のチェックを自動化
 */
function my_woocommerce_product_options_sold_individually()
{
    ?>
<script>
    jQuery("#_sold_individually").prop("checked", true);
</script>
<?php
}
add_action('woocommerce_product_options_sold_individually', 'my_woocommerce_product_options_sold_individually');


/**
 * 在庫管理のチェックをデフォルトでTrue
 */
function my_woocommerce_product_options_stock()
{
    ?>
<script>
    jQuery("#_manage_stock").prop("checked", true);
</script>
<?php
}
add_action('woocommerce_product_options_stock', 'my_woocommerce_product_options_stock');


/**
 * 在庫数の初期値を「１」に設定
 */
function my_woocommerce_product_options_stock_fields()
{
    ?>
<script>
    jQuery("#_stock").val(1);
</script>
<?php
}
add_action('woocommerce_product_options_stock_fields', 'my_woocommerce_product_options_stock_fields');


/**
 * 発送完了メールの追跡番号を追加
 */
function add_email_tracking_number($order)
{
    $order_data = $order->get_data();
    if ($order_data['status'] == 'completed') {
        $tracking_number = get_field("j_tracking_number");
        // $track_url = 'https://jizen.kuronekoyamato.co.jp/jizen/servlet/crjz.b.NQ0010?id=';  //ヤマト運輸のURL
        $track_url = 'https://trackings.post.japanpost.jp/services/srv/search/direct?locale=ja&reqCodeNo1='; //ゆうパックの追跡URL
        $company = get_field("j_tracking_company");
        echo '<h2>発送について</h2>
               <p>追跡番号：<a href="'. $track_url . $tracking_number.'">' . $tracking_number . '</a></p>
               <p>配送会社：' . $company . '</p>';
    }
}
add_action('woocommerce_email_order_meta', 'add_email_tracking_number', 10, 1);


/**
 * 注文メールの画像を表示
 */
function show_email_order_items_image($args)
{
    $args['show_image'] = true;
    $args['image_size'] = array( 32, 32 );
    return $args;
}
add_filter('woocommerce_email_order_items_args', 'show_email_order_items_image');


/**
 * 管理注文画面の請求先編集フォームに氏名カナを追加
 */
function add_woocommerce_admin_billing_fields($fields)
{
    $fields = array(
        'first_name' => array(
            'label' => __('First name', 'woocommerce'),
            'show'  => false,
        ),
        'last_name'  => array(
            'label' => __('Last name', 'woocommerce'),
            'show'  => false,
        ),
        'kana_first_name' => array(
            'label' => __('名カナ', 'woocommerce'),
            'show'  => false,
            'class' => '_billing_first_name_field',
        ),
        'kana_last_name'  => array(
            'label' => __('姓カナ', 'woocommerce'),
            'show'  => false,
            'class' => '_billing_last_name_field',
        ),
        'company'    => array(
            'label' => __('Company', 'woocommerce'),
            'show'  => false,
        ),
        'address_1'  => array(
            'label' => __('Address line 1', 'woocommerce'),
            'show'  => false,
        ),
        'address_2'  => array(
            'label' => __('Address line 2', 'woocommerce'),
            'show'  => false,
        ),
        'city'       => array(
            'label' => __('City', 'woocommerce'),
            'show'  => false,
        ),
        'postcode'   => array(
            'label' => __('Postcode / ZIP', 'woocommerce'),
            'show'  => false,
        ),
        'country'    => array(
            'label'   => __('Country / Region', 'woocommerce'),
            'show'    => false,
            'class'   => 'js_field-country select short',
            'type'    => 'select',
            'options' => array( '' => __('Select a country / region&hellip;', 'woocommerce') ) + WC()->countries->get_allowed_countries(),
        ),
        'state'      => array(
            'label' => __('State / County', 'woocommerce'),
            'class' => 'js_field-state select short',
            'show'  => false,
        ),
        'email'      => array(
            'label' => __('Email address', 'woocommerce'),
        ),
        'phone'      => array(
            'label' => __('Phone', 'woocommerce'),
        ),
    );
    return $fields;
}
add_filter('woocommerce_admin_billing_fields', 'add_woocommerce_admin_billing_fields');

/**
 * 注文画面のお客様情報のクラスを追加
 */
function add_class_admin_billing_fields()
{
    ?>
<script>
    jQuery("._billing_kana_first_name_field").addClass("_billing_first_name_field");
    jQuery("._billing_kana_last_name_field").addClass("_billing_last_name_field");
    // jQuery("._billing_kana_first_name_field").removeClass("_billing_kana_first_name_field");
    // jQuery("._billing_kana_last_name_field").removeClass("_billing_kana_last_name_field");
</script>
<?php
}
add_action('woocommerce_admin_order_data_after_billing_address', 'add_class_admin_billing_fields');


function custom_woocommerce_get_order_address($data)
{
    // var_dump($data);
    // $data['first_name']
    // echo 'custom_woocommerce_get_order_address';
    // clog($data);
    // $data = array(
    //     'first_name' => '',
    //     'last_name'  => '',
    //     'kana_first_name' => '',
    //     'kana_last_name' => '',
    //     'company'    => '',
    //     'address_1'  => '',
    //     'address_2'  => '',
    //     'city'       => '',
    //     'state'      => '',
    //     'postcode'   => '',
    //     'country'    => '',
    //     'email'      => '',
    //     'phone'      => '',
    // );
    return $data;
}
add_filter('woocommerce_get_order_address', 'custom_woocommerce_get_order_address');
