<?php
function td_mvc_load_demo_index() {

    ?>

    <script>
        function td_progressbar_step(step_to_percent) {
            if (step_to_percent >= 100) {
                jQuery('.td_progress_bar').hide();
                jQuery('.td-loading').hide();
                jQuery('.td-complete').show();
                jQuery('.td-progress-show-details').show();
            } else {
                jQuery('.td_progress_bar div').css('width', step_to_percent + '%');
            }
        }


        jQuery().ready(function() {
           jQuery('.td-progress-show-details').click(function(){
               jQuery(this).hide();
               jQuery('.td-demo-msg').show('fast');
           });
        });
    </script>

    <div class="td-wrap">
        <div class="td-section td-loading">
            <div class="td-section-title">Loading the demo... </div>
            <p>Please wait until the demo is loading. It may take one or two minutes.</p>
        </div>

        <div class="td-section td-complete" style="display:none">
            <div class="td-section-title">The demo is live! :)</div>
            <p>That's it. Remember that you can always recreate the demo by just pressing the load demo button from this admin. It will not create duplicates, it will just rebuild the demo pages.</p>
        </div>


        <div class="td_progress_bar">
            <div></div>
        </div>


        <div><a href="#" class="td-progress-show-details">Show details</a></div>

        <?php

        //return;
        //new class
        $td_demo_site = new td_demo_site();
        $td_demo_site->total_progress_steps = 64; //used for loading bar


        /*  ----------------------------------------------------------------------------
            top menu
         */
        $td_demo_site->create_menu('td_demo_top');
        $td_demo_site->add_top_menu('Products review');
        $td_demo_site->add_top_menu('Custom 404');
        $td_demo_site->add_top_menu('Contact us');
        $td_demo_site->activate_menu('top-menu');


        /*  ----------------------------------------------------------------------------
            logo + ad
         */
        $td_demo_site->update_logo(get_template_directory_uri() . '/images/demo/logo-top.png', get_template_directory_uri() . '/images/demo/logo-top-retina.png');
        $td_demo_site->add_ad_spot('demo top ad', '',
            '<a href="#"><img src="' . $td_demo_site->get_demo_image('ad_top/ads-468.jpg') . '" alt="" /></a>',
            '<a href="#"><img src="' . $td_demo_site->get_demo_image('ad_top/ads-468.jpg') . '" alt="" /></a>',
            '<a href="#"><img src="' . $td_demo_site->get_demo_image('ad_top/ads-728.jpg') . '" alt="" /></a>'
        );
        $td_demo_site->set_header_adspot('demo top ad');




        /*  ----------------------------------------------------------------------------
            default sidebar
         */
        $td_demo_site->remove_widgets_from_sidebar('default');

        //ad widget + adspot
        $td_demo_site->add_ad_spot('demo sidebar ad',
            '<a href="#"><img src="' . $td_demo_site->get_demo_image('ad_sidebar/ads-300.jpg') . '" alt="" /></a>',
            '<a href="#"><img src="' . $td_demo_site->get_demo_image('ad_sidebar/ads-200.jpg') . '" alt="" /></a>',
            '<a href="#"><img src="' . $td_demo_site->get_demo_image('ad_sidebar/ads-250.jpg') . '" alt="" /></a>',
            '<a href="#"><img src="' . $td_demo_site->get_demo_image('ad_sidebar/ads-300.jpg') . '" alt="" /></a>'
        );
        $td_demo_site->add_widget_to_sidebar('default', 'td_ad_box_widget', array(
            'spot_name' => 'Ad spot -- demo sidebar ad'
        ));

        $td_demo_site->add_widget_to_sidebar('default', 'td_social_widget', array(
            'custom_title' => 'STAY CONNECTED',
            'facebook' => '#',
            'youtube' => '#',
            'github' => '#',
            'google' => '#',
            'googledrive' => '#',
            'googlemaps' => '#',
            'paypal' => '#'

        ));

        $td_demo_site->add_widget_to_sidebar('default', 'td_block4_widget', array(
            'sort' => '',
            'custom_title' => 'LATEST',
            'limit' => '5'
        ));


        /*  ----------------------------------------------------------------------------
            footer widgets
         */
        $td_demo_site->remove_widgets_from_sidebar('footer-1');
        $td_demo_site->add_widget_to_sidebar('footer-1', 'footer_logo_widget', array(
            'logo_url' => get_template_directory_uri() . '/images/demo/logo-footer.png',
            'logo_url_r' => get_template_directory_uri() . '/images/demo/logo-footer-retina.png',
            'footer_text' => 'Newspaper is your news, entertainment, music & fashion website. We provide you with the latest breaking news and videos straight from the entertainment industry.',
            'footer_text_2' => 'We are your all-access pass to all the A-List stars around the globe.',
            'footer_email' => 'contact@tagdiv.com'
        ));

        $td_demo_site->remove_widgets_from_sidebar('footer-2');
        $td_demo_site->add_widget_to_sidebar('footer-2', 'td_block4_widget', array(
            'sort' => 'featured',
            'custom_title' => 'FEATURED',
            'limit' => '3'
        ));

        $td_demo_site->remove_widgets_from_sidebar('footer-3');
        $td_demo_site->add_widget_to_sidebar('footer-3', 'td_popular_categories_widget', array(
            'limit' => 7,
            'custom_title' => 'POPULAR CATEGORIES'
        ));

        /*  ----------------------------------------------------------------------------
            footer menu
         */
        $td_demo_site->create_menu('td_demo_footer');
        $td_demo_site->add_top_menu('Privacy policy');
        $td_demo_site->add_top_menu('Advertising');
        $td_demo_site->add_top_menu('Contact us');
        $td_demo_site->activate_menu('footer-menu');
        $td_demo_site->set_theme_copyright('Copyright 2013 - your text');





        /*  ----------------------------------------------------------------------------
            header menu - make the main menu
         */
        $td_demo_site->create_menu('td header');
        $td_demo_site->activate_menu('header-menu');


        /*  ----------------------------------------------------------------------------
            pages
         */
        //add new pages to top menu
        $new_demo_page_64 = "W3ZjX3JvdyBlbF9wb3NpdGlvbj0iZmlyc3QgbGFzdCJdW3ZjX2NvbHVtbl1bdGRfc2xpZGVfYmlnIGxpbWl0PSI4IiBoaWRlX3RpdGxlPSJoaWRlX3RpdGxlIiBlbF9wb3NpdGlvbj0iZmlyc3QiXVt0ZF9ibG9jazIgbGltaXQ9IjMiIGN1c3RvbV90aXRsZT0iRE9OJ1QgTUlTUyIgc2hvd19jaGlsZF9jYXQ9IjMiIGFqYXhfcGFnaW5hdGlvbj0ibmV4dF9wcmV2Il1bL3ZjX2NvbHVtbl1bL3ZjX3Jvd10=";
        $td_demo_site->create_page('page', 'Home', base64_decode($new_demo_page_64), 'page-homepage-loop.php');
        $td_demo_site->add_top_page('[menu_home]');
        $td_demo_site->set_homepage();
        $td_demo_site->update_post_meta('td_homepage_loop', 'td_layout', '6');
        $td_demo_site->update_post_meta('td_homepage_loop', 'featured_posts', 'show_featured_posts');

        //one main category menu + homepage submenu
        $td_demo_site->add_top_menu('[menu_category]');
        $td_demo_site->create_page('page', 'Home', base64_decode($new_demo_page_64), 'page-homepage-loop.php');
        $td_demo_site->add_sub_page();


        //homepages
        $td_demo_site->add_top_menu('Homepages');


        $new_demo_page_64 = "W3ZjX3Jvd11bdmNfY29sdW1uIHdpZHRoPSIxLzEiXVt0ZF9zbGlkZV9iaWcgbGltaXQ9IjgiIGhpZGVfdGl0bGU9ImhpZGVfdGl0bGUiXVsvdmNfY29sdW1uXVsvdmNfcm93XVt2Y19yb3ddW3ZjX2NvbHVtbiB3aWR0aD0iMi8zIl1bdGRfYmxvY2syIGxpbWl0PSI2IiBzaG93X2NoaWxkX2NhdD0iMyIgYWpheF9wYWdpbmF0aW9uPSJuZXh0X3ByZXYiIGN1c3RvbV90aXRsZT0iU29tZSB0aXRsZSJdW3RkX3NsaWRlIGxpbWl0PSIzIiBoaWRlX3RpdGxlPSJoaWRlX3RpdGxlIiBzb3J0PSJwb3B1bGFyIl1bL3ZjX2NvbHVtbl1bdmNfY29sdW1uIHdpZHRoPSIxLzMiXVt0ZF9hZF9ib3ggc3BvdF9uYW1lPSJBZCBzcG90IC0tIHNpZGViYXIgYWQiXVt0ZF9zb2NpYWxfY291bnRlciBmYWNlYm9vaz0idGhlbWVmb3Jlc3QiIHR3aXR0ZXI9ImVudmF0byIgeW91dHViZT0iY29sbGVnZWh1bW9yIl1bdmNfdGFic11bdmNfdGFiIHRpdGxlPSJURUNIIiB0YWJfaWQ9IjEzNzc2ODg0NTItMS04NyJdW3RkX2Jsb2NrNCBsaW1pdD0iNCIgaGlkZV90aXRsZT0iaGlkZV90aXRsZSJdWy92Y190YWJdW3ZjX3RhYiB0aXRsZT0iVklERU8iIHRhYl9pZD0iMTM3NzY4ODQ1Mi0yLTg5Il1bdGRfYmxvY2s0IGxpbWl0PSI0IiBoaWRlX3RpdGxlPSJoaWRlX3RpdGxlIl1bL3ZjX3RhYl1bdmNfdGFiIHRpdGxlPSJHQU1FUyIgdGFiX2lkPSIxMzc3Njg4NjA3MjQyLTItMyJdW3RkX2Jsb2NrNCBsaW1pdD0iNCIgaGlkZV90aXRsZT0iaGlkZV90aXRsZSJdWy92Y190YWJdWy92Y190YWJzXVsvdmNfY29sdW1uXVsvdmNfcm93XQ==";
        $td_demo_site->create_page('page', 'Homepage 2', base64_decode($new_demo_page_64), 'page-homepage-loop.php');
        $td_demo_site->add_sub_page();


        $new_demo_page_64 = "W3ZjX3Jvd11bdmNfY29sdW1uIHdpZHRoPSIyLzMiXVt0ZF9zbGlkZSBsaW1pdD0iNSIgaGlkZV90aXRsZT0iaGlkZV90aXRsZSJdW3RkX2Jsb2NrMSBsaW1pdD0iNSIgc29ydD0icG9wdWxhciIgY3VzdG9tX3RpdGxlPSJNT1NUIFBPUFVMQVIiIGFqYXhfcGFnaW5hdGlvbj0ibG9hZF9tb3JlIl1bdGRfYmxvY2syIGxpbWl0PSI2IiBzaG93X2NoaWxkX2NhdD0iMyIgYWpheF9wYWdpbmF0aW9uPSJuZXh0X3ByZXYiXVt2Y19yb3dfaW5uZXJdW3ZjX2NvbHVtbl9pbm5lciB3aWR0aD0iMS8yIl1bdGRfc2xpZGUgbGltaXQ9IjMiXVsvdmNfY29sdW1uX2lubmVyXVt2Y19jb2x1bW5faW5uZXIgd2lkdGg9IjEvMiJdW3RkX2Jsb2NrNCBsaW1pdD0iNSJdWy92Y19jb2x1bW5faW5uZXJdWy92Y19yb3dfaW5uZXJdWy92Y19jb2x1bW5dW3ZjX2NvbHVtbiB3aWR0aD0iMS8zIl1bdGRfc29jaWFsX2NvdW50ZXIgZmFjZWJvb2s9InRoZW1lZm9yZXN0IiB0d2l0dGVyPSJlbnZhdG8iIHlvdXR1YmU9Impvbmxham9pZSJdW3RkX2Jsb2NrMyBsaW1pdD0iMyIgY3VzdG9tX3RpdGxlPSJMQVRFU1QgVklERU8iXVt0ZF9hZF9ib3ggc3BvdF9uYW1lPSJBZCBzcG90IC0tIHNpZGViYXIgYWQiXVt0ZF9ibG9jazIgbGltaXQ9IjQiIGN1c3RvbV90aXRsZT0iVFJBVkVMIl1bL3ZjX2NvbHVtbl1bL3ZjX3Jvd10=";
        $td_demo_site->create_page('page', 'Homepage 3', base64_decode($new_demo_page_64), 'page-homepage-blank.php');
        $td_demo_site->add_sub_page();


        $new_demo_page_64 = "W3ZjX3Jvd11bdmNfY29sdW1uIHdpZHRoPSIyLzMiXVt0ZF9zbGlkZSBsaW1pdD0iNSIgaGlkZV90aXRsZT0iaGlkZV90aXRsZSJdW3RkX2Jsb2NrMSBsaW1pdD0iNSIgc29ydD0icG9wdWxhciIgY3VzdG9tX3RpdGxlPSJNT1NUIFBPUFVMQVIiIGFqYXhfcGFnaW5hdGlvbj0ibG9hZF9tb3JlIl1bdGRfYmxvY2syIGxpbWl0PSI2IiBzaG93X2NoaWxkX2NhdD0iMyIgYWpheF9wYWdpbmF0aW9uPSJuZXh0X3ByZXYiIGN1c3RvbV90aXRsZT0iU29tZSB0aXRsZSJdW3ZjX3Jvd19pbm5lcl1bdmNfY29sdW1uX2lubmVyIHdpZHRoPSIxLzIiXVt0ZF9zbGlkZSBsaW1pdD0iMyIgY3VzdG9tX3RpdGxlPSJTb21lIHRpdGxlIl1bL3ZjX2NvbHVtbl9pbm5lcl1bdmNfY29sdW1uX2lubmVyIHdpZHRoPSIxLzIiXVt0ZF9ibG9jazQgbGltaXQ9IjUiIGN1c3RvbV90aXRsZT0iU29tZSB0aXRsZSJdWy92Y19jb2x1bW5faW5uZXJdWy92Y19yb3dfaW5uZXJdWy92Y19jb2x1bW5dW3ZjX2NvbHVtbiB3aWR0aD0iMS8zIl1bdGRfc29jaWFsX2NvdW50ZXIgZmFjZWJvb2s9InRoZW1lZm9yZXN0IiB0d2l0dGVyPSJlbnZhdG8iIHlvdXR1YmU9Impvbmxham9pZSJdW3RkX2Jsb2NrMyBsaW1pdD0iMyIgY3VzdG9tX3RpdGxlPSJMQVRFU1QgVklERU8iXVt0ZF9hZF9ib3ggc3BvdF9uYW1lPSJBZCBzcG90IC0tIHNpZGViYXIgYWQiXVt0ZF9ibG9jazIgbGltaXQ9IjQiIGN1c3RvbV90aXRsZT0iVFJBVkVMIl1bL3ZjX2NvbHVtbl1bL3ZjX3Jvd10=";
        $td_demo_site->create_page('page', 'Homepage 4', base64_decode($new_demo_page_64), 'page-homepage-blank.php');
        $td_demo_site->add_sub_page();



        //contact
        $new_demo_page_64 = "W3ZjX3JvdyBlbF9wb3NpdGlvbj0iZmlyc3QgbGFzdCJdW3ZjX2NvbHVtbiB3aWR0aD0iMi8zIl1bdmNfY29sdW1uX3RleHRdDQoNCkxvcmVtIGlwc3VtIGRvbG9yIHNpdCBhbWV0LCBjb25zZWN0ZXR1ciBhZGlwaXNjaW5nIGVsaXQuIFN1c3BlbmRpc3NlIG5vbiBudW5jIGFjIHF1YW0gY29uZ3VlIGZlcm1lbnR1bSBldCB2ZWwgbWFzc2EuIFByb2luIGltcGVyZGlldCBwdWx2aW5hciByaG9uY3VzLiBJbnRlZ2VyIGluIGVsaXQgYWNjdW1zYW4sIHVsbGFtY29ycGVyIGFudGUgbm9uLCBjb21tb2RvIHZlbGl0LiBOdW5jIGx1Y3R1cyBzY2VsZXJpc3F1ZSBkdWksIHZpdGFlIGx1Y3R1cyBlc3QgYXVjdG9yIGV1Lg0KDQpbL3ZjX2NvbHVtbl90ZXh0XVt2Y19nbWFwcyBsaW5rPSJodHRwOi8vbWFwcy5nb29nbGUuY29tL21hcHM/cT1Ub3duK0hhbGwrU3F1YXJlLCtLZW50K1N0cmVldCwrU3lkbmV5LCtOZXcrU291dGgrV2FsZXMsK0F1c3RyYWxpYSZhbXA7aGw9ZW4mYW1wO3NsbD0tMzMuODg3NDY0LDE1MS4xODc5NjgmYW1wO3NzcG49MC4wMDc0NzIsMC4wMTY1MTImYW1wO29xPXNxdWFyZSthdXN0cmFsaWErc3kmYW1wO3Q9aCZhbXA7aHE9VG93bitIYWxsK1NxdWFyZSwmYW1wO2huZWFyPUtlbnQrU3QsK05ldytTb3V0aCtXYWxlcysyMDAwLCtBdXN0cmFsaWEmYW1wO3o9MTYiIHNpemU9IjMwOCIgdHlwZT0ibSIgem9vbT0iMTQiXVt2Y19yb3dfaW5uZXJdW3ZjX2NvbHVtbl9pbm5lciB3aWR0aD0iMS8yIl1bdGRfdGV4dF93aXRoX3RpdGxlIHRpdGxlPSJDb250YWN0IiBzdHlsZT0ic3R5bGVfMiIgZWxfcG9zaXRpb249ImZpcnN0IGxhc3QiIGN1c3RvbV90aXRsZT0iQ09OVEFDVCBERVRBSUxTIl0NCg0KTmV3c3BhcGVyIENvbXVuaWNhdGlvbiBTZXJ2aWNlDQo0MjUgU2FudGEgVGVyZXNhIFN0Lg0KU3RhbmZvcmQsIENBIDQ1MiAxNCA1MjENCg0KKDY1MCkgNzIzLTI1NTggKG1haW4gbnVtYmVyKQ0KKDY1MCkgNzI1LTAyNDcgKGZheCkNCg0KRW1haWw6IGNvbnRhY3RAbmV3c3BhcGVyLmNvbQ0KDQpbL3RkX3RleHRfd2l0aF90aXRsZV1bL3ZjX2NvbHVtbl9pbm5lcl1bdmNfY29sdW1uX2lubmVyIHdpZHRoPSIxLzIiXVt0ZF9zb2NpYWwgY3VzdG9tX3RpdGxlPSJPVVIgU09DSUFMIFBST0ZJTEVTIiBpY29uX3N0eWxlPSIxIiBpY29uX3NpemU9IjMyIiBkcmliYmJsZT0iaHR0cDovL3d3dy50YWdkaXYuY29tIiBmYWNlYm9vaz0iaHR0cDovL3d3dy50YWdkaXYuY29tIiBnb29nbGVwbHVzPSIjIiBncm9vdmVzaGFyaz0iaHR0cDovL3d3dy50YWdkaXYuY29tIiBsaW5rZWRpbj0iIyIgdHdpdHRlcj0iaHR0cDovL3d3dy50YWdkaXYuY29tIiB5b3V0dWJlPSJodHRwOi8vd3d3LnRhZ2Rpdi5jb20iIGVsX3Bvc2l0aW9uPSJmaXJzdCJdW3RkX3RleHRfd2l0aF90aXRsZSBjdXN0b21fdGl0bGU9IldPUktJTkcgSE9VUiJdDQoNClRoZSBvZmZpY2UgaXMgb3BlbiBmcm9tIDggYS5tLiB0byA1IHAubS4gTW9uZGF5IHRocm91Z2ggRnJpZGF5IGV4Y2VwdCB1bml2ZXJzaXR5IGhvbGlkYXlzLg0KDQpbL3RkX3RleHRfd2l0aF90aXRsZV1bL3ZjX2NvbHVtbl9pbm5lcl1bL3ZjX3Jvd19pbm5lcl1bY29udGFjdC1mb3JtLTcgaWQ9Ijc5NyIgdGl0bGU9IkxFQVZFIFVTIEEgTUVTU0FHRSJdWy92Y19jb2x1bW5dW3ZjX2NvbHVtbiB3aWR0aD0iMS8zIl1bdmNfd2lkZ2V0X3NpZGViYXIgc2lkZWJhcl9pZD0idGQtZGVmYXVsdCIgZWxfcG9zaXRpb249ImZpcnN0IGxhc3QiXVsvdmNfY29sdW1uXVsvdmNfcm93XQ==";
        $td_demo_site->create_page('page', 'Home', base64_decode($new_demo_page_64), 'page-pagebuilder-title.php');
        $td_demo_site->add_top_page('Contact us');


        /*  ----------------------------------------------------------------------------
            posts
         */
        $td_demo_site->create_page('post');
        $td_demo_site->add_featured_image();

        $td_demo_site->create_page('post');
        $td_demo_site->add_featured_image();

        $td_demo_site->create_page('post');
        $td_demo_site->add_featured_image();

        $td_demo_site->create_page('post');
        $td_demo_site->add_featured_image();

        $td_demo_site->create_page('post');
        $td_demo_site->add_featured_image();

        $td_demo_site->create_page('post');
        $td_demo_site->add_featured_image();

        $td_demo_site->create_page('post');
        $td_demo_site->add_featured_image();

        $td_demo_site->create_page('post');
        $td_demo_site->add_featured_image();

        $td_demo_site->create_page('post');
        $td_demo_site->add_featured_image();

        $td_demo_site->create_page('post');
        $td_demo_site->add_featured_image();

        $td_demo_site->create_page('post');
        $td_demo_site->add_featured_image();

        ?>
    </div>
    <?php
}