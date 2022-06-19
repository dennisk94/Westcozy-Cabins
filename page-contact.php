<?php

/**
 * The template for displaying the contact page
 *
 * This is the template that displays the contact page by default.
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
	<section class='banner-wrapper'>

		<?php the_post_thumbnail(); ?>
		<h1><?php the_title(); ?></h1>
	</section>
	<?php
	while (have_posts()) :
		the_post();
	?>

		<?php the_content(); ?>

		<section class="contact-wrapper">
			<section class="contact-section">
				<section class="questions-concerns-wrapper">
					<article class="questions">
						<?php
						if (function_exists('the_field')) : ?>
							<?php
							//Main Content Landscape Image
							if (get_field('banner_image_main_content')) : ?>
								<img class="landscape-image" src="<?php the_field('banner_image_main_content'); ?>" />
						<?php endif;

						endif; ?>

					</article>
					<section class="questions-concerns-right">
						<?php
						//Heading for FAQ and Policies button
						if (function_exists('the_field')) : ?>
							<article class='contact-heading'>
								<h4>
									<?php
									if (get_field('contact_heading')) :
										the_field('contact_heading');
									endif;
									?>
								</h4>
							</article>
						<?php
						endif;
						?>

						<?php
						//Text for questions & concerns
						if (function_exists('the_field')) : ?>
							<article class='contact-text'>
								<p>
									<?php
									if (get_field('contact_description')) :
										the_field('contact_description');
									endif;
									?>
								</p>
							</article>
						<?php
						endif; ?>


						<!-- Button linking to FAQ and Policies Page -->
						<?php
						if (function_exists('the_field')) : ?>
							<a class="faq-button" href="<?php the_field('faq_button') ?>">Check our FAQs and Policies</a>

					</section>
				</section>

				<section class="location-info-wrapper">
					<?php $location = get_field('map'); ?>
					<?php
							if (function_exists('the_field')) : ?>
						<?php
								if ($location) : ?>
							<!-- Google Maps -->
							<article class="acf-map" data-zoom="16">
								<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
							</article>
					<?php endif;
							endif;
					?>

					<section class="contact-information-wrapper">
						<?php
							//Contact Information Heading
							if (function_exists('the_field')) : ?>
							<article class='contact-heading'>
								<h4>
									<?php
									if (get_field('heading')) :
										the_field('heading');
									endif;
									?>
								</h4>
							</article>
						<?php
							endif;
						?>

						<?php

							//Contact Information address
							if (function_exists('the_field')) : ?>
							<article class='contact-address'>
								<?php
								if (get_field('address')) :
									the_field('address');
								endif;
								?>
							</article>
						<?php
							endif;
						?>

						<?php

							if (function_exists('the_field')) : ?>
							<!-- Contact Information link to external google maps -->
							<a class='btn-location-google-map' href="https://www.google.ca/maps/place/432+Cardena+Rd,+Bowen+Island,+BC+V0N+1G1/@49.3801495,-123.3361942,17z/data=!3m1!4b1!4m5!3m4!1s0x54866ba7454692b5:0xf5939eacf888b3a3!8m2!3d49.3801495!4d-123.3340055">Get directions in Google Maps</a>

						<?php endif; ?>

						<?php

							//Contact Information phone number
							if (function_exists('the_field')) : ?>
							<article class='contact-phone-number'>
								<a href="tel:<?php the_field('contact_phone', 32); ?>"><?php the_field('contact_phone', 32); ?></a>
							</article>
						<?php
							endif;
						?>

						<?php
							//Contact Information email
							if (function_exists('the_field')) : ?>
							<article class='contact-email'>
								<a href="mailto:<?php the_field('contact_email', 32); ?>"><?php the_field('contact_email', 32); ?></a>
							</article>
						<?php
							endif;
						?>


						<a class="contact-instagram" href="
					<?php
							//Contact Information instagram
							if (function_exists('the_field')) {
								if (get_field('instagram')) {

									the_field('instagram');
								}
							}

					?>
					">WestCozy Instagram</a>
					<?php endif;
					?>
					</section>
				</section>

			</section>
		</section>
	<?php
	endwhile; // End of the loop.
	?>
	<section class="form">
		<h2 class="form-heading">We would love to hear from you!</h2>
		<?php
		//Shortcode for Contact form
		echo do_shortcode('[contact-form-7 id="13" title="Contact form 1"]');
		?>
	</section>

</main><!-- #main -->

<?php
get_footer();
