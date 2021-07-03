<?php $categories = get_medaka_categories(); ?>
<div class="products">
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
    <li><?php the_product_html($product->ID); ?>
    </li>
    <?php endforeach; ?>
  </ul>
  <?php wp_reset_postdata(); ?>
  <?php endif; ?>
  <?php endforeach; ?>
</div>