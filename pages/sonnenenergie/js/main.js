
//###################### Kontaktformular ########################

$("#sendMessage").on("click", function () {
  SendMessage();
})


function SendMessage() {

  var name = $("#nameContact").val();
  var email = $("#emailContact").val();
  var message = $("#messageContact").val();
  var token = $("#token").val();

console.log(name);
console.log(email);
console.log(message);

  if (name == "" || email == "" || message == "") {
    $("#contactError").text("Bitte geben Sie alle Informationen an");
    $("#contactError").removeClass("text-success")
  } else {

    $.ajax({
      type: "POST",
      url: '../../backend/contactForm.php',
      data: {

        //Seite
        'instanz':"Sonnenenergie",

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