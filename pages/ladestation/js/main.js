
//###################### Privat oder Gewerbe ########################

$("input:radio[name='card']").on("click", function () {
  if ($("input:radio[name='card']:checked").val() == "privat") {
    $("#stepOne__btn").addClass("activeAcc");
    $("#stepOne").animate({ "max-height": "100%" }, 800);
    window.location = "index.html#stepOne__scroll";
  } else {
    $("#stepOne__btn").removeClass("activeAcc");
    $(".accordionContent").animate({ "max-height": "0px" }, 800);
    window.location = "index.html#contact";
  }
})



//###################### Ladeboxmodelle ########################

$("#farbe").change(function () {
  productValidation();
});

$("#laenge").change(function () {
  productValidation();
});


$("input:radio[name='product']").on("click", function (e) {
  if (e.currentTarget.defaultValue == "WallboxPulsarPlus") {
    productValidation();
  } else {

    $("#stepTwo__btn").addClass("activeAcc");
    $("#stepTwo").animate({ "max-height": "100%" }, 800);
    window.location = "index.html#stepTwo__scroll";
  }

});

//Pulsar Plus
function productValidation() {
  var farbe = $("#farbe").val()
  var laenge = $("#laenge").val()
  if (farbe != "not" && laenge != "not") {
    $("input:radio[value='WallboxPulsarPlus']").prop("checked", true);
    $("#stepTwo__btn").addClass("activeAcc");
    $("#stepTwo").animate({ "max-height": "100%" }, 800);
    $(".auswahl > .errormessage").css("display", "none");
    window.location = "index.html#stepTwo__scroll";
  } else {
    $(".auswahl > .errormessage").css("display", "block");
    $("input:radio[value='WallboxPulsarPlus']").prop("checked", false);
  }


}



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


$("input[name='GRUEN'").on("click", function () {
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

  if ($("input[name='KFW']:checked").val() && $("input[name='GRUEN']:checked").val()) {

    if ($("input[name='KFW']:checked").val() == 'Nein') {
      window.location = "index.html#scroll_kfw";
    }

    if ($("input[name='GRUEN']:checked").val() == 'Nein') {
      window.location = "index.html#scroll_gruen";
    }

    $("#stepThree__btn").addClass("activeAcc");
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
      $(".infoBox__fragebogen").css("display", "none");
      $("#zurueckBtn").css("display", "none");
      $("#weiterBtn").css("display", "none");
      $(".step")
        .eq(n - 1)
        .css("display", "none");
      $(".step").eq(n).fadeIn();
      $("#zurueckBtn").css("visibility", "visible");
      $(".progressstep").eq(n).css("background-color", "#2da1ab")

      //###################### Validation - Step (2) ########################
      SendData();
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
    console.log(steps);
    checkStep(steps);
  } else {
    //nothing
  }
}

function stepBack() {
  steps--;
  checkStep(steps);
}


function SendData() {

  var instanz = "Energiesysteme";

  var laenge = $("#laenge").val();
  var farbe = $("#farbe").val();
  var product = $("input[name=product]:checked").val();

  var kfw = $("input[name=KFW]:checked").val();
  var gruen = $("input[name=GRUEN]:checked").val();

  var meter = $("input[name=meter]").val();
  var frage2 = $("input[name=frage2Checked]:checked").val();
  var frage3 = $("input[name=frage3Checked]:checked").val();
  var frage4 = $("input[name=frage4Checked]:checked").val();
  var frage5 = $("input[name=frage5Checked]:checked").val();
  var frage6 = $("input[name=frage6Checked]:checked").val();
  var token = $("#token").val();
  var name = $("input[name=name]").val();
  var email = $("input[name=email]").val();
  var telefon = $("input[name=tel]").val();
  var strasse = $("input[name=strasse]").val();
  var ort = $("input[name=ort]").val();

  $.ajax({
    type: "POST",
    url: '../../backend/sendMail.php',
    data: {

      //Instanz
      'instanz': instanz,

      //Produktauswahl
      'product': product,
      'farbe': farbe,
      'laenge': laenge,

      //Förderung
      'kfw': kfw,
      'gruen': gruen,

      //Fragen vom ersten Screen
      'token': token,
      'meter': meter,
      'frage2': frage2,
      'frage3': frage3,
      'frage4': frage4,
      'frage5': frage5,
      'frage6': frage6,

      //Frgen vom zweiten Screen
      'name': name,
      'email': email,
      'telefon': telefon,
      'strasse': strasse,
      'ort': ort
    },
    success: function (data) {
      console.log(data);
      //löschen des SessionS
    },
    error: function (xhr, status, error) {
      console.error(xhr);
    }
  });

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
    //STEP 2
  }
}


