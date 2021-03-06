<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

if (! defined('ABSPATH')) {
    exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action('woocommerce_email_header', $email_heading, $email); ?>

<?php /* translators: %s: Customer first name */ ?>
<p><?php printf(esc_html__('Hi %s,', 'woocommerce'), esc_html($order->get_billing_last_name())); ?>
</p>
<p>この度は、「じめだか」をご利用いただきありがとうございました。<br>
    本日、ご注文の商品を発送しましたので、お知らせいたします。
</p>
<?php
// $order_data = $order->get_data();
// if ($order_data['status'] == 'completed') {
    // $tracking_number = get_field("j_tracking_number", $order_data['id']);
    $tracking_number = get_post_meta( $order->id, "j_tracking_number", true );
    // $track_url = 'https://jizen.kuronekoyamato.co.jp/jizen/servlet/crjz.b.NQ0010?id=';  //ヤマト運輸のURL
    $track_url = 'https://trackings.post.japanpost.jp/services/srv/search/direct?locale=ja&reqCodeNo1='; //ゆうパックの追跡URL
    // $company = get_field("j_tracking_company", $order_data['id']);
    $company = get_post_meta( $order->id, "j_tracking_company", true );
    ?>
    <h2 style="margin-top: 50px; color: #636363;">発送内容</h2>
    <div style="font-size: 15px; padding: 5px;">追跡番号：<a href="<?php echo $track_url . $tracking_number; ?>"><?php echo $tracking_number; ?></a></div>
    <div style="font-size: 15px; padding: 5px;">配送会社：<?php echo $company; ?></div>
    <p>※配送状況は、追跡番号リンクをクリックすることで、配送会社のサイトから確認することが可能です。</p>
    <?php 
// } ?>
<?php

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action('woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email);

/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
// do_action('woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email);

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action('woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email);

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ($additional_content) {
    echo wp_kses_post(wpautop(wptexturize($additional_content)));
}

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action('woocommerce_email_footer', $email);
