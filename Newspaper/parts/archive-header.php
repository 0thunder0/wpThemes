<?php

if (is_day()) {
    $td_archive_title = __td('Daily Archives: ') . get_the_date();
} elseif (is_month()) {
    $td_archive_title = __td('Monthly Archives: ') . get_the_date('F Y');
} elseif (is_year()) {
    $td_archive_title = __td('Yearly Archives: ') . get_the_date('Y');
} else {
    $td_archive_title = __td('Archives');
}

?><h1 itemprop="name" class="entry-title td-page-title">
    <span><?php echo $td_archive_title; ?></span>
</h1>