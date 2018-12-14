

    $( ".navButton" ).click(function() {
  $( this ).toggleClass( "active" );
  $(".navvv").slideToggle();
});



$('a[href^="#"]').on('click', function(event) {
    var target = $(this.getAttribute('href'));
    if( target.length ) {
        event.preventDefault();
        $('html, body').stop().animate({
            scrollTop: target.offset().top - 220
        }, 1000);
    }
});



var windowWidth = $(window).width()

  if (windowWidth < 973) 
  {
    $('.mob-des .row').addClass('justify-content-center');
    $('.footerimg').addClass('text-center');
  }










    $("img.checkable").imgCheckbox({
     
        "scaleSelected" :false ,
        "graySelected" : false,
        "fixedImageSize":"auto 30px",
        "checkMarkSize" : "0px",
        "addToForm" : true,
        "styles": {
        "span.imgCheckbox.imgChked img": {
            
            "filter": "grayscale(0)",
            "-webkit-filter": "grayscale(0)",
            "-moz-filter":"grayscale(0)",
            "ms-filter":"grayscale(0)",
            "-o-filter":"grayscale(0)",
            "border-color":"white"
        },

        "span.imgCheckbox.imgChked": {
            
            "border": "0",
            "background-color":"white",
            "border-radius":"5px"
        }
    }


});




$("img.checkable2").imgCheckbox({
     
        "scaleSelected" :false ,
        "graySelected" : false,
        "fixedImageSize":"auto 30px",
        "checkMarkSize" : "0px",
        "addToForm" : true,
        "styles": {
        "span.imgCheckbox.imgChked img": {
            
            "border-color":"#f53123"
        },

        "span.imgCheckbox.imgChked": {
            
            "border": "0",
            "background-color":"white",
            "border-radius":"5px"
        }
    }


});