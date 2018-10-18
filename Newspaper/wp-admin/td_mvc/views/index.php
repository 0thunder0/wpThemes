<?php

function td_run_index() {
    ?>
    <div class="td-wrap">
        <div class="td-section td-section-gray">
            <div class="td-section-title">Theme customizer:</div>
            This theme uses the wordpress theme customizer. <br> <br> <br>
            <a class="td-big-button" href="customize.php">Open theme customizer</a>
        </div>

        <div class="td-section td-section-gray">
            <div class="td-section-title">One click demo install:</div>
            With just one click you can install the demo on your site. The install process only takes one or two minutes and it will not create duplicated content.<br> <br> <br>
            <a class="td-big-button" href="<?php echo td_admin_controller::get_url('load_demo')?>" >Install demo</a>
        </div>


        <div class="td-section td-section-gray">
            <div class="td-section-title">Theme information:</div>
            <p>
            <ul>
                <li><strong>Theme name:</strong> <?php echo TD_THEME_NAME?> </li>
                <li><strong>Version:</strong> <?php echo TD_THEME_VERSION?> </li>
                <li><strong>Author:</strong> <a href="http://themeforest.net/user/tagDiv">tagDiv</a></li>
                <li><strong>Email:</strong> contact@tagDiv.com</li>
                <li><strong>Support forum (recommended):</strong> <a href="http://forum.tagdiv.com">forum.tagdiv.com</a></li>
                <li><strong>Documentation URL:</strong> <a href="<?php echo TD_THEME_DOC_URL?>"><?php echo TD_THEME_DOC_URL?></a></li>
                <li><strong>Demo URL:</strong> <a href="<?php echo TD_THEME_DEMO_URL?>"><?php echo TD_THEME_DEMO_URL?></a></li>
            </ul>
            </p>
        </div>



        <div class="td-section td-section-gray">
            <div class="td-section-title">Thanks!</div>
            <p>Thanks for using our theme, we had worked very hard to release a great product and we will do our absolute best to support this theme and fix all the issues.</p>
            <p>Marius and Radu from tagDiv - 2013</p>
        </div>
    </div>
    <?php
}
?>