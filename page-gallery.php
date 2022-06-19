<?php

/**
 * The template for displaying the gallery page
 *
 * This is the template that displays the gallery page by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Westcozy_Cabins
 */

get_header();

?>

<section class='banner-wrapper'>
	<h1><?php the_title(); ?></h1>
	<?php the_post_thumbnail(); ?>
</section>

<main id="primary" class="site-main">

	<?php
	?>
	<section class="button-group filter-button-group">

		<button class="isotope-button" data-filter="*">Show All</button>
		<button class="isotope-button" data-filter=".land-activity">Land Activity</button>
		<button class="isotope-button" data-filter=".water-activity">Water Activity</button>
		<button class="isotope-button" data-filter=".views">Views</button>

	</section>

	<?php $galleryImages = get_field('gallery'); ?>

	<?php

	if ($galleryImages) {

	?>

		<section class="grid">
			<?php
			foreach ($galleryImages as $galleryImage) {

				$image_title = 'grid-item ' . get_post_meta(attachment_url_to_postid($galleryImage), '_wp_attachment_image_alt', true);

			?>

				<a href="<?php echo $galleryImage; ?>" data-lightbox="wcc-gallery" data-title="wcc-gallery" <?php post_class($image_title); ?>>

					<?php
					echo "<img src='$galleryImage' alt='gallery image'>";
					?>

				</a>

			<?php
			}
			?>
		</section>

	<?php
	}
	?>

</main><!-- #main -->

<?php
get_footer();
