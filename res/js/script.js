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
