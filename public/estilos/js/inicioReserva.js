$(document).ready(function(){
    var btnReservar = $("#reservar");
    var ofirecogida = $("#ofireco");
    var ofidevolucion = $("#ofidevo");
    var fechaini = $("#fecharecogida");
    var fechafin = $("#fechadevolucion");

    
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
        window.location = "/reserva?ofirecogida="+ofirecogida.val()+"&ofidevolucion="+ofidevolucion.val()+"&fechaini="+fechaini.val()+"&fechafin="+fechafin.val();
      });
})