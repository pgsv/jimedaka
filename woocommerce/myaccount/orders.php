<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>
	<?php
	foreach ( $customer_orders->orders as $customer_order ) {
		$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		$item_count = $order->get_item_count() - $order->get_item_count_refunded();
		?>

		<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
			<tbody>
				<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order">
				<td colspan="2">
					<a href="' . esc_url( $order->get_view_order_url() ) . '">
						<div class="order-number">注文番号：<?php echo esc_html( $order->get_order_number() ); ?></div>
						<div class="order-date">注文日：<time datetime="' . esc_attr( $order->get_date_created()->date( 'c' ) ) . '"> <?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time></div>
					</a>
				</td>
				<td colspan="2">
					<div class="order-comment">（送料込み）</div>
					<div class="order-total">合計：<?php echo wp_kses_post( sprintf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ) ); ?></div>
				</tr>
				<?php
				// ここに商品情報を追加
				// do_action( 'woocommerce_order_details_after_order_table_row', $order );
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
					$product_url = get_permalink($product_id);
					?>
					<tr class="woocommerce-orders-table__row-order-detail">
						<td class="woocommerce-orders-table__cell-order-thumbnail"><img src="<?php echo $product_image_url; ?>"></div>
						<td class="woocommerce-orders-table__cell-order-name"><a href="<?php echo $product_url; ?>"> <?php echo $product_name; ?></a></div>
						<td class="woocommerce-orders-table__cell-order-price">￥<?php echo $product_price; ?> × <?php echo $product_quantity; ?></td>
						<td>
							<div class="order-status"><span><?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?></span></div>
							<?php
							$actions = wc_get_account_orders_actions( $order );

							if ( ! empty( $actions ) ) {
								foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
									?>
									<div class="order-actions">
										<a href="<?php echo esc_url( $action['url'] ); ?>" class="woocommerce-button button <?php echo sanitize_html_class( $key ); ?>">
											<?php echo esc_html( $action['name'] ); ?>
										</a>
									</div>
								<?php
								}
							}
							?>
						</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		<?php
	}
	?>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Browse products', 'woocommerce' ); ?></a>
		<?php esc_html_e( 'No order has been made yet.', 'woocommerce' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
