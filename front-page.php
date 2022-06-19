<?php

/**
 * The template for displaying front page
 *
 * This is the template that displays front page by default.
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

<main id="primary" class="site-main">

	<?php
	while (have_posts()) :
		the_post(); ?>

		<section class='banner-wrapper'>
			<h1>Welcome to WestCozy Cabins</h1>
			<h2>The Best Cabins Bowen Island Has To Offer!</h2>
			<a id='banner-link' href="<?php the_field('cabins-page'); ?>">BOOK NOW</a>
			<?php the_post_thumbnail(); ?>
		</section>

		<div class="homepage-cabins-introduction">
			<?php
			// Homepage Image
			$image = get_field('landscape_photo');
			if (!empty($image)) : ?>
				<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
			<?php endif; ?>

			<div class="homepage-cabins-intro-texts"><?php
				// General Information text
				the_field('general_information');

				// General Features List
				$rows = get_field('general_features_list');
				if ($rows) :
				?>
					<div class="home-feature-list-container">
						<ul class='feature-lists'>
						<?php
							foreach ($rows as $row) : ?>
							<?php
								foreach ($row as $feature) :
									echo "<li>$feature</li>";
								endforeach;
							endforeach;
							?>
							</ul>
					</div>
				<?php
					endif; ?>

				<?php
				// Button to Cabins Page
				?>
				<a href='<?php the_field('cabins-page'); ?>' class='btn-to-cabins-page'>More About Cabins</a>
			</div>
		</div>

		<div class="instagram-feed-container">
			<div class="instagram-heading">
				<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="48px" height="48px"><radialGradient id="yOrnnhliCrdS2gy~4tD8ma" cx="19.38" cy="42.035" r="44.899" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#fd5"/><stop offset=".328" stop-color="#ff543f"/><stop offset=".348" stop-color="#fc5245"/><stop offset=".504" stop-color="#e64771"/><stop offset=".643" stop-color="#d53e91"/><stop offset=".761" stop-color="#cc39a4"/><stop offset=".841" stop-color="#c837ab"/></radialGradient><path fill="url(#yOrnnhliCrdS2gy~4tD8ma)" d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z"/><radialGradient id="yOrnnhliCrdS2gy~4tD8mb" cx="11.786" cy="5.54" r="29.813" gradientTransform="matrix(1 0 0 .6663 0 1.849)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#4168c9"/><stop offset=".999" stop-color="#4168c9" stop-opacity="0"/></radialGradient><path fill="url(#yOrnnhliCrdS2gy~4tD8mb)" d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z"/><path fill="#fff" d="M24,31c-3.859,0-7-3.14-7-7s3.141-7,7-7s7,3.14,7,7S27.859,31,24,31z M24,19c-2.757,0-5,2.243-5,5	s2.243,5,5,5s5-2.243,5-5S26.757,19,24,19z"/><circle cx="31.5" cy="16.5" r="1.5" fill="#fff"/><path fill="#fff" d="M30,37H18c-3.859,0-7-3.14-7-7V18c0-3.86,3.141-7,7-7h12c3.859,0,7,3.14,7,7v12	C37,33.86,33.859,37,30,37z M18,13c-2.757,0-5,2.243-5,5v12c0,2.757,2.243,5,5,5h12c2.757,0,5-2.243,5-5V18c0-2.757-2.243-5-5-5H18z"/></svg>
				<h2>WestCozy on Instagram</h2>
			</div>
			<?php // Shortcode for instagram 
			echo do_shortcode('[instagram-feed]');?>
		</div>

		<?php // Button to Gift Certificate page ?>
		<a class='btn-gift-certificate' href='<?php the_field('link_to_gift_certificate'); ?>'>Give the gift that keeps on giving! Check out our gift certificates</a>
		<?php
		// Button to Gift Certificate page
		?>

		<!-- Google Map -->
		<!-- Location -->
		<div class="homepage-google-map-container">
			<?php
			$location = get_field('location');
			if ($location) : ?>
				<div class="acf-map" data-zoom="16">
					<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
				</div>
			<?php endif; ?>
			<div class="homepage-google-map-text-container">
				<h4>How to Locate Us</h4>
				<?php 
					if( $location ) {

						// Loop over segments and construct HTML.
						$address = '';
						foreach( array('street_number', 'street_name', 'city', 'state', 'post_code') as $i => $k ) {
							if( isset( $location[ $k ] ) ) {
								if( $location[$k] == $location['street_number']){
									$address .= sprintf( '<span class="segment-%s">%s</span> ', $k, $location[ $k ] );
								} else if( $location[$k] == $location['city']){
									$address .= sprintf( ' <br> <span class="segment-%s">%s</span>, ', $k, $location[ $k ] );
								} else if( $location[$k] == $location['state']){
									$address .= sprintf( '<span class="segment-%s">BC</span> ', $k, $location[ $k ] );
								} else if( $location[$k] != $location['post_code'] && $location[$k] != $location['street_number'] ){
									$address .= sprintf( '<span class="segment-%s">%s</span> ', $k, $location[ $k ] );
								} else if ( $location[$k] == $location['post_code'] ){
									$address .= sprintf( '<br><span class="segment-%s">%s</span> ', $k, $location[ $k ] );
								}							}
						}

						// Trim trailing comma.
						$address = trim( $address, ', ' );

						// Display HTML.
						echo '<p class="location-address">' . $address . '</p>';
					}
				?>
				<a class='btn-location-google-map' href="<?php the_field('locations_on_google_maps') ?>">Get directions in Google Maps</a>
			</div>
		</div>
	<?php
	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_footer();
