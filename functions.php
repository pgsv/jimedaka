<?php
// locate_template('functions_admin.php', true);
// require_once dirname(__FILE__) . '/functions_admin.php';
// include('C:\Users\user\Local Sites\medakashopping\app\public\wp-content\themes\mytemplate\functions\functions_debug.php');
// include(get_template_directory().'/functions/functions_products.php');
// include(get_template_directory().'/functions/functions_woocomerce.php');

/**
 * 投稿ラベルを「お知らせ」に変更
 */
function post_has_archive($args, $post_type)
{
    if ('post' == $post_type) {
        $args['rewrite'] = true;
        $args['has_archive'] = 'news';
        $args['label'] = 'お知らせ';
    }
    return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);

/**
 * カスタムフィールドを取得
 */
function get_custom_field($field_name, $page_slug)
{
    $page = get_page_by_path($page_slug);
    $id = $page->ID;
    return get_field_object($field_name, $id);
}


/**
 * WooCommerceの連携を有効化
 */
function woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'woocommerce_support');

/**
 * WooCommerceのcssを無効化
 */
add_filter('woocommerce_enqueue_styles', '__return_false');

/**
 * WooCommerce商品一覧のカートボタンを非表示
 */
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);



// Remove the first menu item (the dashboard)
add_filter('woocommerce_account_menu_items', 'account_menu_items_callback');
function account_menu_items_callback($items)
{
    foreach ($items as $key => $item) {
        unset($items[$key]);
        break;
    }
    return $items;
}

// Redirect default my account dashboard to the first my account enpoint (after dashboard)
add_action('template_redirect', 'template_redirect_callback');
function template_redirect_callback()
{
    if (is_account_page() && is_user_logged_in() && ! is_wc_endpoint_url()) {
        $first_myaccount_endpoint = 'orders';
        wp_redirect(wc_get_account_endpoint_url($first_myaccount_endpoint));
    }
}

/**
 * WooCommerceのサムネ画像を取得
 */
function get_wc_thumb_url($term_id)
{
    $thumb_id = get_woocommerce_term_meta($term_id, 'thumbnail_id', true);
    return wp_get_attachment_thumb_url($thumb_id);
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
    <?php clog($product_id); ?>
    <div class="prodPrice">￥<?php echo get_product_taxPrice($product_id); ?>円（税込）</div>
</a>
<?php
}

/**
 * 商品価格を取得
 */
function get_product_taxPrice($product_id)
{
    $price = get_post_meta($product_id, '_price', true);
    $taxRate = 1.1;
    $taxPrice = $price * $taxRate;
    if (! empty($taxPrice)) {
        return number_format($taxPrice);
    } else {
        return 0;
    }
}


add_action('woocommerce_after_add_to_cart_quantity', 'ts_quantity_plus_sign');

function ts_quantity_plus_sign()
{
    echo '<button type="button" class="plus" >+</button>';
}
add_action('woocommerce_before_add_to_cart_quantity', 'ts_quantity_minus_sign');

function ts_quantity_minus_sign()
{
    echo '<button type="button" class="minus" >-</button>';
}
add_action('wp_footer', 'ts_quantity_plus_minus');

function ts_quantity_plus_minus()
{
    // To run this on the single product page
    if (! is_product()) {
        return;
    } ?>

<script type="text/javascript">
    jQuery(document).ready(function($) {

        $('form.cart').on('click', 'button.plus, button.minus', function() {

            // Get current quantity values
            var qty = $(this).closest('form.cart').find('.qty');
            var val = parseFloat(qty.val());
            var max = parseFloat(qty.attr('max'));
            var min = parseFloat(qty.attr('min'));
            var step = parseFloat(qty.attr('step'));

            // Change the value if plus or minus
            if ($(this).is('.plus')) {
                if (max && (max <= val)) {
                    qty.val(max);
                } else {
                    qty.val(val + step);
                }
            } else {
                if (min && (min >= val)) {
                    qty.val(min);
                } else if (val > 1) {
                    qty.val(val - step);
                }
            }
        });
    });
</script>
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


/**
* 開発用デバッグを表示
*/
function debug_print()
{
    // echo "[get_theme_root] = " . get_theme_root();
  // echo '<br>';
  // echo "[get_stylesheet] = " . get_stylesheet();
  // echo "<br>";
  // echo "[get_stylesheet_directory_uri] = " . get_stylesheet_directory_uri();
}
add_action('wp_head', 'debug_print');

/**
 * コンソールログ表示
 */
function clog($data)
{
    echo '<script>';
    echo 'console.log('. json_encode($data) .')';
    echo '</script>';
}
