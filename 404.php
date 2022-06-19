<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Westcozy_Cabins
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<?php echo get_custom_logo(); ?>
				<h1 class="page-title"><?php esc_html_e( 'Sorry! That page can&rsquo;t be found.', 'westcozy-cabins' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'Nothing was found on this page but we have awesome cabins you might want to check out!', 'westcozy-cabins' ); ?></p>
				
				<a href="<?php echo get_post_type_archive_link('product') ?>" class="error-page-links">
					Check Out Our Cabins Page
				</a>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
