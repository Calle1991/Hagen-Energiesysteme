/*
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
*/


//Entscheiden ob Privat oder Gewerblich
$('#privat').click(function(){
  $('#stepOne__btn').addClass('active');
  $('#stepOne').animate({'max-height':'500px'},800);
  window.location.href = "index.html#stepOne__scroll"
});

$('#gewerblich').click(function(){
  $('#stepOne__btn').removeClass('active');
  $('.accordionContent').animate({'max-height':'0px'},800);
  window.location.href = "index.html#contact"
});



//Wählen Sie ein Modell
$("input:radio[name='product']").on('click', function(e) {
  $('#stepTwo__btn').addClass('active');
  $('#stepTwo').animate({'max-height':'500px'},800);
  window.location.href = "index.html#stepTwo__scroll"
});



//Stattliche Förderung sichern
$('#KFW__Nein').click(function(){
  $('.infoBox__KFW').css('visibility','visible');
});

$('#KFW__Ja').click(function(){
  $('.infoBox__KFW').css('visibility','hidden');
});


$('#GRUEN__Nein').click(function(){
  $('.infoBox__gruenStrom').css('visibility','visible');
});

$('#GRUEN__Ja').click(function(){
  $('.infoBox__gruenStrom').css('visibility','hidden');
});

//Postleitzahl eingeben

$('#plzInput').keyup(function(){
console.log($('#plzInput').val())
$('#plzTest').html($('#plzInput').val())
});

//Fragebogen ausfüllen


$("input:radio[name='KFW']").on("click",function(){
  checkValidation();
});

$("input:radio[name='GRUEN']").on("click",function(){
  checkValidation();
});

function checkValidation(){
  if($("input[name='KFW']:checked").val() == 'Ja' && $("input[name='GRUEN']:checked").val() == 'Ja'){
    window.location.href = "index.html#stepThree__scroll"
    $('#stepThree__btn').addClass('active');
    $('#stepThree').animate({'max-height':'500px'},800);
    
  }else{
    $('#stepThree').animate({'max-height':'0px'},800);
  }
}