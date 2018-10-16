<?php get_header(); ?>


<!--<div class="home row">

    <div class="main-content-holder col-xs-12 col-sm-8">
        <?php
/*
        if(have_posts()):

            while (have_posts()): the_post(); */?>

                <?php /*get_template_part('content', get_post_format()); */?>

            <?php /*endwhile;

        endif;

        */?>
    </div>

    <div class="sidebar-holder col-xs-12 col-sm-4">
        <?php /*get_sidebar(); */?>
    </div>

</div>-->


<?php
/*$args = array(
    'posts_per_page' => -1,
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'tax_query'      => array(
        array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'featured',
            'operator' => 'IN',
        ),
    )
);
$featured_product = new WP_Query( $args );

if ( $featured_product->have_posts() ) :

    echo '<div class="woocommerce columns-3"><ul class="products">';

    while ( $featured_product->have_posts() ) : $featured_product->the_post();

        $post_thumbnail_id     = get_post_thumbnail_id();
        $product_thumbnail     = wp_get_attachment_image_src($post_thumbnail_id, $size = 'shop-feature');
        $product_thumbnail_alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
        */?><!--

        <li class="product">
            <a href="<?php /*the_permalink();*/?>">
                <img src="<?php /*echo $product_thumbnail[0];*/?>" alt="<?php /*echo $product_thumbnail_alt;*/?>">
                <h3 class="woocommerce-loop-product__title"><?php /*the_title();*/?></h3>
                <button class="yellow-but">VIEW PRODUCT</button>
                <a data-product-id="<?php /*echo get_the_ID() */?>" class="quick_view button" >
                    <span>Quick View</span>
                </a>
            </a>
        </li>
        --><?php
/*    endwhile;

    echo '</ul></div>';

endif;

wp_reset_query();*/
?>
<!-- Featured products loop -->

<?php get_footer(); ?>





