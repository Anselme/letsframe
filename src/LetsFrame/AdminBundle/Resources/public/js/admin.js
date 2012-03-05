$(function() {
    $(".confirm").on('click', function() {
         if(!confirm($(this).text()+" ?")) return false ;
    });
});
