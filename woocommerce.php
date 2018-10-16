<?php get_header(); ?>

    <!-- Hide title -->
    <?php add_filter( 'woocommerce_show_page_title', false) ?>

    <!-- WooCommerce Content -->
    <?php woocommerce_content(); ?>

<?php get_footer(); ?>