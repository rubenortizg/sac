/*=============================================
SUBIENDO LA FOTO DE LA TRANSPORTADORA
=============================================*/
$(".nuevoLogo").change(function(){

	var imagen = this.files[0];

	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevoLogo").val("");

  		 swal({
		      title: "Error al subir el logo",
		      text: "¡El logo debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevoLogo").val("");

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
EDITAR TRANSPORTADORA
=============================================*/
$(".tablas").on("click", ".btnEditarTransportadora", function(){

	var idTransportadora = $(this).attr("idTransportadora");

	var datos = new FormData();
	datos.append("idTransportadora", idTransportadora);

	$.ajax({

		url:"ajax/transportadoras.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#editarTransportadora").val(respuesta["transportadora"]);
			$("#idTransportadora").val(respuesta["id"]);
			$("#transportadoraActual").val(respuesta["transportadora"]);
			/* Logo actual */
			$("#logoActual").val(respuesta["logo"]);

			if(respuesta["logo"] != ""){

				$(".previsualizar").attr("src", respuesta["logo"]);

			}

		}

	});

})

/*=============================================
ACTIVAR TRANSPORTADORA
=============================================*/
$(".tablas").on("click", ".btnActivarTransportadora", function(){

	var idTransportadora = $(this).attr("idTransportadora");
	var estadoTransportadora = $(this).attr("estadoTransportadora");

	var datos = new FormData();
 	datos.append("activarId", idTransportadora);
  	datos.append("activarTransportadora", estadoTransportadora);

  	$.ajax({

	  url:"ajax/transportadoras.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      }

  	})

  	if(estadoTransportadora == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoTransportadora',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoTransportadora',0);

  	}

})

/*=============================================
REVISAR SI LA TRANSPORTADORA ESTA REGISTRADO
=============================================*/

$("#nuevaTransportadora").change(function(){

	$(".alert").remove();

	var transportadora = $(this).val();

	var datos = new FormData();
	datos.append("validarTransportadora", transportadora);

	$.ajax({

		url:"ajax/transportadoras.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			if (respuesta) {

				$("#nuevaTransportadora").parent().before('<div class="alert alert-warning">Esta transportadora ya existe en la base de datos</div>');
				$("#nuevaTransportadora").val("");

			}
		}

	})

})


$("#editarTransportadora").change(function(){

	$(".alert").remove();

	var transportadora = $(this).val();

	var datos = new FormData();
	datos.append("validarTransportadora", transportadora);

	$.ajax({

		url:"ajax/transportadoras.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			if (respuesta) {

				idTransportadora = $("#idTransportadora").val();
				transportadoraActual = $("#transportadoraActual").val();

				if (respuesta["id"] != idTransportadora) {
				$("#editarTransportadora").parent().before('<div class="alert alert-warning">Esta transportadora ya existe en la base de datos</div>');
				$("#editarTransportadora").val(transportadoraActual);
				}
			}
		}

	})

})

/*=============================================
ELIMINAR TRANSPORTADORA
=============================================*/

$(".tablas").on("click", ".btnEliminarTransportadora", function(){

	var idTransportadora = $(this).attr("idTransportadora");
	var logoTransportadora = $(this).attr("logoTransportadora");
	var transportadora = $(this).attr("transportadora");


	swal({

		title: '¿Esta seguro de borrar la transportadora',
		text: "!Si no lo esta puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar transportadora!'

	}).then(function(result){

		if (result.value) {

			window.location = "index.php?ruta=transportadoras&idTransportadora="+idTransportadora+"&transportadora="+transportadora+"&logoTransportadora="+logoTransportadora;
		}


	})


})
