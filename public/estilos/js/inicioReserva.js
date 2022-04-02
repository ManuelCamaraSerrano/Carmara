$(document).ready(function(){
    var btnReservar = $("#reservar");
    var ofirecogida = $("#ofireco");
    var ofidevolucion = $("#ofidevo");
    var fechaini = $("#fecharecogida");
    var fechafin = $("#fechadevolucion");

    fechaini.on("drop", function(event) {
      event.preventDefault();  
      event.stopPropagation();
    });

   fechafin.on("drop", function(event) {
    event.preventDefault();  
    event.stopPropagation();
  });


fechaini.on("paste",function(ev){
  ev.preventDefault();
})

fechafin.on("paste",function(ev){
  ev.preventDefault();
})
    
    $( function() {
        
          from = fechaini
            .datepicker({
              dateFormat: "yy/mm/dd",
              defaultDate: "+1w",
              changeMonth: true,
              numberOfMonths: 3
            })
            .on( "change", function() {
              to.datepicker( "option", "minDate", getDate( this ) );
            }),
          to = fechafin.datepicker({
            dateFormat: "yy/mm/dd",
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3
          })
          .on( "change", function() {
            from.datepicker( "option", "maxDate", getDate( this ) );
          });
     
        function getDate( element ) {
          var date;
          try {
            date = $.datepicker.parseDate( "yy/mm/dd", element.value );
          } catch( error ) {
            date = null;
          }
     
          return date;
        }
      } );




    $.getJSON("/oficinas",
        function(data){
            $.each(data,function(ind,valor){
                  $("<option></option").text(valor.descripcion).val(valor.id)
                  .appendTo("#ofireco");
                })
        });
    $.getJSON("/oficinas",
        function(data){
            $.each(data,function(ind,valor){
                $("<option></option").text(valor.descripcion).val(valor.id)
                .appendTo("#ofidevo");
            })
        });
    btnReservar.click(function(ev){
        ev.preventDefault();
        var errores="";
        if(ofirecogida.val()=="vacio")
        {
          $("#spanofireco").text("El campo oficina de recogida no puede estar vacio");
          errores="error";
        }
        else{
          $("#spanofireco").text("");
        }
        if(ofidevolucion.val()=="vacio")
        {
          $("#spanofidevo").text("El campo oficina de devolución no puede estar vacio");
          errores="error";
        }
        else{
          $("#spanofidevo").text("");
        }
        if(fechaini.val()=="")
        {
          $("#spanfechareco").text("El campo fecha recogida no puede estar vacio");
          errores="error";
        }
        else{
          $("#spanfechareco").text("");
        }
        if(fechafin.val()=="")
        {
          $("#spanfechadevo").text("El campo fecha devolucion no puede estar vacio");
          errores="error";
        }
        else{
          $("#spanfechadevo").text("");
        }
        if(errores=="")
        {
          window.location = "/reserva?ofirecogida="+ofirecogida.val()+"&ofidevolucion="+ofidevolucion.val()+"&fechaini="+fechaini.val()+"&fechafin="+fechafin.val();
        }
      });
})