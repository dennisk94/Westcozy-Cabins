<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li>
    <article class=id-<?php the_id()?>>
        <a class = 'cabin-list-product' href="<?php the_permalink()?>">
            <h3><?php the_title()?></h3>
            <?php the_post_thumbnail('portrait-cabin')?>
        </a>
        <div>
            <h4>Details</h4>
            <?php
            the_content(); 

            $rows = get_field('cabin_features');
            if($rows) : ?>
            <h4>Features</h4>
            <ul class='cabin-features-list'>
            <?php
                foreach($rows as $row):
                    foreach($row as $feature):
                        echo "<li>$feature</li>";
                    endforeach;
                endforeach;?>
            </ul>
            <?
            endif; ?>
            <p class='see-more'><a href="<?php the_permalink(); ?>">See More</a><p>
        </div>
    </article> 
</li>
