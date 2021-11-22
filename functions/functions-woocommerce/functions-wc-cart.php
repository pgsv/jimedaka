<?php

/**
 * お買い物カゴページの送料表記を非表示
 */
function disable_shipping_calc_on_cart($show_shipping)
{
    if (is_cart()) {
        return false;
    }
    return $show_shipping;
}
add_filter('woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99);


function my_woocommerce_after_cart()
{
    ?>
<script>
    jQuery('th.product-name').attr('colspan', 2);
</script>
<?php
}
add_action('woocommerce_after_cart', 'my_woocommerce_after_cart');