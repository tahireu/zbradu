<?php

/*
 * Template Name: Contact Page
 * */

get_header(); ?>

    <div class="contact row">

        <?php if(have_posts()): ?>

            <div class="contact__title">
                <h1><?php the_title() ?></h1>
            </div>

            <div class="contact__content">
            <?php while (have_posts()): the_post(); ?>

                <?php the_content() ?>

            <?php endwhile; ?>
            </div>


        <?php endif;

        ?>

        <!-- Clearfix to keep height of 7 Form when input fields are all floated to left -->
        <div class="clearfix"></div>
    </div>

<?php get_footer(); ?>