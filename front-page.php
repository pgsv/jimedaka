<?php get_header(); ?>
    <div class="wrap">
        <?php get_sidebar(); ?>
        <main>
            <div class="front_sldr"><?php echo do_shortcode('[smartslider3 slider=4]'); ?></div>
            <?php include('newslist.php'); ?>
            <section class="">
                <?php include('product-items.php'); ?>
                <?php //include('test.php'); ?>
            </section>        
        </main>
    </div>
<?php get_footer(); ?>