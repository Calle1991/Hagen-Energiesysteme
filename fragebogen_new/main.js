$(function() {
    // Input radio-group visual controls
    $('.radio-group label').on('click', function(){
        $(this).removeClass('not-active').siblings().addClass('not-active');
        
    });
});


$("#toTheSecond").click(function(){
    formValid = false

    alert($("input[name=meter]").val());
    alert($('input[name=frage2Checked]:checked').val());
    alert($('input[name=frage3Checked]:checked').val());
    alert($('input[name=frage4Checked]:checked').val());
    alert($('input[name=frage5Checked]:checked').val());
    alert($('input[name=frage6Checked]:checked').val());


    if(formValid){
        window.location.href = "second.html";
    }else{
        alert("Bitte alle Infomationen ausfüllen");
    }
    
});





//Validate Firstpage

function validateFirst(){
alert("TEST")
};

