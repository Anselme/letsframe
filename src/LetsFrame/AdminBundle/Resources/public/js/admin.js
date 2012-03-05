$(function() {
    $(".confirm").on('click', function() {
         if(!confirm($(this).text()+" ?")) return false ;
    });

    $(".confirmimg").on('click', function() {
        if(!confirm($(this).find("> img").attr("alt")+" ?")) return false ;
    });


});
