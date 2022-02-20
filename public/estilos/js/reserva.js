$(document).ready(function(){

    // Recogemos los parametros pasados por la url
    const urlParams = new URLSearchParams(window.location.search);
    const fechaini = urlParams.get('fechaini');
    const fechafin = urlParams.get('fechafin');
    const ofireco = urlParams.get('ofirecogida');
    const ofidevo = urlParams.get('ofidevolucion');
    // Calculamos el número de días que hay entre las dos fechas
    const dias = restaFechas(fechaini,fechafin);
    
    

    // Rellenamos el combo de marcas 
    $("nav").attr("id","navEspecial")
            $.getJSON("/marcas",
            function(data){
                $.each(data,function(ind,valor){
                    $("<option></option").text(valor.nombre)
                    .appendTo("#marca");
                })
            });

    // Cargamos la plantilla de mostrar un coche
    var cont = $("<div>").load("/estilos/js/plantillas/coche.html",
            function(){
                // Cargamos la plantilla de el modal
                var detalle = $("<div>").load("/estilos/js/plantillas/detalles.html",
            function(){})
            var realizaReserva = $("<div>").load("/estilos/js/plantillas/realizaReserva.html",
            function(){})
                // Cargamos los coches
                $.getJSON("/coches",{},
                    function(data){
                        var modelo=cont.find("div[id^=coche]:first");
                        //creo las cajas
                        $.each(data,function(ind,valor){
                            var coche=modelo.clone(true);
                            coche.attr("id","coche_"+data[ind].id);
                            coche.find(".nombre").text(data[ind].marca.nombre+" "+data[ind].modelo);
                            coche.find(".npuertas").text(data[ind].npuertas);
                            coche.find(".cv").text(data[ind].cv);
                            coche.find(".cambio").text(data[ind].cambio);
                            coche.find(".color").text(data[ind].color);
                            coche.find(".precio").text(data[ind].precio+"€");
                            coche.find(".img").attr("src","/estilos/images/"+data[ind].fotos[0].foto);
                            // Cargamos los modales de detalles y de realizar la reserva
                            var cochedetalle = muestraDetalles(detalle,data[ind]);
                            var reserva = contenidoReserva(realizaReserva,data[ind]);
                            // Cuando pulse el enlace aparecerá el modal
                            coche.find(".detalle").click(function(ev){
                                ev.preventDefault();
                                $(".contenedorModal").addClass("active");
                                $(cochedetalle).dialog({
                                    width: 1050,  // Tamaño del dialog
                                    height:500
                                });
                                $(".ui-button").click(function(){
                                    $(".contenedorModal").removeClass("active");
                                })
                            })
                            coche.find(".reserva").click(function(ev){
                                ev.preventDefault();
                                $(".contenedorModal").addClass("active");
                                $(reserva).dialog({
                                    width: 1100,  // Tamaño del dialog
                                    height:500
                                });
                                $(".ui-button").click(function(){
                                    $(".contenedorModal").removeClass("active");
                                })
                            })
                            $("footer").before(coche);   
                    })
            })
    })


    // Función que añade el contenido al modal
    function muestraDetalles(detalle,data){
        var modelo=detalle.find("div[id^=detalle]:first");
        //creo las cajas               
        var coche=modelo.clone(true);
        coche.attr("id","detalle_"+data.id);
        coche.find(".nombred").text(data.marca.nombre+" "+data.modelo);
        coche.find(".npuertasd").text(data.npuertas);
        coche.find(".cvd").text(data.cv);
        coche.find(".cambiod").text(data.cambio);
        coche.find(".colord").text(data.color);
        coche.find(".preciod").text(data.precio+"€");
        coche.find(".matriculad").text(data.matricula);
        coche.find(".tipod").text(data.tipo);
        coche.find(".img1").attr("src","/estilos/images/"+data.fotos[0].foto);
        coche.find(".img2").attr("src","/estilos/images/"+data.fotos[1].foto);
        coche.find(".img3").attr("src","/estilos/images/"+data.fotos[2].foto);
        coche.find(".img4").attr("src","/estilos/images/"+data.fotos[3].foto);
            
        return coche;
        
    }

    // Función que añade el contenido al modal de realizar la reserva
    function contenidoReserva(detalle,data){
        var modelo=detalle.find("div[id^=reserva]:first");
        //creo las cajas               
        var coche=modelo.clone(true);
        coche.attr("id","reserva_"+data.id);
        coche.find(".nombre").text(data.marca.nombre+" "+data.modelo);
        coche.find(".fechareco").text(fechaini);
        coche.find(".fechadevo").text(fechafin);
        coche.find(".ofireco").text(ofireco);
        coche.find(".ofidevo").text(ofidevo);
        coche.find(".preciodia").text(data.precio+"€");
        coche.find(".preciototal").text(dias*data.precio+"€");
        coche.find(".matricula").text(data.matricula);
        coche.find(".imagen").attr("src","/estilos/images/"+data.fotos[0].foto);
        var datos = [data.id,fechaini,fechafin,ofireco,ofidevo,dias*data.precio];
        json = JSON.stringify(datos);
        coche.find(".reservarya").click(function(ev){
            ev.preventDefault();
            $.get("/realizareserva",json);
        })
        

        
        return coche;
        
    }

    // Función que calcula cuantos días hay entre dos fechas
    function restaFechas(f1,f2)
    {
    var aFecha1 = f1.split('/');
    var aFecha2 = f2.split('/');
    var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,aFecha1[2]);
    var fFecha2 = Date.UTC(aFecha2[0],aFecha2[1]-1,aFecha2[2]);
    var dif = fFecha2 - fFecha1;
    var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
    return dias;
    }
})
