//  Función de reporte
$("#generar_reporte").click(function(event){
  
  // Recorremos la tabla para contar el número de productos mostrados
  var num_rows = 0;  // Contador de checkbox marcados
  $("#dataTable tbody tr").each(function () {
	  if($(this).find('td').eq(0).text() == 'No matching records found'){
		  return false;
	  }
	  num_rows += 1;
  });

  if (num_rows < 1) {
	  alert("Disculpe, no hay productos resultantes de la búsqueda");
	  event.preventDefault();
  }else{

	  //~ var href = $(this).attr('href');
	  var url = 'print_inventario.php';

	  var search = $("#dataTable_filter").find('input').val();  // Buscador de datatable (valor)

	  // Si hay una búsqueda se coloca en la url
	  if(search != ''){
		  //~ $("#generar_reporte").attr('href', href+'?search='+search);
		  url = url+'?search='+search;
	  };
	  
	  window.open(url);
  }
});

// Función de control de modal para registro de productos
$("#new_product").click(function(){

  //~ $("#formulario").trigger("reset");
  $(".modal-header").css("background-color","#446ad7");
  $(".modal-header").css("color","white");
  $(".modal-title").text("Nuevo producto");
  $("#modal_new_edit").modal("show");
});
