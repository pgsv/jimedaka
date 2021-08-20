<!-- 参考サイト：https://kiyaku.jp/hinagata/gp.html -->

<?php get_header(); ?>
<div class="terms">
    <main class="terms-wrapper">
        <h1 class="terms-title"><?php the_title(); ?>
        </h1>
        <?php if (have_posts()): while (have_posts()):the_post(); ?>
        <div class="terms-contents">
            <?php the_content(); ?>
        </div>
        <?php endwhile;endif; ?>
    </main>
</div>
<?php get_footer();
