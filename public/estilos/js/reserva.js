$(document).ready(function(){

    //const urlParams = new URLSearchParams(window.location.search);
    //const myParam = urlParams.get('ofirecogida');
    //alert(myParam.val());

    
            $.getJSON("/marcas",
            function(data){
                $.each(data,function(ind,valor){
                    $("<option></option").text(valor.nombre)
                    .appendTo("#marca");
                })
            });
    



    var cont = $("<div>").load("plantillas/coche.html",
            function(){
                $.getJSON("/coches",{},
                    function(data){
                        var modelo=cont.find("div[id^=coche]:first");
                        //creo las cajas
                        $.each(data,function(ind,valor){
                            var id=data[ind].id;
                            var coche=modelo.clone(true);
                            coche.attr("id","coche_"+id);
                            coche.find(".nombre").text(data[ind].marca.nombre+" "+data[ind].modelo)
                            coche.find(".nombre").text(data[ind].precio)
                    })
            })
    
    })
})
