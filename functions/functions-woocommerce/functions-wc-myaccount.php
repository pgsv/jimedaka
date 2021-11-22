<?php

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
 * マイページのダッシュボードを注文履歴ページにリダイレクト
 */
function redirect_to_orders_from_dashboard(){

	if( is_account_page() && empty( WC()->query->get_current_endpoint() ) ){
		wp_safe_redirect( wc_get_account_endpoint_url( 'orders' ) );
		exit;
	}

}
add_action('template_redirect', 'redirect_to_orders_from_dashboard' );


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
 * 購入履歴の商品情報を取得
 */
function add_order_details_after_order_table_row($order)
{
    $items = $order->get_items();
    foreach ( $items as $item ) {
        $product_name = $item['name'];
        $product_id = $item['product_id'];
        $product_variation_id = $item['variation_id'];
        $product_quantity = $item['qty'];
        $product_price = $item['line_total'];
        $product_tax = $item['line_tax'];
        $product_shipping = $item['line_total'];
        $product_shipping_tax = $item['line_tax'];
        $product_total = $item['line_total'] + $item['line_tax'];
    
        $product_image = wp_get_attachment_image_src( get_post_thumbnail_id($product_id), 'full' );
        $product_image_url = $product_image[0];
        // $product_image_url = str_replace( 'https://', 'http://', $product_image_url );
        
        $product_url = get_permalink($product_id);
        // $product_url = str_replace( 'https://', 'http://', $product_url );

        // echo '------------------- <br>';
        // echo 'product_name => ' . $product_name . '<br>';
        // echo 'product_id => ' . $product_id . '<br>';
        // echo 'product_variation_id => ' . $product_variation_id . '<br>';
        // echo 'product_quantity => ' . $product_quantity . '<br>';
        // echo 'product_price => ' . $product_price . '<br>';
        // echo 'product_tax => ' . $product_tax . '<br>';
        // echo 'product_shipping => ' . $product_shipping . '<br>';
        // echo 'product_shipping_tax => ' . $product_shipping_tax . '<br>';
        // echo 'product_total => ' . $product_total . '<br>';
        // echo 'product_image_url => ' . $product_image_url . '<br>';
        // echo 'product_url => ' . $product_url . '<br>';
        // echo '------------------- <br>';
        echo '<tr class="woocommerce-orders-table__row-order-detail">';
        echo '<td class="woocommerce-orders-table__cell-order-thumbnail"><img src="' . $product_image_url . '"></div>';
        echo '<td class="woocommerce-orders-table__cell-order-name" colspan="1"><a href="' . $product_url . '">' . $product_name . '</a></div>';
        echo '<td class="woocommerce-orders-table__cell-order-price" colspan="2">￥' . $product_price . ' × ' . $product_quantity . ' </td>';
        // echo '<td>数量：' . $product_quantity . '</td>';
        $actions = wc_get_account_orders_actions( $order );

        if ( ! empty( $actions ) ) {
            foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                echo '<td><a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a></td>';
            }
        }
        echo '</tr>';
    }
}
add_action('woocommerce_order_details_after_order_table_row', 'add_order_details_after_order_table_row');

function remove_my_account_my_orders_column_order_actions()
{
    // 何もしない
}
add_action('woocommerce_my_account_my_orders_column_order-actions', 'remove_my_account_my_orders_column_order_actions');