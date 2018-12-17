<?php get_header(); ?>

    <div class="error-404 not-found row">

        <div class="col-sm-12">

            <div class="error-404__header">
                <h1 class="page-title"><?php __( 'Sorry, page not found!', 'zbradu_text_domain' ) ?></h1>
            </div>

            <div class="error-404__content">

                <h4><?php __( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'zbradu_text_domain') ?></h4>

                <?php get_search_form(); ?>

                <?php the_widget('WP_Widget_Recent_Posts');  ?>

                <div class="widget widget_categories">
                    <h3><?php __( 'Check the most used categories', 'zbradu_text_domain') ?></h3>
                    <ul>
                        <?php
                            wp_list_categories(array(
                                'orderby' => 'count',
                                'order' => 'DESC',
                                'show_count' => 1,
                                'title_li' => '',
                                'number' => 5,
                            ));
                        ?>
                    </ul>

                </div>

                <?php the_widget('WP_Widget_Archives', 'dropdown=1'); ?>

            </div>

        </div>

    </div>

<?php get_footer(); ?>