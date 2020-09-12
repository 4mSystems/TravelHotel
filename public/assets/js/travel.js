$(document).ready(function () {

    var method;
    $("#cardPanel").hide();


    $("#payment").change(function () {
        method = $('#payment').val();
      
        if (method == 'cash') {
            // $('#card').empty();
           $("#cardPanel").hide();
        //    console.log(method);

        } else if (method == 'visa') {
            // $('#card').empty();
        $("#cardPanel").show();
        // console.log(method);
        }


        });
  

});


