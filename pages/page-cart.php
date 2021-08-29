<?php get_header(); ?>
<main class="cart">
    <h1 class="cart-head">
        <div class="cart-head-title">
            <?php the_title(); ?>
        </div>
        <div class="cart-head-link">
            <a href="<?php echo home_url(); ?>">ホーム</a> > お買い物カゴ
        </div>
    </h1>
    <?php if (have_posts()): while (have_posts()):the_post(); ?>

    <?php the_content(); ?>

    <?php endwhile; endif; ?>
</main>
<?php get_footer();
