<!doctype html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title> <?php bloginfo('name'); ?><?php wp_title(' | '); ?>  </title>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
</head>


<?php $zbradu_classes = is_front_page() ? array( 'front-page' ) : array( 'not-front-page' ); ?>


<body <?php body_class( $zbradu_classes ); ?> >

<header class="header">

    <!-- Logo and user navigation -->
    <div class="header__logo-bar">
        <div class="header__logo-bar-inner">
            <div class="logo">
                <?php
                if ( function_exists( 'the_custom_logo' ) ) {
                    the_custom_logo();
                }
                ?>
            </div>

            <div class="user-nav">
                <?php
                wp_nav_menu(array(
                        'theme_location' => 'user-nav',
                        'container' => false,
                        'menu_class' => 'zbradu-navbar zbradu-navbar-right'
                    )
                );
                ?>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>


    <!-- Carousel/Hero -->
    <?php get_template_part( 'carousel' ); ?>


    <!-- Main navigation -->
    <nav class="header__navigation-bar">
        <?php
        wp_nav_menu(array(
                'theme_location' => 'primary-header-nav',
                'container' => false,
                'menu_class' => 'zbradu-navbar zbradu-navbar-center',
                'walker' => new Walker_Nav_Primary()
            )
        );
        ?>
    </nav>


    <!-- Overlay -->
    <?php get_template_part( 'overlay' ); ?>

    <!-- Cart Overlay -->
    <?php /*get_template_part( 'cart-overlay' ); */?>

</header>

<main class="main">
