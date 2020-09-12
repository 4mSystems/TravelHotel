$(document).ready(function () {

    var method;
    $("#Panel").hide();
    method = $('#payment_method').val();
    console.log(method);
    
    if (method == 'cash') {
        console.log(method);
       $("#Panel").hide();

    }  else if (method == 'visa') {
        console.log(method);
    $("#Panel").show();
}


    $("#payment_method").change(function () {
        method = $('#payment_method').val();
      
        if (method == 'cash') {
           console.log(method);
            
           $("#Panel").hide();

        } else if (method == 'visa') {
        console.log(method);
            
        $("#Panel").show();
        }


        });
  

});


