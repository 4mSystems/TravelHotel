$(document).ready(function () {

    var method;
    $("#cardPanel").hide();
    // method = $('#payment').val();
    // if (method == 'cash') {
    //     $('#cardPanel').empty();
    //    $("#cardPanel").hide();

    // } else
    // $("#cardPanel").show();



    $("#payment").change(function () {
        method = $('#payment').val();
      
        if (method == 'cash') {
            $('#cardPanel').empty();
           $("#cardPanel").hide();
           console.log(method);

        } else if (method == 'visa') {
        $("#cardPanel").show();
        console.log(method);
        }


        });
  

});


