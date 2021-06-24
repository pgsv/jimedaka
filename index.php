<?php get_header(); ?>
<div class="wrap">
    <?php get_sidebar(); ?>
    <main>
        <div class="front_sldr"><?php echo do_shortcode('[smartslider3 slider=4]'); ?>
        </div>
        <?php include('template-parts/news.php'); ?>
        <section class="">
            <?php include('template-parts/products.php'); ?>
        </section>
    </main>
</div>
<?php get_footer();
