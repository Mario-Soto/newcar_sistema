$("#btn-nav").click(function () {
	if ($("#fondo-nav").hasClass("fondo-nav")) {
		$("#fondo-nav").removeClass("fondo-nav");
		$("#nav").removeClass("m-active");
		$("#tira").removeClass("m-active");
	} else {
		$("#fondo-nav").addClass("fondo-nav");
		$("#nav").addClass("m-active");
		$("#tira").addClass("m-active");
	}
});

$("#mos_oc_pass i").click(function (event) {
	event.preventDefault();
	if ($("#mos_oc_pass input").attr("type") == "text") {
		$("#mos_oc_pass input").attr("type", "password");
		$("#mos_oc_pass i").addClass("fa-eye-slash");
		$("#mos_oc_pass i").removeClass("fa-eye");
	} else if ($("#mos_oc_pass input").attr("type") == "password") {
		$("#mos_oc_pass input").attr("type", "text");
		$("#mos_oc_pass i").removeClass("fa-eye-slash");
		$("#mos_oc_pass i").addClass("fa-eye");
	}
});


$("#mos_oc_pass2 i").click(function (event) {
	event.preventDefault();
	if ($("#mos_oc_pass2 input").attr("type") == "text") {
		$("#mos_oc_pass2 input").attr("type", "password");
		$("#mos_oc_pass2 i").addClass("fa-eye-slash");
		$("#mos_oc_pass2 i").removeClass("fa-eye");
	} else if ($("#mos_oc_pass2 input").attr("type") == "password") {
		$("#mos_oc_pass2 input").attr("type", "text");
		$("#mos_oc_pass2 i").removeClass("fa-eye-slash");
		$("#mos_oc_pass2 i").addClass("fa-eye");
	}
});

$("#nuevo, #usado").change(function() {
	if($("#nuevo").is(":checked")){
		$("#kilometraje").prop("disabled", true);
		$("#kilometraje").prop("required", false);
	}else{
		$("#kilometraje").prop("disabled", false);
		$("#kilometraje").prop("required", true);
	}
});

$(".solo-num").number(true, 0);

$("#registrar").on("click", function (event) {
	pass1 = $("#contraseña").val();
	pass2 = $("#contraseña2").val();
	if (pass1 == pass2) {
		return;
	} else {
		event.preventDefault();
		Swal.fire({
			icon: "error",
			title: "Error...",
			text: "Las contraseñas no coinciden",
		});
	}
});

$("#auto").change(function () {
	$("#costo").prop("selectedIndex",$("#auto").prop("selectedIndex"));
	total = $("#costo").val()*$("#cantidad").val();
	if($("#emplacar").prop("checked")){
		total = total + 5000;
	}
	$("#precio").val(total);
});

$("#cantidad").change(function () {
	total = $("#costo").val()*$("#cantidad").val();
	if($("#emplacar").prop("checked")){
		total = total + 5000;
	}
	$("#precio").val(total);
});

const valores = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

$("#emplacar").change(function () {
	total = $("#costo").val()*$("#cantidad").val();
	placa = '';
	if($("#emplacar").prop("checked")){
		total = total + 5000;
		for(var i = 0; i < 7; i++){
			placa += valores.charAt(Math.floor(Math.random()*valores.length));
		}
	}else{
		placa = null;
	}
	$("#precio").val(total);
	$("#placas").val(placa);
});