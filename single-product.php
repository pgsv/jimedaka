<?php get_header(); ?>
<div class="singleProduct">
  <?php include('template-parts/product_aside.php'); ?>

  <main class="singleProduct-wrapper">
    <div class="singleProduct-left col-4">
      <?php if (have_posts()): while (have_posts()):the_post(); ?>
      <?php $product = wc_get_product(get_the_ID()); ?>
      <div class="singleProduct-left-img"
        style="background-image: url('<?php echo wp_get_attachment_thumb_url($product->image_id); ?>')">
      </div>
      <ul class="singleProduct-left-subImg">
        <?php foreach ($product->gallery_image_ids as $galleyId):
        $galleryThumbUrl = wp_get_attachment_thumb_url($galleyId); ?>
        <li>
          <div
            style="background-image: url('<?php echo $galleryThumbUrl; ?>')">
          </div>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>


    <div class="singleProduct-right col-8">
      <h1 class="singleProduct-right-head">
        <?php the_title(); ?>
      </h1>
      <div class="singleProduct-right-price">
        ￥<?php echo get_product_taxPrice(get_the_ID(), false); ?>円
        <span class="red">（税込）</span>
      </div>
      <div class="singleProduct-right-desc">
        <?php echo wc_get_product(get_the_ID())->description;?>
      </div>

      <?php
    if (! $product->is_purchasable()) {
        return;
    }
    echo wc_get_stock_html($product); // WPCS: XSS ok.
    if ($product->is_in_stock()) : ?>
      <?php do_action('woocommerce_before_add_to_cart_form'); ?>
      <form class="singleProductForm"
        action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
        method="post" enctype='multipart/form-data'>
        <?php do_action('woocommerce_before_add_to_cart_button'); ?>
        <div class="numberInput">
          <div class="numberInput-label">数量</div>
          <?php
          do_action('woocommerce_before_add_to_cart_quantity');
          woocommerce_quantity_input(
              [
                  'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                  'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                  'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
              ]
          );

          do_action('woocommerce_after_add_to_cart_quantity');
        ?>
        </div>
        <button class="singleProductForm-submitBtn" type="submit" name="add-to-cart"
          value="<?php echo esc_attr($product->get_id()); ?>"
          class="single_add_to_cart_button button alt">カートに入れる</button>
        <?php do_action('woocommerce_after_add_to_cart_button'); ?>
      </form>
      <?php do_action('woocommerce_after_add_to_cart_form'); ?>
      <?php endif; ?>
      <?php endwhile; endif; ?>
    </div>

  </main>
</div>
<?php get_footer();
