<?php get_header(); ?>
<div class="products">
    <?php include(dirname(__FILE__).'/../template-parts/product_aside.php'); ?>
    
    <?php
    $sortset = (string) filter_input(INPUT_GET, 'sort');
    if ($sortset === "") {
        $sortset = "category";
    } else {
        $sortset = (string) filter_input(INPUT_GET, 'sort');
    }
    ?>
    <?php switch ($sortset) :
    case ('category'): ?>
        <?php $product_ids = get_product_ids_by_cat(); ?>
        <?php break; ?>
    <?php case ('cheap'): ?>
        <?php $product_ids = get_product_ids_by_price('asc'); ?>
        <?php break; ?>
    <?php case ('expensive'): ?>
        <?php $product_ids = get_product_ids_by_price('desc'); ?>
        <?php break; ?>
    <?php endswitch; ?>
    
    <main class="products-list">
        <ul class="clearfix">
            <?php if ($product_ids): foreach ($product_ids as $product_id):?>
                <li class="sm-col sm-col-6 md-col-3 lg-col-3 pr2 pb2">
                    <?php the_product_link_html($product_id); ?>
                </li>   
            <?php endforeach; endif; ?>
        </ul>
    </main>
</div>
<?php get_footer();
