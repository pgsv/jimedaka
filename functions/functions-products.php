<?php

/**
 * メダカのカテゴリーリストを取得
 */
function get_medaka_categories()
{
    $args = [
        'type'        => 'post',
        'parent'      => 51,        // 親：medakaカテゴリ(51)
        'orderby'     => 'name',
        'order'       => 'ASC',
        'taxonomy'    => 'product_cat',
    ];
    return get_categories($args);
}

/**
 * メダカカテゴリーのURLを取得
 */
function get_medaka_cat_url($cat_slug)
{
    return  home_url().'/products/#'.$cat_slug;
}

/**
 * 商品リンクのHTMLを表示
 */
function the_product_html($product_id)
{
    ?>
<a class="prodLink" href="<?php echo get_permalink($product_id); ?>">
    <div class="prodImg"><img
            src="<?php echo get_the_post_thumbnail_url($product_id, 'medium'); ?>"
            alt="<?php echo $product->slug ?>"></div>
    <div class="prodTitl"><?php echo get_the_title($product_id); ?>
    </div>
    <div class="prodPrice">￥<?php echo get_product_taxPrice($product_id); ?>円（税込）</div>
</a>
<?php
}

/**
 * 商品価格を取得
 */
$num_to_kanji_dict = ['〇','一','二','三','四','五','六','七','八','九'];
function num_to_kanji($num)
{
    global $num_to_kanji_dict;
    if ($num != ',') {
        return $num_to_kanji_dict[(int) $num];
    } else {
        return '，';
    }
}

function get_product_taxPrice($product_id, $convert_kanji=true)
{
    $price = get_post_meta($product_id, '_price', true);
    if (! empty($price)) {
        $taxRate = 1.1;
        $taxPrice = $price * $taxRate;
        if ($convert_kanji) {
            $format_price = str_split(number_format($taxPrice));
            return implode(array_map('num_to_kanji', $format_price));
        } else {
            return number_format($taxPrice);
        }
    } else {
        return 0;
    }
}
