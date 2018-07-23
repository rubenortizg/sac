/*=============================================
EDITAR REMITENTE
=============================================*/

$(".tablas").on("click", ".btnEditarRemitente", function(){

	var idRemitente = $(this).attr("idRemitente");

	var datos = new FormData();
	datos.append("idRemitente", idRemitente);

	$.ajax({

		url:"ajax/remitentes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#editarRemitente").val(respuesta["remitente"]);
			$("#idRemitente").val(respuesta["id"]);
			$("#remitenteActual").val(respuesta["remitente"]);

		}

	})

})

/*=============================================
REVISAR SI EL REMITENTE ESTA REGISTRADO
=============================================*/

$("#nuevoRemitente").change(function(){

	$(".alert").remove();

	var remitente = $(this).val();

	var datos = new FormData();
	datos.append("validarRemitente", remitente);

	$.ajax({

		url:"ajax/remitentes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			if (respuesta) {

				$("#nuevoRemitente").parent().before('<div class="alert alert-warning">Este remitente ya existe en la base de datos</div>');
				$("#nuevoRemitente").val("");


			}
		}

	})

})


$("#editarRemitente").change(function(){

	$(".alert").remove();

	var remitente = $(this).val();

	var datos = new FormData();
	datos.append("validarRemitente", remitente);

	$.ajax({

		url:"ajax/remitentes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){


			if (respuesta) {

				idRemitente = $("#idRemitente").val();
				remitenteActual = $("#remitenteActual").val();

				if (respuesta["id"] != idRemitente) {
					$("#editarRemitente").parent().before('<div class="alert alert-warning">Este remitente ya existe en la base de datos</div>');
					$("#editarRemitente").val(remitenteActual);
				}

			}
		}

	})

})


/*=============================================
ELIMINAR REMITENTE
=============================================*/


$(".tablas").on("click", ".btnEliminarRemitente", function(){

	var idRemitente = $(this).attr("idRemitente");
	console.log("idRemitente",idRemitente);

	swal({
		title: '¿Esta seguro de borrar el remitente?',
		text: "¡Si no lo esta puede cancelar la acción! ",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar remitente!'
	}).then(function(result){

		if (result.value) {

			window.location = "index.php?ruta=remitentes&idRemitente="+idRemitente;

		}

	})


})
