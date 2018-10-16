/* =================================================
FUNCION PARA INABILITAR ESTABLECIMIENTOS
====================================================*/

function desactivarEstablecimientos(){

  var desactivarBoton = $(".agregarEstablecimiento");

  for (var i = 0; i < desactivarBoton.length; i++) {

    $(desactivarBoton[i]).removeClass("btn-primary agregarEstablecimiento");
    $(desactivarBoton[i]).addClass("btn-default ");

  }

}

/* =================================================
FUNCION PARA HABILITAR ESTABLECIMIENTOS
====================================================*/

function activarEstablecimientos(){

  var activarBoton = $(".recuperarEstablecimiento");

  for (var i = 0; i < activarBoton.length; i++) {

    $(activarBoton[i]).removeClass("btn-default");
    $(activarBoton[i]).addClass("btn-primary agregarEstablecimiento");

  }

}

/* =================================================
AGREGANDO ESTABLECIMIENTOS AL RADICADO DESDE LA TABLA
====================================================*/

$(".tablaRadicados tbody").on("click", "button.agregarEstablecimiento", function(){

  desactivarEstablecimientos();

  $(".sorting").click(function(){
      desactivarEstablecimientos();
  })

  $("select[name='DataTables_Table_0_length']").change(function(){
      desactivarEstablecimientos();
  })

  $("input[aria-controls='DataTables_Table_0']").focus(function(){
    $(document).keyup(function(event){
      event.preventDefault();
      desactivarEstablecimientos();
    })
  })

  $(".dataTables_paginate").click(function(){
    desactivarEstablecimientos();
  })

  var idEstablecimiento = $(this).attr("idEstablecimiento");

  var datos =new FormData();
  datos.append("idEstablecimiento",idEstablecimiento);

  $.ajax({

    url:"ajax/establecimientos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
    success:function(respuesta){

      var datosEmpresa = new FormData();
      datosEmpresa.append("idEmpresa",respuesta["idempresa"]);

      var identificador = respuesta["identificador"];

      $.ajax({

        url: "ajax/empresas.ajax.php",
        method: "POST",
        data: datosEmpresa,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){

          var empresa = respuesta["empresa"];
          var idempresa = respuesta["id"];

          $(".nuevoDestinatario").append(

              '<div class="row" style="padding:5px 15px">'+

                '<div class="form group">'+

                  '<div class="input-group">'+
                    '<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>'+
                    '<input type="text" class="form-control nuevoEstablecimiento" id="nuevoEstablecimiento" name="nuevoEstablecimiento" idEstablecimiento="'+idEstablecimiento+'" value="'+identificador+'" readonly>'+
                    '<span class="input-group-addon"><button class="btn btn-danger btn-xs quitarEstablecimiento" idEstablecimiento="'+idEstablecimiento+'"><i class="fa fa-times"></i></button></span>'+
                  '</div>'+

                  '<div class="row" style="padding:5px 0px">'+

                    '<div class="form group">'+

                      '<div class="col-xs-12">'+
                        '<div class="input-group">'+
                          '<span class="input-group-addon"><i class="fa fa-building"></i></span>'+
                          '<input type="text" class="form-control nuevaEmpresa" id="nuevaEmpresa" name="nuevaEmpresa" idEmpresa="'+idempresa+'" value="'+empresa+'" readonly>'+
                        '</div>'+
                      '</div>'+

                      '<div class="col-xs-12" style="padding:5px 15px">'+
                        '<div class="input-group">'+
                          '<span class="input-group-addon"><i class="fa fa-users"></i></span>'+
                          '<select class="form-control seleccionarCliente" id="seleccionarCliente" name="seleccionarCliente">'+
                            '<option value="">Seleccionar Cliente</option>'+
                          '</select>'+

                          '<span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal"'+ 'data-target="#modalAgregarCliente" data-dismiss="modal">Agregar Cliente</button></span>'+
                        '</div>'+
                      '</div>'+

                    '</div>'+

                  '</div>'+

                '</div>'+

              '</div>'

          )


          // AGRUPAR DESTINATARIO EN FORMATO JSON

          listarDestinatario()

        }

      })


      var datosCliente = new FormData();
      datosCliente.append("idEstablecimiento", respuesta["id"]);

      $.ajax({

        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datosCliente,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){

          //AGREGAR LOS CLIENTES AL SELECT

          var select = document.getElementById("seleccionarCliente");

          if (select.length > 0) {

            while (select.length > 0) {
              select.remove(select.length-1);
            }

          }

          $("#seleccionarCliente").append(

            '<option value="">Seleccionar Cliente</option>'
          )

          respuesta.forEach(funcionForEach);

          function funcionForEach(item, index){

            $("#seleccionarCliente").append(

              '<option idCliente="'+item.id+'"  value="'+item.id+'">'+item.nombre+'</option>'
            )
          }


        }

      })

    }

  })

})

/* =================================================
QUITAR ESTABLECIMIENTOS AL RADICADO DESDE LA TABLA
====================================================*/

$(".formularioRadicador").on("click", "button.quitarEstablecimiento", function(){

  $(this).parent().parent().parent().parent().remove();

  var idEstablecimiento =$(this).attr("idEstablecimiento");

  $("button.recuperarEstablecimiento[idEstablecimiento='"+idEstablecimiento+"']").removeClass('btn-default');
  $("button.recuperarEstablecimiento[idEstablecimiento='"+idEstablecimiento+"']").addClass('btn-primary agregarEstablecimiento');


  activarEstablecimientos();

  $(".sorting").click(function(){
      activarEstablecimientos();
  })

  $("select[name='DataTables_Table_0_length']").change(function(){
      activarEstablecimientos();
  })

  $("input[aria-controls='DataTables_Table_0']").focus(function(){
    $(document).keyup(function(event){
      event.preventDefault();
      activarEstablecimientos();
    })
  })

  $(".dataTables_paginate").click(function(){
    activarEstablecimientos();
  })

  // AGRUPAR DESTINATARIO EN FORMATO JSON

  listarDestinatario()

})

/* ====================================================================
AGREGANDO ESTABLECIMIENTOS AL RADICADO DESDE EL BOTON PARA DISPOSITIVOS
=====================================================================*/

$(".btnAgregarEstablecimiento").click(function(){

  var datos = new FormData();
  datos.append("traerEstablecimientos", "ok");

  $.ajax({

    url:"ajax/establecimientos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
    success:function(respuesta){

      $(".nuevoDestinatario").append(

          '<div class="row" style="padding:5px 15px">'+

            '<div class="form group">'+

              '<div class="input-group">'+
                '<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>'+
                '<select class="form-control nuevoEstablecimiento" idEstablecimiento id="nuevoEstablecimiento" name="nuevoEstablecimiento" required>'+
                '<option>Seleccione el Establecimiento</option>'+
                '</select>'+
                '<span class="input-group-addon"><button class="btn btn-danger btn-xs quitarEstablecimiento" idEstablecimiento><i class="fa fa-times"></i></button></span>'+
              '</div>'+

              '<div class="row" style="padding:5px 0px">'+

                '<div class="form group">'+

                  '<div class="col-xs-12">'+
                    '<div class="input-group">'+
                      '<span class="input-group-addon"><i class="fa fa-building"></i></span>'+
                      '<input type="text" class="form-control nuevaEmpresa" id="nuevaEmpresa" idEmpresa name="nuevaEmpresa" value="" readonly>'+
                    '</div>'+
                  '</div>'+

                  '<div class="col-xs-12" style="padding:5px 15px">'+
                    '<div class="input-group">'+
                      '<span class="input-group-addon"><i class="fa fa-users"></i></span>'+
                      '<select class="form-control seleccionarCliente" id="seleccionarCliente" name="seleccionarCliente">'+
                        '<option value="">Seleccionar Cliente</option>'+
                      '</select>'+

                      '<span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal"'+ 'data-target="#modalAgregarCliente" data-dismiss="modal">Agregar Cliente</button></span>'+
                    '</div>'+
                  '</div>'+

                '</div>'+

              '</div>'+

            '</div>'+

          '</div>');

          //AGREGAR LOS ESTABLECIMIENTOS AL select

          respuesta.forEach(funcionForEach);

          function funcionForEach(item, index){

            $(".nuevoEstablecimiento").append(

              '<option idEstablecimiento="'+item.id+'"  value="'+item.id+'">'+item.identificador+'</option>'
            )

          }

    }

  })

})

/* =================================================
AGREGAR EMPRESA AL ESTABLECIMIENTO DESDE DISPOSITIVOS
====================================================*/

$(".formularioRadicador").on("change", "select.nuevoEstablecimiento", function(){

  var idEstablecimiento = $(this).val();

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
    success:function(respuesta){

      var datosEmpresa = new FormData();
      datosEmpresa.append("idEmpresa",respuesta["idempresa"]);

      $("#nuevoEstablecimiento").attr("idEstablecimiento",respuesta["id"]);

      var identificador = respuesta["identificador"];

      $.ajax({

        url: "ajax/empresas.ajax.php",
        method: "POST",
        data: datosEmpresa,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){

          $("#nuevaEmpresa").val(respuesta["empresa"]);
          $("#nuevaEmpresa").attr("idEmpresa",respuesta["id"]);

        }

      })

      var datosCliente = new FormData();
      datosCliente.append("idEstablecimiento", respuesta["id"]);

      $.ajax({

        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datosCliente,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){

          //AGREGAR LOS CLIENTES AL SELECT

          var select = document.getElementById("seleccionarCliente");

          if (select.length > 0) {

            while (select.length > 0) {
              select.remove(select.length-1);
            }

          }

          $("#seleccionarCliente").append(

            '<option value="">Seleccionar Cliente</option>'
          )

          respuesta.forEach(funcionForEach);

          function funcionForEach(item, index){

            $("#seleccionarCliente").append(

              '<option idCliente="'+item.id+'"  value="'+item.id+'">'+item.nombre+'</option>'
            )
          }

          // AGRUPAR DESTINATARIO EN FORMATO JSON

          listarDestinatario()

        }

      })


    }

  })

})


/* =============================================================
FUNCION PARA INABILITAR CATEGORIAS EN CORRESPONDENCIA INDIVIDUAL
================================================================*/

function desactivarCategorias(){

  var desactivarBotonCategoria = $(".agregarCategoria");

  for (var i = 0; i < desactivarBotonCategoria.length; i++) {

    $(desactivarBotonCategoria[i]).removeClass("btn-primary agregarCategoria");
    $(desactivarBotonCategoria[i]).addClass("btn-default ");

  }

}

/* =================================================
FUNCION PARA HABILITAR CATEGORIAS
====================================================*/

function activarCategoria(){

  var activarBotonCategoria = $(".recuperarCategoria");

  for (var i = 0; i < activarBotonCategoria.length; i++) {

    $(activarBotonCategoria[i]).removeClass("btn-default");
    $(activarBotonCategoria[i]).addClass("btn-primary agregarCategoria");

  }

}

/* =================================================
FUNCION PARA DETERMINAR EL RADIO SELECCIONADO
====================================================*/

function obtenerValorRadioButtonSeleccionado(ctrl){

    for(i=0;i<ctrl.length;i++)
        if(ctrl[i].checked) return ctrl[i].value;
}

/* =================================================
AGREGANDO CATEGORIAS AL RADICADO DESDE LA TABLA
====================================================*/

$(".tablaCategorias tbody").on("click", "button.agregarCategoria", function(){

  var tipo = obtenerValorRadioButtonSeleccionado(formularioRadicador.nuevoTipoCorrespondencia);

  if (tipo == "Individual") {

    desactivarCategorias();

    $(".sorting").click(function(){
      desactivarCategorias();
    })

    $("select[name='DataTables_Table_0_length']").change(function(){
      desactivarCategorias();
    })

    $("input[aria-controls='DataTables_Table_0']").focus(function(){
      $(document).keyup(function(event){
        event.preventDefault();
        desactivarCategorias();
      })
    })

    $(".dataTables_paginate").click(function(){
      desactivarCategorias();
    })

  }

  var idCategoria = $(this).attr("idCategoria");

  $(this).removeClass("btn-primary agregarCategoria");
  $(this).addClass("btn-default ");

  var datos =new FormData();
  datos.append("idCategoria",idCategoria);

  $.ajax({

    url:"ajax/categorias.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
    success:function(respuesta){

      var categoria = respuesta["categoria"];

      if (tipo == "Individual") {
        $(".nuevaCategoria").append(

          '<div class="row" style="padding:5px 0px">'+

          '<div class="form group">'+

          '<div class="col-xs-6" style="padding-right:0px">'+

          '<div class="input-group">'+
          '<span class="input-group-addon"><i class="fa fa-tag"></i></span>'+
          '<input type="text" class="form-control nuevaCategoriaCorrespondencia" id="nuevaCategoria" name="nuevaCategoria" idCategoria="'+idCategoria+'" value="'+categoria+'" readonly>'+
          '</div>'+

          '</div>'+

          '<div class="col-xs-6">'+

          '<div class="input-group">'+
          '<span class="input-group-addon"><i class="ion ion-grid"></i></span>'+
          '<input min="1" class="form-control nuevaCantidadCorrespondencia" name="nuevaCantidadCorrespondencia" value="1"'+
          'required="" type="number" readonly>'+
          '<span class="input-group-addon"><button class="btn btn-danger btn-xs quitarCategoria" idCategoria="'+idCategoria+'"><i class="fa fa-times"></i></button></span>'+
          '</div>'+

          '</div>'+

          '<div class="col-xs-12" style="padding:5px 15px">'+

          '<div class="input-group">'+
          '<span class="input-group-addon"><i class="fa fa-info-circle"></i></span>'+
          '<input type="text" class="form-control nuevaObservacion" id="nuevaObservacion" name="nuevaObservacion"  >'+
          '</div>'+

          '</div>'+

          '</div>'+

          '</div>'

        )

      } else {

        $(".nuevaCategoria").append(

          '<div class="row" style="padding:5px 0px">'+

          '<div class="form group">'+

          '<div class="col-xs-6" style="padding-right:0px">'+

          '<div class="input-group">'+
          '<span class="input-group-addon"><i class="fa fa-tag"></i></span>'+
          '<input type="text" class="form-control nuevaCategoriaCorrespondencia" id="nuevaCategoria" name="nuevaCategoria" idCategoria="'+idCategoria+'" value="'+categoria+'" readonly>'+
          '</div>'+

          '</div>'+

          '<div class="col-xs-6">'+

          '<div class="input-group">'+
          '<span class="input-group-addon"><i class="ion ion-grid"></i></span>'+
          '<input min="1" class="form-control nuevaCantidadCorrespondencia" name="nuevaCantidadCorrespondencia" value="1"'+
          'required="" type="number">'+
          '<span class="input-group-addon"><button class="btn btn-danger btn-xs quitarCategoria" idCategoria="'+idCategoria+'"><i class="fa fa-times"></i></button></span>'+
          '</div>'+

          '</div>'+

          '<div class="col-xs-12" style="padding:5px 15px">'+

          '<div class="input-group">'+
          '<span class="input-group-addon"><i class="fa fa-info-circle"></i></span>'+
          '<input type="text" class="form-control nuevaObservacion" id="nuevaObservacion" name="nuevaObservacion"  >'+
          '</div>'+

          '</div>'+

          '</div>'+

          '</div>'

        )
      }

      // AGRUPAR CORRESPONDENCIA EN FORMATO JSON

      listarCorrespondencia()

    }

  })

})


/* =================================================
QUITAR CATEGORIAS AL RADICADO DESDE LA TABLA
====================================================*/

$(".formularioRadicador").on("click", "button.quitarCategoria", function(){

  $(this).parent().parent().parent().parent().parent().remove();

  var idCategoria = $(this).attr("idCategoria");

  $("button.recuperarCategoria[idCategoria='"+idCategoria+"']").removeClass('btn-default');
  $("button.recuperarCategoria[idCategoria='"+idCategoria+"']").addClass('btn-primary agregarCategoria');

  var tipo = obtenerValorRadioButtonSeleccionado(formularioRadicador.nuevoTipoCorrespondencia);

  if (tipo == "Individual") {

    activarCategoria();

    $(".sorting").click(function(){
      activarCategoria();
    })

    $("select[name='DataTables_Table_0_length']").change(function(){
      activarCategoria();
    })

    $("input[aria-controls='DataTables_Table_0']").focus(function(){
      $(document).keyup(function(event){
        event.preventDefault();
        activarCategoria();
      })
    })

    $(".dataTables_paginate").click(function(){
      activarCategoria();
    })

  }

  // AGRUPAR CORRESPONDENCIA EN FORMATO JSON

  listarCorrespondencia()

})

/* =================================================
ACTUALIZAR DESTINATARIO
====================================================*/

$(".formularioRadicador").on("change", "select.nuevoDestinatario", function(){

  // AGRUPAR DESTINATARIO EN FORMATO JSON

  listarDestinatario()

})

/* =================================================
ACTUALIZAR CLIENTE DESTINATARIO
====================================================*/

$(".formularioRadicador").on("change", "select.seleccionarCliente", function(){

  // AGRUPAR DESTINATARIO EN FORMATO JSON

  listarDestinatario()

})


/* =================================================
LISTADO INFORMACION DESTINATARIO
====================================================*/

function listarDestinatario(){

  var listaDestinatario = [];

  var establecimiento = $(".nuevoEstablecimiento");
  var empresa = $(".nuevaEmpresa");
  var cliente = $(".seleccionarCliente");


  for (var i = 0; i < empresa.length; i++) {

    listaDestinatario.push({  "idEstablecimiento" : $(establecimiento[i]).attr("idEstablecimiento"),
                              "idEmpresa" : $(empresa[i]).attr("idEmpresa"),
                              "idCliente" : $(cliente[i]).val()})
  }

  $("#listaDestinatario").val(JSON.stringify(listaDestinatario));

}


/* =================================================
ACTUALIZAR CANTIDAD
====================================================*/

$(".formularioRadicador").on("change", "input.nuevaCantidadCorrespondencia", function(){

  // AGRUPAR CORRESPONDENCIA EN FORMATO JSON

  listarCorrespondencia()

})

/* =================================================
ACTUALIZAR OBSERVACIONES CORRESPONDENCIA
====================================================*/

$(".formularioRadicador").on("change", "input.nuevaObservacion", function(){


  // AGRUPAR CORRESPONDENCIA EN FORMATO JSON

  listarCorrespondencia()

})


/* =================================================
LISTADO CORRESPONDENCIA
====================================================*/

function listarCorrespondencia(){

  var listaCorrespondencia = [];

  var tipo = obtenerValorRadioButtonSeleccionado(formularioRadicador.nuevoTipoCorrespondencia);

  var categoria = $(".nuevaCategoriaCorrespondencia");
  var cantidad = $(".nuevaCantidadCorrespondencia");
  var observacion = $(".nuevaObservacion");

  for (var i = 0; i < categoria.length; i++) {

    listaCorrespondencia.push({ "id" : $(categoria[i]).attr("idCategoria"),
                                "cantidad" : $(cantidad[i]).val(),
                                "observacion" : $(observacion[i]).val()})
  }

    $("#listaCorrespondencia").val(JSON.stringify(listaCorrespondencia));

}

/* =================================================
BOTON EDITAR RADICADO
====================================================*/

$(".tablas").on("click", ".btnEditarRadicado", function(){

  var idRadicado = $(this).attr("idRadicado");

  window.location = "index.php?ruta=editar-radicado&idRadicado="+idRadicado;

})

/* =================================================
DESACTIVAR DESTINATARIOS EN EDICION DE RADICADO
====================================================*/

function quitarAgregarEstablecimiento(){

  // Captura id establecimiento
  var idEstablecimientos = $(".quitarEstablecimiento");

  // Captura botones que aparecen en establecimientos
  var botonesTabla =$(".tablaRadicados tbody button.agregarEstablecimiento");

  for (var i = 0; i < idEstablecimientos.length; i++) {

    var boton = $(idEstablecimientos[i]).attr("idEstablecimiento");

    for (var j = 0; j < botonesTabla.length; j++) {

        $(botonesTabla[j]).removeClass("btn-primary agregarEstablecimiento");
        $(botonesTabla[j]).addClass("btn-default");

    }
  }
}


$('.tablaRadicados').on( 'draw.dt', function(){

  quitarAgregarEstablecimiento();

})



/* =================================================
DESACTIVAR CATEGORIAS EN EDICION DE RADICADO
====================================================*/

function quitarAgregarCategoria(){

  // Captura id categoria
  var idCategorias = $(".quitarCategoria");

  // Captura botones que aparecen en establecimientos
  var botonesTablaCat =$(".tablaCategorias tbody button.agregarCategoria");

  for (var i = 0; i < idCategorias.length; i++) {

    var botonCat = $(idCategorias[i]).attr("idCategoria");

    for (var j = 0; j < botonesTablaCat.length; j++) {

      if ($(botonesTablaCat[j]).attr("idCategoria") == botonCat) {

        $(botonesTablaCat[j]).removeClass("btn-primary agregarEstablecimiento");
        $(botonesTablaCat[j]).addClass("btn-default");

      }
    }
  }
}


$('.tablaCategorias').on( 'draw.dt', function(){

  quitarAgregarCategoria();

})

/* =================================================
DESACTIVAR ESTABLECIMIENTO Y CATEGORIAS EN LA CARGA
====================================================*/

$(window).on("load", function(){

  quitarAgregarEstablecimiento();
  quitarAgregarCategoria();

})

/* =================================================
BORRAR RADICADO
====================================================*/

$(".btnEliminarRadicado").click(function(){

  var idRadicado =$(this).attr("idRadicado");

  swal({

		title: '¿Esta seguro de borrar el radicado',
		text: "!Si no lo esta puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar radicado!'

	}).then(function(result){

		if (result.value) {

			window.location = "index.php?ruta=radicados&idRadicado="+idRadicado;
		}


	})

})
