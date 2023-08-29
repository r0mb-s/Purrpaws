$(document).ready(function(){
    var slideIndex = 0;
    slideShow();

    function slideShow(){
        $lista = $(".slide");

        for(let i = 0; i < $lista.length; i++)
            $($lista[i]).hide();
        
        if(slideIndex >= $lista.length)
            slideIndex = 0;

        $($lista[slideIndex]).show();

        slideIndex ++;
        setTimeout(slideShow, 5000);
    }
});