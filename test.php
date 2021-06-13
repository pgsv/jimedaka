<?php
$args = array(
	'type'                     => 'post',
	'parent'                   => 51,
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'taxonomy'                 => 'product_cat',
); 

$categories = get_categories( $args );

// $query = new WP_Query( $args );
// if($query->have_posts()) : while($query->have_posts()): $query->the_post();
foreach( $categories as $category) :
    echo "カテゴリ： " . $category->name;
    echo "<br/>";
endforeach;



// $categories = get_the_category();  // カテゴリ情報を配列で取得
// foreach( $categories as $category ) :
//   $parent = $category->parent; // 親カテゴリーIDを取得
//   if( !$parent ){
//     echo '<a class="c-meta__cat c-meta__cat--main" href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a>';
//     break;
//   }
// endforeach;
?>