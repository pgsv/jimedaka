<?php get_header(); ?>
<div class="products">
    <?php include(dirname(__FILE__).'/../template-parts/product_aside.php'); ?>

    <?php
    $sortset = (string) filter_input(INPUT_GET, 'sort');
    if ($sortset === '') {
        $sortset = 'category';
    } else {
        $sortset = (string) filter_input(INPUT_GET, 'sort');
    }
    ?>
    <?php
    switch ($sortset) :
        case ('category'):
            $product_ids = get_product_ids_by_cat();
            break;
        case ('cheap'):
            $product_ids = get_product_ids_by_price('asc');
            break;
        case ('expensive'):
            $product_ids = get_product_ids_by_price('desc');
            break;
        default:
            $array_price = explode('_', $sortset);
            $product_ids = get_product_ids_between_price($array_price[0], $array_price[1]);
    endswitch;
    ?>

    <main class="products-list">
        <ul class="clearfix">
            <?php
            if ($product_ids): foreach ($product_ids as $product_id):
            $_product = wc_get_product($product_id);
            if ($_product->is_in_stock()) :
            ?>
            <li class="products-list-item">
                <?php the_product_link_html($product_id); ?>
            </li>
            <?php endif; endforeach; endif; ?>
        </ul>
    </main>
</div>
<?php get_footer();
