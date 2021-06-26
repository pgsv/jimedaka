<?php get_header(); ?>
<div class="wrap">
    <?php get_sidebar(); ?>
    <main>
        <div class="front_sldr"><?php echo do_shortcode('[smartslider3 slider=4]'); ?>
        </div>
        <?php include('template-parts/news.php'); ?>

        <?php
            function clog($data) {
            echo '<script>';
            echo 'console.log('. json_encode($data) .')';
            echo '</script>';}
        ?>
        <?php 
            $page = get_page_by_path('custom-field');
            $id = $page->ID;
            $field_medaka = get_field_object('medaka', $id);    
            // echo $field_medaka;
        ?>

        <img src="<?php echo $field_medaka['value']['guid']; ?>" />

        <?php
            $page = get_page_by_path('custom-field');
            $id = $page->ID;
            $field_desc = get_field_object('description', $id);
            echo $field_desc['value'];
        ?>
        <?php clog( $field_medaka); ?>
        <section class="">
            <?php include('template-parts/products.php'); ?>
        </section>
    </main>
</div>
<?php get_footer();
