<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined('ABSPATH') || exit;
?>
<div class="woocommerce-shipping-fields">
	<?php if (true === WC()->cart->needs_shipping_address()) : ?>

	<div class="customFormWrapper shippingForm">
		<div class="customFormWrapper-title">お届け先について</div>
		<h3 id="ship-to-different-address">
			<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
				<input id="ship-to-different-address-checkbox"
					class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" <?php checked(apply_filters('woocommerce_ship_to_different_address_checked', 'shipping' === get_option('woocommerce_ship_to_destination') ? 1 : 0), 1); ?>
				type="checkbox" name="ship_to_different_address" value="1" /> <span><?php esc_html_e('Ship to a different address?', 'woocommerce'); ?></span>
			</label>
		</h3>

		<div class="shipping_address">
			<?php $fields = $checkout->get_checkout_fields('shipping');?>
			<?php do_action('woocommerce_before_checkout_shipping_form', $checkout); ?>

			<div class="customForm">
				<div class="customForm-head">お名前</div>
				<div class="customForm-body flex-col">
					<div class="flex-row">
						<?php woocommerce_form_field('shipping_last_name', $fields['shipping_last_name'], $checkout->get_value('shipping_last_name')); ?>
						<?php woocommerce_form_field('shipping_first_name', $fields['shipping_first_name'], $checkout->get_value('shipping_first_name')); ?>
					</div>
					<div class="flex-row kana_first_name">
						<?php woocommerce_form_field('shipping_kana_last_name', $fields['shipping_kana_last_name'], $checkout->get_value('shipping_kana_last_name')); ?>
						<?php woocommerce_form_field('shipping_kana_first_name', $fields['shipping_kana_first_name'], $checkout->get_value('shipping_kana_first_name')); ?>
					</div>
				</div>
			</div>
			<div class="customForm address">
				<div class="customForm-head">住所</div>
				<div class="customForm-body">
					<div class="flex-row">
						<?php woocommerce_form_field('shipping_postcode', $fields['shipping_postcode'], $checkout->get_value('shipping_postcode')); ?>
						<?php woocommerce_form_field('shipping_state', $fields['shipping_state'], $checkout->get_value('shipping_state')); ?>
						<?php woocommerce_form_field('shipping_country', $fields['shipping_country'], $checkout->get_value('shipping_country')); ?>
					</div>

					<?php woocommerce_form_field('shipping_city', $fields['shipping_city'], $checkout->get_value('shipping_city')); ?>
					<div class="flex-col">
						<?php woocommerce_form_field('shipping_address_1', $fields['shipping_address_1'], $checkout->get_value('shipping_address_1')); ?>
						<?php woocommerce_form_field('shipping_address_2', $fields['shipping_address_2'], $checkout->get_value('shipping_address_2')); ?>
					</div>
				</div>
			</div>
			<div class="customForm">
				<div class="customForm-head">電話番号</div>
				<div class="customForm-body">
					<?php woocommerce_form_field('shipping_phone', $fields['shipping_phone'], $checkout->get_value('shipping_phone')); ?>
				</div>
			</div>
			<?php do_action('woocommerce_after_checkout_shipping_form', $checkout); ?>
		</div>
	</div>

	<?php endif; ?>
</div>
<div class="shipping_order woocommerce-additional-fields customFormWrapper">
	<div class="shipping_order-date">
		<?php do_action('woocommerce_before_order_notes', $checkout); ?>
	</div>

	<?php if (apply_filters('woocommerce_enable_order_notes_field', 'yes' === get_option('woocommerce_enable_order_comments', 'yes'))) : ?>

	<?php if (! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only()) : ?>

	<h3><?php esc_html_e('Additional information', 'woocommerce'); ?>
	</h3>

	<?php endif; ?>

	<!-- <div class="shipping_order-comment woocommerce-additional-fields__field-wrapper">
		<?php //foreach ($checkout->get_checkout_fields('order') as $key => $field) : ?>
		<?php  //woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
		<?php //endforeach; ?>
	</div> -->

	<?php endif; ?>

	<?php do_action('woocommerce_after_order_notes', $checkout); ?>
</div>