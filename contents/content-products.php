<?php
$sortset = (string) filter_input(INPUT_GET, 'sort');
if ($sortset === '') {
    $sortset = 'category';
} else {
    $sortset = (string) filter_input(INPUT_GET, 'sort');
}
switch ($sortset) :
    case ('category'):
        $args = get_product_args_by_cat();
        break;
    case ('cheap'):
        $args = get_product_args_by_price('asc');
        break;
    case ('expensive'):
        $args = get_product_args_by_price('desc');
        break;
    default:
        $array_price = explode('_', $sortset);
        $args = get_product_args_between_price($array_price[0], $array_price[1]);
endswitch;
?>

<script>
    jQuery('.selectedLink').removeClass('selectedLink');
    jQuery('#<?php echo $sortset;?>').addClass('selectedLink');
</script>

<ul class="clearfix">
    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $posts_per_page = 16;
    $args['paged'] = $paged;
    $args['posts_per_page'] = $posts_per_page; 
    
    $the_query = new WP_Query($args);
    // var_dump($the_query);
    $pages_cnt = $the_query->max_num_pages; ?>
    <?php if ($the_query->have_posts()) :  ?>
    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
    <?php
        // $wc_product = wc_get_product(get_the_ID());
        // var_dump($wc_product);
    ?>
    <li class="products-list-item">
        <?php the_product_link_html(get_the_ID()); ?>
    </li>

    <?php endwhile; ?>
    <?php else: ?>
    <div>
        <p>申し訳ございません。お探しの商品はありませんでした。</p>
    </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</ul>


<div class="pagination">
    <?php //ページリスト表示処理
global $wp_rewrite;
$paginate_base = get_pagenum_link(1);
if (strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()) {
    $paginate_format = '';
    $paginate_base = add_query_arg('paged', '%#%');
} else {
    $paginate_format = (substr($paginate_base, -1, 1) == '/' ? '' : '/') .
  user_trailingslashit('page/%#%/', 'paged');
    $paginate_base .= '%_%';
}
echo paginate_links(array(
  'base' => $paginate_base,
  'format' => $paginate_format,
  'total' => $pages_cnt,
  'mid_size' => 1,
  'current' => ($paged ? $paged : 1),
  'prev_text' => '< 前へ',
  'next_text' => '次へ >',
)); ?>
</div>