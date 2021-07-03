<?php
/**
 * 商品リンクのHTMLを表示
 */
function the_product_html($product_id)
{
    ?>
<a class="prod-link"
    href="<?php echo get_permalink($product_id); ?>">
    <div class="prod-img"><img
            src="<?php echo get_the_post_thumbnail_url($product_id, 'medium'); ?>"
            alt="<?php echo $product->slug ?>"></div>

    <div class="prod-titl"><?php echo get_the_title($product_id); ?>
    </div>
    <?php
    $price = get_post_meta($product_id, '_price', true);
    $taxRate = 1.1;
    $taxPrice = $price * $taxRate;
    if (! empty($taxPrice)) {
        $formatprice = number_format($taxPrice);
    } else {
        $formatprice = 0;
    } ?>
    <div class="prod-price">￥<?php echo $formatprice; ?>円（税込）</div>
</a>
<?php
}

/**
 * メダカカテゴリーのURLを取得
 */
function get_medaka_cat_url($cat_slug)
{
    return  home_url()."/products/#".$cat_slug;
}

/**
 * メダカのカテゴリーリストを取得
 */
function get_medaka_categories()
{
    $args = array(
        'type'        => 'post',
        'parent'      => 51,        // 親：medakaカテゴリ(51)
        'orderby'     => 'name',
        'order'       => 'ASC',
        'taxonomy'    => 'product_cat',
    );
    return get_categories($args);
}
