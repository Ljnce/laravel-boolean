require('./bootstrap');

$(document).ready(function () {
    var urlBase = '/api/photos';
stampaGrafico();

function stampografico(){
    $.ajax({
        url: urlBase,
        method:'GET',
        headers: {
            'Authorization': 'Bearer Pippo89'
        },
        success:function(data){
            // graficoAjax(data);
            console.log(data);
        },
        error: function(){
            // alert('errore');
        }
    });
}

});
