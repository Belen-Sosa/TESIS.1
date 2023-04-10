<?php

	  //llamo a la conexion de la base de datos 
      require_once("../config/conexion.php");
     //llamo al modelo Clientes
      require_once("../modelos/Clientes.php");

      //llamo al modelo Ventas
     require_once("../modelos/Ventas.php");
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
		
		$datos=$cuentaCorriente->get_cc_por_cliente($_POST["id_cliente"]);
		if(is_array($datos)==true and count($datos)>0){
			foreach($datos as $row)
			{
				$id_cc=$row["id_cuentas_corrientes"];
			
		  
			}


		}

		require_once('../modelos/Ventas.php');

	    $venta = new Ventas();

		$datos=$venta->get_venta_por_num_venta($_POST["numero_venta"]);
		if(is_array($datos)==true and count($datos)>0){
			foreach($datos as $row)
			{
				$id_ventas=$row["id_ventas"];
			    $total= $row["total"];
		  
			}


		}


	    $cuentaCorriente->registrar_detalle_cc($id_ventas,$id_cc,$total,$id_usuario,$_POST["id_cliente"]);
		
		



		     
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
	 
	 case "ver_detalle_cuenta_corriente":
		require_once("../modelos/Ventas.php");
		$ventas= new Ventas();

		$datos= $ventas-> get_ventas_cc_por_cliente($id_cliente);	
	 
				 // si existe el proveedor entonces recorre el array
			   if(is_array($datos)==true and count($datos)>0){
	 
					 foreach($datos as $row)
					 {
						 
						 $output["proveedor"] = $row["proveedor"];
						 $output["numero_compra"] = $row["numero_compra"];
						 $output["cuit_proveedor"] = $row["cuit_proveedor"];
						 $output["direccion"] = $row["direccion"];
						 $output["fecha_compra"] = date("d-m-Y", strtotime($row["fecha_compra"]));
										 
					 }
			 
				   
					   echo json_encode($output);
	 
	 
				 } else {
					  
					  //si no existe el registro entonces no recorre el array
					 $errors[]="no existe";
	 
				 }
	 
	 
				  //inicio de mensaje de error
	 
					 if (isset($errors)){
				 
						 ?>
						 <div class="alert alert-danger" role="alert">
							 <button type="button" class="close" data-dismiss="alert">&times;</button>
								 <strong>Error!</strong> 
								 <?php
									 foreach ($errors as $error) {
											 echo $error;
										 }
									 ?>
						 </div>
						 <?php
					   }
	 
				 //fin de mensaje de error	    
	 
	 
		   break;

  
     case "buscar_cuentas_corrientes":

		$datos=$cuentaCorriente->get_cuentas_corrientes();
   
		//Vamos a declarar un array
		 $data= Array();

		foreach($datos as $row)
			   {
				   $sub_array = array();
   
				  /* $est = '';
				   
					$atrib = "btn btn-danger btn-md estado";
				   if($row["estado"] == 1){
					   $est = 'PAGADO';
					   $atrib = "btn btn-success btn-md estado";
				   }
				   else{
					   if($row["estado"] == 0){
						   $est = 'ANULADO';
						   
					   }	
				   }
                   */
				   
   

					$sub_array[] = $row["nombre_cliente"];
					$sub_array[] = $row["apellido_cliente"];
					$sub_array[] = $row["dni_cliente"];
					$sub_array[] = $row["direccion_cliente"];
					$sub_array[] = $row["telefono_cliente"];
					$sub_array[] = $row["saldo"];
					$sub_array[] = '<button class="btn btn-warning detalle" id="'.$row["id_cliente"].'"  data-toggle="modal" data-target="#detalle_venta_cc"><i class="fa fa-eye"></i></button>';
                 

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

			$datos= $cuentaCorriente->get_detalle_ventas_cc_cliente($_POST["id_cliente"]);	
   
   
		  break;


		

      case "activarydesactivar":
     
     //los parametros id_cliente y est vienen por via ajax
     $datos=$clientes->get_cliente_por_id($_POST["id_cliente"]);

          // si existe el id del cliente entonces recorre el array
	      if(is_array($datos)==true and count($datos)>0){

              //edita el estado del cliente
		      $clientes->editar_estado($_POST["id_cliente"],$_POST["est"]);
		     
	        } 

     break;

    



	 	
	 }
  


   ?>