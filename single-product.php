
<?php get_header(); ?>
<main>
  <p>single-product</p>
  <?php if(have_posts()): while(have_posts()):the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <p><?php the_content(); ?></p>
    <?php the_post_thumbnail('thumbnail'); ?>
    <div class="cart-btn"><a href="?add-to-cart= <?php the_ID(); ?> ">カートに追加</a></div>
  <?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>