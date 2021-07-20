<?php get_header(); ?>
<div class="products">
    <aside class="products-aside">
        <div class="products-aside-cart">
            <div class="productsCart productsItem">
                <div class="productsCart-head">
                    買い物カゴ
                </div>
                <div class="productsCart-body">
                    <div>※ 現在カート内に商品はございません。</div>
                </div>
                <a href="<?php echo home_url(); ?>/cart"
                    class="productsCart-foot btn_stroke_beige">
                    <img src='<?php echo get_template_directory_uri(); ?>/assets/img/cart_beige.svg'
                        alt='カート'>
                    カートの詳細
                </a>
            </div>

            <a href="#" class="products-aside-all productsItem">
                全商品から探す
            </a>
            <a href="#" class="products-aside-recommend productsItem">
                おすすめ商品
            </a>
            <div class="productsSort productsItem">
                <div class="productsSort-head">
                    並び替え
                </div>
                <div class="productsSort-body">
                    <ul>
                        <li><a class="productsSOrt-body-link" href="#">カテゴリ順</a></li>
                        <li><a class="productsSOrt-body-link" href="#">人気順</a></li>
                        <li><a class="productsSOrt-body-link" href="#">安い順</a></li>
                        <li><a class="productsSOrt-body-link" href="#">高い順</a></li>
                        <li><a class="productsSOrt-body-link" href="#">飼育しやすい順</a></li>
                    </ul>
                </div>
            </div>
            <div class="productsSort productsItem">
                <div class="productsSort-head">
                    価格帯
                </div>
                <div class="productsSort-body">
                    <ul>
                        <li><a class="productsSOrt-body-link" href="#">〜1,000円</a></li>
                        <li><a class="productsSOrt-body-link" href="#">1,000円～1,500円</a></li>
                        <li><a class="productsSOrt-body-link" href="#">1,500円〜2,000円</a></li>
                        <li><a class="productsSOrt-body-link" href="#">2,000円〜3,000円</a></li>
                        <li><a class="productsSOrt-body-link" href="#">3,000円〜4,000円</a></li>
                        <li><a class="productsSOrt-body-link" href="#">4,000円〜</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
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
