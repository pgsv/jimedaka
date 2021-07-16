<?php
/**
* 開発用デバッグを表示
*/
function debug_print()
{
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
