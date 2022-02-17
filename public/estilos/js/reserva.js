$(document).ready(function(){

    //const urlParams = new URLSearchParams(window.location.search);
    //const myParam = urlParams.get('ofirecogida');
    //alert(myParam.val());

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
                            $("footer").before(coche);
                            cochedetalle = muestraDetalles(detalle,data[ind]);
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
                    })
            })
    
    })


    // Función que añade el contenido al modal
    function muestraDetalles(detalle,data){
        var modelo=detalle.find("div[id^=coche]:first");
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
})
