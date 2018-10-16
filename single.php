<?php get_header(); ?>

    <div class="single row">

        <div class="main-content-holder col-xs-12 col-sm-8">

            <?php

            if(have_posts()):

                while (have_posts()): the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>

                        <div class="single__title">
                            <?php the_title('<h1 class="entry-title">','</h1>'); ?>
                        </div>

                        <div class="single__thumbnail">
                            <?php if( has_post_thumbnail()): ?>

                                <div class="pull-right"><?php the_post_thumbnail('thumbnail'); ?></div>

                            <?php endif; ?>
                        </div>

                        <div class="single__meta">
                            <small><?php the_category(' ') ?> || <?php the_tags() ?> || <?php edit_post_link(); ?></small>
                        </div>

                        <div class="single__content">
                            <?php the_content(); ?>
                        </div>

                        <div class="clearfix"></div>

                        <hr>

                        <div class="single__navigation">
                            <div class="col-xs-6 text-left"><?php previous_post_link( ) ?></div>
                            <div class="col-xs-6 text-right"><?php next_post_link( ) ?></div>
                        </div>

                        <div class="clearfix"></div>


                        <?php if( comments_open() ) { ?>
                        <div class="single__comments">
                            <?php comments_template(); ?>
                        </div>
                        <?php } ?>

                    </article>

                <?php endwhile;

            endif;

            ?>
        </div>


        <div class="sidebar-holder col-xs-12 col-sm-4">
            <?php get_sidebar(); ?>
        </div>
    </div>

<?php get_footer(); ?>