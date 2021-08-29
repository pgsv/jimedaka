<?php get_header(); ?>
<main class="purchase">
    <?php if (have_posts()): while (have_posts()):the_post(); ?>

    <div class="purchaseWrapper">
        <h1 class="purchase-head">
            購入手続き
        </h1>

        <div class="purchase-foot">
            <a href="<?php echo home_url(); ?>">ホーム</a> <span
                class="right_arrow">></span> <a
                href="<?php echo home_url(); ?>/cart">お買い物カゴ</a> <span
                class="right_arrow">></span> 購入手続き
        </div>
    </div>

    <p><?php the_content(); ?>
    </p>
    <?php endwhile; endif; ?>
</main>
<?php get_footer();
