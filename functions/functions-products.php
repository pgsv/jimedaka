<?php

function get_product_ids_by_cat()
{
    $categories = get_medaka_categories();
    $product_ids = array();
    foreach ($categories as $cat) {
        $args = [
        'post_type'   => 'product',
        'order'       => 'ASC',
        'product_cat' => $cat->slug,
        ];
        $products = get_posts($args);
        if ($products) {
            foreach ($products as $product) {
                array_push($product_ids, $product->ID);
            }
        }
    }
    return $product_ids;
}

function get_product_ids_by_price($order)
{
    $args = [
    'post_type'     => 'product',
    'numberposts'   => -1,
    'orderby'       => 'meta_value_num',
    'order'         => $order,
    'meta_key'      => '_price',
    'post_status'   => 'publish',
    'fields'        => 'ids',
    ];
    return get_posts($args);
}

function get_star_rating()
{
    global $woocommerce, $product;

    $average      = $product->get_average_rating();
    $review_count = $product->get_review_count();

    return '<div class="star-rating">
                <span style="width:'.(($average / 5) * 100) . '%" title="'.
                  $average.'">
                    <strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__('out of 5', 'woocommerce').
                '</span>                    
            </div>'.'
            <a href="#reviews" class="woocommerce-review-link" rel="nofollow">( ' . $review_count .' )</a>';
}

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
    return  esc_url(home_url().'/products/#'.$cat_slug);
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



function the_product_link_html($product_id)
{
    $wc_product = wc_get_product($product_id);
    if (!$wc_product) {
        return;
    }
    $product_data = $wc_product->get_data();
    $category_id = $product_data['category_ids'][0];
    $product_cat = get_term_by('id', $category_id, 'product_cat'); ?>
<a href="<?php echo get_permalink($product_id); ?>">
    <div class="products-list-img"
        style="background-image : url(<?php echo get_the_post_thumbnail_url($product_id, 'medium'); ?>)"
        alt="<?php echo get_post($product_id)->post_name; ?>">

        <div class="products-list-category">
            <div id="<?php echo $product_cat->slug; ?>"
                class="products-list-head">
                <?php echo $product_cat->name; ?>
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

/**
 * 検索条件を追加
 */
function my_posts_search($search, $wp_query)
{
    // クエリを修正する条件
    if ($wp_query->is_main_query() && is_search() &&  !is_admin()) {
        // 検索結果に対して投稿ページのみとする条件を追加
        $search .= " AND post_type = 'product' ";
    }
    return $search;
}
add_filter('posts_search', 'my_posts_search', 99, 2);
