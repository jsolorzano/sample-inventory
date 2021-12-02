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

  $("#formulario").trigger("reset");
  $("#formulario").attr("action", "products/add.php");
  $(".modal-header").css("background-color","#446ad7");
  $(".modal-header").css("color","white");
  $(".modal-title").text("Nuevo producto");
  $("#modal_new_edit").modal("show");
  $("#formulario #register").text("Registrar");
});

// Función de control de modal para edición de productos
function modal_edit(id){
	var dataString = 'id='+id;
	$.ajax({
		type: "POST",
		url: "products/search_ajax.php",
		data: dataString,
		success: function(data) {
			// Convertir el JSON recibido a un objeto en javaScript
			data = JSON.parse(data);
			//~ console.log(data);
			//~ console.log(data.CodigoProducto);
			$("#formulario").trigger("reset");
			$("#formulario").attr("action", "products/edit.php");
			$(".modal-header").css("background-color","#446ad7");
			$(".modal-header").css("color","white");
			$(".modal-title").text("Editar producto");
			$("#modal_new_edit").modal("show");
			$("#formulario #register").text("Actualizar");
			// Carga de datos
			$("#formulario #id").val(data.id);
			$("#formulario #CodigoProducto").val(data.CodigoProducto);
			$("#formulario #NombreProducto").val(data.NombreProducto);
			$("#formulario #Descripcion").val(data.Descripcion);
			$("#formulario #PrecioUnitario").val(data.PrecioUnitario);
			$("#formulario #Unidades").val(data.Unidades);
			$("#formulario #Direccion").val(data.Direccion);
		}
	}, 'json');
}

// Función de control de modal para eliminación de productos
function modal_delete(id){
	console.log(id);
}
