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
AGREGANDO ESTABLECIMIENTOS AL COMPROBANTE DESDE LA TABLA
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

          $(".nuevoDestinatario").append(

              '<div class="row" style="padding:5px 15px">'+

                '<div class="form group">'+

                  '<div class="input-group">'+
                    '<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>'+
                    '<input type="text" class="form-control" id="nuevoEstablecimiento" name="nuevoEstablecimiento" value="'+identificador+'" readonly>'+
                    '<span class="input-group-addon"><button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></span>'+
                  '</div>'+

                  '<div class="row" style="padding:5px 0px">'+

                    '<div class="form group">'+

                      '<div class="col-xs-12">'+
                        '<div class="input-group">'+
                          '<span class="input-group-addon"><i class="fa fa-building"></i></span>'+
                          '<input type="text" class="form-control" id="nuevaEmpresa" name="nuevaEmpresa" value="'+empresa+'" readonly>'+
                        '</div>'+
                      '</div>'+

                      '<div class="col-xs-12" style="padding:5px 15px">'+
                        '<div class="input-group">'+
                          '<span class="input-group-addon"><i class="fa fa-users"></i></span>'+
                          '<select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>'+
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

        }

      })

    }

  })

})


/* =================================================
AGREGANDO CATEGORIAS AL COMPROBANTE DESDE LA TABLA
====================================================*/

$(".tablaCategorias tbody").on("click", "button.agregarCategoria", function(){

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

      $(".nuevaCategoria").append(

        '<div class="row" style="padding:5px 0px">'+

            '<div class="form group">'+

              '<div class="col-xs-6" style="padding-right:0px">'+

                '<div class="input-group">'+
                  '<span class="input-group-addon"><i class="fa fa-tag"></i></span>'+
                  '<input type="text" class="form-control" id="nuevaEmpresa" name="nuevaEmpresa" value="'+categoria+'" readonly>'+
                '</div>'+

              '</div>'+

              '<div class="col-xs-6">'+

                '<div class="input-group">'+
                  '<span class="input-group-addon"><i class="ion ion-grid"></i></span>'+
                  '<input min="1" class="form-control" id="nuevaCantidadMasivo" name="nuevaCantidadMasivo" placeholder="0" valorconcepto=""'+ 'required="" type="number">'+
                  '<span class="input-group-addon"><button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></span>'+
                '</div>'+

              '</div>'+

              '<div class="col-xs-12" style="padding:5px 15px">'+

                '<div class="input-group">'+
                  '<span class="input-group-addon"><i class="fa fa-info-circle"></i></span>'+
                  '<input type="text" class="form-control" id="nuevaObservacion" name="nuevaObservacion"  >'+
                '</div>'+

              '</div>'+

            '</div>'+

        '</div>'

      )

    }

  })

})
