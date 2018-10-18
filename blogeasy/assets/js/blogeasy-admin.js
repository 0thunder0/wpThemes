jQuery(document).ready(function(jQuery) {

    "use strict";

    jQuery(document).on( 'click', '.blogeasy-intro-notice .be-notice-dismiss', function(e) {
        e.preventDefault();
        jQuery.ajax({
            url: ajaxurl,
            data: {
                action: 'blogeasy-intro-dismissed'
            },
            success: function() {
                location.reload();
            }
        });
    });

});
