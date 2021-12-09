// Url base
var base_url = $("#base_url").val();

//  Función de reporte
$("#generar_reporte").click(function(event){
  
  // Recorremos la tabla para contar el número de usuarios mostrados
  var num_rows = 0;  // Contador de checkbox marcados
  $("#dataTable tbody tr").each(function () {
	  if($(this).find('td').eq(0).text() == 'No matching records found'){
		  return false;
	  }
	  num_rows += 1;
  });

  if (num_rows < 1) {
	  alert("Disculpe, no hay usuarios resultantes de la búsqueda");
	  event.preventDefault();
  }else{

	  //~ var href = $(this).attr('href');
	  var url = base_url+'admin/users/print_users.php';

	  var search = $("#dataTable_filter").find('input').val();  // Buscador de datatable (valor)

	  // Si hay una búsqueda se coloca en la url
	  if(search != ''){
		  //~ $("#generar_reporte").attr('href', href+'?search='+search);
		  url = url+'?search='+search;
	  };
	  
	  window.open(url);
  }
});

// Función de control de modal para registro de usuarios
$("#new_user").click(function(){

  $("#formulario").trigger("reset");
  $("#formulario").attr("action", base_url+"admin/users/add.php");
  $(".modal-header").css("background-color","#446ad7");
  $(".modal-header").css("color","white");
  $("#modal_user").text("Nuevo usuario");
  $("#modal_new_edit").modal("show");
  $("#formulario #register").text("Registrar");
  $("#formulario #id").val('');
});

// Función de control de modal para edición de usuarios
function modal_edit(id){
	var dataString = 'id='+id;
	$.ajax({
		type: "POST",
		url: base_url+"admin/users/search_ajax.php",
		data: dataString,
		success: function(data) {
			// Convertir el JSON recibido a un objeto en javaScript
			data = JSON.parse(data);
			//~ console.log(data);
			//~ console.log(data.email);
			$("#formulario").trigger("reset");
			$("#formulario").attr("action", base_url+"admin/users/edit.php");
			$(".modal-header").css("background-color","#446ad7");
			$(".modal-header").css("color","white");
			$("#modal_user").text("Editar usuario");
			$("#modal_new_edit").modal("show");
			$("#formulario #register").text("Actualizar");
			// Carga de datos
			$("#formulario #id").val(data.id);
			$("#formulario #firstname").val(data.firstname);
			$("#formulario #lastname").val(data.lastname);
			$("#formulario #email").val(data.email);
		}
	}, 'json');
}

// Función para el registro/actualización de usuarios
$("#register").click(function(){
	var action = $("#formulario").attr("action");
	var dataForm = $('#formulario').serialize();
	var buttonText = $("#formulario #register").text();
	if($("#formulario #firstname").val() == "" || jQuery.isNumeric($("#formulario #firstname").val())){
		swal({title: buttonText, text: "El nombre está vacío o no es válido.", type: "warning"});
	}else if($("#formulario #lastname").val() == "" || jQuery.isNumeric($("#formulario #lastname").val())){
		swal({title: buttonText, text: "El apellido está vacío o no es válido.", type: "warning"});
	}else if($("#formulario #email").val() == "" || jQuery.isNumeric($("#formulario #email").val())){
		swal({title: buttonText, text: "El email está vacío o no es válido.", type: "warning"});
	}else if($("#formulario #password").val() == ""){
		swal({title: buttonText, text: "La contraseña está vacía o no es válida.", type: "warning"});
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

// Función de control de modal para eliminación de usuarios
function modal_delete(id){
	//~ if(confirm("La operación no se puede deshacer, ¿Está seguro de eliminar el usuario?")){
	swal({
		title: "La operación de eliminación no se puede deshacer.",
		text: "¿Está seguro de eliminar el usuario?",
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
				url: base_url+"admin/users/delete.php",
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
