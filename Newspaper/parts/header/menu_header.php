<!-- menu -->

<div class="td-menu-placeholder">

    <div class="td-menu-background">
        <div class="container td-menu-wrap">



            <div class="row-fluid">

                <div class="span11">
                    <div id="td-top-mobile-toggle">
                        <ul class="sf-menu">
                            <li>
                                <a href="#">
                                    <span class="menu_icon td-sp td-sp-ico-menu"></span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div id="td-top-menu" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

                            <?php

                            wp_nav_menu(array(
                                'theme_location' => 'header-menu',
                                'menu_class'=> 'sf-menu',
                                'fallback_cb' => 'td_wp_page_menu'
                            ));

                            //if no menu
                            function td_wp_page_menu() {
                                //this is the default menu
                                echo '<ul class="sf-menu">';
                                echo '<li class="menu-item-first"><a href="' . home_url() . '/wp-admin/nav-menus.php?action=locations">Click here - to select or create a menu</a></li>';
                                echo '</ul>';
                            }

                            ?>
                    </div>
                </div>

                <div class="span1" id="td-top-search">
                    <!-- Search -->
                    <div class="header-search-wrap">
                        <div class="dropdown header-search">
                            <a id="search-button" href="#" role="button" class="dropdown-toggle " data-toggle="dropdown"><span class="td-sp td-sp-ico-search"></span></a>
                            <div class="dropdown-menu" aria-labelledby="search-button">
                                <form role="search" method="get" class="td-search-form" action="<?php echo home_url( '/' ); ?>">
                                    <div class="td-head-form-search-wrap">
                                        <input class="needsclick" id="td-header-search" type="text" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" /><input class="wpb_button wpb_btn-inverse btn" type="submit" id="td-header-search-top" value="<?php _etd('Search')?>" />
                                    </div>
                                </form>
                                <div id="td-aj-search"></div>
                            </div>
                        </div>
                    </div>
                </div>


            </div> <!-- /.row-fluid -->
        </div> <!-- /.td-menu-wrap -->
    </div> <!-- /.td-menu-background -->
</div> <!-- /.td-menu-placeholder -->