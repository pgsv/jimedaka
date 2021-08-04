<?php get_header(); ?>
<main>
    <div class="singleNews">
        <?php if (have_posts()): while (have_posts()):the_post(); ?>
        <h1><?php the_title(); ?>
        </h1>
        <div class="singleNews-contents"><?php the_content(); ?>
        </div>
        <?php endwhile; endif; ?>
    </div>
</main>
<?php get_footer();
