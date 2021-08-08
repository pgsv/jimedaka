<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
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
<div class="woocommerce-billing-fields">

	<?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>
	<?php $fields = $checkout->get_checkout_fields('billing');  ?>

	<div class="customFormWrapper">
		<div class="customFormWrapper-title">お客様情報の入力</div>
		<div class="customForm">
			<div class="customForm-head">お名前</div>
			<div class="customForm-body flex-col">
				<div class="flex-row">
					<?php woocommerce_form_field('billing_first_name', $fields['billing_first_name'], $checkout->get_value('billing_first_name')); ?>
					<?php woocommerce_form_field('billing_last_name', $fields['billing_last_name'], $checkout->get_value('billing_last_name')); ?>
				</div>
				<div class="flex-row kana_first_name">
					<?php woocommerce_form_field('billing_kana_first_name', $fields['billing_kana_first_name'], $checkout->get_value('billing_kana_first_name')); ?>
					<?php woocommerce_form_field('billing_kana_last_name', $fields['billing_kana_last_name'], $checkout->get_value('billing_kana_last_name')); ?>
				</div>
			</div>
		</div>
		<div class="customForm address">
			<div class="customForm-head">住所</div>
			<div class="customForm-body">
				<div class="flex-row">
					<?php woocommerce_form_field('billing_postcode', $fields['billing_postcode'], $checkout->get_value('billing_postcode')); ?>
					<?php woocommerce_form_field('billing_state', $fields['billing_state'], $checkout->get_value('billing_state')); ?>
					<?php woocommerce_form_field('billing_country', $fields['billing_country'], $checkout->get_value('billing_country')); ?>
				</div>

				<?php woocommerce_form_field('billing_city', $fields['billing_city'], $checkout->get_value('billing_city')); ?>
				<div class="flex-col">
					<?php woocommerce_form_field('billing_address_1', $fields['billing_address_1'], $checkout->get_value('billing_address_1')); ?>
					<?php woocommerce_form_field('billing_address_2', $fields['billing_address_2'], $checkout->get_value('billing_address_2')); ?>
				</div>
			</div>
		</div>
		<div class="customForm">
			<div class="customForm-head">電話番号</div>
			<div class="customForm-body">
				<?php woocommerce_form_field('billing_phone', $fields['billing_phone'], $checkout->get_value('billing_phone')); ?>
			</div>
		</div>
		<div class="customForm">
			<div class="customForm-head customFormHead">メール</div>
			<div class="customForm-body">
				<?php woocommerce_form_field('billing_email', $fields['billing_email'], $checkout->get_value('billing_email')); ?>
			</div>
		</div>
	</div>

	<?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>
</div>

<?php if (! is_user_logged_in() && $checkout->is_registration_enabled()) : ?>


<!--							『アカウントを作成しますか ?』の表示
							現時点では、アカウントを作れないのでコメントアウト
	------------------------------↓↓↓↓↓↓    START    ↓↓↓↓↓↓------------------------------ -->
<!-- <div class="woocommerce-account-fields">
	<?php if (! $checkout->is_registration_required()) : ?>

<p class="form-row form-row-wide create-account">
	<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
		<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount"
			<?php checked((true === $checkout->get_value('createaccount') || (true === apply_filters('woocommerce_create_account_default_checked', false))), true); ?>
		type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e('Create an account?', 'woocommerce'); ?></span>
	</label>
</p>

<?php endif; ?>

<?php do_action('woocommerce_before_checkout_registration_form', $checkout); ?>

<?php if ($checkout->get_checkout_fields('account')) : ?>

<div class="create-account">
	<?php foreach ($checkout->get_checkout_fields('account') as $key => $field) : ?>
	<?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
	<?php endforeach; ?>
	<div class="clear"></div>
</div>

<?php endif; ?>

<?php do_action('woocommerce_after_checkout_registration_form', $checkout); ?>
</div> -->
<!-- ------------------------------↑↑↑↑↑↑      END      ↑↑↑↑↑↑------------------------------ -->

<?php endif;
