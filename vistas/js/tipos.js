/*=============================================
EDITAR TIPO DE ESTABLECIMIENTO
=============================================*/

$(".tablas").on("click", ".btnEditarTipo", function(){

	var idTipo = $(this).attr("idTipo");

	var datos = new FormData();
	datos.append("idTipo", idTipo);

	$.ajax({

		url:"ajax/tipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#editarTipo").val(respuesta["tipo"]);
			$("#idTipo").val(respuesta["id"]);

		}

	})

})

/*===================================================
REVISAR SI EL TIPO DE ESTABLECIMIENTO ESTA REGISTRADO
====================================================*/

$("#nuevoTipo").change(function(){

	$(".alert").remove();

	var tipo = $(this).val();

	var datos = new FormData();
	datos.append("validarTipo", tipo);

	$.ajax({

		url:"ajax/tipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			if (respuesta) {

				$("#nuevoTipo").parent().before('<div class="alert alert-warning">Este tipo de establecimiento ya existe en la base de datos</div>');
				$("#nuevoTipo").val("");


			}
		}

	})

})

/*=============================================
ELIMINAR TIPO DE ESTABLECIMIENTO
=============================================*/


$(".tablas").on("click", ".btnEliminarTipo", function(){

	var idTipo = $(this).attr("idTipo");

	swal({
		title: '¿Esta seguro de borrar el tipo de establecimiento?',
		text: "¡Si no lo esta puede cancelar la acción! ",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar tipo!'
	}).then(function(result){

		if (result.value) {

			window.location = "index.php?ruta=tipos&idTipo="+idTipo;

		}

	})


})
