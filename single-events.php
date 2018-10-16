<?php get_header(); ?>

    <div class="single-events row">

        <div class="main-content-holder col-xs-12 col-sm-8">

            <?php

            if(have_posts()):

                while (have_posts()): the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>

                        <div class="single-events__title">
                            <?php the_title('<h1 class="entry-title">','</h1>'); ?>
                        </div>

                        <div class="single-events__thumbnail">
                            <?php if( has_post_thumbnail()): ?>

                                <div class="pull-right"><?php the_post_thumbnail('thumbnail'); ?></div>

                            <?php endif; ?>
                        </div>

                        <div class="single-events__meta">
                            <small>
                                <?php echo zbradu_get_terms ($post->ID, 'event-category'); ?>
                                || <?php echo zbradu_get_terms ($post->ID, 'event-tag'); ?>

                                <?php if(current_user_can('manage_options')) {
                                    echo '|| '; edit_post_link();
                                }
                            ?></small>
                        </div>

                        <div class="single-events__content">
                            <?php the_content(); ?>
                        </div>

                        <hr>

                        <div class="single-events__navigation">
                            <div class="col-xs-6 text-left"><?php previous_post_link( ) ?></div>
                            <div class="col-xs-6 text-right"><?php next_post_link( ) ?></div>
                        </div>

                        <div class="clearfix"></div>

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