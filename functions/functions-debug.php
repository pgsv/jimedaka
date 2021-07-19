<?php

/**
* 開発用デバッグを表示
*/
function debug_print()
{
    // echo "[get_theme_root] = " . get_theme_root();
  // echo '<br>';
  // echo "[get_stylesheet] = " . get_stylesheet();
  // echo "<br>";
  // echo "[get_stylesheet_directory_uri] = " . get_stylesheet_directory_uri();
}
add_action('wp_head', 'debug_print');

/**
 * コンソールログ表示
 */
function clog($data)
{
    echo '<script>';
    echo 'console.log('. json_encode($data) .')';
    echo '</script>';
}
