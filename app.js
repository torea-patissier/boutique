$(document).ready(function(){
    $('.btn-navigation').click(function(){
        $(this).find('.barre').toggleClass('white');
        $('.navigation').toggleClass('isOpen');
    })
});



