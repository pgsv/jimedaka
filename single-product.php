<style>
  /* slick sliderの表示崩れを解消するための裏技 */
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
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php $_product = wc_get_product(get_the_ID()); ?>
            <ul class="singleProduct-left-subImg slider">
              <li>
                <div style="background-image: url('<?php echo wp_get_attachment_thumb_url($_product->image_id, 'thumbnail'); ?>')">
                </div>
              </li>
              <?php foreach ($_product->gallery_image_ids as $galleyId) :
                $galleryThumbUrl = wp_get_attachment_thumb_url($galleyId); ?>
                <li>
                  <div style="background-image: url('<?php echo $galleryThumbUrl; ?>')">
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
            <ul class="singleProduct-left-subImg thumb">
              <li>
                <div style="background-image: url('<?php echo wp_get_attachment_thumb_url($_product->image_id, 'thumbnail'); ?>')">
                </div>
              </li>
              <?php foreach ($_product->gallery_image_ids as $galleyId) :
                $galleryThumbUrl = wp_get_attachment_thumb_url($galleyId); ?>
                <li>
                  <div style="background-image: url('<?php echo $galleryThumbUrl; ?>')">
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
      </div>

      <div class="singleProduct-right">
        <div class="product-title">
          <h1><?php the_title(); ?></h1>
        </div>

        <?php
            $product_data = $_product->get_data();
            // var_dump($product_data);
            $sale_price = $product_data['sale_price'];
            $before_price = wc_get_price_including_tax($_product, array('price' => $_product->get_regular_price()));
            $before_format_price = number_format($before_price);
            $status_tag = ($sale_price ? 'sale-tag' : 'regular-tag');
        ?>
        <span class="prod-item-thumb__tag <?php echo $status_tag; ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/sale.svg" alt="sale"></span>
        <div class="prod-price">
          <div class="prod-price__before <?php echo $status_tag; ?>">
            <span class="price-before">
              <?php
              echo '¥' . $before_format_price;
              ?>
            </span>
          </div>
          <div class="prod-price__after">
            <span class="price-arrow <?php echo $status_tag; ?>">
              →
            </span>
            <span class="price-after <?php echo ($sale_price ? 'price-sale' : 'price-regular'); ?>">
              <?php
              echo '¥' . get_product_taxPrice(get_the_ID(), false);
              ?>
            </span>
            <span class="price-tax">
              (税込)
            </span>
          </div>
        </div>

        <div class="product-desc">
          <?php echo wc_get_product(get_the_ID())->description; ?>
        </div>

        <?php
            if (!$_product->is_purchasable()) {
              return;
            }
            // 在庫の表示
            // echo wc_get_stock_html($_product); // WPCS: XSS ok.
            if ($_product->is_in_stock()) : ?>
          <?php do_action('woocommerce_before_add_to_cart_form'); ?>
          <form class="singleProductForm" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $_product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
            <?php do_action('woocommerce_before_add_to_cart_button'); ?>

            <!--  個別販売の時は非表示 -->
            <?php if (!$_product->is_sold_individually()) : ?>
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

            <button class="singleProductForm-submitBtn single_add_to_cart_button button alt" type="submit" name="add-to-cart" value="<?php echo esc_attr($_product->get_id()); ?>">
              <span style="background-image: url(<?php echo esc_url(get_template_directory_uri() . '/assets/img/cart3.svg'); ?>)"></span>
              お買い物カゴに入れる
            </button>

            <?php do_action('woocommerce_after_add_to_cart_button'); ?>
          </form>
          <?php do_action('woocommerce_after_add_to_cart_form'); ?>
        <?php endif; ?>
    <?php endwhile;
        endif; ?>
      </div>
    </div>
  </main>
</div>
<?php get_footer();
