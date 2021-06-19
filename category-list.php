<?php
$args = array(
    'type'        => 'post',
    'parent'      => 51,        // 親：medakaカテゴリ(51)
    'orderby'     => 'name',
    'order'       => 'ASC',
    'taxonomy'    => 'product_cat',
);
$categories = get_categories($args);
?>
<aside>
    <strong>メダカ</strong>
    <ul>
        <?php foreach ($categories as $cat): ?>
        <?php $cat_thumb_id = get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true); ?>
        <?php $cat_thumb_url = wp_get_attachment_thumb_url($cat_thumb_id); ?>
        <li><a href="#<?php echo $cat->slug; ?>">
                <img src="<?php echo $cat_thumb_url; ?>"
                    alt="<?php echo $cat->name ?>">
                <?php echo $cat->name; ?>
            </a></li>
        <?php endforeach; ?>
    </ul>
</aside>