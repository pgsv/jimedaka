<?php get_header(); ?>
<div class="wrap">
    <main>
        <div class="top">
            <div class="top-left">
                <?php include("template-parts/categories.php"); ?>
            </div>
            <div class="top-right">
                <div class="top-right-slider"><?php echo do_shortcode('[smartslider3 slider=4]'); ?>
                </div>
                <div class="top-right-news"><?php include('template-parts/news.php'); ?>
                </div>
            </div>
        </div>
        <h2>当店一押しのメダカ</h2>
        <div class="prod-pickup">
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
        <h2>メダカの飼育環境について</h2>
    </main>
</div>
<?php get_footer();
