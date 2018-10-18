jQuery().ready(function() {

    var hash = window.location.hash;
    //alert(hash);

    if (hash !== '') {
        jQuery(hash).addClass('open');
    }


});