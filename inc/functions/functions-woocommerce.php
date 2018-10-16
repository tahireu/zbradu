<?php

/*
 * Add WC theme support
 * */
add_theme_support('woocommerce');
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );




/*
 * Remove "Sort By" dropdown and result count
 * */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);




/*
 * Change number or products per row to 4, if nothing else is declared in Products tab/Customize Shop Page
 * */
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
    function loop_columns() {
        $row = get_option('wc_num_of_products_per_row') ? get_option('wc_num_of_products_per_row') : 4;
        return $row;
    }
}




/*
 * Change number of products that are displayed per page (shop page) to 20, if nothing else is declared in Products tab/Customize Shop Page
 * */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
    $cols = get_option('wc_num_of_products_per_page') ? get_option('wc_num_of_products_per_page') : 12;
    return $cols;
}




/*
 * Create the section beneath the products tab
 * */
add_filter( 'woocommerce_get_sections_products', 'add_section_wc_customize', 10, 1);
function add_section_wc_customize ($sections) {

    $sections['wc_customizer_shop'] = __( 'Products per row/page', 'zbradu');
    return $sections;
}


add_filter( 'woocommerce_get_settings_products', 'wc_customize_all_settings', 10, 2);
function wc_customize_all_settings ( $settings, $current_section) {

    /* Check if the current section is the one we need */
    if ( $current_section == 'wc_customizer_shop') {

        $settings_wc_customize = array();

        /* Add Title to the Settings */
        $settings_wc_customize[] = array(
            'name' => __('Number of products per row and per page', 'text-domain'),
            'type' => 'title',
            'desc' => __('Select number of products which will be displayed per row and per page', 'text-domain'),
            'id' => 'wc_product_customizer'
        );


        /* Add first text field option */
        $settings_wc_customize[] = array(
            'name' => __('Products Per Row:', 'text-domain'),
            'sect_tip' => __('The number typed here will change the number of products per row on shop page.', 'text-domain'),
            'id' => 'wc_num_of_products_per_row',
            'type' => 'text',
            'css' => 'min-width: 300px;'
        );


        /* Add second text field option */
        $settings_wc_customize[] = array(
            'name' => __('Products Per Page:', 'text-domain'),
            'sect_tip' => __('The number typed here will change the number of products per page on shop page.', 'text-domain'),
            'id' => 'wc_num_of_products_per_page',
            'type' => 'text',
            'css' => 'min-width: 300px;'
        );

        $settings_wc_customize[] = array('type' => 'sectionend', 'id' => 'zbradu_wc_customize');

        return $settings_wc_customize;


    /* If not, return the standard settings */
    } else {

        return $settings;

    }

}




/*
 * Remove Add To Cart button
 * */
function remove_add_to_cart_button(){
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}
add_action('init','remove_add_to_cart_button');




/*
 * Add custom buttons for quantity increase and decrease on SINGLE PRODUCT PAGES
 * */
function quantity_decrease() {
    echo "<div class='quantity-buttons-custom-holder'><button class='button quantity-button quantity-decrease' type=\"button\" onclick=\"this.parentNode.querySelector('div.quantity input[type=number]').stepDown()\">-</button>";
}

function quantity_increase() {
    echo "<button type=\"button\" class='button quantity-button quantity-increase' onclick=\"this.parentNode.querySelector('div.quantity input[type=number]').stepUp()\">+</button></div>";
}

add_action( 'woocommerce_after_add_to_cart_quantity', 'quantity_increase');
add_action( 'woocommerce_before_add_to_cart_quantity', 'quantity_decrease');




/*
 * AJAX shopping cart
 * */
function ajax_shopping_cart() {
    echo do_shortcode('[woocommerce_cart]');
    die();
}

add_action('wp_ajax_nopriv_ajax_shopping_cart', 'ajax_shopping_cart');
add_action('wp_ajax_ajax_shopping_cart', 'ajax_shopping_cart');




/*
 * Change product image on hover
 * */
if (class_exists( 'WooCommerce' )) {

    if ( ! class_exists( 'WC_hover_image' ) ) {

        class WC_hover_image {

            public function __construct() {
                add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_second_product_thumbnail' ), 11 );
                add_filter( 'post_class', array( $this, 'product_has_gallery' ) );
            }



            /* Check if product item have gallery */
            public function product_has_gallery( $classes ) {
                global $product;

                $post_type = get_post_type( get_the_ID() );

                if ( ! is_admin() ) {

                    if ( $post_type == 'product' ) {

                        $attachment_ids = $this->get_gallery_image_ids( $product );

                        if ( $attachment_ids ) {
                            $classes[] = 'has-gallery';
                        }
                    }
                }

                return $classes;
            }


            /* Display secondary image inside items with galleries, so they can be handled by CSS */
            public function woocommerce_template_loop_second_product_thumbnail() {
                global $product;

                $attachment_ids = $this->get_gallery_image_ids( $product );

                if ( $attachment_ids ) {
                    $attachment_ids     = array_values( $attachment_ids );
                    $secondary_image_id = $attachment_ids['0'];

                    $secondary_image_alt = get_post_meta( $secondary_image_id, '_wp_attachment_image_alt', true );
                    $secondary_image_title = get_the_title($secondary_image_id);

                    echo wp_get_attachment_image(
                        $secondary_image_id,
                        'shop_catalog',
                        '',
                        array(
                            'class' => 'secondary-image attachment-shop-catalog wp-post-image wp-post-image--secondary',
                            'alt' => $secondary_image_alt,
                            'title' => $secondary_image_title
                        )
                    );
                }
            }



            /* Call get_gallery_image_ids() with a global variable $products */
            public function get_gallery_image_ids( $product ) {
                if ( ! is_a( $product, 'WC_Product' ) ) {
                    return;
                } else {
                    return $product->get_gallery_image_ids();
                }

            }

        }


        $WC_hover_image = new WC_hover_image();
    }
}










