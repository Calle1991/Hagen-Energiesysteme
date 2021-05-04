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
$("#privat").click(function () {
  $("#stepOne__btn").addClass("active");
  $("#stepOne").animate({ "max-height": "500px" }, 800);
});

$("#gewerblich").click(function () {
  $("#stepOne__btn").removeClass("active");
  $(".accordionContent").animate({ "max-height": "0px" }, 800);
});

//Wählen Sie ein Modell
$("input:radio[name='product']").on("click", function (e) {
  $("#stepTwo__btn").addClass("active");
  $("#stepTwo").animate({ "max-height": "800px" }, 800);
});


//Stattliche Förderung sichern
$("#KFW__Nein").click(function () {
  $(".infoBox__KFW").css("opacity", "1");
});

$("#KFW__Ja").click(function () {
  $(".infoBox__KFW").css("opacity", "0");
});

$("#GRUEN__Nein").click(function () {
  $(".infoBox__gruenStrom").css("opacity", "1");
});

$("#GRUEN__Ja").click(function () {
  $(".infoBox__gruenStrom").css("opacity", "0");
});

//Postleitzahl eingeben

$("#plzInput").keyup(function () {
  if($("#plzInput").val() == '31226' || $("#plzInput").val() == '31224' || $("#plzInput").val() == '31228'){
    $("#gpl").css("display", "none");
    $("#swp").fadeIn();
  }else{
    $("#gpl").fadeIn();
    $("#swp").css("display", "none");
  }
});

//Fragebogen ausfüllen

$("input:radio[name='KFW']").on("click", function () {
  checkValidation();
});

$("input:radio[name='GRUEN']").on("click", function () {
  checkValidation();
});

function checkValidation() {

  if (
    $("input[name='KFW']:checked").val() &&
    $("input[name='GRUEN']:checked").val()
  ) {
    $("#stepThree__btn").addClass("active");
    $("#stepThree").animate({ "max-height": "100%" }, 800);
  } else {
    $("#stepThree").animate({ "max-height": "0px" }, 800);
  }
}

//Fragebogen (Multi-Form)
var steps = 0;
var maxSteps = $(".step").length;
checkStep(steps);
console.log(maxSteps);
console.log(steps);

$("#weiterBtn").on("click", function () {
  nextStep();
});

$("#zurueckBtn").on("click", function () {
  stepBack();
});

function checkStep(n) {
  switch (n) {
    case 0:
      $(".step").eq(n).fadeIn();
      $(".step")
        .eq(n + 1)
        .css("display", "none");
      $("#zurueckBtn").css("display", "none");
      $(".progressstep").eq(n).css("background-color", "#2da1ab")
      break;

    case 1:
      $(".step")
        .eq(n - 1)
        .css("display", "none");
      $(".step")
        .eq(n + 1)
        .css("display", "none");
      $(".step").eq(n).fadeIn();
      $("#zurueckBtn").css("display", "block");
      $(".progressstep").eq(n).css("background-color", "#2da1ab")
      break;

    case 2:
      $(".step")
        .eq(n - 1)
        .css("display", "none");
      $(".step").eq(n).fadeIn();
      $("#zurueckBtn").css("display", "block");
      $(".progressstep").eq(n).css("background-color", "#2da1ab")
      break;

    default:
      // Anweisungen werden ausgeführt,
      // falls keine der case-Klauseln mit expression übereinstimmt
      break;
  }
}

function nextStep() {
  if (validateForm(steps) == true) {
    steps++;
    checkStep(steps);
  } else {
    //nothing
  }
}

function stepBack() {
  steps--;
  checkStep(steps);
}

//Fragebogen - Validation
// First Step
function validateForm(n) {
  switch (n) {
    //Firststep
    case 0:
      var meter = $("input[name=meter]").val();
      var frage2 = $("input[name=frage2Checked]:checked").val();
      var frage3 = $("input[name=frage3Checked]:checked").val();
      var frage4 = $("input[name=frage4Checked]:checked").val();
      var frage5 = $("input[name=frage5Checked]:checked").val();
      var frage6 = $("input[name=frage6Checked]:checked").val();

      if (meter && frage2 && frage3 && frage4 && frage5 && frage6) {
        $(".errormessage").css("display", "none");
        return true;
      } else {
        $(".errormessage").css("display", "block");
        return false;
      }
    //Firststep
    case 1:
      var token = $("#token").val();
      var name = $("input[name=name]").val();
      var email = $("input[name=email]").val();
      var tel = $("input[name=tel]").val();
      var strasse = $("input[name=strasse]").val();
      var ort = $("input[name=ort]").val();
      var datenschutz = $("input[name=datenschutz]:checked").val();

      if (name && email && tel && strasse && ort && datenschutz) {
        $(".errormessage").css("display", "none");
        return true;
      } else {
        $(".errormessage").css("display", "block");
        return false;
      }
  }
}
