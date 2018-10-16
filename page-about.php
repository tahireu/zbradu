<?php

/*
 * Template Name: About Page
 * */

get_header(); ?>

    <div class="index">

        <?php

        if(have_posts()):

            while (have_posts()): the_post();

                get_template_part('content', '');

            endwhile;

        endif;

        ?>

    </div>

<?php get_footer(); ?>