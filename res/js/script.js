$( window ).scroll(function(){
    var altura = window.pageYOffset;
	if (altura > 0) {
		$("#logo1").addClass("d-none");
        $("#logo2").removeClass("d-none");
        $("#tira").removeClass("mt1");
        $("#tira").addClass("mt2");
	} else if(altura == 0) {
		$("#logo2").addClass("d-none");
        $("#logo1").removeClass("d-none");
        $("#tira").addClass("mt1");
        $("#tira").removeClass("mt2");
	}
});

function mostrarTotal(){
    auto = parseFloat($("#precio-auto").val());
    placas = parseFloat($("#emplacamiento").val());
    total = auto + placas;
    $("#total").val(total.toFixed(2));
    if($("#pago").val() == 1){
        definirEnganche(auto, total);
    }
}

function definirMensualidades(total, enganche){
    meses = parseInt($("#meses").val());
    mensualidad = (total-enganche) / meses;
    $("#mensualidades").val(mensualidad.toFixed(2));
}

function definirEnganche(auto, total){
    enganche = auto * 0.1;
    $("#enganche").val(enganche.toFixed(2));
    if($("#meses").prop("selectedIndex") != 0){
        definirMensualidades(total, enganche);
    }
}

$("#auto").change(function(){
    costo = $("#auto").val();
    costo = parseFloat(costo);
    $("#precio").val(costo.toFixed(2));
    $("#precio-auto").val(costo.toFixed(2));
    mostrarTotal();
});

$("#pago").change(function(){
    if($("#pago").val() == 1 ){
        $("#meses").prop("disabled", false);
        $("#financiamiento").removeClass("d-none");
        mostrarTotal();
    }else if($("#pago").val() == 0 ){
        $("#meses").prop("disabled", true);
        $("#meses").prop("selectedIndex", 0);
        $("#financiamiento").addClass("d-none");
    }
});

$("#meses").change(function(){
    if(parseInt($("#enganche").val()) != 0){
        total = parseFloat($("#total").val());
        enganche = $("#enganche").val();
        definirMensualidades(total, enganche);
    }
});

$("#placas").change(function(){
    if(this.checked){
        $("#emplacamiento").val("5000.00");
        $("#costo-placas").removeClass("d-none");
        mostrarTotal();
    }else{
        $("#emplacamiento").val("0.00");
        $("#costo-placas").addClass("d-none");
        mostrarTotal();
    }
});

function redireccionar(){
    window.location = "compra.html"
}

$("#compra").on("submit",function(event){
    event.preventDefault();
    nombre = $("#nombre").val();
    apPat = $("#apellidoPat").val();
    apMat = $("#apellidoMat").val();
    $("#nom-com").text(nombre+" "+apPat+" "+apMat);
    $("#verificacion").removeClass("d-none");
});
