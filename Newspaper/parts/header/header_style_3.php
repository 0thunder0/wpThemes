<!-- logo and ad -->
<div class="td-header-bg">
    <div class="container header-style-3">
        <div class="row">
            <div class="span12 td-full-logo" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">
                <div class="td-grid-wrap">
                    <div class="container-fluid">
                        <?php
                        //read the logo + retina logo
                        $td_customLogo = td_util::get_option('tds_logo_upload');
                        $td_customLogoR = td_util::get_option('tds_logo_upload_r');

                        $td_logo_text = td_util::get_option('tds_logo_text');
                        $td_tagline_text = td_util::get_option('tds_tagline_text');

                        $td_logo_alt = td_util::get_option('tds_logo_alt');
                        $td_logo_title = td_util::get_option('tds_logo_title');

                        if (!empty($td_logo_title)) {
                            $td_logo_title = ' title="' . $td_logo_title . '"';
                        }

                        if (!empty($td_customLogoR)) {
                            //if retina
                            ?>
                            <a itemprop="url" href="<?php echo home_url(); ?>">
                                <img class="td-retina-data" itemprop="logo" data-retina="<?php echo htmlentities($td_customLogoR) ?>" src="<?php echo $td_customLogo?>" alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/>
                            </a>
                            <meta itemprop="name" content="<?php bloginfo('name')?>">
                        <?php
                        } else {
                            //not retina
                            if (!empty($td_customLogo)) {
                                ?>
                                <a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo $td_customLogo?>" alt="<?php echo $td_logo_alt ?>"<?php echo $td_logo_title ?>/></a>
                                <meta itemprop="name" content="<?php bloginfo('name')?>">
                            <?php
                            }
                        }

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
    </div>
</div>
