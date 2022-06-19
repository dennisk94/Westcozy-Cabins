<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Westcozy_Cabins
 */

?>

<footer id="colophon" class="site-footer">
	<div class="site-info">
		<nav id="footer-navigation">
			<?php wp_nav_menu(array('theme_location' => 'footer')); ?>
		</nav>
		<div class='footer-info'>
			<p><?php
				if(function_exists('the_field')): ?>
					<a href="tel:<?php the_field('contact_phone',32); ?>"><?php the_field('contact_phone',32); ?></a>
					<?php
				endif; ?>
			</p>
			<p><?php 
				if(function_exists('the_field')): ?>
					<a href="mailto:<?php the_field('contact_email',32); ?>"><?php the_field('contact_email',32); ?></a>
					<?php
				endif; ?>
			</p>
		</div>

	</div><!-- .site-info -->
	<div id='credits'>
		<p><a href='/credits'>Credits</a></p>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>