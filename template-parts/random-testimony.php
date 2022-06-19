<section class='rand-testimony'>
    <h2>Random Testimonial</h2>
    <ul>
        <?php
        $args = array(
            'post_type'      => 'wcc_testimonial',
            'posts_per_page' => 1,
            'orderby' => 'rand',
        );
        $query = new WP_Query($args);
        if($query->have_posts() ){
            while($query->have_posts()){
                $query->the_post();
                echo "<article>";
                    the_content();
                echo "</article>";
            }
            wp_reset_postdata();
        }
        ?>
    </ul>
</section>