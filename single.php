<?php get_header(); ?>

<div class="singleNews">
    <main class="singleNews-wrapper">
        <?php if (have_posts()): while (have_posts()):the_post(); ?>
        <?php my_breadcrumbs(); ?>
        <h1 class="singleNews-title"><?php the_title(); ?>
        </h1>
        <div class="singleNews-contents"><?php the_content(); ?>
        </div>
        <?php endwhile; endif; ?>
    </main>
</div>
<?php get_footer();
