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
		<td width="15%" style="border-bottom: 1px solid #e9e9e9;border-top: 1px solid #e9e9e9;">
			<h2 style="color: #636363;">ご請求先</h2>
		</td>
		<td style="border-bottom: 1px solid #e9e9e9; border-top: 1px solid #e9e9e9; text-align:<?php echo esc_attr($text_align); ?>; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; padding:0;"
			valign="top" width="50%">
			<!-- <h2><?php //esc_html_e('Billing address', 'woocommerce'); ?>
			</h2> -->

			<address class="address" style="border:0;font-size: 14px;">
				<?php //echo wp_kses_post($address ? $address : esc_html__('N/A', 'woocommerce')); ?>
				<?php
				$billing_address = wp_kses_post($address ? $address : esc_html__('N/A', 'woocommerce'));  
				$billing_address = explode('<br />', $billing_address);
				echo $billing_address[3] . '<br />';
				echo $billing_address[0] . ' ' . $billing_address[1] . ' ' . $billing_address[2] . '<br />';
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
		<td width="15%" style="border-bottom: 1px solid #e9e9e9;">
			<h2 style="color: #636363;">お届け先</h2>
		</td>
		<td style="border-bottom: 1px solid #e9e9e9; text-align:<?php echo esc_attr($text_align); ?>; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; padding:0;"
			valign="top" width="50%">
			<!-- <h2><?php //esc_html_e('Shipping address', 'woocommerce'); ?>
			</h2> -->

			<address class="address" style="border:0; font-size: 14px;">
				<?php //echo wp_kses_post($shipping); ?>
				<?php
				$shipping_address = wp_kses_post($shipping);
				$shipping_address = explode('<br />', $shipping_address);
				echo $shipping_address[3] . '<br />';
				echo $shipping_address[0] . ' ' . $shipping_address[1] . ' ' . $shipping_address[2] . '<br />';
				?>
				<?php if ($order->get_shipping_phone()) : ?>
				<br /><?php echo wc_make_phone_clickable($order->get_shipping_phone()); ?>
				<?php endif; ?>
			</address>
		</td>
		<?php endif; ?>
	</tr>
</table>