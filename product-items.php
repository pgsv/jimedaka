<?php
$args = array(
    'type'        => 'post',
    'parent'      => 51,        // 親：medakaカテゴリ(51)
    'orderby'     => 'name',
    'order'       => 'ASC',
    'taxonomy'    => 'product_cat',
);
$categories = get_categories($args);
?>

<div class="sect_title">
  <h2>商品一覧</h2>
</div>
<div class="product-items">
  <?php foreach ($categories as $cat): ?>
  <?php
    $args = array(
      'post_type'   => 'product',
      'order'       => 'ASC',
      'product_cat' => $cat->slug
    );
    $products = get_posts($args);
    ?>
  <?php if ($products): // 該当する投稿があったら?>
  <span id="<?php echo $cat->slug; ?>" class="prod-cat-name">
    <h4><?php echo $cat->name; ?>
    </h4>
  </span>
  <ul>
    <?php foreach ($products as $product): ?>
    <?php setup_postdata($product); ?>
    <li>
      <a class="prod-link"
        href="<?php echo get_permalink($product->id); ?>">
        <div class="prod-img"><img
            src="<?php echo get_the_post_thumbnail_url($product->id, 'medium'); ?>"
            alt="<?php echo $product->slug ?>"></div>

        <div class="prod-titl"><?php echo $product->name; ?>
        </div>
        <?php
            $price = get_post_meta($product->id, '_price', true);
            $taxRate = 1.1;
            $taxPrice = $price * $taxRate;
            if (! empty($taxPrice)) {
                $formatprice = number_format($taxPrice);
            } else {
                $formatprice = 0;
            }
            ?>
        <div class="prod-price">￥<?php echo $formatprice; ?>円（税込）
        </div>
      </a>

    </li>
    <?php endforeach; ?>
  </ul>
  <?php wp_reset_postdata(); ?>
  <?php endif; ?>
  <?php endforeach; ?>
</div>