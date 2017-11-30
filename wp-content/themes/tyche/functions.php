<?php
/**
 * Tyche functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Tyche
 */

/**
 * Start Tyche theme framework
 */
require_once 'inc/class-tyche-autoloader.php';
$tyche = new Tyche();


add_filter( 'intermediate_image_sizes_advanced', 'wpse_240765_image_sizes' );

function wpse_240765_image_sizes( $sizes ){
    $sizes = array();
    return $sizes;
}