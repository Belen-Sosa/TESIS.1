var tabla;
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
function listar_detalle_cc()
{  
	 var id_cliente= getParameterByName('id_cliente');
     console.log("id:"+id_cliente);
	tabla=$('#cuenta_corriente_data').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
		"aServerSide": true,//Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip',//Definimos los elementos del control de tabla
		buttons: [		          
					'copyHtml5',
					'excelHtml5',
					'csvHtml5',
					'pdf'
				],
		"ajax":
				{
					url: '../ajax/cuenta_corriente.php?op=ver_detalle_ventas_cc_cliente&id_cliente='+id_cliente ,
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 10,//Por cada 10 registros hace una paginación
		"order": [[ 0, "desc" ]],//Ordenar (columna,orden)
		
		"language": {
 
				"sProcessing":     "Procesando...",
			 
				"sLengthMenu":     "Mostrar _MENU_ registros",
			 
				"sZeroRecords":    "No se encontraron resultados",
			 
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
			 
				"sInfo":           "Mostrando un total de _TOTAL_ registros",
			 
				"sInfoEmpty":      "Mostrando un total de 0 registros",
			 
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			 
				"sInfoPostFix":    "",
			 
				"sSearch":         "Buscar:",
			 
				"sUrl":            "",
			 
				"sInfoThousands":  ",",
			 
				"sLoadingRecords": "Cargando...",
			 
				"oPaginate": {
			 
					"sFirst":    "Primero",
			 
					"sLast":     "Último",
			 
					"sNext":     "Siguiente",
			 
					"sPrevious": "Anterior"
			 
				},
			 
				"oAria": {
			 
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			 
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			 
				}

			   }//cerrando language
		   
	}).DataTable();

	
}

listar_detalle_cc();