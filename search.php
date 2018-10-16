<?php get_header(); ?>

    <div class="search row">

        <?php if(have_posts()):

            while (have_posts()): the_post();

                get_template_part('content', 'search');

            endwhile; ?>

            <div class="zbradu-navigation">
                <?php the_posts_pagination(); ?>
            </div>

        <?php endif;

        ?>

    </div>

<?php get_footer(); ?>