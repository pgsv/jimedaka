<?php get_header(); ?>
<h1><?php the_title(); ?>
</h1>
<?php //get_template_part('../template_parts/products');?>
<?php include_once(dirname(__FILE__) ."/../template-parts/products.php");?>
<?php //echo do_shortcode('[products limit="8" paginate="true"]');?>
<?php get_footer();
