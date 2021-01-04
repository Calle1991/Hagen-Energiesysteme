$(function() {
    // Input radio-group visual controls
    $('.radio-group label').on('click', function(){
        $(this).removeClass('not-active').siblings().addClass('not-active');
        
    });
});


$("#toTheSecond").click(function(){
    window.location.href = "second.html";
});

$("#toTheThird").click(function(){
    window.location.href = "third.html";
});



//Validate First

