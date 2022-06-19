<?php

/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Westcozy_Cabins
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function westcozy_cabins_woocommerce_setup()
{
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 1920,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'westcozy_cabins_woocommerce_setup');

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function westcozy_cabins_woocommerce_scripts()
{
	wp_enqueue_style('westcozy-cabins-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION);

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style('westcozy-cabins-woocommerce-style', $inline_font);
}
add_action('wp_enqueue_scripts', 'westcozy_cabins_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function westcozy_cabins_woocommerce_active_body_class($classes)
{
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter('body_class', 'westcozy_cabins_woocommerce_active_body_class');

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function westcozy_cabins_woocommerce_related_products_args($args)
{
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args($defaults, $args);

	return $args;
}
add_filter('woocommerce_output_related_products_args', 'westcozy_cabins_woocommerce_related_products_args');

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (!function_exists('westcozy_cabins_woocommerce_wrapper_before')) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function westcozy_cabins_woocommerce_wrapper_before()
	{
?>
		<main id="primary" class="site-main">
		<?php
	}
}
add_action('woocommerce_before_main_content', 'westcozy_cabins_woocommerce_wrapper_before');

if (!function_exists('westcozy_cabins_woocommerce_wrapper_after')) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function westcozy_cabins_woocommerce_wrapper_after()
	{
		?>
		</main><!-- #main -->
	<?php
	}
}
add_action('woocommerce_after_main_content', 'westcozy_cabins_woocommerce_wrapper_after');

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'westcozy_cabins_woocommerce_header_cart' ) ) {
			westcozy_cabins_woocommerce_header_cart();
		}
	?>
 */

if (!function_exists('westcozy_cabins_woocommerce_cart_link_fragment')) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function westcozy_cabins_woocommerce_cart_link_fragment($fragments)
	{
		ob_start();
		westcozy_cabins_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'westcozy_cabins_woocommerce_cart_link_fragment');

if (!function_exists('westcozy_cabins_woocommerce_cart_link')) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function westcozy_cabins_woocommerce_cart_link()
	{
	?>
		<a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'westcozy-cabins'); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'westcozy-cabins'),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></span> <span class="count"><?php echo esc_html($item_count_text); ?></span>
		</a>
	<?php
	}
}

if (!function_exists('westcozy_cabins_woocommerce_header_cart')) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function westcozy_cabins_woocommerce_header_cart()
	{
		if (is_cart()) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
	?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr($class); ?>">
				<?php westcozy_cabins_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget('WC_Widget_Cart', $instance);
				?>
			</li>
		</ul>
		<?php
	}
}

if (!function_exists('cabins_page')) {
	/**
	 * Cabins page
	 */
	function cabins_page()
	{
		// display featured image
		add_action('woocommerce_archive_description', 'the_post_thumbnail', 9);
	}
}
add_action('init', 'cabins_page');

if (!function_exists('individual_cabin_page')) {
	/**
	 * Individual cabin pages
	 */
	function individual_cabin_page()
	{

		// Remove featured image from Single Products page
		remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

		// Remove h1 title from Single Products page
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

		// Structure cabin banner
		function cabin_banner()
		{
		?>
			<section class="cabin-banner">
				<?php
				echo woocommerce_template_single_title();
				echo woocommerce_show_product_images();
				?>
			</section>
			<?php
		}
		add_action('woocommerce_before_single_product_summary', 'cabin_banner', 20);

		// Disable image zooming
		function remove_image_zooming()
		{
			remove_theme_support('wc-product-gallery-zoom');
		}
		add_action('wp', 'remove_image_zooming', 100);

		// Remove Description from Single Products page
		remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
		// Re-add Description higher on Single Products page
		add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 6);

		// Change "Previous" and "Next" in calendar to arrows
		function change_calendar_text($translated_text, $text, $domain)
		{
			if (is_product()) {
				if ($translated_text == 'Previous') {
					$translated_text = '<';
				} else if ($translated_text == 'Next') {
					$translated_text = '>';
				}
			}
			return $translated_text;
		}
		add_filter('gettext', 'change_calendar_text', 25, 3);

        // Display cabin gallery images, features, and testimonial
        function cabin_gallery_features_testimonial() { ?>

			<div class="cabin-gft">

			<?php

                // Display cabin gallery images
                $galleryImages = get_field('gallery');
                if ($galleryImages) {
                    echo "<section class='cabin-gallery'>";

                    foreach ($galleryImages as $galleryImage) {
                ?>
                        <a href="<?php echo $galleryImage; ?>" data-lightbox="wcc-gallery">
                            <?php

                            echo "<img src='$galleryImage' alt='cabin image'>";
                            ?>
                        </a>
                    <?php

                    }
                    echo "</section>";
                }

                ?>

                <div class="cabin-ft">

                <?php

                    // Display cabin features
                    if (have_rows('cabin_features')) : ?>

                        <section class='cabin-features'>
                            <h2>Features:</h2>
                            <ul>
                                <?php
                                // Loop through entries
                                while (have_rows('cabin_features')) : the_row();

                                    // Load sub field values
                                    $sub_value = get_sub_field('features');
                                    echo '<li>' . $sub_value . '</li>';

                                endwhile;
                                ?>
                            </ul>
                        </section>
                    <?php
                    endif;

                    // Display cabin testimonial
                    echo "<section class='cabin-testimonials'>";
                    if (get_field('cabin_testimonies')) {
                        echo "<h2>Cabin Testimonial</h2>";
                        the_field('cabin_testimonies');
                    } else {
                        get_template_part('template-parts/random', 'testimony');
                    }
                    echo "</section>";

                ?>

                </div>
                
            </div>

            <?php
        }
        add_action('woocommerce_after_single_product_summary', 'cabin_gallery_features_testimonial', 10);

		// Change "Related products" text
		add_filter('gettext', 'change_related_products_text', 20, 3);
		function change_related_products_text($translated_text, $text, $domain)
		{
			if ($translated_text == 'Related products' && is_product()) {
				$translated_text = 'Check out our other cabins!';
			}
			return $translated_text;
		}
	}
}
add_action('init', 'individual_cabin_page');
