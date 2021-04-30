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


//Card - Validation

$('#privat').click(function(){
  $('#stepOne__btn').addClass('active');
  $('#stepOne').css('max-height','100%');
});


$('#KFW__Nein').click(function(){
  $('.infoBox__KFW').css('visibility','visible');
});


//Radiobutton Validation - Accordion
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