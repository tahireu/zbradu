<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

    <div class="article__content">

        <?php if( has_post_thumbnail()): ?>
            <div class="article__thumbnail">
                <?php the_post_thumbnail('thumbnail'); ?>
            </div>
        <?php endif; ?>


        <div class="article__title">
            <!-- Title -->
            <?php the_title( sprintf('<h2 class="entry-title"><a href="%s">', esc_url(get_permalink()) ),'</a></h2>'); ?>


            <small class="article__meta">

                <!-- Date and time -->
                Posted on: <?php the_time('F j, Y'); ?> at <?php the_time() ?>


                <!-- Post type -->
                | Post type:  <?php echo get_post_type();?>


                <!-- Categories -->
                <?php echo zbradu_get_terms($post->ID, 'category', ' | ' . __('Category: ', 'zbradu_text_domain')); ?> <!-- If it's standard post type -->
                <?php echo zbradu_get_terms($post->ID, 'event-category', ' | ' . __('Category: ', 'zbradu_text_domain')); ?> <!-- If it is custom post type -->
                <?php echo zbradu_get_terms($post->ID, 'product_cat', ' | ' . __('Category: ', 'zbradu_text_domain')); ?> <!-- If it is WooCommerce products post type -->


                <!-- Tags -->
                <?php echo the_tags(' | ' . __('Tags: ', 'zbradu_text_domain')); ?> <!-- If it's standard post type -->
                <?php echo zbradu_get_terms($post->ID, 'event-tag', ' | ' . __('Tags: ', 'zbradu_text_domain')); ?> <!-- If it is custom post type -->
                <?php echo zbradu_get_terms($post->ID, 'product_tag', ' | ' . __('Tags: ', 'zbradu_text_domain')); ?> <!-- If it is WooCommerce products post type -->


                <!-- Edit post link -->
                <?php echo edit_post_link(__('Edit Item', 'zbradu_text_domain'), ' | '); ?>

            </small>

        </div>


        <?php if( get_the_excerpt() != '' ): ?>
            <div class="article__excerpt">
                <?php the_excerpt(); ?>
            </div>
        <?php endif; ?>

        <div class="clearfix"></div>

    </div>

</article>
