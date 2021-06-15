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
            break;


        case 2:
            $("#zurueckBtn").css("display", "none");
            $("#weiterBtn").css("display", "none");
            $(".step")
                .eq(n - 1)
                .css("display", "none");
            $(".step").eq(n).fadeIn();

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
    var instanz = "pemobil";
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
            'instanz':instanz,

            //Fragen vom ersten Screen
            'kfw': kfw,
            'gruen': gruen,

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
            var kfw = $("input[name=KFW]:checked").val();
            var gruen = $("input[name=GRUEN]:checked").val();
            var meter = $("input[name=meter]").val();
            var frage2 = $("input[name=frage2Checked]:checked").val();
            var frage3 = $("input[name=frage3Checked]:checked").val();
            var frage4 = $("input[name=frage4Checked]:checked").val();
            var frage5 = $("input[name=frage5Checked]:checked").val();
            var frage6 = $("input[name=frage6Checked]:checked").val();

            if (kfw && gruen && meter && frage2 && frage3 && frage4 && frage5 && frage6) {
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


//Cookie Releoad
$("#ccm__footer__consent-modal-submit").on("click",function(){
alert("TEST");
});