
//###################### Privat oder Gewerbe ########################

$("input:radio[name='card']").on("click", function() {
  if($("input:radio[name='card']:checked").val() == "privat"){
    $("#stepOne__btn").addClass("active");
    $("#stepOne").animate({ "max-height": "100%" }, 800);
  }else{
    $("#stepOne__btn").removeClass("active");
    $(".accordionContent").animate({ "max-height": "0px" }, 800);
  }
})



//###################### Ladeboxmodelle ########################
$("input:radio[name='product']").on("click", function (e) {
  $("#stepTwo__btn").addClass("active");
  $("#stepTwo").animate({ "max-height": "100%" }, 800);
});




//###################### KFW und Günstrom ########################


$("input:radio[name='KFW']").click(function () {
  if ($("input:radio[name='KFW']:checked").val() == "Ja") {
    $(".infoBox__KFW").animate({ "opacity": "0" }, 500);
    $(".infoBox__KFW").fadeOut();
  } else {
    $(".infoBox__KFW").css("display", "flex");
    $(".infoBox__KFW").animate({ "opacity": "1" }
      , 500);;
  }
});


$("input[name='GRUEN'").on("click", function() {
  if ($("input:radio[name='GRUEN']:checked").val() == "Ja") {
    $(".infoBox__gruenStrom").animate({ "opacity": "0" }, 500);
    $(".infoBox__gruenStrom").fadeOut();
  } else {
    $(".infoBox__gruenStrom").css("display", "flex");
    $(".infoBox__gruenStrom").animate({ "opacity": "1" }
      , 500);;
  }
});


$("input:radio[name='KFW']").on("click", function () {
  checkValidation_KFW_GRUEN();
});

$("input:radio[name='GRUEN']").on("click", function () {
  checkValidation_KFW_GRUEN();
});

function checkValidation_KFW_GRUEN() {

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

//###################### Postleitzahl abfragen ########################

$("#plzInput").keyup(function () {
  if ($("#plzInput").val() == '31226' || $("#plzInput").val() == '31224' || $("#plzInput").val() == '31228') {
    $("#gpl").css("display", "none");
    $("#swp").fadeIn();
  } else {
    $("#gpl").fadeIn();
    $("#swp").css("display", "none");
  }
});



//######################Fragebogen ausfüllen########################

//###################### Multi-Step-Form ########################
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


//###################### Welcher Step ist aktuell ########################

function checkStep(n) {
  switch (n) {
    case 0:
      $(".step").eq(n).fadeIn();
      $(".step")
        .eq(n + 1)
        .css("display", "none");
      $("#zurueckBtn").css("visibility", "hidden");
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
      $("#zurueckBtn").css("visibility", "visible");
      $(".progressstep").eq(n).css("background-color", "#2da1ab")
      break;

    case 2:
      $(".step")
        .eq(n - 1)
        .css("display", "none");
      $(".step").eq(n).fadeIn();
      $("#zurueckBtn").css("visibility", "visible");
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


//###################### Fragebogen - Validation ########################


function validateForm(n) {
  switch (n) {

    //###################### Validation - Step (0) ########################
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

    //###################### Validation - Step (1) ########################
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
    ////###################### Validation - Step (2) ########################
    case 2:
      alert("TEST");
  }
}


