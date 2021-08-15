<!-- 参考サイト：https://tab-log.com/netshop-privacy -->

<?php get_header(); ?>
<div class="privacy">
    <main class="privacy-wrapper">
        <h1 class="privacy-title"><?php the_title(); ?>
        </h1>
        <?php if (have_posts()): while (have_posts()):the_post(); ?>
        <div class="privacy-contents">
            <?php the_content(); ?>
        </div>
        <?php endwhile;endif; ?>
    </main>
</div>
<?php get_footer();
