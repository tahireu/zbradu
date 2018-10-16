<?php

$slides = new WP_Query(array ('post_type' => 'slides'));
$count = 0;

if ($slides->have_posts()) { ?>

    <div class="header__hero owl-carousel owl-theme">

        <?php

        if ($slides->have_posts()):

            while ($slides->have_posts()): $slides->the_post(); ?>

                <div class="item <?php if($count == 0): echo 'active'; endif; ?>">
                    <?php the_post_thumbnail('full'); ?>
                </div>

            <?php endwhile;

        endif;

        wp_reset_postdata();
        ?>

    </div>

<?php } else { ?>

    <div class="header__hero header-image no-owl-carousel" style="background-image: url('<?php header_image();  ?>'); "></div>

<?php } ?>