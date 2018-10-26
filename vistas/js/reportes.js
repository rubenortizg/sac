/* =================================================
VARIABLE LOCAL STORAGE
====================================================*/

if (localStorage.getItem("capturarRangoReportes") != null) {

  $("#daterange-btnReportes span").html(localStorage.getItem("capturarRangoReportes"));

}else {

  $("#daterange-btnReportes span").html('<i class="fa fa-calendar"></i> Rango de fecha');

}


/* =====================================
  //Date range as a button en REPORTES
==========================================*/

$('#daterange-btnReportes').daterangepicker(
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

    $('#daterange-btnReportes span').html(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));

    var fechaInicial = start.format('YYYY-MM-DD');
    var fechaFinal = end.format('YYYY-MM-DD');
    var capturarRangoReportes = $("#daterange-btnReportes span").html();

    localStorage.setItem("capturarRangoReportes", capturarRangoReportes);

    window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  }
)

/* =================================================
CANCELAR RANGO DE FECHAS
====================================================*/

$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){

  localStorage.removeItem("capturarRangoreportes");
  localStorage.clear();
  window.location = "reportes";
})

/* =================================================
CAPTURAR HOY
====================================================*/

$(".daterangepicker.opensright .ranges li").on("click", function(event){

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

    localStorage.setItem("capturarRangoReportes", fechaInicial+" / "+fechaFinal);
    window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

})
