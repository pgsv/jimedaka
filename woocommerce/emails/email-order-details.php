<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-details.php.
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

defined('ABSPATH') || exit;

$text_align = is_rtl() ? 'right' : 'left';

do_action('woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email); ?>

<h2 style="margin-top: 50px; color: #636363">ご注文内容</h2>
<?php
if ($sent_to_admin) {
	$before = '<a class="link" href="' . esc_url($order->get_edit_order_url()) . '">';
	$after  = '</a>';
} else {
	$before = '';
	$after  = '';
}
/* translators: %s: Order ID. */
// echo wp_kses_post($before . sprintf(__('[Order #%s]', 'woocommerce') . $after . ' (<time datetime="%s">%s</time>)', $order->get_order_number(), $order->get_date_created()->format('c'), wc_format_datetime($order->get_date_created())));
$order_number = wp_kses_post($before . $order->get_order_number() . $after);
$order_date = wp_kses_post(wc_format_datetime($order->get_date_created()));
?>
<div style="font-size: 15px; padding: 5px;">注文番号：#<?php echo wp_kses_post($order_number); ?></div>
<div style="font-size: 15px; padding: 5px; margin-bottom: 20px;">注文日時：<?php echo wp_kses_post($order_date); ?></div>


<div style="margin-bottom: 40px;">
	<table class="td" cellspacing="0" cellpadding="6"
		style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; border:0;border-collapse:collapse;">
		<!-- <colgroup>
			<col style="width: 20%;" />
			<col style="width: 20%;" />
			<col style="width: 20%;" />
			<col style="width: 15%;" />
			<col style="width: 25%;" />
  		</colgroup> -->
		<colgroup>
			<col style="width: 50%;" />
			<col style="width: 25%;" />
			<col style="width: 25%;" />
  		</colgroup>
		<tbody style="font-size: 16px; border-top: 1px solid #e9e9e9;">
			<?php
            echo wc_get_email_order_items( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                $order,
        		array(
                    'show_sku'      => $sent_to_admin,
                    'show_image'    => false,
                    'image_size'    => array( 32, 32 ),
                    'plain_text'    => $plain_text,
                    'sent_to_admin' => $sent_to_admin,
                )
    		);
            ?>
		</tbody>
		<tfoot style="font-size: 16px;">
			<?php
            $item_totals = $order->get_order_item_totals();

            if ($item_totals) {
                $i = 0;
                foreach ($item_totals as $total) {
                    $i++; ?>
						<tr>
							<th scope="row" colspan="2" style="text-align: right; padding: 5px;font-weight: initial;">
								<?php echo wp_kses_post($total['label']); ?>
							</th>
							<td style="text-align: right;<?php if($i===3) echo "font-size: 12px; padding: 5px;";?>">
								<?php echo wp_kses_post($total['value']); ?>
							</td>
						</tr>
				<?php
                }
            }
            if ($order->get_customer_note()) {
                ?>
				<!-- <tr>
					<th scope="row" style="text-align:<?php //echo esc_attr($text_align); ?>;">
						<?php //esc_html_e('Note:', 'woocommerce'); ?>
					</th>
					<td colspan="2" style="text-align:<?php //echo esc_attr($text_align); ?>;">
						<?php //echo wp_kses_post(nl2br(wptexturize($order->get_customer_note()))); ?>
					</td>
				</tr> -->
			<?php
            }
            ?>
		</tfoot>
	</table>
</div>

<?php do_action('woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email);
