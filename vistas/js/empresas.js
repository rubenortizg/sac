	/*=============================================
SUBIENDO LA FOTO DE LA EMPRESA
=============================================*/
$(".nuevoLogoEmpresa").change(function(){

	var imagen = this.files[0];

	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevoLogoEmpresa").val("");

  		 swal({
		      title: "Error al subir el logo",
		      text: "¡El logo debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevoLogoEmpresa").val("");

  		 swal({
		      title: "Error al subir el logo",
		      text: "¡El logo no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
EDITAR EMPRESA
=============================================*/
$(".tablas").on("click", ".btnEditarEmpresa", function(){

	var idEmpresa = $(this).attr("idEmpresa");

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

			$("#editarEmpresa").val(respuesta["empresa"]);
			$("#idEmpresa").val(respuesta["id"]);
			$("#empresaActual").val(respuesta["empresa"]);
			/* Logo actual */
			$("#logoActualEmpresa").val(respuesta["logo"]);

			if(respuesta["logo"] != ""){

				$(".previsualizar").attr("src", respuesta["logo"]);

			}

		}

	});

})

/*=============================================
ACTIVAR EMPRESA
=============================================*/
$(".tablas").on("click", ".btnActivarEmpresa", function(){

	var idEmpresa = $(this).attr("idEmpresa");
	var estadoEmpresa = $(this).attr("estadoEmpresa");

	var datos = new FormData();
 	datos.append("activarId", idEmpresa);
  	datos.append("activarEmpresa", estadoEmpresa);

  	$.ajax({

	  url:"ajax/empresas.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      }

  	})

  	if(estadoEmpresa == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoEmpresa',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoEmpresa',0);

  	}

})

/*=============================================
REVISAR SI LA EMPRESA ESTA REGISTRADA
=============================================*/

$("#nuevaEmpresa").change(function(){

	$(".alert").remove();

	var empresa = $(this).val();

	var datos = new FormData();
	datos.append("validarEmpresa", empresa);

	$.ajax({

		url:"ajax/empresas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			if (respuesta) {

				$("#nuevaEmpresa").parent().before('<div class="alert alert-warning">Esta empresa ya existe en la base de datos</div>');
				$("#nuevaEmpresa").val("");

			}
		}

	})

})


$("#editarEmpresa").change(function(){

	$(".alert").remove();

	var empresa = $(this).val();

	var datos = new FormData();
	datos.append("validarEmpresa", empresa);

	$.ajax({

		url:"ajax/empresas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){


			if (respuesta) {

				idEmpresa = $("#idEmpresa").val();
				empresaActual = $("#empresaActual").val();

				if (respuesta["id"] != idEmpresa) {
					$("#editarEmpresa").parent().before('<div class="alert alert-warning">Esta empresa ya existe en la base de datos</div>');
					$("#editarEmpresa").val(empresaActual);
				}
			}
		}

	})

})

/*=============================================
ELIMINAR EMPRESA
=============================================*/

$(".tablas").on("click", ".btnEliminarEmpresa", function(){

	var idEmpresa = $(this).attr("idEmpresa");
	var logoEmpresa = $(this).attr("logoEmpresa");
	var empresa = $(this).attr("empresa");


	swal({

		title: '¿Esta seguro de borrar la empresa',
		text: "!Si no lo esta puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar empresa!'

	}).then(function(result){

		if (result.value) {

			window.location = "index.php?ruta=empresas&idEmpresa="+idEmpresa+"&empresa="+empresa+"&logoEmpresa="+logoEmpresa;
		}


	})


})
