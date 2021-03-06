// Url base
var base_url = $("#base_url").val();

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
	  var url = base_url+'admin/print_inventario.php';

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
  $("#formulario").attr("action", base_url+"admin/products/add.php");
  $(".modal-header").css("background-color","#446ad7");
  $(".modal-header").css("color","white");
  $("#modal_product").text("Nuevo producto");
  $("#modal_new_edit").modal("show");
  $("#formulario #register").text("Registrar");
  $("#formulario #id").val('');
});

// Función de control de modal para edición de productos
function modal_edit(id){
	var dataString = 'id='+id;
	$.ajax({
		type: "POST",
		url: base_url+"admin/products/search_ajax.php",
		data: dataString,
		success: function(data) {
			// Convertir el JSON recibido a un objeto en javaScript
			data = JSON.parse(data);
			//~ console.log(data);
			//~ console.log(data.CodigoProducto);
			$("#formulario").trigger("reset");
			$("#formulario").attr("action", base_url+"admin/products/edit.php");
			$(".modal-header").css("background-color","#446ad7");
			$(".modal-header").css("color","white");
			$("#modal_product").text("Editar producto");
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

// Función para el registro/actualización de productos
$("#register").click(function(){
	var action = $("#formulario").attr("action");
	var dataForm = $('#formulario').serialize();
	var buttonText = $("#formulario #register").text();
	if($("#formulario #CodigoProducto").val() == ""){
		swal({title: buttonText, text: "El código está vacío o no es válido.", type: "warning"});
	}else if($("#formulario #NombreProducto").val() == "" || jQuery.isNumeric($("#formulario #NombreProducto").val())){
		swal({title: buttonText, text: "El nombre del producto está vacío o no es válido.", type: "warning"});
	}else if($("#formulario #Descripcion").val() == "" || jQuery.isNumeric($("#formulario #Descripcion").val())){
		swal({title: buttonText, text: "La descripción del producto está vacío o no es válido.", type: "warning"});
	}else if($("#formulario #PrecioUnitario").val() == "" || !jQuery.isNumeric($("#formulario #PrecioUnitario").val())){
		swal({title: buttonText, text: "El precio del producto está vacío o no es válido.", type: "warning"});
	}else if($("#formulario #Unidades").val() == "" || !jQuery.isNumeric($("#formulario #Unidades").val())){
		swal({title: buttonText, text: "Las unidades del producto está vacío o no es válido.", type: "warning"});
	}else if($("#formulario #Direccion").val() == "" || jQuery.isNumeric($("#formulario #Direccion").val())){
		swal({title: buttonText, text: "La dirección del producto está vacío o no es válido.", type: "warning"});
	}else{
		$.ajax({
			type: "POST",
			url: action,
			data: dataForm,
			success: function(data) {
				// Convertir el JSON recibido a un objeto en javaScript
				data = JSON.parse(data);
				//~ console.log(data);
				//~ alert(data.message);
				//~ location.reload();
				swal({ 
					title: buttonText, 
					text: data.message, 
					type: data.message_type 
				},function(){
					location.reload();
				});
			}
		}, 'json');
	}
});

// Función de control de modal para eliminación de productos
function modal_delete(id){
	//~ if(confirm("La operación no se puede deshacer, ¿Está seguro de eliminar el producto?")){
	swal({
		title: "La operación de eliminación no se puede deshacer.",
		text: "¿Está seguro de eliminar el producto?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Eliminar",
		cancelButtonText: "Cancelar",
		closeOnConfirm: false,
		closeOnCancel: true
	},function(isConfirm){
		if (isConfirm) {
			var dataString = 'id='+id;
			$.ajax({
				type: "POST",
				url: base_url+"admin/products/delete.php",
				data: dataString,
				success: function(data) {
					// Convertir el JSON recibido a un objeto en javaScript
					data = JSON.parse(data);
					//~ console.log(data);
					//~ alert(data.message);
					//~ location.reload();
					swal({ 
						title: "Eliminar", 
						text: data.message, 
						type: data.message_type 
					},function(){
						location.reload();
					});
				}
			}, 'json');
		}
	});
	//~ }
}
