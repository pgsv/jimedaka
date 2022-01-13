<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.6.0
 */

defined( 'ABSPATH' ) || exit;

$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<section class="woocommerce-customer-details">
	<h2>お客様情報</h2>
	<table>
		<tr class="order-detail__billing_address">
			<th>ご請求先</th>
			<td colspan="2">
				<address>
					<?php 
					
					// echo wp_kses_post( $order->get_formatted_billing_address( esc_html__( 'N/A', 'woocommerce' ) ) );
					$billing_address = wp_kses_post( $order->get_formatted_billing_address( esc_html__( 'N/A', 'woocommerce' ) ) );  
					$billing_address = explode('<br />', $billing_address);
					// var_dump($billing_address);
					echo $billing_address[4] . '<br />';
					echo $billing_address[0] . ' ' . $billing_address[1] . ' ' . $billing_address[2] . '<br />' . $billing_address[5] . '<br />';
					?>

					<?php if ( $order->get_billing_phone() ) : ?>
						<p class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_billing_phone() ); ?></p>
					<?php endif; ?>

					<?php if ( $order->get_billing_email() ) : ?>
						<p class="woocommerce-customer-details--email"><?php echo esc_html( $order->get_billing_email() ); ?></p>
					<?php endif; ?>
				</address>
			</td>
		</tr>
		<?php if ( $show_shipping ) : ?>
			<tr class="order-detail__shipping_address">
				<th>お届け先</th>
				<td colspan="2">
					<address>
						<?php 
						// echo wp_kses_post( $order->get_formatted_shipping_address( esc_html__( 'N/A', 'woocommerce' ) ) ); 
						$shipping_address = wp_kses_post( $order->get_formatted_shipping_address( esc_html__( 'N/A', 'woocommerce' ) ) );
						$shipping_address = explode('<br />', $shipping_address);
						echo $shipping_address[4] . '<br />';
						echo $shipping_address[0] . ' ' . $shipping_address[1] . ' ' . $shipping_address[2] . '<br />'  . $shipping_address[5] . '<br />';
						?>

						<?php if ( $order->get_shipping_phone() ) : ?>
							<p class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_shipping_phone() ); ?></p>
						<?php endif; ?>
					</address>
				</td>
			</tr>
		<?php endif; ?>

		<?php

		// お客様が選択した希望日時の値を取得
		$deliveryDate = get_post_meta($order->get_id(), "wc4jp-delivery-date", true);	// false=>配列で返す
		$deliveryTimeZone = get_post_meta($order->get_id(), "wc4jp-delivery-time-zone", true);	// false=>配列で返す
		?>
		<tr class="order-detail__delivery_date_and_time">
			<th>お届け予定日時</th>
			<td>
				<div><?php echo $deliveryDate ?: "指定日なし"; ?></div>
				<div><?php echo $deliveryTimeZone ?: "指定時間帯なし"; ?></div>
			</td>
		</tr>
		
		<?php if ($order->get_customer_note()) : ?>
			<tr>
				<th><?php esc_html_e('Note:', 'woocommerce'); ?>
				</th>
				<td><?php echo wp_kses_post(nl2br(wptexturize($order->get_customer_note()))); ?>
				</td>
			</tr>
		<?php endif; ?>
		
		<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

	</table>

</section>

