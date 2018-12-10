<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agni Framework
 */

get_header(); 

$term_meta_id = get_queried_object_id(); 
echo agni_page_header( $term_meta_id, true );  

do_action( 'agni_posts_init', '', $archive = true, $shortcode = false ); 

get_footer(); ?>
