




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

swiper.slideTo(1, 0);





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


var farbe = "not"
var laenge = "not"

$("input:radio[name='product']").on("click", function () {
  if ($(this).val() == "WallboxPulsarPlus") {
    productValidation($(this).next());
  } else {
    $("#stepTwo__btn").addClass("activeAcc");
    $("#stepTwo").animate({ "max-height": "100%" }, 800);
    location.href = "#stepTwo__scroll";
  }
});

$("input:radio[name='product'][value='WallboxPulsarPlus']").next().find('select[name=farbe]').change(function(){
  productValidation($(this).parents("div.panel-body"))
});

$("input:radio[name='product'][value='WallboxPulsarPlus']").next().find('select[name=laenge]').change(function(){
  productValidation($(this).parents("div.panel-body"))
});

//Pulsar Plus
function productValidation(e) {
  farbe = e.find('select[name=farbe]').val()
  laenge = e.find('select[name=laenge]').val()
  if (farbe != "not" && laenge != "not") {
    $("input:radio[value='WallboxPulsarPlus']").prop("checked", true);
    $("#stepTwo__btn").addClass("activeAcc");
    $("#stepTwo").animate({ "max-height": "100%" }, 800);
    $(".auswahl > .errormessage").css("display", "none");
    farbe = e.find('select[name=farbe]').val()
    laenge = e.find('select[name=laenge]').val()
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


var filelocation;

function SendData() {


  uploadFile();

  var instanz = "Energiesysteme";
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
    async: false,
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



      var NameValidateOK = false;
      var EmailValidateOK = false;
      var TelValidateOK = false;
      var StrasseValidateOK = false;
      var OrtValidateOK = false;
      var DSValidateOK = false;


      //Frage 1
      if (!name) {
        $("input[name=name]").prev().addClass("textbox--error");
        $("input[name=name]").next().addClass("textbox--error").css('display','block');
        NameValidateOK = false;
      } else {
        $("input[name=name]").prev().removeClass("textbox--error");
        $("input[name=name]").next().removeClass("textbox--error").css('display','none');
        NameValidateOK = true;
      }

      //Frage 2

      if (!email) {
        $("input[name=email]").prev().addClass("textbox--error");
        $("input[name=email]").next().addClass("textbox--error").text('Bitte tragen Sie eine E-Mail ein').css('display','block')
        EmailValidateOK = false;
      } else {
        $("input[name=email]").prev().removeClass("textbox--error");
        if(validateEmail(email)){
          $("input[name=email]").next().removeClass("textbox--error").css('display','none');
          EmailValidateOK = true;
        }else{
          $("input[name=email]").next().addClass("textbox--error").text('Bitte tragen Sie eine gültige E-Mail ein').css('display','block');
        } 
      }

      //Frage 3
      if (!tel) {
        $("input[name=tel]").prev().addClass("textbox--error");
        $("input[name=tel]").next().addClass("textbox--error").text('Bitte tragen Sie eine Telefonnummer ein').css('display','block')
        TelValidateOK = false;
      } else {
        $("input[name=tel]").prev().removeClass("textbox--error");
        if(validateTelefon(tel)){
          $("input[name=tel]").next().removeClass("textbox--error").css('display','none');
          TelValidateOK = true;
        }else{
          $("input[name=tel]").next().addClass("textbox--error").text('Bitte tragen Sie eine gültige Telefonnummer ein').css('display','block');
        } 
      }

      //Frage 3
      if (!strasse) {
        $("input[name=strasse]").prev().addClass("textbox--error");
        $("input[name=strasse]").next().addClass("textbox--error").css('display','block');
        StrasseValidateOK = false;
      } else {
        $("input[name=strasse]").prev().removeClass("textbox--error");
        $("input[name=strasse]").next().removeClass("textbox--error").css('display','none');
        StrasseValidateOK = true;
      }

      //Frage 4
      if (!ort) {
        $("input[name=ort]").prev().addClass("textbox--error");
        $("input[name=ort]").next().addClass("textbox--error").css('display','block');
        OrtValidateOK = false;
      } else {
        $("input[name=ort]").prev().removeClass("textbox--error");
        $("input[name=ort]").next().removeClass("textbox--error").css('display','none');
        OrtValidateOK = true;
      }

      //Frage 5
      if (!datenschutz) {
        $("input[name=datenschutz]").addClass("checkbox--error");
        DSValidateOK = false;
      } else {
        $("input[name=datenschutz]").removeClass("checkbox--error");
        DSValidateOK = true;
      }

      if (NameValidateOK && EmailValidateOK && TelValidateOK && StrasseValidateOK && OrtValidateOK && DSValidateOK) {
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





////###################### Validation - Telefon ########################
function validateTelefon(x) {
  var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
  if (re.test(x)) {
    return true;
  } else {
    return false;
  }
}

////###################### Validation - Email ########################
function validateEmail(x) {
    return /\S+@\S+\.\S+/.test(x);
}



//###################### Kontaktformular ########################

$("#sendMessage").on("click", function () {
  SendMessage();
})


function SendMessage() {

  var name = $("#nameContact").val();
  var email = $("#emailContact").val();
  var unternehmen = $("#UnternehmenContact").val();
  var message = $("#messageContact").val();
  var datenschutz = $("input[name=datenschutzKontakt]:checked").val();
  var token = $("#token").val();

  console.log(name);
  console.log(email);
  console.log(message);

  if (!datenschutz) {
    $("input[name=datenschutzKontakt]").addClass("checkbox--error");
  } else {
    $("input[name=datenschutzKontakt]").removeClass("checkbox--error");
  }

  if (name == "" || email == "" || message == "" || !datenschutz) {
    $("#contactError").text("Bitte geben Sie alle Informationen an");
    $("#contactError").removeClass("text-success")
  } else {

    $.ajax({
      type: "POST",
      url: '../../backend/contactForm.php',
      async: false,
      data: {

        //Seite
        'instanz': "Ladestation",

        //Kontaktdaten
        'name': name,
        'email': email,
        'unternehmen' : unternehmen,
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
          $('#filename').text(filename.name).css('color', '');
          $('.uploadFile').css('display', 'flex');
          $('#deleteFile').css('display', 'inline-flex');
        } else {
          $('#filename').text(response).css('color', 'red');
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

//Cookie Releoad
$('body').delegate("#ccm__footer__consent-modal-submit", 'click',function(event){
  location.reload();
});

$('body').delegate(".consent-give", 'click',function(event){
  location.reload();
});