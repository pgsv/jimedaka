<?php get_header(); ?>
<h1><?php the_title(); ?>
</h1>
<?php echo do_shortcode('[products limit="8" paginate="true"]'); ?>
<?php get_footer();
