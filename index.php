<?php get_header(); ?>
<?php $categories = get_medaka_categories(); ?>
<main>
    <div class="top">
        <div class="top-categories">
            <ul class="top-categories-body">
                <?php foreach ($categories as $cat): ?>
                <?php $cat_thumb_url = get_wc_thumb_url($cat->term_id); ?>
                <li class="button type1">
                    <a class="categoryItem"
                        href="<?php echo get_medaka_cat_url($cat->slug); ?>">
                        <div class="categoryItem-image"
                            style="background-image: url('<?php echo $cat_thumb_url; ?>')"
                            alt="<?php echo $cat->name ?>">
                        </div>
                        <div class="categoryItem-text">
                            <?php echo $cat->name; ?>
                        </div>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
            <div class="top-categories-head">
                <span>
                    メダカの種類
                </span>
                <object class="separation"
                    data='<?php echo get_template_directory_uri(); ?>/assets/img/separationW.svg'
                    type=""></object>
            </div>
        </div>

        <div class="top-right">
            <div class="top-right-slider"><?php echo do_shortcode(' [smartslider3 slider="5"] '); ?>
            </div>
            <div class="news">
                <div class="news-head">お知らせ</div>
                <div class="news-body">
                    <dl>
                        <?php if (have_posts()): while (have_posts()):the_post(); ?>
                        <dt>
                            <a href="<?php the_permalink(); ?>">
                                <time class="newsTime"
                                    datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
                                <span class="newsTitle"><?php the_title(); ?>
                                </span>
                            </a>
                        </dt>
                        <?php endwhile; endif; ?>
                    </dl>
                    <object class="separation"
                        data='<?php echo get_template_directory_uri(); ?>/assets/img/separationW.svg'
                        type=""></object>
                </div>
            </div>
        </div>
    </div>

    <h2>当店一押しのメダカ</h2>
    <div class="prod-pickup">
        <ul>
            <?php for ($i = 1; $i <= 3; $i++) { ?>
            <li>
                <?php
                    $field_medaka = get_custom_field('medaka_'.$i, 'custom-field');
                    $field_desc = get_custom_field('description_'.$i, 'custom-field');
                    the_product_html($field_medaka['value']->ID);
                    echo $field_desc['value'];?>
            </li>
            <?php } ?>
        </ul>
    </div>
    <h2>メダカの飼育環境について</h2>
</main>

<?php get_footer();
