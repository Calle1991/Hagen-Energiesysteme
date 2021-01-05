$(function () {
    // Input radio-group visual controls
    $('.radio-group label').on('click', function () {
        $(this).removeClass('not-active').siblings().addClass('not-active');

    });
});



//Validate FirstScreen
$("#toTheSecond").click(function () {
    formValid = false

    var meter = $("input[name=meter]").val();
    var frage2 = $('input[name=frage2Checked]:checked').val();
    var frage3 = $('input[name=frage3Checked]:checked').val();
    var frage4 = $('input[name=frage4Checked]:checked').val();
    var frage5 = $('input[name=frage5Checked]:checked').val();
    var frage6 = $('input[name=frage6Checked]:checked').val();

    if (meter && frage2 && frage3 && frage4 && frage5 && frage6) {
        formValid = true
    }


    if (formValid) {
        sessionStorage.setItem("meter", meter)
        sessionStorage.setItem("frage2", frage2)
        sessionStorage.setItem("frage3", frage3)
        sessionStorage.setItem("frage4", frage4)
        sessionStorage.setItem("frage5", frage5)
        sessionStorage.setItem("frage6", frage6)
        $(".errormessage").css("visibility", "hidden");
        window.location.href = "second.html";
    } else {
        $(".errormessage").css("visibility", "visible");
    }

});



//Validate SecondScreen
$("#toTheThird").click(function () {
    formValid = false

    var name = $("input[name=name]").val();
    var email = $('input[name=email]').val();
    var tel = $('input[name=tel]').val();
    var strasse = $('input[name=strasse]').val();
    var ort = $('input[name=ort]').val();
    var datenschutz = $('input[name=datenschutz]:checked').val();

    if (name && email && tel && strasse && ort && datenschutz) {
        formValid = true
    }


    if (formValid) {
        sessionStorage.setItem("name", name)
        sessionStorage.setItem("email", email)
        sessionStorage.setItem("telefon", tel)
        sessionStorage.setItem("strasse", strasse)
        sessionStorage.setItem("ort", ort)
        sessionStorage.setItem("datenschutz", datenschutz)
        $(".errormessage").css("visibility", "hidden");


        //Senden der Daten an Server
        $.ajax({
            type: "POST",
            url: './backend/sendMail.php',
            data: {
                //Fragen vom ersten Screen
                'meter':sessionStorage.getItem("meter"),
                'frage2':sessionStorage.getItem("frage2"),
                'frage3':sessionStorage.getItem("frage3"),
                'frage4':sessionStorage.getItem("frage4"),
                'frage5':sessionStorage.getItem("frage5"),
                'frage6':sessionStorage.getItem("frage6"),

                //Frgen vom zweiten Screen
                'name':sessionStorage.getItem("name"),
                'email':sessionStorage.getItem("email"),
                'telefon':sessionStorage.getItem("telefon"),
                'strasse':sessionStorage.getItem("strasse"),
                'ort':sessionStorage.getItem("ort")
            },
            success: function (data) {
                console.log(data);
            },
            error: function (xhr, status, error) {
                console.error(xhr);
            }
        });

        //löschen des SessionS
        sessionStorage.clear()

        //weiterleiten
        window.location.href = "third.html";


    } else {
        $(".errormessage").css("visibility", "visible");
    }

});




