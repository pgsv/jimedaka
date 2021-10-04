<?php get_header(); ?>
<main>
  <?php if (have_posts()): while (have_posts()):the_post(); ?>
  <div class="myaccount-title">
    <h1><?php the_title();?>
    </h1>
  </div>
  <div class="myAccount-contents">
    <?php the_content(); ?>
  </div>
  <?php endwhile; endif; ?>
</main>

<?php
// get the user meta
$userMeta = get_user_meta(get_current_user_id());

// get the form fields
$countries = new WC_Countries();
$billing_fields = $countries->get_address_fields('', 'billing_');
$shipping_fields = $countries->get_address_fields('', 'shipping_');
?>

<!-- billing form -->
<?php
$load_address = 'billing';
$page_title   = __('Billing Address', 'woocommerce');
?>
<form action="/my-account/edit-address/billing/" class="edit-account" method="post">

  <h2><?php echo apply_filters('woocommerce_my_account_edit_address_title', $page_title); ?>
  </h2>

  <?php do_action("woocommerce_before_edit_address_form_{$load_address}"); ?>

  <?php foreach ($billing_fields as $key => $field) : ?>

  <?php woocommerce_form_field($key, $field, $userMeta[$key][0]); ?>

  <?php endforeach; ?>

  <?php do_action("woocommerce_after_edit_address_form_{$load_address}"); ?>

  <p>
    <input type="submit" class="button" name="save_address"
      value="<?php esc_attr_e('Save Address', 'woocommerce'); ?>" />
    <?php wp_nonce_field('woocommerce-edit_address'); ?>
    <input type="hidden" name="action" value="edit_address" />
  </p>
</form>

<!-- shipping form -->
<?php
$load_address = 'shipping';
$page_title   = __('Shipping Address', 'woocommerce');
?>
<form action="/my-account/edit-address/shipping/" class="edit-account" method="post">

  <h2><?php echo apply_filters('woocommerce_my_account_edit_address_title', $page_title); ?>
  </h2>

  <?php do_action("woocommerce_before_edit_address_form_{$load_address}"); ?>

  <?php foreach ($shipping_fields as $key => $field) : ?>

  <?php woocommerce_form_field($key, $field, $userMeta[$key][0]); ?>

  <?php endforeach; ?>

  <?php do_action("woocommerce_after_edit_address_form_{$load_address}"); ?>

  <p>
    <input type="submit" class="button" name="save_address"
      value="<?php esc_attr_e('Save Address', 'woocommerce'); ?>" />
    <?php wp_nonce_field('woocommerce-edit_address'); ?>
    <input type="hidden" name="action" value="edit_address" />
  </p>

</form>
Sha
<?php get_footer();
