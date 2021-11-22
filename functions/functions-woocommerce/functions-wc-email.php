<?php

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
// function show_email_order_items_image($args)
// {
//     $args['show_image'] = true;
//     $args['image_size'] = array( 80, 80 );
//     return $args;
// }
// add_filter('woocommerce_email_order_items_args', 'show_email_order_items_image');


/**
 * 注文メールの送料に付いてくる「定額送料として」のテキストを削除
 */
function delete_woocommerce_order_shipping_to_display_shipped_via($shipped_via)
{
    $shipped_via = "";
    return $shipped_via;
}
add_filter('woocommerce_order_shipping_to_display_shipped_via', 'delete_woocommerce_order_shipping_to_display_shipped_via');

/**
 * 注文メールの合計金額で「￥**　消費税を含む」のテキストを削除
 */
function hidden_woocommerce_get_formatted_order_total_tax_string($formatted_total, $order, $tax_display, $display_refunded)
{
    $formatted_total = wc_price( $order->get_total(), array( 'currency' => $order->get_currency() ) );
    $order_total     = $order->get_total();
    $total_refunded  = $order->get_total_refunded();
    $tax_string      = '';

    // Tax for inclusive prices.
    if ( wc_tax_enabled() && 'incl' === $tax_display ) {
        $tax_string_array = array();
        $tax_totals       = $order->get_tax_totals();

        if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
            foreach ( $tax_totals as $code => $tax ) {
                $tax_amount         = ( $total_refunded && $display_refunded ) ? wc_price( WC_Tax::round( $tax->amount - $order->get_total_tax_refunded_by_rate_id( $tax->rate_id ) ), array( 'currency' => $order->get_currency() ) ) : $tax->formatted_amount;
                $tax_string_array[] = sprintf( '%s %s', $tax_amount, $tax->label );
            }
        } elseif ( ! empty( $tax_totals ) ) {
            $tax_amount         = ( $total_refunded && $display_refunded ) ? $order->get_total_tax() - $order->get_total_tax_refunded() : $order->get_total_tax();
            $tax_string_array[] = sprintf( '%s %s', wc_price( $tax_amount, array( 'currency' => $order->get_currency() ) ), WC()->countries->tax_or_vat() );
        }

        if ( ! empty( $tax_string_array ) ) {
            /* translators: %s: taxes */
            //$tax_string = ' <small class="includes_tax">' . sprintf( __( '(includes %s)', 'woocommerce' ), implode( ', ', $tax_string_array ) ) . '</small>';
        }
    }

    if ( $total_refunded && $display_refunded ) {
        $formatted_total = '<del aria-hidden="true">' . wp_strip_all_tags( $formatted_total ) . '</del> <ins>' . wc_price( $order_total - $total_refunded, array( 'currency' => $order->get_currency() ) ) . $tax_string . '</ins>';
    } else {
        $formatted_total .= $tax_string;
    }
    return $formatted_total;
}
add_filter('woocommerce_get_formatted_order_total', 'hidden_woocommerce_get_formatted_order_total_tax_string', 20, 4);

/**
 * 注文メールの商品の数量に「数量」のテキストを追加
 */
function add_woocommerce_email_order_item_quantity_thead($qty_display, $item)
{
    $qty_display = "数量：" . $qty_display;
    return $qty_display;
}
add_filter('woocommerce_email_order_item_quantity', 'add_woocommerce_email_order_item_quantity_thead', 10, 2);


// function misha_remove_fields($fields)
// {
//     echo 'misha_remove_fields';
//     unset($fields[ 'address_2' ]);
//     return $fields;
// }
// add_filter('woocommerce_default_address_fields', 'misha_remove_fields');