$(document).ready(function () {

    var method;
    $("#cardPanel2").hide();
    method = $('#payment_method').val();
    if (method == 'cash') {
        // $('#cardPanel2').empty();
       $("#cardPanel2").hide();

    }  else if (method == 'visa') {
    $("#cardPanel2").show();
}


    $("#payment_method").change(function () {
        method = $('#payment_method').val();
      
        if (method == 'cash') {
            // $('#cardPanel2').empty();
           $("#cardPanel2").hide();
           console.log(method);

        } else if (method == 'visa') {
        $("#cardPanel2").show();
        console.log(method);
        }


        });
  

});


