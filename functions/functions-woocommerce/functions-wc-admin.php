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
    if ($translated_text =='表示' && $domain == 'woocommerce') {
        $translated_text = '詳細を表示';
    }
    return $translated_text;
}
add_filter('gettext', 'my_gettext', 10, 3);


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
    // jQuery("#_sold_individually").prop("checked", true);
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
    // jQuery("#_manage_stock").prop("checked", true);
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
    jQuery(function($) {
                var stock = $("#_stock").val();
                console.log('stock=>' + stock);
                if (stock == 0) {
                    $("#_stock").val(1);
                }
            }
</script>
<?php
}
add_action('woocommerce_product_options_stock_fields', 'my_woocommerce_product_options_stock_fields');


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