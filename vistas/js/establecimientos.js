/*=============================================
EDITAR ESTABLECIMIENTO
=============================================*/
$(".tablas").on("click", ".btnEditarEstablecimiento", function(){

	var idEstablecimiento = $(this).attr("idEstablecimiento");

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

			$("#editarTipo").val(respuesta["tipo"]);
			$("#editarTipo").html(respuesta["tipo"]);

			$("#editarIdentificador").val(respuesta["identificador"]);
			$("#idEstablecimiento").val(respuesta["id"]);
			$("#establecimientoActual").val(respuesta["identificador"]);

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

		}

	});

})



/*=============================================
ACTIVAR ESTABLECIMIENTO
=============================================*/
$(".tablas").on("click", ".btnActivarEstablecimiento", function(){

	var idEstablecimiento = $(this).attr("idEstablecimiento");
	var estadoEstablecimiento = $(this).attr("estadoEstablecimiento");

	var datos = new FormData();
 	datos.append("activarId", idEstablecimiento);
	datos.append("activarEstablecimiento", estadoEstablecimiento);

	$.ajax({

  url:"ajax/establecimientos.ajax.php",
  method: "POST",
  data: datos,
  cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta){

    }

	})

	if(estadoEstablecimiento == 0){

		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoEstablecimiento',1);

	}else{

		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activado');
		$(this).attr('estadoEstablecimiento',0);

	}

})

/*=============================================
REVISAR SI El ESTABLECIMIENTO ESTA REGISTRADO
=============================================*/

$("#nuevoIdentificador").change(function(){

	$(".alert").remove();

	var establecimiento = $(this).val();

	var datos = new FormData();
	datos.append("validarEstablecimiento", establecimiento);

	$.ajax({

		url:"ajax/establecimientos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			if (respuesta) {

				$("#nuevoIdentificador").parent().before('<div class="alert alert-warning">Este establecimiento ya existe en la base de datos</div>');
				$("#nuevoIdentificador").val("");

			}
		}

	})

})


$("#editarIdentificador").change(function(){

	$(".alert").remove();

	var establecimiento = $(this).val();

	var datos = new FormData();
	datos.append("validarEstablecimiento", establecimiento);

	$.ajax({

		url:"ajax/establecimientos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			if (respuesta) {

				idEstablecimiento = $("#idEstablecimiento").val();
				establecimientoActual = $("#establecimientoActual").val();

				if (respuesta["id"] != idEstablecimiento) {

					$("#editarIdentificador").parent().before('<div class="alert alert-warning">Este establecimiento ya existe en la base de datos</div>');
					$("#editarIdentificador").val(establecimientoActual);

				}

			}
		}

	})

})

/*=============================================
ELIMINAR ESTABLECIMIENTO
=============================================*/

$(".tablas").on("click", ".btnEliminarEstablecimiento", function(){

	var idEstablecimiento = $(this).attr("idEstablecimiento");

	swal({

		title: '¿Esta seguro de borrar el establecimiento',
		text: "!Si no lo esta puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar establecimiento!'

	}).then(function(result){

		if (result.value) {

			window.location = "index.php?ruta=establecimientos&idEstablecimiento="+idEstablecimiento;
		}


	})


})
