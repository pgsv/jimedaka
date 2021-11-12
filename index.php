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
            <div class="top-right-slider"><?php echo do_shortcode(' [smartslider3 slider="4"] '); ?>
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
    <div class="recommend">
        <div class="recommend-head">注目のメダカ種</div>
        <div class="recommend-body">
            <?php for ($i = 1; $i <= 3; $i++) {?>
            <div class="recommendItem">
                <?php
                    $term_id = get_custom_field('medaka_'.$i, 'recommend-products')['value'];
                    $recommend_desc = get_custom_field('description_'.$i, 'recommend-products')['value'];
                    //$product_id = $field_medaka['value']->ID
                    // echo $term_id;
                    // echo $recommend_desc;
                    $term_object = get_term($term_id);
                    $term_slug = $term_object->slug;
                    $term_thumb_url = get_wc_thumb_url($term_id);
                    // echo $term_slug;
                    ?>
                <a class="recommendItem-head"
                    href="<?php echo get_medaka_cat_url($term_slug);?>">
                    <img class="recommendItem-head-img"
                        src="<?php echo $term_thumb_url;?>"
                        alt="<?php echo $term_slug?>">
                    <span class="recommendItem-head-label">当店一押し</span>
                </a>
                <div class="recommendItem-body">
                    <div class="recommendItem-body-name">
                        <?php echo $term_object->name;?>
                    </div>
                    <!-- <div class="recommendItem-body-price">
                        <?php //echo get_product_taxPrice($product_id);?>円<span
                        class="light_red">（税込）</span>
                </div> -->
                <div class="recommendItem-body-desc">
                    <?php echo $recommend_desc;?>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
    </div>
    <div class="deliveryflow">
        <div class="deliveryflow-left">
            <img class='deliveryflow-left-img'
                src='<?php echo get_template_directory_uri(); ?>/assets/img/deliveryflow.jpg'
                alt='お買い物カゴページ画面の映ったスマsートフォン'>
        </div>
        <div class="deliveryflow-right">
            <div class="deliveryflow-right-head">
                お届けまでの手順
            </div>
            <div class="deliveryflowItem">
                <div class="deliveryflowItem-wrapper">
                    <div class="deliveryflowItem-wrapper-title">
                        一、お買い物カゴに入れる
                    </div>
                    <div class="deliveryflowItem-wrapper-desc">
                        購入される商品をお買い物カゴに入れます。
                    </div>
                </div>
                <img class='deliveryflowItem-img deliveryflowItem-cart'
                    src='<?php echo get_template_directory_uri(); ?>/assets/img/cart.svg'
                    alt='お買い物カゴ'>
            </div>
            <div class="deliveryflowItem">
                <div class="deliveryflowItem-wrapper">
                    <div class="deliveryflowItem-wrapper-title">
                        二、商品購入の確定
                    </div>
                    <div class="deliveryflowItem-wrapper-desc">
                        オンライン決済で商品の購入の確定します。
                    </div>
                </div>
                <img class='deliveryflowItem-img order'
                    src='<?php echo get_template_directory_uri(); ?>/assets/img/order.svg'
                    alt='注文'>
            </div>
            <div class="deliveryflowItem">
                <div class="deliveryflowItem-wrapper">
                    <div class="deliveryflowItem-wrapper-title">
                        三、商品の配送
                    </div>
                    <div class="deliveryflowItem-wrapper-desc">
                        購入後、２〜3日ほどで商品が届きます。
                    </div>
                </div>
                <img class='deliveryflowItem-img track'
                    src='<?php echo get_template_directory_uri(); ?>/assets/img/truck.svg'
                    alt='トラック'>
            </div>
        </div>
    </div>
</main>
<?php get_footer();
