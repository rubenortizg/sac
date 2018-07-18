/*=============================================
EDITAR CLIENTE
=============================================*/

$(".tablas").on("click", ".btnEditarCliente", function(){

	var idCliente = $(this).attr("idCliente");

	var datos = new FormData();
	datos.append("idCliente", idCliente);

	$.ajax({

		url:"ajax/clientes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#idCliente").val(respuesta["id"]);
			$("#editarTipoDocumento").val(respuesta["tipoid"]);
			$("#editarTipoDocumento").html(respuesta["tipoid"]);
			$("#editarDocumento").val(respuesta["identificacion"]);
			$("#editarCliente").val(respuesta["nombre"]);
			$("#editarCiudad").val(respuesta["ciudad"]);
			$("#editarTelefono").val(respuesta["telfijo"]);
			$("#editarCelular").val(respuesta["celular"]);
			$("#editarEmail").val(respuesta["correo"]);
			$("#editarEmpresa").val(respuesta["empresa"]);
			$("#editarEmpresa").html(respuesta["empresa"]);
			$("#editarLocalOficina").val(respuesta["oficinalocal"]);
			$("#editarLocalOficina").html(respuesta["oficinalocal"]);

		}

	})

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/

$(".tablas").on("click", ".btnEliminarCliente", function(){

	var idCliente = $(this).attr("idCliente");

	swal({

		title: '¿Esta seguro de borrar el cliente',
		text: "!Si no lo esta puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar cliente!'

	}).then(function(result){

		if (result.value) {

			window.location = "index.php?ruta=clientes&idCliente="+idCliente;
		}


	})


})
