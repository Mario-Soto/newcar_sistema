$("#btn-nav").click(function () {
    if($("#fondo-nav").hasClass("fondo-nav")){
        $("#fondo-nav").removeClass("fondo-nav");
        $("#nav").removeClass("m-active");
        $("#tira").removeClass("m-active");
    }else{
        $("#fondo-nav").addClass("fondo-nav");
        $("#nav").addClass("m-active");
        $("#tira").addClass("m-active");
    }
});