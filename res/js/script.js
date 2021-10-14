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
		$("#kilometraje").val("0");
		$("#kilometraje").attr("disabled", true);
	}else{
		$("#kilometraje").val(null);
		$("#kilometraje").attr("disabled", false);
	}
});

$(".solo-num").on("input", function(){
	this.value = this.value.replace(/[^0-9]/g,'');
});