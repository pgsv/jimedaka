<div class="sect_title"><h2>商品一覧</h2></div>
<?php 
$args = array(
	'type'        => 'post',
	'parent'      => 51,        // 親：medakaカテゴリ(51)
	'orderby'     => 'name',
	'order'       => 'ASC',
	'taxonomy'    => 'product_cat',
); 
$categories = get_categories( $args );
?>
<div class="product-items">
  <?php foreach($categories as $cat): ?>
    <?php
    $args = array(
      'post_type'   => 'product',
      'order'       => 'ASC',
      'product_cat' => $cat->slug
    );
    $products = get_posts( $args );
    ?>
    <?php if ( $products ): // 該当する投稿があったら ?>
      <span id="<?php echo $cat->slug; ?>" class="prod-cat-name"><h4><?php echo $cat->name; ?></h4></span>
      <ul>
      <?php foreach ( $products as $product ): ?>
        <?php setup_postdata( $product ); ?>
        <li>
          <a class="prod-link" href="<?php echo get_permalink($product->id); ?>">
            <!-- <div class="prod-img"><?php //echo get_the_post_thumbnail($product->id,'medium'); ?></div> -->
            <div class="prod-img"><img src="<?php echo get_the_post_thumbnail_url( $product->id, 'medium' ); ?>" alt="<?php echo $product->slug ?>"></div>

            <div class="prod-titl"><?php echo $product->name; ?></div>
            <?php
            $price = get_post_meta( $product->id, '_price', true );
            $taxRate = 1.1;
            $taxPrice = $price * $taxRate;
            //$taxPrice = $product->regular_price;
            //$price = wc_get_price_including_tax( $product, array('price' => $taxPrice )

            if(! empty($taxPrice)){
              $formatprice = number_format($taxPrice);  
            } else {
              $formatprice = 0;
            }
            ?>
            <div class="prod-price">￥<?php echo $formatprice; ?>円（税込）</div>
          </a>
          <!-- <div class="cart-btn"><a href="?add-to-cart= <?php //echo $product->id; ?> ">カートに追加</a></div> -->
        </li>
      <?php endforeach; ?>
      </ul>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
  <?php endforeach; ?>
</div>







<?php
/*
  $taxonomy_name = 'product_cat';
  $taxonomys = get_terms($taxonomy_name);
  if(!is_wp_error($taxonomys) && count($taxonomys)){
    echo '<ul>';
    foreach($taxonomys as $taxonomy){
      $tax_posts = get_posts(array('post_type' => get_post_type(), 'taxonomy' => $taxonomy_name, 'term' => $taxonomy->slug ) );
      echo '<li>' . $taxonomy->name . '</li>';

      echo '<ul>';
      foreach($tax_posts as $tax_post){
        echo '<li>アイテム</li>';
        echo '<li>' . $tax_post->name . '</li>';
      }
      echo '</ul>';
    }
    echo '</ul>';
  }

  */
 ?>




<?php
/*
  $taxonomyName = "product_cat";
  $prod_categories = get_terms($taxonomyName, array(
      'orderby'=> 'name',
      'order' => 'ASC',
      'hide_empty' => 1
  ));
  echo '<ul>';
  foreach( $prod_categories as $prod_cat ) {
    $cats_id = $prod_cat->cat_id;
    echo '<li>' . $cats_id . '</li>';
      //echo '<li>' . $prod_cat->term_id . '</li>';
      //echo '<li>' . $prod_cat->name . '</li>';


    //if(have_posts()) {
      //while (have_posts()) {
        //the_post();
        //echo '<li>' . get_the_title() . '</li>';
      //}
    //}
  }
  echo '</ul>';
  wp_reset_query();
*/
?>





<?php
  /*
  $params = array('post_type' => 'product');
  $wc_query = new WP_Query($params);

 if ($wc_query->have_posts()) {

   echo '<ul class="prod-ul">';
   while ($wc_query->have_posts()) {
    $wc_query->the_post();
    $thumbnail_id = get_post_thumbnail_id();
    $img = wp_get_attachment_image_src( $thumbnail_id , 'medium');

    echo '<li class="prod-list"><a class="prod-link" >'get_the_title();
    echo '<img src=' . $img[0] . '>';

     //do_action( 'woocommerce_product_meta_start' );
       //echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' );
       //echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' );
     //do_action( 'woocommerce_product_meta_end' );

   }
   echo "</ul>";
   wp_reset_postdata();
 }
 */
?>