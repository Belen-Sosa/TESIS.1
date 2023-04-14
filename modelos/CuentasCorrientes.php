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

   	   	

              $sql="select c.id_cliente,c.nombre_cliente,c.apellido_cliente,c.dni_cliente,c.direccion_cliente,c.telefono_cliente,cc.saldo from cuentas_corrientes cc, clientes c where c.id_cliente=cc.id_cliente";

   	   	  $sql=$conectar->prepare($sql);
   	   	  $sql->execute();
           
   	   	  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
   	   }
         
       #metodo para saber el total de cc por cliente
        public function ver_total_cc_cliente($id_cliente){

          $conectar=parent::conexion();
          parent::set_names();

        

            $sql="select saldo from cuentas_corrientes  where id_cliente=?";

          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $id_cliente);
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

         public function registrar_detalle_cc($id_venta,$id_cc,$total,$id_usuario,$id_cliente){


            $conectar= parent::conexion();
            parent::set_names();
 
            $sql="insert into detalle_cuentas_corrientes
            values(null,?,?,now(),?,?,?)";
 
           
             $sql=$conectar->prepare($sql);
 
             $sql->bindValue(1, $id_cc);
             $sql->bindValue(2, $id_venta);
             $sql->bindValue(3, $total);
             $sql->bindValue(4, $id_cliente);
             $sql->bindValue(5, $id_usuario);
             $sql->execute();
       
            


             $sql= "select saldo from cuentas_corrientes where id_cuentas_corrientes=?";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $id_cc);
             $sql->execute();
             $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
           

             foreach($resultado as $row)
             {
                $saldo_actual= $row["saldo"];
             }         
        


             $saldo_final= $saldo_actual+$total;

             $sql2 = "update cuentas_corrientes set 
                     
              saldo=?
              where 
              id_cuentas_corrientes=?
              ";


              $sql2 = $conectar->prepare($sql2);
              $sql2->bindValue(1,$saldo_final);
              $sql2->bindValue(2,$id_cc);
              $sql2->execute(); 

            

       
          
         }


         //método para mostrar los datos en detalles cuenta corriente por cliente
        public function get_cc_por_cliente($id_cliente){

            
            $conectar= parent::conexion();
            parent::set_names();

            $sql="select dc.id_ventas,v.numero_venta,v.fecha_venta,v.total from detalle_cuentas_corrientes as dc,ventas as v where v.id_cliente=? and v.id_ventas=dc.id_ventas";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_cliente);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
     

        //metodo para tomar la id_cc de una cuenta corriente 
        public function get_idcc_por_cliente($id_cliente){

            
         $conectar= parent::conexion();
         parent::set_names();

         $sql="select * from cuentas_corrientes where id_cliente=?";
         $sql=$conectar->prepare($sql);

         $sql->bindValue(1, $id_cliente);
         $sql->execute();
         return $resultado=$sql->fetchAll();
     }

     


         
       

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
        public function get_detalle_ventas_cc_cliente($id_cliente){

         $conectar=parent::conexion();

         $sql= "select * from detalle_cuentas_corrientes where id_cliente=?";

         $sql=$conectar->prepare($sql);

     
         $sql->bindValue(1, $id_cliente);
         $sql->execute();

         //print_r($email); exit();

         return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
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
        
       
        
       /*     public function eliminar_cliente($id_cliente){

                $conectar=parent::conexion();

                $sql="delete from clientes where id_cliente=?";

                $sql=$conectar->prepare($sql);

                $sql->bindValue(1, $id_cliente);
                $sql->execute();

                return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
        }

*/
     /*    public function get_cliente_por_id_usuario($id_usuario){

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