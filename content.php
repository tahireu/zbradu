<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="article__title">
        <h1><?php the_title(); ?></h1>
    </div>

    <div class="article__content">

        <?php if( has_post_thumbnail()): ?>
            <div class="article__image">
                <?php the_post_thumbnail('medium'); ?>
            </div>
        <?php endif; ?>

        <div class="article__text">
            <?php the_content(); ?>
        </div>


    </div>

</article>