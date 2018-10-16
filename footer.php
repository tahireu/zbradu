

        </main> <!-- .container-->

        <footer class="footer">

            <!-- Top -->
            <?php if(is_active_sidebar('footer-top-left') || is_active_sidebar('footer-top-middle') || is_active_sidebar('footer-top-right')){ ?>
            <div class="footer__top">

                <div class="footer__top__left">
                    <?php if(is_active_sidebar('footer-top-left')){
                        dynamic_sidebar('footer-top-left');
                    } ?>
                </div>

                <div class="footer__top__middle">
                    <?php if(is_active_sidebar('footer-top-middle')){
                        dynamic_sidebar('footer-top-middle');
                    } ?>
                </div>

                <div class="footer__top__right">
                    <?php if(is_active_sidebar('footer-top-right')){
                        dynamic_sidebar('footer-top-right');
                    } ?>
                </div>

                <div class="clearfix"></div>

            </div>
            <?php } ?>


            <!-- Bottom -->
            <div class="footer__bottom">

                <div class="footer__bottom__left">
                    <?php if(is_active_sidebar('footer-bottom-left')){
                        dynamic_sidebar('footer-bottom-left');
                    } ?>
                </div>

                <div class="footer__bottom__right">
                    <?php
                    wp_nav_menu(array(
                            'theme_location' => 'footer-bottom-right',
                            'container' => false,
                            'menu_class' => 'zbradu-navbar zbradu-navbar-right'
                        )
                    );
                    ?>
                </div>

                <div class="clearfix"></div>

            </div>

            <div class="footer__scripts">
                <?php wp_footer(); ?>
            </div>

        </footer>

    </body>
</html>
