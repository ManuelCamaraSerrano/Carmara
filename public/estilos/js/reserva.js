$(document).ready(function(){

    //const urlParams = new URLSearchParams(window.location.search);
    //const myParam = urlParams.get('ofirecogida');
    //alert(myParam.val());

    $.getJSON("/coches",
                    {
                    },
                    function(data){
                        var a = data;
                    })
})