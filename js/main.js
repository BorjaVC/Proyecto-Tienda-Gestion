jQuery(document).on('submit', 'formlg',function (event) {
    event.preventDefault();

    jQuery.ajax({
        type: "POST",
        url: "tienda/login1.php",
        data: $(this).serialize(),
        dataType: "json",
        success: function (response) {
            
        }
    })
    .done(function (respuesta) {
        console.log(respuesta);
    })
    .fail(function (resp) {
        console.log(resp.response.text);
    })
    .always(function(){
        console.log("complete");
    });

});
