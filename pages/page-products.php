<?php get_header(); ?>
<div class="products">
    <?php include(dirname(__FILE__).'/../template-parts/product_aside.php'); ?>
    <main class="products-list">
        <ul class="clearfix">
            <?php $categories = get_medaka_categories(); ?>
            <?php foreach ($categories as $cat): ?>
            <?php
            $args = [
            'post_type'   => 'product',
            'order'       => 'ASC',
            'product_cat' => $cat->slug
            ];
            $products = get_posts($args);
        ?>
            <?php if ($products): // 該当する投稿があったら?>
            <?php foreach ($products as $product): ?>
            <?php setup_postdata($product); ?>
            <li class="sm-col sm-col-6 md-col-3 lg-col-3 pr2 pb2">
                <?php $product_id = $product->ID; ?>
                <a href="<?php echo get_permalink($product_id); ?>">
                    <div class="products-list-img"
                        style="background-image : url(<?php echo get_the_post_thumbnail_url($product_id, 'medium'); ?>)"
                        alt="<?php echo $product->slug ?>">

                        <div class="products-list-category">
                            <div id="<?php echo $cat->slug; ?>"
                                class="products-list-head">
                                <?php echo $cat->name; ?>
                            </div>
                        </div>

                        <div class="products-list-wrapper">
                            <div class="products-list-price">
                                ￥<?php echo get_product_taxPrice($product_id, false); ?>円（税込）
                            </div>
                            <div class="products-list-name">
                                <?php echo get_the_title($product_id); ?>
                            </div>

                        </div>
                    </div>

                </a>
            </li>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
            <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </main>
</div>
<?php get_footer();
