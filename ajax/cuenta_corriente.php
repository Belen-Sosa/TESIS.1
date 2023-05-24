<?php

	  //llamo a la conexion de la base de datos 
      require_once("../config/conexion.php");
     //llamo al modelo Clientes
      require_once("../modelos/Clientes.php");

      //llamo al modelo Ventas
     require_once("../modelos/Ventas.php");


	 $venta = new Ventas();
	 require_once("../modelos/CuentasCorrientes.php");
  
     $clientes = new Cliente();
        //llamo al modelo Ventas		

     $cuentaCorriente = new CuentaCorriente();


     //declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo
   
   //los valores vienen del atributo name de los campos del formulario
   /*el valor id_usuario y dni_cliente se carga en el campo hidden cuando se edita un registro*/
   //se copian los campos de la tabla clientes
   $id_usuario=isset($_POST["id_usuario"]); 
   $dni_cliente=isset($_POST["dni_cliente"]);
   $dni = isset($_POST["dni"]);
   $nombre=isset($_POST["nombre"]);
   $apellido=isset($_POST["apellido"]);
   $telefono=isset($_POST["telefono"]);
   $correo=isset($_POST["email"]);
   $direccion=isset($_POST["direccion"]);
   $estado=isset($_POST["estado"]);


    switch($_GET["op"]){

         
	 case "registrar_detalle_cc";
	
	  
        //se llama al modelo Ventas.php


		$datos=$cuentaCorriente->get_idcc_por_cliente($_POST["id_cliente"]);
		if(is_array($datos)==true and count($datos)>0){
			foreach($datos as $row)
			{
				$id_cc=$row["id_cuentas_corrientes"];
			
		  
			}


		}

		

		$datos=$venta->get_venta_por_num_venta($_POST["numero_venta"]);
		if(is_array($datos)==true and count($datos)>0){
			foreach($datos as $row)
			{
				$id_ventas=$row["id_ventas"];
			    $total= $row["total_venta"];
		  
			}


		}


	    $cuentaCorriente->registrar_detalle_cc($id_ventas,$id_cc,$total,$id_usuario,$_POST["id_cliente"],$_POST["estado"]);
		
		



		     
     //mensaje success
     if (isset($messages)){
				
		?>
		<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>¡Bien hecho!</strong>
				<?php
					foreach ($messages as $message) {
							echo $message;
						}
					?>
		</div>
		<?php
	}
//fin success


     break;
	 
	 

  
     case "buscar_cuentas_corrientes":

		$datos=$cuentaCorriente->get_cuentas_corrientes();
   
		//Vamos a declarar un array
		 $data= Array();

		foreach($datos as $row)
			   {
				   $sub_array = array();
   
						
					$est = '';
					
					$atrib = "btn btn-success btn-md estado";
					if($row["estado_cc"] == 0){
						$est = 'DESACTIVADA';
						$atrib = "btn btn-warning btn-md estado";
					}
					else{
						if($row["estado_cc"] == 1){
							$est = 'ACTIVADA';
							
						}	
					}
					
   

					$sub_array[] = $row["nombre_cliente"];
					$sub_array[] = $row["apellido_cliente"];
					$sub_array[] = $row["dni_cliente"];
					$sub_array[] = $row["direccion_cliente"];
					$sub_array[] = $row["telefono_cliente"];
					$sub_array[] = "$ ".$row["saldo_cc"];
					$sub_array[] = '<button type="button" onClick="cambiarEstado('.$row["id_cuentas_corrientes"].','.$row["estado_cc"].');" name="estado" id="'.$row["id_cuentas_corrientes"].'" class="'.$atrib.'">'.$est.'</button>';
					$sub_array[] = '<a href="consultar_cuenta_corriente_cliente.php?id_cliente='.$row["id_cliente"].'" class="btn btn-warning detalle" ><i class="fa fa-eye"></i> </a>';

					

				   $data[] = $sub_array;
			

				   
	
			   }
   
		 $results = array(
				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data);
			echo json_encode($results);
          
	
		break;




		case "ver_detalle_ventas_cc_cliente":
		$id_cliente=$_GET["id_cliente"];
		

	
		$datos=$cuentaCorriente->get_cc_por_cliente($id_cliente);
   
		//Vamos a declarar un array
		 $data= Array();

		foreach($datos as $row)
			   {
				   $sub_array = array();
					$sub_array[] = $row["fecha_venta"];
					$sub_array[] = $row["numero_venta"];
					
					$sub_array[] = "$ ".$row["total"];
					$sub_array[] = $row["estado_dc"];	

					$sub_array[] = '<button class="btn btn-warning detalle" id="'.$row["numero_venta"].'"  data-toggle="modal" data-target="#detalle_venta"><i class="fa fa-eye"></i></button>';
                 
				   $est = '';
				   
				   $atrib = "btn btn-danger btn-md estado";
				   if($row["estado_detalle_cc"] == "adeuda"){
					$est = 'PAGAR';
					  
				   }
				   else{
					   if($row["estado_detalle_cc"] == "pagado"){
						   $est = 'ANULAR PAGO';
						   $atrib = "btn btn-success btn-md estado";
						   
					   }	
				   }
                   
					
					
			   
					$sub_array[] = '<button type="button" onClick="cambiarEstado('.$row["id_detalle_cc"].','.$row["id_cuenta_corriente"].',\''.$row["estado_detalle_cc"].'\');" name="" id="'.$row["id_detalle_cc"].'" class="'.$atrib.'">'.$est.'</button>';
					$sub_array[] = $row["fecha_pago_detalle_cc"];
					$data[] = $sub_array;
			   }
   
		 $results = array(
				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data), //enviamos el total registros al datatable
				"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
				"aaData"=>$data);
			echo json_encode($results);
   
   
   
		  break;

		  #ver el total que adeuda la cc de un cliente
		  case "ver_total_cc_cliente":
		
  
			$datos= $cuentaCorriente->ver_total_cc_cliente($_POST["id_cliente"]);	

			
			
		  break;
		

    

    


		  case "activarydesactivar":
			
			
			$cuentaCorriente->editar_cuenta_corriente($_POST["id_cuentas_corrientes"],$_POST["est"]);
					
				
	   
		break;

		case "ver_estado":
			
			
		$datos=$cuentaCorriente->ver_estado($_GET["id_cliente"]);
		$output= array();
	    foreach($datos as $row)
			{
				$output["estado_cc"] = $row["estado_cc"];
				

				

				}
		echo json_encode($output);
		break;
	 	
	 	
	 
  
	 case "cambiar_estado_venta_dc":
		
		
	   
		$datos=$cuentaCorriente->get_detalle_cc_por_id($_POST["id_detalle_cc"]);

		// si existe el id de la detalle cc entonces se edita el estado 
		if(is_array($datos)==true and count($datos)>0){

				//cambia el estado de la venta en cc
				$cuentaCorriente->cambiar_estado($_POST["id_detalle_cc"],$_POST["id_cuenta_corriente"],$_POST["est"]);
	            
				

		    
		  } 


      break;
		}
   ?>