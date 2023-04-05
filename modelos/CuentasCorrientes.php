<?php

	   //conexión a la base de datos

	   require_once("../config/conexion.php");

	   class CuentaCorriente extends Conectar{


      public function get_filas_ventas_cc(){

             $conectar= parent::conexion();
           
             $sql="select * from ventas where tipo_pago='CUENTA CORRIENTE'";
             
             $sql=$conectar->prepare($sql);

             $sql->execute();

             $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

             return $sql->rowCount();
        
        }
      //toma todas las ventas del cliente hechas en cc
        public function get_filas_ventas_cc_cliente($dni_cliente){

         $conectar=parent::conexion();
         parent::set_names();

        $sql="select v.fecha_venta,v.numero_venta, v.cliente, v.dni_cliente,v.total,v.tipo_pago,c.id_cliente,c.dni_cliente,c.nombre_cliente, c.apellido_cliente,c.telefono_cliente,c.direccion_cliente,c.fecha_alta,c.estado
        from ventas as v, clientes as c
        where 
        v.dni_cliente=?
        and
        v.dni_cliente=c.dni_cliente
        and
        v.tipo_pago='CUENTA CORRIENTE'
        
        
        ;";

        //echo $sql; exit();

        $sql=$conectar->prepare($sql);
            

            $sql->bindValue(1,$id_cliente);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

    }

           
       //método para seleccionar registros

   	   public function get_cuentas_corrientes(){

   	   	  $conectar=parent::conexion();
   	   	  parent::set_names();

   	   	

              $sql="select c.id_cliente,c.nombre_cliente,c.apellido_cliente,cc.saldo from cuentas_corrientes cc, clientes c where c.id_cliente=cc.id_cliente";

   	   	  $sql=$conectar->prepare($sql);
   	   	  $sql->execute();

   	   	  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
   	   }


   	     //método para crear cuenta corriente

        public function crear_cuenta_corriente($dni_cliente){

 
         $conectar=parent::conexion();
         parent::set_names();
          	 
				//el cliente se registra con un saldo de 0 pesos en la cuenta corriente
           $saldo=0;

           $sql="insert into cuentas_corrientes
           values(null,?,?)";

          
            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $dni_cliente);
            $sql->bindValue(2, $saldo);
            $sql->execute();
      
         
        }
         //método para crear detalle de cuenta corriente

         public function registrar_detalle_cc($id_venta,$id_cc,$total){

              $numero_venta = $_POST["numero_venta"];
              $dni_cliente = $_POST["dni"];
              $tipo_pago = $_POST["tipo_pago"];
              $id_usuario = $_POST["id_usuario"];
              $id_cliente = $_POST["id_cliente"];
        


            $conectar= parent::conexion();
            parent::set_names();
 
            $sql="insert into detalle_cuentas_corrientes
            values(null,?,?,now(),?,?,?);";
 
           
             $sql=$conectar->prepare($sql);
 
             $sql->bindValue(1, $id_cc);
             $sql->bindValue(2, $id_venta);
             $sql->bindValue(3, $total);
             $sql->bindValue(4, $id_cliente);
             $sql->bindValue(5, $id_usuario);
             $sql->execute();
       
       
          
         }


         //método para mostrar los datos de un registro a modificar
        public function get_cc_por_cliente($dni_cliente){

            
            $conectar= parent::conexion();
            parent::set_names();

            $sql="select * from cuentas_corrientes where dni_cliente=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $dni_cliente);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

      
     


         //este metodo es para validar el id del cliente(luego llamamos el metodo de editar_estado()) 
        //el id_cliente se envia por ajax cuando se editar el boton cambiar estado y que se ejecuta el evento onclick y llama la funcion de javascript
       /* public function get_cliente_por_id($id_cliente){

          $conectar= parent::conexion();

          //$output = array();

          $sql="select * from clientes where id_cliente=?";

                $sql=$conectar->prepare($sql);

                $sql->bindValue(1, $id_cliente);
                $sql->execute();

                return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


        } */

         //método para editar saldo de cc
       
        public function editar_saldo_cuenta_corriente($dni_cliente,$saldo_actualizado){

        	$conectar=parent::conexion();
        	parent::set_names();

         $sql="update cuentas_corrientes set 

            saldo=?,
            
            where 
            dni_cliente=?

         ";
            

         $sql=$conectar->prepare($sql);

         $sql->bindValue(1, $saldo_actualizado);
         $sql->bindValue(2, $dni_cliente);
         $sql->execute();

        }



        /*metodo que valida si hay registros activos*/
     /*   public function get_cliente_por_id_estado($id_cliente,$estado){

         $conectar= parent::conexion();

         //declaramos que el estado esté activo, igual a 1

         $estado=1;

          
        $sql="select * from clientes where id_cliente=? and estado=?";

              $sql=$conectar->prepare($sql);

              $sql->bindValue(1, $id_cliente);
               $sql->bindValue(2, $estado);
              $sql->execute();

              return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


         }
      */


          //método para activar Y/0 desactivar el estado del cliente

      /*  public function editar_estado($id_cliente,$estado){

        	 $conectar=parent::conexion();

        	 //si el estado es igual a 0 entonces el estado cambia a 1
        	 //el parametro est se envia por via ajax
        	 if($_POST["est"]=="0"){

        	   $estado=1;

        	 } else {

        	 	 $estado=0;
        	 }

        	 $sql="update clientes set 
              
              estado=?
              where 
              id_cliente=?

        	 ";

        	 $sql=$conectar->prepare($sql);

        	 $sql->bindValue(1,$estado);
        	 $sql->bindValue(2,$id_cliente);
        	 $sql->execute();
        }
*/
         //método si el cliente existe en la base de datos
        //valida si existe la dni, cliente , si existe entonces se hace el registro del cliente
        /*public function get_datos_cliente($dni,$cliente){

           $conectar=parent::conexion();

           $sql= "select * from clientes where dni_cliente=? or nombre_cliente=? ";

	        $sql=$conectar->prepare($sql);

	        $sql->bindValue(1, $dni);
	        $sql->bindValue(2, $cliente);
	        $sql->execute();

           //print_r($email); exit();

           return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        
         public function eliminar_cliente($id_cliente){

                $conectar=parent::conexion();

                $sql="delete from clientes where id_cliente=?";

                $sql=$conectar->prepare($sql);

                $sql->bindValue(1, $id_cliente);
                $sql->execute();

                return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
        }

*/
  /*       public function get_cliente_por_id_usuario($id_usuario){

           $conectar= parent::conexion();

 
           $sql="select * from clientes where id_usuario=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_usuario);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


      }*/


         //consulta si la dni del cliente con tiene un detalle_venta asociado
    /* public function get_cliente_por_dni_ventas($dni_cliente){

             
             $conectar=parent::conexion();
             parent::set_names();


             $sql="select c.dni_cliente,v.dni_cliente
                 
              from clientes c 
              
              INNER JOIN ventas v ON c.dni_cliente=v.dni_cliente


              where c.dni_cliente=?

              ";

             $sql=$conectar->prepare($sql);
             $sql->bindValue(1,$dni_cliente);
             $sql->execute();

             return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

        }*/



        //consulta si la cuenta corriente tiene registros 
       
        public function get_registros_por_cc($dni_cliente){

                 
             $conectar=parent::conexion();
             parent::set_names();


             $sql="select *
             from detalle_cuentas_corrientes d 
             
             INNER JOIN cuentas_corrientes c ON c.dni_cliente=d.dni_cliente


             where c.dni_cliente=?
              ";

             $sql=$conectar->prepare($sql);
             $sql->bindValue(1,$dni_cliente);
             $sql->execute();

             return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
      
       }


  }


   ?>