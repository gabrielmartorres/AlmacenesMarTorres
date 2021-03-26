// Función autocompletar
function autocompletar() {
	var minimo_letras = 0; // minimo letras visibles en el autocompletar
	var palabra = $('#codigoCaja').val();
	//Contamos el valor del input mediante una condicional
	if (palabra.length >= minimo_letras) {
		$.ajax({
			url: '../../DAO/mostrarCajas.php',
			type: 'POST',
			data: {palabra:palabra},
			success:function(data){
				$('#lista_id').show();
				$('#lista_id').html(data);
			}
		});
	} else {
		//ocultamos la lista
		$('#lista_id').hide();
	}
}

function autocompletarDevolucion() {
	var minimo_letras = 0; // minimo letras visibles en el autocompletar
	var palabra = $('#codigoCaja').val();
	//Contamos el valor del input mediante una condicional
	if (palabra.length >= minimo_letras) {
		$.ajax({
			url: '../../DAO/mostrarCajasBackup.php',
			type: 'POST',
			data: {palabra:palabra},
			success:function(data){
				$('#lista_id').show();
				$('#lista_id').html(data);
			}
		});
	} else {
		//ocultamos la lista
		$('#lista_id').hide();
	}
}

// Funcion Mostrar valores
function set_item(opciones) {
	// Cambiar el valor del formulario input
	$('#codigoCaja').val(opciones);
	// ocultar lista de proposiciones
	$('#lista_id').hide();
}
