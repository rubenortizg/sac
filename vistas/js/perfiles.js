/* =================================================
BOTON EDITAR PERFIL
====================================================*/

$(".tablas").on("click", ".btnEditarPerfil", function(){

  var idPerfil = $(this).attr("idPerfil");

  window.location = "index.php?ruta=editar-perfil&idPerfil="+idPerfil;

})


/* =================================================
BORRAR PERFIL
====================================================*/

$(".tablas").on("click", ".btnEliminarPerfil", function(){

  var idPerfil =$(this).attr("idPerfil");

  swal({

		title: '¿Esta seguro de borrar el perfil',
		text: "!Si no lo esta puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar perfil!'

	}).then(function(result){

		if (result.value) {

			window.location = "index.php?ruta=perfiles&idPerfil="+idPerfil;
		}


	})

})
