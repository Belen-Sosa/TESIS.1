var tabla;
var id_cliente= getParameterByName('id_cliente');
console.log("id:"+id_cliente);
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
function listar_detalle_cc()
{  
	 
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


	  //VER DETALLE CLIENTE-VENTA
	  $(document).on('click', '.detalle', function(){
		//toma el valor del id
	   var numero_venta = $(this).attr("id");

	   $.ajax({
		   url:"../ajax/ventas.php?op=ver_detalle_cliente_venta",
		   method:"POST",
		   data:{numero_venta:numero_venta},
		   cache:false,
		   dataType:"json",
		   success:function(data)
		   {
			   
			   $("#cliente").html(data.cliente);
			   $("#numero_venta").html(data.numero_venta);
			   $("#dni_cliente").html(data.dni_cliente);
			   $("#direccion").html(data.direccion);
			   $("#fecha_venta").html(data.fecha_venta);
			
				//puse el alert para ver el error, sin necesidad de hacer echo en la consulta ni nada
			   //alert(data);
			   
		   }
	   })
   });

	 //VER DETALLE VENTA
	$(document).on('click', '.detalle', function(){
		//toma el valor del id
	   var numero_venta = $(this).attr("id");

	   $.ajax({
		   url:"../ajax/ventas.php?op=ver_detalle_venta",
		   method:"POST",
		   data:{numero_venta:numero_venta},
		   cache:false,
		   //dataType:"json",
		   success:function(data)
		   {
			   
			   $("#detalles").html(data);
				
				//puse el alert para ver el error, sin necesidad de hacer echo en la consulta ni nada
			   //alert(data);
			   
		   }
	   })
   });
   function listar_detalle_cc(){
	$.ajax({
		url:"../ajax/cuenta_corriente.php?op=ver_total_cc_cliente",
		method:"POST",
		data:{id_cliente:id_cliente},
		cache:false,
		//dataType:"json",
		success:function(dato)
		{
			
			$('#total_compra').html(dato);
			 
			 //puse el alert para ver el error, sin necesidad de hacer echo en la consulta ni nada
			//alert(data);
			
		}
	})
 
   }
  

listar_detalle_cc();