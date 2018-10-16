<?php

/*
 * Include scripts
 * */
function zbradu_script_enqueue() {

    /* CSS */
    wp_enqueue_style('owlcarousel', get_template_directory_uri() . '/css/vendor/owl.carousel.min.css');
    wp_enqueue_style('owl-theme-default', get_template_directory_uri() . '/css/vendor/owl.theme.default.min.css'); // todo: try to remove
    wp_enqueue_style('normalize', get_template_directory_uri() . '/css/vendor/normalize.css');
    wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/zbradu.css', array(), '1.0.0', 'all'); // todo: switch to .min.css after development is finished

    /* JS */
    wp_enqueue_script ('jquery');
    wp_enqueue_script('owlcarouseljs', get_template_directory_uri() . '/js/vendor/owl.carousel.min.js', array( 'jquery'), false, true);
    wp_enqueue_script('customjs', get_template_directory_uri() . '/js/zbradu.js', array(), '1.0.0', true);
    wp_enqueue_script('wc-cart');

    /* AJAX */
    wp_localize_script( 'customjs', 'zbradu_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

    /* Fonts */
    wp_enqueue_style('font-chewy', 'https://fonts.googleapis.com/css?family=Chewy', false );
    wp_enqueue_style('font-fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
    wp_enqueue_style('font-zbradu', get_template_directory_uri() . '/fonts/zbradu-icons/style.css', array(), '1.0.0', 'all');
}
add_action( 'wp_enqueue_scripts', 'zbradu_script_enqueue');




/*
 * Add viewport meta tags
 * */
function set_meta_tags () {

    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge" /><!-- use latest IE engine-->';
    echo '<meta name="viewport"  content="width = device-width, initial-scale=1" /><!-- cross-device displaying adjustments-->';

}
add_action ('wp_head', 'set_meta_tags');




/*
 * Include Walker file
 * */
require get_template_directory() . '/inc/functions/functions-walker.php';




/*
 * Head function
 * */
function zbradu_remove_version() {
    return '';
}
add_filter('the_generator' , 'zbradu_remove_version');




/*
 * Theme support function
 * */
add_theme_support('menus');
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_theme_support('html5', array('search-form'));
add_theme_support('custom-logo');




/*
 * Activate menu
 * */
function zbradu_menus_setup() {

    register_nav_menu('primary-header-nav', 'Primary Header Navigation');
    register_nav_menu('user-nav', 'User Navigation');
    register_nav_menu('footer-bottom-right', 'Footer Bottom - Right');
    register_nav_menu('overlay-left', 'Overlay Bottom - Left');
    register_nav_menu('overlay-right', 'Overlay Bottom - Right');

}
add_action( 'init', 'zbradu_menus_setup');




/*
 * Sidebar function
 * */
function zbradu_widget_setup() {

    register_sidebar(
        array (
            'name' => 'Sidebar',
            'id' => 'sidebar-1',
            'class' => 'custom',
            'description' => 'Standard Sidebar',
            'before_widget' => '<aside id="%1$s" class="%2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        )
    );

    register_sidebar(
        array (
            'name' => 'Footer Top Left',
            'id' => 'footer-top-left',
            'class' => 'custom',
            'description' => 'Footer Top Left Area',
            'before_widget' => '<aside id="%1$s" class="%2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );

    register_sidebar(
        array (
            'name' => 'Footer Top Middle',
            'id' => 'footer-top-middle',
            'class' => 'custom',
            'description' => 'Footer Top Middle Area',
            'before_widget' => '<aside id="%1$s" class="%2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );

    register_sidebar(
        array (
            'name' => 'Footer Top Right',
            'id' => 'footer-top-right',
            'class' => 'custom',
            'description' => 'Footer Top Right Area',
            'before_widget' => '<aside id="%1$s" class="%2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );

    register_sidebar(
        array (
            'name' => 'Footer Bottom Left',
            'id' => 'footer-bottom-left',
            'class' => 'custom',
            'description' => 'Footer Bottom Left Area',
            'before_widget' => '<aside id="%1$s" class="%2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}
add_action ('widgets_init', 'zbradu_widget_setup');




/*
* Custom Term Function
* */
function zbradu_get_terms ($postID, $term, $prefix = "") {

    $terms_list = wp_get_post_terms($postID, $term);
    $output = '';

    $i = 0;
    foreach( $terms_list as $term) { $i++;
        if($i > 1){$output .= ', ';}
        if($i == 1){$output .= $prefix;}
        $output .= '<a href="' . get_term_link($term) . '">'. $term->name .'</a>';
    }

    return $output;
}


