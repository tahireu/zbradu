<div class="header__overlay">
    <div class="header__overlay-inner">


        <!-- Top -->
        <div class="header__overlay--top">
            <div class="logo">
                <?php
                if ( function_exists( 'the_custom_logo' ) ) {
                    the_custom_logo();
                }
                ?>
            </div>
            <div class="close-trigger"></div>
        </div>


        <!-- Middle -->
        <div class="header__overlay--middle">
            <div class="search-holder">
                <?php get_template_part('overlay-search'); ?>
            </div>

            <div class="cart-holder">
                <!-- content is handled with ajax -->
            </div>
        </div>


        <!-- Bottom -->
        <div class="header__overlay--bottom">
            <div class="bottom--left">
                <?php
                wp_nav_menu(array(
                        'theme_location' => 'overlay-left',
                        'container' => false,
                        'menu_class' => 'zbradu-navbar zbradu-navbar-left'
                    )
                );
                ?>
            </div>
            <div class="bottom--right">
                <?php
                wp_nav_menu(array(
                        'theme_location' => 'overlay-right',
                        'container' => false,
                        'menu_class' => 'zbradu-navbar zbradu-navbar-right'
                    )
                );
                ?>
            </div>
        </div>


        <!-- Loader image -->
        <div class="loader-image">
            <div class="loader-image-inner"></div>
        </div>


    </div>
</div>