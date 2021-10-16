<style>
  * {
    min-height: 0;
    min-width: 0;
  }
</style>

<?php get_header(); ?>
<div class="singleProduct">
  <?php include('template-parts/product_aside.php'); ?>

  <main class="singleProduct-wrapper">
    <?php my_breadcrumbs(); ?>
    <div class="singleProduct-contents">
      <div class="singleProduct-left">
        <div class="smProductTitle">
          <h1 class="singleProduct-right-head">
            <?php the_title(); ?>
          </h1>
          <div class="singleProduct-right-price">
            ￥<?php echo get_product_taxPrice(get_the_ID(), false); ?>円
            <span class="red">（税込）</span>
          </div>
        </div>
        <?php if (have_posts()): while (have_posts()):the_post(); ?>
        <?php $_product = wc_get_product(get_the_ID()); ?>
        <ul class="singleProduct-left-subImg slider">
          <li>
            <div
              style="background-image: url('<?php echo wp_get_attachment_thumb_url($_product->image_id, 'thumbnail');?>')">
            </div>
          </li>
          <?php foreach ($_product->gallery_image_ids as $galleyId):
          $galleryThumbUrl = wp_get_attachment_thumb_url($galleyId); ?>
          <li>
            <div
              style="background-image: url('<?php echo $galleryThumbUrl; ?>')">
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
        <ul class="singleProduct-left-subImg thumb">
          <li>
            <div
              style="background-image: url('<?php echo wp_get_attachment_thumb_url($_product->image_id, 'thumbnail');?>')">
            </div>
          </li>
          <?php foreach ($_product->gallery_image_ids as $galleyId):
          $galleryThumbUrl = wp_get_attachment_thumb_url($galleyId); ?>
          <li>
            <div
              style="background-image: url('<?php echo $galleryThumbUrl; ?>')">
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="singleProduct-right">
        <div class="lgProductTitle">
          <h1 class="singleProduct-right-head">
            <?php the_title(); ?>
          </h1>
          <div class="singleProduct-right-price">
            ￥<?php echo get_product_taxPrice(get_the_ID(), false); ?>円
            <span class="red">（税込）</span>
          </div>
        </div>
        <div class="singleProduct-right-desc">
          <?php echo wc_get_product(get_the_ID())->description;?>
        </div>

        <?php
      if (! $_product->is_purchasable()) {
          return;
      }
      // 在庫の表示
      // echo wc_get_stock_html($_product); // WPCS: XSS ok.
      if ($_product->is_in_stock()) : ?>
        <?php do_action('woocommerce_before_add_to_cart_form'); ?>
        <form class="singleProductForm"
          action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $_product->get_permalink())); ?>"
          method="post" enctype='multipart/form-data'>
          <?php do_action('woocommerce_before_add_to_cart_button'); ?>
          <!--  個別販売の時は非表示 -->
          <?php if (! $_product->is_sold_individually()): ?>
          <div class="numberInput">
            <div class="numberInput-label">数量</div>
            <?php
              do_action('woocommerce_before_add_to_cart_quantity');
              woocommerce_quantity_input(
                  [
                      'min_value'   => apply_filters('woocommerce_quantity_input_min', $_product->get_min_purchase_quantity(), $_product),
                      'max_value'   => apply_filters('woocommerce_quantity_input_max', $_product->get_max_purchase_quantity(), $_product),
                      'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $_product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                  ]
              );

              do_action('woocommerce_after_add_to_cart_quantity');
            ?>
          </div>
          <?php endif; ?>
          <button class="singleProductForm-submitBtn" type="submit" name="add-to-cart"
            value="<?php echo esc_attr($_product->get_id()); ?>"
            class="single_add_to_cart_button button alt">お買い物カゴに入れる</button>
          <?php do_action('woocommerce_after_add_to_cart_button'); ?>
        </form>
        <?php do_action('woocommerce_after_add_to_cart_form'); ?>
        <?php endif; ?>
        <?php endwhile; endif; ?>
      </div>
    </div>
  </main>
</div>
<?php get_footer();
