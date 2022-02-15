$(document).ready(function(){
    var btnReservar = $("#reservar");
    var ofirecogida = $("#ofirecogida");
    var ofidevolucion = $("#ofidevolucion");
    var fechaini = $("#book_pick_date");
    var fechafin = $("#book_off_date");


    btnReservar.click(function(ev){
        ev.preventDefault();
        ofirecogida.val();
        ofidevolucion.val();
        fechaini.val();
        fechafin.val();
        window.location = "/reserva?ofirecogida="+ofirecogida.val()+"&ofidevolucion="+ofidevolucion.val()+"&fechaini="+fechaini.val()+"&fechafin="+fechafin.val();
      });
})