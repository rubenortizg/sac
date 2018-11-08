/* =================================================
VARIABLE LOCAL STORAGE
====================================================*/

if (localStorage.getItem("capturarRango") != null) {

  $("#daterange-btnSalidas span").html(localStorage.getItem("capturarRango"));

}else {

  $("#daterange-btnSalidas span").html('<i class="fa fa-calendar"></i> Rango de fecha');

}

/* =================================================
SELECIONAR TODOS LOS RADICADOS
====================================================*/

$(".salidas .seleccionarTodos").on("click", function(event){

  $(this).parent().parent().parent().parent().parent().children("div.box-body").children().children().children().children().children().children().children().children().children().children().has(":checkbox").iCheck('check');

})

/* =================================================
DESELECIONAR TODOS LOS RADICADOS
====================================================*/

$(".salidas .deseleccionarTodos").on("click", function(event){

  $(this).parent().parent().parent().parent().parent().children("div.box-body").children().children().children().children().children().children().children().children().children().children().has(":checkbox").iCheck('uncheck');

})

/* =================================================
SALIDAS PDF
====================================================*/

$(".btnPdfSalidas").on("click", function(){

  var fechaInicial = $(this).attr("fechaInicial");
  var fechaFinal = $(this).attr("fechaFinal");

  window.open("extensiones/tcpdf/pdf/salidasPDF.php", "_blank");


})


/*=============================================
CAMBIAR ESTADO RADICADO
=============================================*/
$(".salidas").on("click", ".btnEstadoRadicado", function(){

	var idRadicado = $(this).attr("idRadicado");
	var estadoRadicado = $(this).attr("estadoRadicado");

	var datos = new FormData();
 	datos.append("activarId", idRadicado);
	datos.append("activarRadicado", estadoRadicado);

	$.ajax({

  url:"ajax/radicados.ajax.php",
  method: "POST",
  data: datos,
  cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta){

    }

	})

	if(estadoRadicado == 0){

		$(this).removeClass('btn-success');
		$(this).addClass('btn-warning');
		$(this).html('Radicado');
		$(this).attr('estadoRadicado',1);

	}else{

		$(this).addClass('btn-success');
		$(this).removeClass('btn-warning');
		$(this).html('Entregado');
		$(this).attr('estadoRadicado',0);

	}

})


/* =================================================
CAMBIAR ESTADO MULTIPLES RADICADOS
====================================================*/

// Comprobar los checkbox seleccionados
$('.cambiarEstado').on('click', function() {

    var radicadosSeleccionados = new Array();

    $('input[type=checkbox]:checked').each(function() {
        radicadosSeleccionados.push($(this).attr("name"));

      	var idRadicado = $(this).attr("name");
      	var estadoRadicado = 1;

      	var datos = new FormData();
       	datos.append("activarId", idRadicado);
      	datos.append("activarRadicado", estadoRadicado);

      	$.ajax({

        url:"ajax/radicados.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
          contentType: false,
          processData: false,
          success: function(respuesta){

          }

      	})

    })

    swal({

  		title: '¿Esta seguro de actualizar estado',
  		text: "!Si no lo esta puede cancelar la acción!",
  		type: 'warning',
  		showCancelButton: true,
  		confirmButtonColor: '#3085d6',
  		cancelButtonColor: '#d33',
  		cancelButtonText: 'Cancelar',
  		confirmButtonText: 'Si, actualizar estado!'

  	}).then(function(result){

  		if (result.value) {

  			window.location = "index.php?ruta=salidas";

      }

    })


})


/* =====================================
  //Date range as a button en RADICADO
==========================================*/

$('#daterange-btnSalidas').daterangepicker2(
  {
    "locale": {
        "format": "YYYY-MM-DD",
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Especificar",
        "weekLabel": "W",
        "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio<",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
    },
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Ultimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Ultimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Mes pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {

    $('#daterange-btnSalidas span').html(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));

    var fechaInicial = start.format('YYYY-MM-DD');
    var fechaFinal = end.format('YYYY-MM-DD');
    var capturarRango = $("#daterange-btnSalidas span").html();

    localStorage.setItem("capturarRango", capturarRango);

    window.location = "index.php?ruta=salidas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  }
)

/* =================================================
CANCELAR RANGO DE FECHAS
====================================================*/

$(".daterangepicker2.opensleft .range_inputs .cancelBtn").on("click", function(){

  localStorage.removeItem("capturarRango");
  localStorage.clear();
  window.location = "salidas";
})

/* =================================================
CAPTURAR HOY
====================================================*/

$(".daterangepicker2.opensleft .ranges li").on("click", function(event){

  var textoDia =  $(this).attr("data-range-key");

  if (textoDia == "Hoy") {

    var d = new Date();

    var dia = d.getDate();
    var mes = d.getMonth()+1;
    var año = d.getFullYear();

    if (mes < 10) {
      var fechaInicial = año+"-0"+mes+"-"+dia;
      var fechaFinal = año+"-0"+mes+"-"+dia;
    } else if (dia < 10) {
      var fechaInicial = año+"-"+mes+"-0"+dia;
      var fechaFinal = año+"-"+mes+"-0"+dia;
    } else if (mes < 10 && dia < 10) {
      var fechaInicial = año+"-0"+mes+"-0"+dia;
      var fechaFinal = año+"-0"+mes+"-0"+dia;
    } else {
      var fechaInicial = año+"-"+mes+"-"+dia;
      var fechaFinal = año+"-"+mes+"-"+dia;
    }

    localStorage.setItem("capturarRango", fechaInicial+" / "+fechaFinal);
    window.location = "index.php?ruta=salidas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

})
