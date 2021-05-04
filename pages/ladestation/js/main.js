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
  $("#stepTwo").animate({ "max-height": "500px" }, 800);
});

//Stattliche Förderung sichern
$("#KFW__Nein").click(function () {
  $(".infoBox__KFW").css("visibility", "visible");
});

$("#KFW__Ja").click(function () {
  $(".infoBox__KFW").css("visibility", "hidden");
});

$("#GRUEN__Nein").click(function () {
  $(".infoBox__gruenStrom").css("visibility", "visible");
});

$("#GRUEN__Ja").click(function () {
  $(".infoBox__gruenStrom").css("visibility", "hidden");
});

//Postleitzahl eingeben

$("#plzInput").keyup(function () {
  console.log($("#plzInput").val());
  $("#plzTest").html($("#plzInput").val());
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
      $(".step").eq(n + 1).css("display", "none");
      $("#zurueckBtn").css("display", "none");
      break;

    case 1:
      $(".step").eq(n - 1).css("display", "none");
      $(".step").eq(n + 1).css("display", "none");
      $(".step").eq(n).fadeIn();
      $("#zurueckBtn").css("display", "block");
      break;

    case 2:
      $(".step").eq(n - 1).css("display", "none");
      $(".step").eq(n).fadeIn();
      $("#zurueckBtn").css("display", "block");
      break;

    default:
      // Anweisungen werden ausgeführt,
      // falls keine der case-Klauseln mit expression übereinstimmt
      break;
  }
}

function nextStep() {
  steps++;
  checkStep(steps);
}

function stepBack() {
  steps--;
  checkStep(steps);
}
