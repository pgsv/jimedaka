<?php get_header(); ?>
<main>
  <?php if (have_posts()): while (have_posts()):the_post(); ?>
  <div class="myaccount-title">
    <h1><?php the_title();?>
  </div>
  </h1>
  <?php the_content(); ?>
  <?php endwhile; endif; ?>
</main>
<?php get_footer();
