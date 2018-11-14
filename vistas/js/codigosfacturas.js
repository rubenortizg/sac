/* =================================================
SALIDAS PDF
====================================================*/

$(".btnPdfCodigos").on("click", function(){

  var operador = $("#seleccionarOperador option:selected").val();

  window.open("extensiones/tcpdf/pdf/codigosPDF.php?operador="+operador, "_blank");


})
