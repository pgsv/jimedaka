<?php
$args = array(
    'type'                     => 'post',
    'parent'                   => 51,
    'orderby'                  => 'name',
    'order'                    => 'ASC',
    'taxonomy'                 => 'product_cat',
);

$categories = get_categories($args);

foreach ($categories as $category) :
    echo "カテゴリ： " . $category->name;
    echo "<br/>";
endforeach;
