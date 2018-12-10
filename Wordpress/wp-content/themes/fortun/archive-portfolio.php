<?php
/*
   Template Name: Portfolio
 *
 * The template for displaying all portfolio.
 *
 *
 * @package fortun
 */

get_header(); ?>
<?php
	if( get_page_by_path( 'portfolio' ) ){
		$archive_page = get_page_by_path( 'portfolio' );
		echo agni_page_header( $archive_page->ID );
	}
?>
<?php do_action( 'agni_portfolio_init', '', false ); ?>

<?php get_footer(); ?>