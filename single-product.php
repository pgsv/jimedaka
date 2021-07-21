<?php get_header(); ?>
<div class="singleProduct">
  <?php include('template-parts/product_aside.php'); ?>
  <main>
    <?php if (have_posts()): while (have_posts()):the_post(); ?>
    <?php the_post_thumbnail('thumbnail'); ?>
    <p><?php the_title(); ?>
    </p>
    <div class="prodPrice">￥<?php echo get_product_taxPrice(get_the_ID()); ?>円（税込）</div>
    <?php echo wc_get_product(get_the_ID())->description;?>
    <div class="cartBtn"><a
        href="?add-to-cart= <?php the_ID(); ?> ">カートに入れる</a></div>
    <?php endwhile; endif; ?>
  </main>
</div>
<?php get_footer();
