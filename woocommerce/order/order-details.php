<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.6.0
 */

defined('ABSPATH') || exit;

$order = wc_get_order($order_id); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if (! $order) {
    return;
}

$order_items           = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));
$show_purchase_note    = $order->has_status(apply_filters('woocommerce_purchase_note_order_statuses', [ 'completed', 'processing' ]));
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ($show_downloads) {
    wc_get_template(
        'order/order-downloads.php',
        [
            'downloads'  => $downloads,
            'show_title' => true,
        ]
    );
}
?>
<section class="woocommerce-order-details">
	<?php do_action('woocommerce_order_details_before_order_table', $order); ?>

	<h2 class="woocommerce-order-details__title"><?php esc_html_e('Order details', 'woocommerce'); ?>
	</h2>

	<table class="reviewOrder woocommerce-table woocommerce-table--order-details shop_table order_details">
		<tbody>
			<tr class="order-details__order_number">
				<th>注文番号</th>
				<td><?php echo $order->get_order_number(); ?></td>
			</tr>
			<tr class="order-details__order_date">
				<th>注文日</th>
				<td><?php echo wc_format_datetime( $order->get_date_created() ); ?></td>
			</tr>
			<tr class="order-details__order_status">
				<th>注文状況</th>
				<td><?php echo wc_get_order_status_name( $order->get_status() ); ?></td>
			</tr>
			<?php
            do_action('woocommerce_order_details_before_order_table_items', $order);
			
			$item_cnt = count($order_items);
			$index_item = 0;

			foreach ($order_items as $item_id => $item) {
				++$index_item;
                $product = $item->get_product();

                wc_get_template(
                    'order/order-details-item.php',
                    [
                        'order'              => $order,
                        'item_id'            => $item_id,
                        'item'               => $item,
                        'show_purchase_note' => $show_purchase_note,
                        'purchase_note'      => $product ? $product->get_purchase_note() : '',
                        'product'            => $product,
						'index_item'		 => $index_item,
						'item_cnt'		 	 => $item_cnt,
                    ]
                );
            }

            do_action('woocommerce_order_details_after_order_table_items', $order);
            ?>
		</tbody>

		<tfoot>
			<?php
            foreach ($order->get_order_item_totals() as $key => $total) {
                ?>
			<tr>
				<th scope="row"><?php echo esc_html($total['label']); ?>
				</th>
				<td><?php echo ('payment_method' === $key) ? esc_html($total['value']) : wp_kses_post($total['value']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>
				</td>
			</tr>
			<?php
            }
            ?>
		</tfoot>
	</table>

	<?php //do_action('woocommerce_order_details_after_order_table', $order); ?>
</section>

<?php
/**
 * Action hook fired after the order details.
 *
 * @since 4.4.0
 * @param WC_Order $order Order data.
 */
do_action('woocommerce_after_order_details', $order);

if ($show_customer_details) {
    wc_get_template('order/order-details-customer.php', [ 'order' => $order ]);
}
