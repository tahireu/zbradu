<?php get_header(); ?>

    <div class="archive row">


        <div class="main-content-holder col-xs-12 col-sm-8">

            <div class="row text-center no-margin">

                <?php if(have_posts()): ?>

                    <div class="archive__title page-header">
                        <?php

                            the_archive_title('<h1 class="page-title">', '</h1>');
                            the_archive_description('<div class="taxonomy-description">', '</div>');

                        ?>
                    </div>

                    <div class="archive__content">
                        <?php while (have_posts()): the_post(); ?>

                            <?php get_template_part('content', 'archive'); ?>

                        <?php endwhile; ?>

                        <div class="col-xs-12 text-left">
                            <?php the_posts_navigation(); ?>
                        </div>
                    </div>

                <?php endif ?>

            </div>

        </div>



        <div class="sidebar-holder col-xs-12 col-sm-4">
            <?php get_sidebar(); ?>
        </div>


    </div>

<?php get_footer(); ?>