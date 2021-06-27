<?php get_header(); ?>
<div class="wrap">
    <?php get_sidebar(); ?>
    <main>
        <div class="front_sldr"><?php echo do_shortcode('[smartslider3 slider=4]'); ?>
        </div>
        <?php include('template-parts/news.php'); ?>
        <div class="products">
            <ul>
                <?php for ($i = 1; $i <= 3; $i++) { ?>
                <li>
                    <?php
                    $field_medaka = get_custom_field('medaka_'.$i, 'custom-field');
                    $field_desc = get_custom_field('description_'.$i, 'custom-field');
                    the_product_html($field_medaka['value']->ID);
                    echo $field_desc['value'];?>
                </li>
                <?php } ?>
            </ul>
        </div>
        <section class="">
            <?php include('template-parts/products.php'); ?>
        </section>
    </main>
</div>
<?php get_footer();
