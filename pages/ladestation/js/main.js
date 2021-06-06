




//###################### SWIPER JS ########################



var swiper = new Swiper(".swiper-container", {
  slidesPerView: "1.2",
  centeredSlides: true,
  spaceBetween: 5,
  pagination: {
    el: ".swiper-pagination",
    clickable: false,
  },
});

swiper.slideTo(1, 0)










//###################### Privat oder Gewerbe ########################

$("input:radio[name='card']").on("click", function () {
  if ($("input:radio[name='card']:checked").val() == "privat") {
    $("#stepOne__btn").addClass("activeAcc");
    $("#stepOne").animate({ "max-height": "120%" }, 500);
    location.href = "#stepOne__scroll";
  } else {
    $("#stepOne__btn").removeClass("activeAcc");
    $(".accordionContent").animate({ "max-height": "0px" }, 800);
    location.href = "#contact";
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
    location.href = "#stepTwo__scroll";
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
    location.href = "#stepTwo__scroll";
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
      location.href = "#scroll_kfw";
    }

    if ($("input[name='GRUEN']:checked").val() == 'Nein') {
      location.href = "#scroll_gruen";
    }

    if ($("input[name='KFW']:checked").val() == 'Ja' && $("input[name='GRUEN']:checked").val() == 'Ja') {
      location.href = "#stepThree__scroll";
    }

    $("#stepThree__btn").addClass("activeAcc");
    $("#stepThree").animate({ "max-height": "300%" }, 800);
  } else {
    $("#stepThree").animate({ "max-height": "0px" }, 800);
  }


}

//###################### Postleitzahl abfragen ########################

$("#plzInput").keyup(function () {
  if ($("#plzInput").val() == '31226' || $("#plzInput").val() == '31224' || $("#plzInput").val() == '31228') {
    $("#swp").fadeIn();
    $("#gpl").css("display", "none");
    $("#andere").css("display", "none");
  } else if ($("#plzInput").val() == '31234'
    || $("#plzInput").val() == '31241'
    || $("#plzInput").val() == '31246'
    || $("#plzInput").val() == '31249'
    || $("#plzInput").val() == '38176'
    || $("#plzInput").val() == '38268'
    || $("#plzInput").val() == '38159'
  ) {
    $("#gpl").fadeIn();
    $("#swp").css("display", "none");
    $("#andere").css("display", "none");
  }
  else {
    $("#gpl").css("display", "none");
    $("#swp").css("display", "none");
    $("#andere").fadeIn();
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
      $("#weiterBtn").text("Fortfahren");
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
      $("#weiterBtn").text("Absenden");
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
      $(".progressstep").eq(n).css("background-color", "#2da1ab");
      location.href = "#success";


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

var filelocation = "PFAD";

function SendData() {


  uploadFile();

  var instanz = "Energiesysteme";

  var laenge = $("#laenge").val();
  var farbe = $("#farbe").val();
  var product = $("input[name=product]:checked").val();

  var kfw = $("input[name=KFW]:checked").val();
  var gruen = $("input[name=GRUEN]:checked").val();

  var frage0 = $("input[name=frage0Checked]:checked").val();
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
      'alterStromverteiler': frage0,
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
      'ort': ort,

      //Fileupload
      'file': filelocation
    },
    success: function (data) {
      console.log(data);
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
      var frage1 = $("input[name=frage0Checked]:checked").val();
      var frage2 = $("input[name=frage2Checked]:checked").val();
      var frage3 = $("input[name=frage3Checked]:checked").val();
      var frage4 = $("input[name=frage4Checked]:checked").val();
      var frage5 = $("input[name=frage5Checked]:checked").val();
      var frage6 = $("input[name=frage6Checked]:checked").val();

      //Frage 1
      if (!frage1) {
        $("input[name=frage0Checked]").next().addClass("radiobutton--error");
      } else {
        $("input[name=frage0Checked]").next().removeClass("radiobutton--error");
      }

      //Frage 1s
      if (!meter) {
        $("input[name=meter]").next().addClass("textbox--error");
      } else {
        $("input[name=meter]").next().removeClass("textbox--error");
      }

      //Frage 2
      if (!frage2) {
        $("input[name=frage2Checked]").next().addClass("radiobutton--error");
      } else {
        $("input[name=frage2Checked]").next().removeClass("radiobutton--error");
      }

      //Frage 3
      if (!frage3) {
        $("input[name=frage3Checked]").next().addClass("radiobutton--error");
      } else {
        $("input[name=frage3Checked]").next().removeClass("radiobutton--error");
      }

      //Frage 4
      if (!frage4) {
        $("input[name=frage4Checked]").next().addClass("radiobutton--error");
      } else {
        $("input[name=frage4Checked]").next().removeClass("radiobutton--error");
      }

      //Frage 5
      if (!frage5) {
        $("input[name=frage5Checked]").next().addClass("radiobutton--error");
      } else {
        $("input[name=frage5Checked]").next().removeClass("radiobutton--error");
      }

      //Frage 6
      if (!frage6) {
        $("input[name=frage6Checked]").next().addClass("radiobutton--error");
      } else {
        $("input[name=frage6Checked]").next().removeClass("radiobutton--error");
      }

      if (frage1 && meter && frage2 && frage3 && frage4 && frage5 && frage6) {
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



      //Frage 1
      if (!name) {
        $("input[name=name]").prev().addClass("textbox--error");
      } else {
        $("input[name=name]").prev().removeClass("textbox--error");
      }

      //Frage 2
      if (!email) {
        $("input[name=email]").prev().addClass("textbox--error");
      } else {
        $("input[name=email]").prev().removeClass("textbox--error");
      }

      //Frage 3
      if (!tel) {
        $("input[name=tel]").prev().addClass("textbox--error");
      } else {
        $("input[name=tel]").prev().removeClass("textbox--error");
      }

      //Frage 3
      if (!strasse) {
        $("input[name=strasse]").prev().addClass("textbox--error");
      } else {
        $("input[name=strasse]").prev().removeClass("textbox--error");
      }

      //Frage 4
      if (!ort) {
        $("input[name=ort]").prev().addClass("textbox--error");
      } else {
        $("input[name=ort]").prev().removeClass("textbox--error");
      }

      //Frage 5
      if (!datenschutz) {
        $("input[name=datenschutz]").addClass("checkbox--error");
      } else {
        $("input[name=datenschutz]").removeClass("checkbox--error");
      }



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


//###################### Kontaktformular ########################

$("#sendMessage").on("click", function () {
  SendMessage();
})


function SendMessage() {

  var name = $("#nameContact").val();
  var email = $("#emailContact").val();
  var message = $("#messageContact").val();
  var datenschutz = $("#datenschutzKontakt").val();
  var token = $("#token").val();

  console.log(name);
  console.log(email);
  console.log(message);

  if (!datenschutz) {
    $("input[name=datenschutzKontakt]").addClass("checkbox--error");
  } else {
    $("input[name=datenschutzKontakt]").removeClass("checkbox--error");
  }

  if (name == "" || email == "" || message == "" || datenschutz == "") {
    $("#contactError").text("Bitte geben Sie alle Informationen an");
    $("#contactError").removeClass("text-success")
  } else {

    $.ajax({
      type: "POST",
      url: '../../backend/contactForm.php',
      data: {

        //Seite
        'instanz': "Ladestation",

        //Kontaktdaten
        'name': name,
        'email': email,
        'token': token,

        //Nachricht
        'message': message

      },
      success: function (data) {
        console.log(data);
        $("#contactError").removeClass("text-danger")
        $("#contactError").addClass("text-success")
        $("#contactError").text("Vielen Dank für Ihre Anfrage!");
        //löschen des SessionS
      },
      error: function (xhr, status, error) {
        console.error(xhr);
      }
    });

  }
}


//###################### Upload ########################

$('#deleteFile').click(function () {
  $('#file').val('');
  $('.uploadFile').css('display', 'none');
  $('#deleteFile').css('display', 'none');
});


$('#file').change(function () {
  
  //ValidateUpload
  var fd = new FormData();
  var files = $('#file')[0].files;

  if (files.length > 0) {
    fd.append('file', files[0]);

    $.ajax({
      url: '../../backend/validateUpload.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      async: true,
      success: function (response) {
        if (response == 1) {
          var filename = $('#file')[0].files[0];
          $('#filename').text(filename.name).css('color','');
          $('.uploadFile').css('display', 'flex');
          $('#deleteFile').css('display', 'inline-flex');
        } else {
          $('#filename').text(response).css('color','red');
          $('#deleteFile').css('display', 'none');
        }
      },
    });
  }
});


function uploadFile() {
  var fd = new FormData();
  var files = $('#file')[0].files;

  if (files.length > 0) {
    fd.append('file', files[0]);

    $.ajax({
      url: '../../backend/upload.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      async: false,
      success: function (response) {
        if (response != 0) {
          filelocation = response;
          console.log("UploadFile: " + filelocation);
        } else {
          $('#filename').text("Datei konnte nicht hochgeladen werden!");
        }
      },
    });
  }
}