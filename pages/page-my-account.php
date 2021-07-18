<?php get_header(); ?>
<main>
  <?php if (have_posts()): while (have_posts()):the_post(); ?>
  <div class="myaccount-title">
    <h1><?php the_title();?>
    </h1>
  </div>
  <div class="myAccount-contents">
    <?php the_content(); ?>
  </div>
  <?php endwhile; endif; ?>
</main>
<?php get_footer();
