/*=============================================
EDITAR CLIENTE FACTURA
=============================================*/
$(".tablas").on("click", ".btnEditarClienteFactura", function(){

	var idClienteFactura = $(this).attr("idClienteFactura");

	var datos = new FormData();
	datos.append("idClienteFactura", idClienteFactura);

	$.ajax({

		url:"ajax/clienteFacturas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#editarOperador").val(respuesta["idoperador"]);

			var idOperador = respuesta["idoperador"];
			var datos = new FormData();
			datos.append("idOperador", idOperador);

			$.ajax({

				url:"ajax/operadores.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta){

					$("#editarOperador").html(respuesta["nombre"]);

				}

			});


			$("#editarCtaContrato").val(respuesta["ctacontrato"]);
			$("#idClienteFactura").val(respuesta["id"]);
			$("#clienteFacturaActual").val(respuesta["ctacontrato"]);


			$("#editarEmpresa").val(respuesta["idempresa"]);

			var idEmpresa = respuesta["idempresa"];
			var datos = new FormData();
			datos.append("idEmpresa", idEmpresa);

			$.ajax({

				url:"ajax/empresas.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta){

					$("#editarEmpresa").html(respuesta["empresa"]);

				}

			});


			$("#editarEstablecimiento").val(respuesta["idestablecimiento"]);

			var idEstablecimiento = respuesta["idestablecimiento"];
			var datos = new FormData();
			datos.append("idEstablecimiento", idEstablecimiento);

			$.ajax({

				url:"ajax/establecimientos.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta){

					$("#editarEstablecimiento").html(respuesta["identificador"]);

				}

			});

		}

	});

})



/*=============================================
ACTIVAR CLIENTE FACTURA
=============================================*/
$(".tablas").on("click", ".btnActivarClienteFactura", function(){

	var idClienteFactura = $(this).attr("idClienteFactura");
	var estadoClienteFactura = $(this).attr("estadoClienteFactura");

	var datos = new FormData();
 	datos.append("activarId", idClienteFactura);
	datos.append("activarClienteFactura", estadoClienteFactura);

	$.ajax({

  url:"ajax/clienteFacturas.ajax.php",
  method: "POST",
  data: datos,
  cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta){

    }

	})

	if(estadoClienteFactura == 0){

		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoClienteFactura',1);

	}else{

		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activado');
		$(this).attr('estadoClienteFactura',0);

	}

})

/*=============================================
REVISAR SI El CLIENTE FACTURA ESTA REGISTRADO
=============================================*/

$("#nuevaCtaContrato").change(function(){

	$(".alert").remove();

	var ctacontrato = $(this).val();

	var datos = new FormData();
	datos.append("validarClienteFactura", ctacontrato);

	$.ajax({

		url:"ajax/clienteFacturas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			if (respuesta) {

				$("#nuevaCtaContrato").parent().before('<div class="alert alert-warning">Esta Cuenta Contrato ya existe en la base de datos</div>');
				$("#nuevaCtaContrato").val("");

			}
		}

	})

})


$("#editarCtaContrato").change(function(){

	$(".alert").remove();

	var ctacontrato = $(this).val();

	var datos = new FormData();
	datos.append("validarClienteFactura", ctacontrato);

	$.ajax({

		url:"ajax/clienteFacturas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			if (respuesta) {

				idClienteFactura = $("#idClienteFactura").val();
				clienteFacturaActual = $("#clienteFacturaActual").val();

				if (respuesta["id"] != idClienteFactura) {

					$("#editarCtaContrato").parent().before('<div class="alert alert-warning">Esta Cuenta Contrato ya existe en la base de datos</div>');
					$("#editarCtaContrato").val(clienteFacturaActual);

				}

			}
		}

	})

})

/*=============================================
ELIMINAR CLIENTE FACTURA
=============================================*/

$(".tablas").on("click", ".btnEliminarClienteFactura", function(){

	var idClienteFactura = $(this).attr("idClienteFactura");

	swal({

		title: '¿Esta seguro de borrar la factura de cliente',
		text: "!Si no lo esta puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar factura de cliente!'

	}).then(function(result){

		if (result.value) {

			window.location = "index.php?ruta=clientes-facturas&idClienteFactura="+idClienteFactura;
		}


	})


})
