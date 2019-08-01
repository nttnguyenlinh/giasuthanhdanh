$(document).ready(function(){
    $('details').click(function (event) {
        $('details').not(this).removeAttr("open");
    });
});