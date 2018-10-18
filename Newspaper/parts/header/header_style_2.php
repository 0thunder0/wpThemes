<!-- logo and ad -->
<div class="td-header-bg">
    <div class="container td-logo-rec-wrap">
        <div class="row">
            <div class="span4 header-logo-wrap" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">
                <div class="td-logo-wrap-align">
                    <a itemprop="url" class="td-logo-wrap" href="<?php echo home_url(); ?>">
                        <span class="td-logo-text"><?php echo get_bloginfo( 'name' ); ?></span>
                        <span class="td-tagline-text"><?php echo get_bloginfo( 'description' ); ?></span>
                    </a>
                </div>
                <meta itemprop="name" content="<?php bloginfo('name')?>">
            </div>
            <div class="span8">
                <?php
                $tds_top_ad_spot = td_util::get_option('tds_top_ad_spot');
                if (!empty($tds_top_ad_spot)) {
                    //show the responsive ad spots via the shortcode
                    echo td_global_blocks::get_instance('td_ad_box')->render(array('spot_name' => $tds_top_ad_spot));
                } else {
                    //show the default text ad spot
                    $tds_top_ad_code = td_util::get_option('tds_top_ad_code');
                    if (!empty($tds_top_ad_code)) {
                        echo '<div class="td-rec-default">' . $tds_top_ad_code . '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
