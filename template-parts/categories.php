<?php $categories = get_medaka_categories(); ?>
<aside>
    <strong>メダカ</strong>
    <ul>
        <?php foreach ($categories as $cat): ?>
        <?php $cat_thumb_url = get_wc_thumb_url($cat->term_id); ?>
        <li><a href="<?php echo get_medaka_cat_url($cat->slug); ?>">
                <img src="<?php echo $cat_thumb_url; ?>"
                    alt="<?php echo $cat->name ?>">
                <?php echo $cat->name; ?>
            </a></li>
        <?php endforeach; ?>
    </ul>
</aside>