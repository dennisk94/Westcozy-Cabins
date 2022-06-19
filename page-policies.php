<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
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
		while ( have_posts() ) :
			the_post(); ?>
			<section class='banner-wrapper'>
				<h1><?php the_title();?></h1>
				<?php the_post_thumbnail(); ?>
			</section>
			<section class='policies-wrapper'> <?php
				if(function_exists(the_field('reservation_info'))){
					if(get_field('reservation_info')){
						the_field('reservation_info');
					}
				}
				if(have_rows('faqs')): ?>
					<section>
						<h2>FAQs</h2>
						<?php
							while(have_rows('faqs')):
								the_row();
								$sub_question = get_sub_field('faq_question');
								$sub_answer = get_sub_field('faq_answer'); ?>
								<div class='faq'>
									<?php
										echo $sub_question;
										echo $sub_answer;
									?>
								</div>
								<?php
							endwhile;
							?>
					</section>
					<?php
				endif;
				if(function_exists('the_field')):
					if(get_field('arrivals_departures')): ?>
						<section>
							<?php the_field('arrivals_departures');	?>				
						</section> 
						<?php
					endif;
				endif;
				if(function_exists('the_field')):
					if(get_field('cancellation_policy')): ?>
						<section>
							<?php the_field('cancellation_policy'); ?>
						</section>
						<?php
					endif;
				endif;
				if(function_exists('the_field')):
					if(get_field('gift_certificate_policy')): ?>
						<section>
							<?php the_field('gift_certificate_policy'); ?>
						</section>
						<?php
					endif;
				endif;
				if(function_exists('the_field')):
					if(get_field('pet_policy')): ?>
						<section>
							<?php the_field('pet_policy'); ?>
						</section>
						<?php
					endif;
				endif;
				if(function_exists('the_field')):
					if(get_field('privacy_policy')): ?>
						<section>
							<?php the_field('privacy_policy'); ?>
						</section>
						<?php
					endif;
				endif;
				?>
			</section>
			<section class='contact-info'>
				<h2>Can't Find the Information You Are Looking For?</h2>
				<?php
				if(get_field('contact_page')): ?>
					<a href="<?php the_field('contact_page') ?>"><h4>Go To Contacts</h4></a>
					<?php
				endif; ?>
			</section>
			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
