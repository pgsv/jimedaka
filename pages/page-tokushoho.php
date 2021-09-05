<?php get_header(); ?>
<div class="tokushoho">
    <main class="tokushoho-wrapper">
        <h1 class="tokushoho-title"><?php the_title(); ?>
        </h1>
        <?php if (have_posts()): while (have_posts()):the_post(); ?>
        <div class="tokushoho-contents">
            <?php the_content(); ?>
        </div>
        <?php endwhile;endif; ?>
    </main>
</div>
<?php get_footer();
