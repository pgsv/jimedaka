<?php
/**
 * Email Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-addresses.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 5.6.0
 */

if (! defined('ABSPATH')) {
    exit;
}

$text_align = is_rtl() ? 'right' : 'left';
$address    = $order->get_formatted_billing_address();
$shipping   = $order->get_formatted_shipping_address();

?>
<table id="addresses" cellspacing="0" cellpadding="0"
	style="width: 100%; vertical-align: top; margin-bottom: 40px; padding:0;border:0;">
	<tr>
		<td width="20%" style="border-bottom: 1px solid #e9e9e9;border-top: 1px solid #e9e9e9; color: #636363">
			ご請求先
		</td>
		<td style="font-size: 14px; border-bottom: 1px solid #e9e9e9; border-top: 1px solid #e9e9e9; text-align:<?php echo esc_attr($text_align); ?>; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; padding:0;"
			valign="top">

			<address class="address" style="border:0;font-size: 14px;">
				<?php
				$billing_address = wp_kses_post($address ? $address : esc_html__('N/A', 'woocommerce'));  
				$billing_address = explode('<br />', $billing_address);
				echo $billing_address[3] . '<br />';
				echo $billing_address[0] . ' ' . $billing_address[1] . ' ' . $billing_address[2];
				?>
				<?php if ($order->get_billing_phone()) : ?>
				<br /><?php echo wc_make_phone_clickable($order->get_billing_phone()); ?>
				<?php endif; ?>
				<?php if ($order->get_billing_email()) : ?>
				<br /><?php echo esc_html($order->get_billing_email()); ?>
				<?php endif; ?>
			</address>
		</td>
	</tr>
	<tr>
		<?php if (! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && $shipping) : ?>
		<td style="border-bottom: 1px solid #e9e9e9; color: #636363">
			お届け先
		</td>
		<td style="font-size: 14px; border-bottom: 1px solid #e9e9e9; text-align:<?php echo esc_attr($text_align); ?>; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; padding:0;"
			valign="top">

			<address class="address" style="border:0; font-size: 14px;">
				<?php
				$shipping_address = wp_kses_post($shipping);
				$shipping_address = explode('<br />', $shipping_address);
				echo $shipping_address[3] . '<br />';
				echo $shipping_address[0] . ' ' . $shipping_address[1] . ' ' . $shipping_address[2];
				?>
				<?php if ($order->get_shipping_phone()) : ?>
				<br /><?php echo wc_make_phone_clickable($order->get_shipping_phone()); ?>
				<?php endif; ?>
			</address>
		</td>
		<?php endif; ?>
	</tr>
	<tr>
		<?php
		$delivery_date = get_post_meta($order->get_id(), 'wc4jp-delivery-date', true);
		$delivery_time = get_post_meta($order->get_id(), 'wc4jp-delivery-time-zone', true);
		$delivery_date_time = '<div>配達指定日：' . ($delivery_date ? $delivery_date : '指定なし') . '</div><div>配達時間帯：' . ($delivery_time ? $delivery_time : '指定なし') . '</div>';
		?>
		<td style="border-bottom: 1px solid #e9e9e9; margin:0; color: #636363">配達指定</td>
		<td style="padding: 12px;font-size: 14px;color: #636363; border-bottom: 1px solid #e9e9e9; text-align:<?php echo esc_attr($text_align); ?>; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;"><?php echo $delivery_date_time; ?></td>
	</tr>
</table>