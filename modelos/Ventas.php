  
  <?php

require_once("../config/conexion.php");

 class Ventas extends Conectar{


     public function get_filas_venta(){

           $conectar= parent::conexion();
          
            $sql="select * from ventas";
            
            $sql=$conectar->prepare($sql);

            $sql->execute();

            $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

            return $sql->rowCount();
       
       }


    public function get_ventas(){

    $conectar= parent::conexion();
      
        $sql="select * from ventas";

        
        $sql=$conectar->prepare($sql);

        $sql->execute();

        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
   
   }

   public function get_detalle_cliente($numero_venta){

      $conectar=parent::conexion();
          parent::set_names();

         $sql="select v.fecha_venta,v.numero_venta, v.nombre_cliente, v.dni_cliente,v.total_venta,c.id_cliente,c.dni_cliente,c.nombre_cliente, c.apellido_cliente,c.telefono_cliente,c.direccion_cliente,c.fecha_alta_cliente,c.estado_cliente
         from ventas as v, clientes as c
         where 
         
         v.dni_cliente=c.dni_cliente
         and
         v.numero_venta=?
         
         ;";


         $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$numero_venta);
         $sql->execute();
         return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

      
           
   }


   public function get_detalle_ventas_cliente($numero_venta){

      $conectar=parent::conexion();
          parent::set_names();

         $sql="select d.numero_venta,d.dni_cliente,d.nombre_producto,d.precio_venta_producto,d.cantidad_detalle_v,d.descuento_detalle_v,d.importe_detalle_v,d.fecha_detalle_v,v.numero_venta,v.total_venta,c.id_cliente,c.dni_cliente,c.nombre_cliente,c.apellido_cliente,c.telefono_cliente,c.direccion_cliente,c.fecha_alta_cliente,c.estado_cliente
         from detalle_ventas as d, ventas as v, clientes as c
         where 
         
         d.numero_venta = v.numero_venta
         and 
         d.dni_cliente = c.dni_cliente
         and
         d.numero_venta=? ;";

         $sql=$conectar->prepare($sql);
             

             $sql->bindValue(1,$numero_venta);
         $sql->execute();
         $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

      
             $html= "

             <thead style='background-color:#A9D0F5'>

                                   <th>Cantidad</th>
                                   <th>Producto</th>
                                   <th>Precio Venta</th>
                                   <th>Descuento (%)</th>
                                   <th>Importe</th>
                                  
                               </thead>


                             ";

          
           
             foreach($resultado as $row)
       {

        
 $html.="<tr class='filas'><td>".$row['cantidad_detalle_v']."</td><td>".$row['nombre_producto']."</td> <td>$ ".$row['precio_venta_producto']."</td> <td>".$row['descuento_detalle_v']."</td> <td>$" .$row['importe_detalle_v']."</td></tr>";
              
                  $total=  "$".$row["total_venta"];
                  
       }
   

    $html .= "<tfoot>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                  

                                   <th>

                          

                                    <p><strong>".$total."</strong></p>

                                   </th> 
                               </tfoot>";
     
     echo $html;

   }

    public function numero_venta(){

       $conectar=parent::conexion();
       parent::set_names();

    
       $sql="select numero_venta from detalle_ventas;";

       $sql=$conectar->prepare($sql);

       $sql->execute();
       $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

          //aqui selecciono solo un campo del array y lo recorro que es el campo numero_venta
          foreach($resultado as $k=>$v){

                    $numero_venta["numero"]=$v["numero_venta"];

                  
             
                }
             //luego despues de tener seleccionado el numero_venta digo que si el campo numero_venta està vacio entonces se le asigna un F000001 de lo contrario ira sumando

           

                      if(empty($numero_venta["numero"]))
                   {
                     echo 'F000001';
                   }else
             
                     {
                       $num     = substr($numero_venta["numero"] , 1);
                       $dig     = $num + 1;
                       $fact = str_pad($dig, 6, "0", STR_PAD_LEFT);
                       echo 'F'.$fact;
                       //echo 'F'.$new_cod;
                     } 

          //return $data;
     }



     public function agrega_detalle_venta(){

      
 //echo json_encode($_POST['arrayCompra']);
 $str = '';
 $detalles = array();
 $detalles = json_decode($_POST['arrayVenta']);

 

 /*IMPORTANTE:Esas variables NO las puedes usar fuera del foreach
Por que se crean dentro. con cada producto para el INSERT, 

hay dos formas de hacer esto:
1,. Es la más fácil, que es dentro del bucle 
2..- La más difícil, que es fuera del bucle
Cuando es dentro, lo que vas a hacer es un insert por cada producto
Imagina que son 10 productos los que seleccionaste, entonces dentro del bucle , tendrías 1 insert por esos 10, es decir en total harías 10 inserts
Por que le envías producto por producto
En cambio cuando es fuera del bucle, haces 1 solo insert pero le envías TODO los 10 productos.

-con las variables del proveedor no hay problema, las puedes usar directo
Si no estan en el arreglo, las puedes usar directo, se haria $proveedor = $_POST["debe ir el nombre que le has asignado en el ajax"], Y luego en la consulta INSERT pones la variable que has creado $proveedor 

- cuando armo un insert lo hago en el mismo orden que he creado las columnas de la tabla de la bd


- en esas variables ($cantidad, $codProd, $producto etc) ya están la información de cada producto seleccionado en el formulario


*/
  
  $conectar=parent::conexion();


 foreach ($detalles as $k => $v) {

   //IMPORTANTE:estas variables son del array detalles
   $cantidad = $v->cantidad;
   $codProd = $v->codProd;
   $producto = $v->producto;
   $precio = $v->precio; 
   $dscto = $v->dscto;
   $importe = $v->importe;
   $estado = $v->estado;

      $numero_venta = $_POST["numero_venta"];
      $dni_cliente = $_POST["dni"];
      $cliente_nombre = $_POST["nombre"];
      $cliente_apellido = $_POST["apellido"];
      $direccion = $_POST["direccion"];
      $total = $_POST["total"];
      $vendedor = $_POST["vendedor"];
      $tipo_pago = $_POST["tipo_pago"];
         $id_usuario = $_POST["id_usuario"];
         $id_cliente = $_POST["id_cliente"];
      
      /*IMPORTANTE: no me imprimia porque tenia estas variables que no usaba*/
 
   //modificamos estado si el metodo de pago es cc
   if($tipo_pago=="CUENTA CORRIENTE"){
    $estado= 2;

   }    

       $sql="insert into detalle_ventas
       values(null,?,?,?,?,?,?,?,?,now(),?,?,?);";


       $sql=$conectar->prepare($sql);

       //echo $sql;

       /*importante:se ingresó el id_producto=$codProd ya que se necesita para relacionar las tablas compras con detalle_compras para cuando se vaya a hacer la consulta de la existencia del producto y del stock para cuando se elimine un detalle compra y se reintegre la cantidad de producto*/

       $sql->bindValue(1,$numero_venta);
       $sql->bindValue(2,$dni_cliente);
       $sql->bindValue(3,$codProd);
       $sql->bindValue(4,$producto);
       $sql->bindValue(5,$precio);
       $sql->bindValue(6,$cantidad);
       $sql->bindValue(7,$dscto);
       $sql->bindValue(8,$importe);
       $sql->bindValue(9,$id_usuario);
       $sql->bindValue(10,$id_cliente);
       $sql->bindValue(11,$estado);
       $sql->execute();
     
        //Esta linea "$resultado=$sql->fetch(PDO::ASSOC);" se utliza cuando la consulta devuelva algún valor(osea si quieres imprimir un campo de la tabla de la bd) Pero la sentencia insert no deuelve nada
       // Y esperar que devuelva despues del insert es un error en el codigo por eso es que solo ejecuta 1 producto y no el resto, por lo tanto se comenta dicha linea  */

      
         //si existe el producto entonces actualiza la cantidad, en caso contrario no lo inserta


            $sql3="select * from producto where id_producto=?;";

            $sql3=$conectar->prepare($sql3);

            $sql3->bindValue(1,$codProd);
            $sql3->execute();

            $resultado = $sql3->fetchAll(PDO::FETCH_ASSOC);

                 foreach($resultado as $b=>$row){

                   $re["existencia"] = $row["stock_producto"];

                 }

               //la cantidad total es la resta del stock menos la cantidad de productos vendido
               $cantidad_total = $row["stock_producto"] - $cantidad;

            
              //si existe el producto entonces actualiza el stock en producto
             
              if(is_array($resultado)==true and count($resultado)>0) {
                    
                 //actualiza el stock en la tabla producto

                 $sql4 = "update producto set 
                     
                     stock_producto=?
                     where 
                     id_producto=?
                 ";


                $sql4 = $conectar->prepare($sql4);
                $sql4->bindValue(1,$cantidad_total);
                $sql4->bindValue(2,$codProd);
                $sql4->execute();

              } //cierre la condicional


      }//cierre del foreach

      /*IMPORTANTE: hice el procedimiento de imprimir la consulta y me di cuenta a traves del mensaje alerta que la variable total no estaba definida y tube que agregarla en el arreglo y funcionó*/


      //SUMO EL TOTAL DE IMPORTE SEGUN EL CODIGO DE DETALLES DE VENTA

        $sql5="select sum(importe_detalle_v) as total from detalle_ventas where numero_venta=?";
     
        $sql5=$conectar->prepare($sql5);

        $sql5->bindValue(1,$numero_venta);

        $sql5->execute();

        $resultado2 = $sql5->fetchAll();

            foreach($resultado2 as $c=>$d){

               $row["total"]=$d["total"];
              
            }

            $subtotal=$d["total"];

         
        $total= $subtotal;
       //IMPORTANTE: hay que sacar la consulta INSERT INTO VENTAS fuera del foreach sino se repetiria el registro en la tabla ventas
       
       

          $sql2="insert into ventas 
          values(null,now(),?,?,?,?,?,?,?,?,?);";


          $sql2=$conectar->prepare($sql2);
          
         
          $sql2->bindValue(1,$numero_venta);
          $sql2->bindValue(2,$cliente_nombre);
          $sql2->bindValue(3,$dni_cliente);
          $sql2->bindValue(4,$vendedor);
          $sql2->bindValue(5,$total);
          $sql2->bindValue(6,$tipo_pago);
          $sql2->bindValue(7,$estado);
          $sql2->bindValue(8,$id_usuario);
          $sql2->bindValue(9,$id_cliente);
          $sql2->execute();

         
          

     }


     public function get_ventas_por_id($id_ventas){

    $conectar= parent::conexion();

    $id_ventas=$_POST["id_ventas"];
      
        $sql="select * from ventas where id_ventas=?";
        
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_ventas);
        $sql->execute();

        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

   
   }
   

     /*cambiar estado de la venta, solo se cambia si se quiere eliminar una venta y se revertería la cantidad de venta al stock*/

   public function cambiar_estado(){

     $conectar=parent::conexion();
     parent::set_names();
           //estado 1= pagado, 2=pendiente,0=cancelado
           //si estado es igual a 0 entonces lo cambia a 1
     $estado = 0;
     //el parametro est se envia por via ajax, viene del $est:est
   
     $numero_venta=$_POST["numero_venta"];
     $id_ventas=$_POST["id_ventas"];
     $est=$_POST["est"];


     //si la venta es a cuenta corriente no puede cambiar a pagado desde la seccion de ventas, debe ir a cuentas corrientes.
     $sql="select tipo_pago_venta from ventas where id_ventas=? ";
     $sql=$conectar->prepare($sql);
     $sql->bindValue(1,$id_ventas);
     $sql->execute();
     $datos= $sql->fetch(PDO::FETCH_ASSOC);

     foreach($datos as $row)
     {
        $tipo_pago= $row;
     } 

     
    
     if($_POST["est"] == 0 and $tipo_pago!="CUENTA CORRIENTE"){
       $estado = 1;

       
    




     $sql="update ventas set 
           
           estado_venta=?
           where 
           id_ventas=?
          
             ";

           // echo $sql; 

           $sql=$conectar->prepare($sql);

           $sql->bindValue(1,$estado);
           $sql->bindValue(2,$id_ventas);
           $sql->execute();

           $resultado= $sql->fetch(PDO::FETCH_ASSOC);


     $sql_detalle= "update detalle_ventas set

         estado_venta=?
         where 
         numero_venta=?
         ";

           $sql_detalle=$conectar->prepare($sql_detalle);

           $sql_detalle->bindValue(1,$estado);
           $sql_detalle->bindValue(2,$numero_venta);
           $sql_detalle->execute();

           $resultado= $sql_detalle->fetch(PDO::FETCH_ASSOC);



           /*una vez se cambie de estado a ACTIVO entonces actualizamos la cantidad de stock en productos*/


           //INICIO CONSULTA EN DETALLE DE VENTAS Y VENTAS

         $sql2="select * from detalle_ventas where numero_venta=?";

         $sql2=$conectar->prepare($sql2);

        
           $sql2->bindValue(1,$numero_venta);
           $sql2->execute();

           $resultado=$sql2->fetchAll();

             foreach($resultado as $row){

                $id_producto=$output["id_producto"]=$row["id_producto"];
               //selecciona la cantidad vendida
               $cantidad_venta=$output["cantidad_venta"]=$row["cantidad_venta"];



               
                //si el id_producto existe entonces que consulte si la cantidad de productos existe en la tabla producto

                 if(isset($id_producto)==true /*and count($id_producto)>0*/){
                     
                     $sql3="select * from producto where id_producto=?";

                     $sql3=$conectar->prepare($sql3);

                     $sql3->bindValue(1, $id_producto);
                     $sql3->execute();

                     $resultado=$sql3->fetchAll();

                        foreach($resultado as $row2){
                          
                          //este es la cantidad de stock para cada producto
                          $stock=$output2["stock"]=$row2["stock_producto"];
                          
                          //esta debe estar dentro del foreach para que recorra el $stock de los productos, ya que es mas de un producto que está asociado a la venta
                          //cuando das click a estado pasa a PAGADO Y RESTA la cantidad de stock con la cantidad de venta
                          $cantidad_actual= $stock - $cantidad_venta;

                        }
                 }

              
               //LE ACTUALIZO LA CANTIDAD DEL PRODUCTO 

              $sql6="update producto set 
              stock_producto=?
              where

              id_producto=?

              ";
              
              $sql6=$conectar->prepare($sql6);   
              
              $sql6->bindValue(1,$cantidad_actual);
              $sql6->bindValue(2,$id_producto);

              $sql6->execute();


             }//cierre del foreach

         }//cierre del if del estado

         

          //si el estado es igual a 1(pagado) y tipo de pago es diferente de cc entonces pasa a 0(anulado)
          if($_POST["est"] == 1 and $tipo_pago!="CUENTA CORRIENTE"){
               $estado = 0;

                  $sql="update ventas set 
                        
                        estado_venta=?
                        where 
                        id_ventas=?
                        
                          ";

                        // echo $sql; 

                        $sql=$conectar->prepare($sql);

                        $sql->bindValue(1,$estado);
                        $sql->bindValue(2,$id_ventas);
                        $sql->execute();

                        $resultado= $sql->fetch(PDO::FETCH_ASSOC);


                      $sql_detalle= "update detalle_ventas set

                      estado_venta=?
                      where 
                      numero_venta=?
                      ";

                        $sql_detalle=$conectar->prepare($sql_detalle);

                        $sql_detalle->bindValue(1,$estado);
                        $sql_detalle->bindValue(2,$numero_venta);
                        $sql_detalle->execute();

                        $resultado= $sql_detalle->fetch(PDO::FETCH_ASSOC);



                        /*una vez se cambie de estado a ACTIVO entonces revertimos la cantidad de stock en productos*/


                        //INICIO REVERTIR LA CANTIDAD DE PRODUCTOS VENDIDOS EN EL STOCK

                      $sql2="select * from detalle_ventas where numero_venta=?";

                      $sql2=$conectar->prepare($sql2);

                      
                        $sql2->bindValue(1,$numero_venta);
                        $sql2->execute();

                        $resultado=$sql2->fetchAll();

             foreach($resultado as $row){

                              $id_producto=$output["id_producto"]=$row["id_producto"];
                            //selecciona la cantidad vendida
                            $cantidad_venta=$output["cantidad_venta"]=$row["cantidad_venta"];



                            
                              //si el id_producto existe entonces que consulte si la cantidad de productos existe en la tabla producto

                              if(isset($id_producto)==true /*and count($id_producto)>0*/){
                                  
                                  $sql3="select * from producto where id_producto=?";

                                  $sql3=$conectar->prepare($sql3);

                                  $sql3->bindValue(1, $id_producto);
                                  $sql3->execute();

                                  $resultado=$sql3->fetchAll();

                                      foreach($resultado as $row2){
                                        
                                        //este es la cantidad de stock para cada producto
                                        $stock=$output2["stock"]=$row2["stock_producto"];
                                        
                                        //esta debe estar dentro del foreach para que recorra el $stock de los productos, ya que es mas de un producto que está asociado a la venta
                                  //cuando le da click al estado pasa de PAGADO A ANULADO y SUMA la cantidad de stock en productos con la cantidad de venta de detalle_ventas, aumentando de esta manera la cantidad actual de productos en el stock de productos
                                        $cantidad_actual= $stock + $cantidad_venta;

                                      }
                              }

                            
                            //LE ACTUALIZO LA CANTIDAD DEL PRODUCTO 

                            $sql6="update producto set 
                            stock_producto=?
                            where

                            id_producto=?

                            ";
                            
                            $sql6=$conectar->prepare($sql6);   
                            
                            $sql6->bindValue(1,$cantidad_actual);
                            $sql6->bindValue(2,$id_producto);

                            $sql6->execute();

                          

             }//cierre del foreach

            
         }
          //si el estado es igual a 1(pagado) y tipo de pago es  cc entonces pasa a 2(pendiente)
          if($_POST["est"] == 1 and $tipo_pago=="CUENTA CORRIENTE"){
            $estado = 2;

               $sql="update ventas set 
                     
                     estado_venta=?
                     where 
                     id_ventas=?
                     
                       "; 

                     $sql=$conectar->prepare($sql);

                     $sql->bindValue(1,$estado);
                     $sql->bindValue(2,$id_ventas);
                     $sql->execute();

                     $resultado= $sql->fetch(PDO::FETCH_ASSOC);


                   $sql_detalle= "update detalle_ventas set

                   estado_detalle_v=?
                   where 
                   numero_venta=?
                   ";

                     $sql_detalle=$conectar->prepare($sql_detalle);

                     $sql_detalle->bindValue(1,$estado);
                     $sql_detalle->bindValue(2,$numero_venta);
                     $sql_detalle->execute();

                     $resultado= $sql_detalle->fetch(PDO::FETCH_ASSOC);



                     /*una vez se cambie de estado a ACTIVO entonces revertimos la cantidad de stock en productos*/


                     //INICIO REVERTIR LA CANTIDAD DE PRODUCTOS VENDIDOS EN EL STOCK

                   $sql2="select * from detalle_ventas where numero_venta=?";

                   $sql2=$conectar->prepare($sql2);

                   
                     $sql2->bindValue(1,$numero_venta);
                     $sql2->execute();

                     $resultado=$sql2->fetchAll();

          foreach($resultado as $row){

                           $id_producto=$output["id_producto"]=$row["id_producto"];
                         //selecciona la cantidad vendida
                         $cantidad_venta=$output["cantidad_venta"]=$row["cantidad_venta"];



                         
                           //si el id_producto existe entonces que consulte si la cantidad de productos existe en la tabla producto

                           if(isset($id_producto)==true /*and count($id_producto)>0*/){
                               
                               $sql3="select * from producto where id_producto=?";

                               $sql3=$conectar->prepare($sql3);

                               $sql3->bindValue(1, $id_producto);
                               $sql3->execute();

                               $resultado=$sql3->fetchAll();

                                   foreach($resultado as $row2){
                                     
                                     //este es la cantidad de stock para cada producto
                                     $stock=$output2["stock"]=$row2["stock_´producto"];
                                     
                                     //esta debe estar dentro del foreach para que recorra el $stock de los productos, ya que es mas de un producto que está asociado a la venta
                               //cuando le da click al estado pasa de PAGADO A ANULADO y SUMA la cantidad de stock en productos con la cantidad de venta de detalle_ventas, aumentando de esta manera la cantidad actual de productos en el stock de productos
                                     $cantidad_actual= $stock + $cantidad_venta;

                                   }
                           }

                         
                         //LE ACTUALIZO LA CANTIDAD DEL PRODUCTO 

                         $sql6="update producto set 
                         stock_producto=?
                         where

                         id_producto=?

                         ";
                         
                         $sql6=$conectar->prepare($sql6);   
                         
                         $sql6->bindValue(1,$cantidad_actual);
                         $sql6->bindValue(2,$id_producto);

                         $sql6->execute();

                       

          }//cierre del foreach

          //borramos la fecha de pago de la deuda en cc

          $sqlcc="update detalle_cuentas_corrientes set 
       
          estado_detalle_cc=?,fecha_pago_detalle_cc=null
          where 
          id_ventas=?";
    
   
          $sqlcc=$conectar->prepare($sqlcc);
   
          $sqlcc->bindValue(1,"adeuda");
          $sqlcc->bindValue(2,$id_ventas);
          $sqlcc->execute();



          //CAMBIAMOS EL SALDO DE LA CUENTA CORRIENTE
          $sql="select id_cuenta_corriente,monto_detalle_cc 
          from detalle_cuentas_corrientes
          where id_ventas=?
          ";
   
          //tomo el valor de la id de la cuenta corriente y el monto
   
          $sql=$conectar->prepare($sql);
   
          $sql->bindValue(1,$id_ventas);
          $sql->execute();
          $resultado=$sql->fetchAll();

          foreach($resultado as $row){
            
            //este es la cantidad de stock para cada producto
            $saldo_venta=$row["monto_detalle_cc"];
            $id_cuenta_corriente=$row["id_cuenta_corriente"];

          }


           
            $sql="update cuentas_corrientes 
            set saldo_cc = saldo_cc + ?
            where id_cuentas_corrientes = ?";
            
     
          
     
            $sql=$conectar->prepare($sql);
     
            $sql->bindValue(1,$saldo_venta);
            $sql->bindValue(2,$id_cuenta_corriente);
            $sql->execute();
            $resultado=$sql->fetchAll();
  

         
      }

        if($est==2){
          $estado=0;
        
         
    
          $sql="update ventas set 
                
                estado_venta=?
                where 
                id_ventas=?";
     
                $sql=$conectar->prepare($sql);
     
                $sql->bindValue(1,$estado);
                $sql->bindValue(2,$id_ventas);
                $sql->execute();
     
     
     
     
          $sql_detalle= "update detalle_ventas set
     
              estado_detalle_v=?
              where 
              numero_venta=?
              ";
     
                $sql_detalle=$conectar->prepare($sql_detalle);
     
                $sql_detalle->bindValue(1,$estado);
                $sql_detalle->bindValue(2,$numero_venta);
                $sql_detalle->execute();
     
          $sqlcc="update detalle_cuentas_corrientes set 
          
          estado_detalle_cc=?
          where 
          id_ventas=?";

        
          $sqlcc=$conectar->prepare($sqlcc);

          $sqlcc->bindValue(1,"anulado");
          $sqlcc->bindValue(2,$id_ventas);
          $sqlcc->execute();
     
     
     
           //CAMBIAMOS EL SALDO DE LA CUENTA CORRIENTE
           $sql="select id_cuenta_corriente,monto_detalle_cc 
           from detalle_cuentas_corrientes
           where id_ventas=?
           ";
    
           //tomo el valor de la id de la cuenta corriente y el monto
    
           $sql=$conectar->prepare($sql);
    
           $sql->bindValue(1,$id_ventas);
           $sql->execute();
           $resultado=$sql->fetchAll();
 
           foreach($resultado as $row){
             
             //este es la cantidad de stock para cada producto
             $saldo_venta=$row["monto_detalle_cc"];
             $id_cuenta_corriente=$row["id_cuenta_corriente"];
 
           }
 
 
            
             $sql="update cuentas_corrientes 
             set saldo_cc = saldo_cc - ?
             where id_cuentas_corrientes = ?";
          
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1,$saldo_venta);
             $sql->bindValue(2,$id_cuenta_corriente);
             $sql->execute();
             $resultado=$sql->fetchAll();
     
                /*una vez se cambie de estado a PAGADO entonces revertimos la cantidad de stock en productos*/
     
         }

         if($est==0 and $tipo_pago=="CUENTA CORRIENTE"){
          $estado=2;
        
         
    
          $sql="update ventas set 
                
                estado_venta=?
                where 
                id_ventas=?";
     
                $sql=$conectar->prepare($sql);
                $sql->bindValue(1,$estado);
                $sql->bindValue(2,$id_ventas);
                $sql->execute();
     
     
     
     
          $sql_detalle= "update detalle_ventas set
     
              estado_detalle_v=?
              where 
              numero_venta=?
              ";
     
                $sql_detalle=$conectar->prepare($sql_detalle);
     
                $sql_detalle->bindValue(1,$estado);
                $sql_detalle->bindValue(2,$numero_venta);
                $sql_detalle->execute();
     
             
            $sqlcc="update detalle_cuentas_corrientes set 
      
            estado_detalle_cc=?,fecha_pago_detalle_cc=null
            where 
            id_ventas=?";
  
  
            $sqlcc=$conectar->prepare($sqlcc);
            $sqlcc->bindValue(1,"adeuda");
            $sqlcc->bindValue(2,$id_ventas);
            $sqlcc->execute();

           
            //CAMBIAMOS EL SALDO DE LA CUENTA CORRIENTE
          $sql="select id_cuenta_corriente,monto_detalle_cc
          from detalle_cuentas_corrientes
          where id_ventas=?
          ";
   
          //tomo el valor de la id de la cuenta corriente y el monto
   
          $sql=$conectar->prepare($sql);
   
          $sql->bindValue(1,$id_ventas);
          $sql->execute();
          $resultado=$sql->fetchAll();

          foreach($resultado as $row){
            
            //este es la cantidad de stock para cada producto
            $saldo_venta=$row["monto_detalle_cc"];
            $id_cuenta_corriente=$row["id_cuenta_corriente"];

          }


           
            $sql="update cuentas_corrientes 
            set saldo_cc = saldo_cc + ?
            where id_cuentas_corrientes = ?";
        
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$saldo_venta);
            $sql->bindValue(2,$id_cuenta_corriente);
            $sql->execute();
            $resultado=$sql->fetchAll();
            
     
     
             
         }
         if($est==0 and $tipo_pago!="CUENTA CORRIENTE"){
          $estado=1;
        
         
    
          $sql="update ventas set 
                
                estado_venta=?
                where 
                id_ventas=?";
              $sql=$conectar->prepare($sql);
     
                $sql->bindValue(1,$estado);
                $sql->bindValue(2,$id_ventas);
                $sql->execute();
     
     
     
     
          $sql_detalle= "update detalle_ventas set
     
              estado_detalle_v=?
              where 
              numero_venta=?
              ";
     
                $sql_detalle=$conectar->prepare($sql_detalle);
     
                $sql_detalle->bindValue(1,$estado);
                $sql_detalle->bindValue(2,$numero_venta);
                $sql_detalle->execute();
     
             
            $sqlcc="update detalle_cuentas_corrientes set 
      
            estado_detalle_cc=?,fecha_pago_detalle_cc=null
            where 
            id_ventas=?";
            $sqlcc=$conectar->prepare($sqlcc);
  
            $sqlcc->bindValue(1,"adeuda");
            $sqlcc->bindValue(2,$id_ventas);
            $sqlcc->execute();

           
      
            
     
     
             
         }
         
        
     
     
     
         
       
       

   }//CIERRE DEL METODO

   public function cambiar_estado_venta_cc($est,$id_ventas){
   
     $numero_venta=0;

     //estado 1 = pagado ,2=pendiente
    //tomando numero venta
    $conectar=parent::conexion();
    parent::set_names();
    $sql_detalle= "select numero_venta from ventas where id_ventas=?";

    $sql_detalle=$conectar->prepare($sql_detalle);
    $sql_detalle->bindValue(1,$id_ventas);
    $sql_detalle->execute();
    $dato= $sql_detalle->fetch(PDO::FETCH_ASSOC);

    foreach($dato as $row)
    {
      $numero_venta= $row;
    }

    if($est==2){
      $estado=1;
    
     

      $sql="update ventas set 
            
            estado_venta=?
            where 
            id_ventas=?";
 
            $sql=$conectar->prepare($sql);
 
            $sql->bindValue(1,$estado);
            $sql->bindValue(2,$id_ventas);
            $sql->execute();
 
 
 
 
      $sql_detalle= "update detalle_ventas set
 
          estado_detalle_venta=?
          where 
          numero_venta=?
          ";
 
            $sql_detalle=$conectar->prepare($sql_detalle);
 
            $sql_detalle->bindValue(1,$estado);
            $sql_detalle->bindValue(2,$numero_venta);
            $sql_detalle->execute();
 
         
 
 
 
            /*una vez se cambie de estado a PAGADO entonces revertimos la cantidad de stock en productos*/
 
     }
     if($est== 1){
      $estado=2;
     
     

      $sql="update ventas set 
            
            estado_venta=?
            where 
            id_ventas=?
           
              ";
 
 
            $sql=$conectar->prepare($sql);
 
            $sql->bindValue(1,$estado);
            $sql->bindValue(2,$id_ventas);
            $sql->execute();
 
 
 
      $sql_detalle= "update detalle_ventas set
 
          estado_detalle_v=?
          where 
          numero_venta=?
          ";
 
            $sql_detalle=$conectar->prepare($sql_detalle);
 
            $sql_detalle->bindValue(1,$estado);
            $sql_detalle->bindValue(2,$numero_venta);
            $sql_detalle->execute();

         
 
 
            /*una vez se cambie de estado a PAGADO entonces revertimos la cantidad de stock en productos*/
 
     }

   }

   //BUSCA REGISTROS VENTAS-FECHA

 public function lista_busca_registros_fecha($fecha_inicial, $fecha_final){

               $conectar= parent::conexion();

           $date_inicial = $_POST["fecha_inicial"];
           $date = str_replace('/', '-', $date_inicial);
           $fecha_inicial = date("Y-m-d", strtotime($date));

             $date_final = $_POST["fecha_final"];
             $date = str_replace('/', '-', $date_final);
             $fecha_final = date("Y-m-d", strtotime($date));

      
        
     $sql= "SELECT * FROM ventas WHERE fecha_venta>=? and fecha_venta<=? ";


           $sql = $conectar->prepare($sql);
           $sql->bindValue(1,$fecha_inicial);
           $sql->bindValue(2,$fecha_final);
           $sql->execute();
           return $result = $sql->fetchAll(PDO::FETCH_ASSOC);

      }


        //BUSCA REGISTROS VENTAS-FECHA-MES

       public function lista_busca_registros_fecha_mes($mes, $ano){

         $conectar= parent::conexion();


         //variables que vienen por POST VIA AJAX
            $mes=$_POST["mes"];
            $ano=$_POST["ano"];
           
     
           
          $fecha= ($ano."-".$mes."%");

          //la consulta debe hacerse asi para seleccionar el mes/ano

          /*importante: explicacion de cuando se pone el like y % en una consulta: like sirve para buscar una palabra en especifica dentro de la columna, por ejemplo buscar 09 dentro de 2017-09-04. Los %% se ocupan para indicar en que parte se quiere buscar, si se pone like '%queBusco' significa que lo buscas al final de una cadena, si pones 'queBusco%' significa que se busca al principio de la cadena y si pones '%queBusco%' significa que lo busca en medio, asi la imprimo la consulta en phpmyadmin SELECT * FROM ventas WHERE fecha_venta like '2017-09%'*/

     
         $sql= "SELECT * FROM ventas WHERE fecha_venta like ? ";

           $sql = $conectar->prepare($sql);
           $sql->bindValue(1,$fecha);
           $sql->execute();
           return $result = $sql->fetchAll(PDO::FETCH_ASSOC);


       }

        
          public function get_ventas_por_id_cliente($id_cliente){

          $conectar= parent::conexion();

    
           $sql="select * from ventas where id_cliente=?";

           $sql=$conectar->prepare($sql);

           $sql->bindValue(1, $id_cliente);
           $sql->execute();

           return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


   }
   public function get_ventas_cc_por_cliente($id_cliente){

    $conectar= parent::conexion();


     $sql="select * from ventas where id_cliente=? and tipo_pago_venta=´CUENTA CORRIENTE´";

     $sql=$conectar->prepare($sql);

     $sql->bindValue(1, $numero_venta);
     $sql->execute();

     return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


}
   public function get_venta_por_num_venta($numero_venta){

    $conectar= parent::conexion();


     $sql="select * from ventas where numero_venta=?";

     $sql=$conectar->prepare($sql);

     $sql->bindValue(1, $numero_venta);
     $sql->execute();

     return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


}

      public function get_detalle_ventas_por_id_cliente($id_cliente){

       $conectar= parent::conexion();

      
       $sql="select * from detalle_ventas where id_cliente=?";

             $sql=$conectar->prepare($sql);

             $sql->bindValue(1, $id_cliente);
             $sql->execute();

             return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


     }


        public function get_ventas_por_id_usuario($id_usuario){

          $conectar= parent::conexion();

    
          $sql="select * from ventas where id_usuario=?";

           $sql=$conectar->prepare($sql);

           $sql->bindValue(1, $id_usuario);
           $sql->execute();

           return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


     }

        public function get_detalle_ventas_por_id_usuario($id_usuario){

          $conectar= parent::conexion();

    
          $sql="select * from detalle_ventas where id_usuario=?";

           $sql=$conectar->prepare($sql);

           $sql->bindValue(1, $id_usuario);
           $sql->execute();

           return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


     }


          /*REPORTE VENTAS*/

       public function get_ventas_reporte_general(){

      $conectar=parent::conexion();
      parent::set_names();
      $año=date("Y");


     $sql="SELECT MONTHname(fecha_venta) as mes, MONTH(fecha_venta) as numero_mes, YEAR(fecha_venta) as ano, SUM(total_venta) as total_venta
       FROM ventas where estado_venta='1' and YEAR(fecha_venta)=? GROUP BY YEAR(fecha_venta) desc, month(fecha_venta) desc";

     
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $año);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

    }
    
    //suma el total de ventas por año

    public function suma_ventas_total_ano(){

     $conectar=parent::conexion();
     $año=date("Y");


      $sql="SELECT YEAR(fecha_venta) as ano,SUM(total_venta) as total_venta_ano FROM ventas where estado_venta='1' and YEAR(fecha_venta)=? GROUP BY YEAR(fecha_venta) desc";
          
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $año);
          $sql->execute();

          return $resultado= $sql->fetchAll();


    }

    //recorro el array para traerme la lista de una en vez de traerlo con el return, y hago el formato para la grafica
    //suma total por año 
    public function suma_ventas_total_grafica(){
      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

     $conectar=parent::conexion();
     $año=date("Y");


      $sql="SELECT MONTH(fecha_venta) as mes,SUM(total_venta) as total_venta_ano FROM ventas where estado_venta='1'  and YEAR(fecha_venta)=? GROUP BY MONTH(fecha_venta) desc";
          
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $año);
          $sql->execute();

          $resultado= $sql->fetchAll();
            
            //recorro el array y lo imprimo
          foreach($resultado as $row){

                $ano= $output["mes"]=$meses[$row["mes"]-1];
                $p = $output["total_venta_ano"]=$row["total_venta_ano"];

           echo $grafica= "{name:'".$ano."', y:".$p."},";

          }


    }


    

    


    public function suma_ventas_anio_mes_grafica($mes,$año){

     $conectar=parent::conexion();
     parent::set_names();

     //se usa para traducir el mes en la grafica
      //imprime la fecha por separado ejemplo: dia, mes y año
       
       

      //SI EXISTE EL ENVIO POST ENTONCES SE MUESTRA LA FECHA SELECCIONADA
       if(isset($_POST["year"])&&isset($_POST["mes"])){

        $year=$_POST["year"];
        $mes=$_POST["mes"];
        $sql=  " select MONTHname(fecha_venta) as mes, MONTH(fecha_venta) as numero_mes, YEAR(fecha_venta) as ano, SUM(total_venta) as total_venta,tipo_pago_venta,estado_venta
               from ventas where YEAR(fecha_venta)=? and month(fecha_venta)=? group by mes,estado_venta";

   
          
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1,$year);
          $sql->bindValue(2,$mes);
          $sql->execute();

          $resultado= $sql->fetchAll();
            
            //recorro el array y lo imprimo
          foreach($resultado as $row){
            $estado="";
            if($row["estado_venta"]==1){
              $estado="PAGADO";
            }
            if($row["estado_venta"]==2){
              $estado="PENDIENTE";
            }
            if($row["estado_venta"]==0){
              $estado="ANULADO";
            }



                $mes= $output["mes"]=$estado;
                $p = $output["total_venta"]=$row["total_venta"];

        echo $grafica= "{name:'".$mes."', y:".$p."},";

          }


        } else {


    //sino se envia el POST, entonces se mostraria los datos del año actual cuando se abra la pagina por primera vez
 
    $year=date("Y"); 
    $mes=date("n");
    $sql=  " select MONTHname(fecha_venta) as mes, MONTH(fecha_venta) as numero_mes, YEAR(fecha_venta) as ano, SUM(total_venta) as total_venta,tipo_pago_venta,estado_venta
          from ventas where YEAR(fecha_venta)=? and month(fecha_venta)=? group by mes,estado_venta";


      
      $sql=$conectar->prepare($sql);
      $sql->bindValue(1,$year);
      $sql->bindValue(2,$mes);
      $sql->execute();

      $resultado= $sql->fetchAll();
        
        //recorro el array y lo imprimo
      foreach($resultado as $row){
        $estado="";
        if($row["estado_venta"]==1){
          $estado="PAGADO";
        }
        if($row["estado_venta"]==2){
          $estado="PENDIENTE";
        }
        if($row["estado_venta"]==0){
          $estado="ANULADO";
        }



            $mes= $output["mes"]=$estado;
            $p = $output["total_venta"]=$row["total_venta"];

    echo $grafica= "{name:'".$mes."', y:".$p."},";

  }


        }//cierre del else


    }

     public function get_mes_ventas(){

       $conectar=parent::conexion();

         $sql="select month(fecha_venta) as fecha_mes from ventas group by  MONTH(fecha_venta)  asc";
         

         $sql=$conectar->prepare($sql);
         $sql->execute();
         return $resultado= $sql->fetchAll();


    }
    public function get_año_ventas(){

      $conectar=parent::conexion();

        $sql="select year(fecha_venta) as fecha_año from ventas group by  year(fecha_venta)  asc";
        

        $sql=$conectar->prepare($sql);
        $sql->execute();
        return $resultado= $sql->fetchAll();


   }



     public function get_ventas_mensual($año,$mes){


       $conectar=parent::conexion();
     
     if(isset($_POST["year"]) && isset($_POST["mes"])){

         $año=$_POST["year"];
         $mes=$_POST["mes"];

       $sql="select MONTHname(fecha_venta) as mes, MONTH(fecha_venta) as numero_mes, YEAR(fecha_venta) as ano, SUM(total_venta) as total_venta,tipo_pago_venta,estado_venta
       from ventas where YEAR(fecha_venta)=? and month(fecha_venta)=?  group by mes,tipo_pago_venta,estado_venta";
         

         $sql=$conectar->prepare($sql);
         $sql->bindValue(1,$año);
         $sql->bindValue(2,$mes);
         $sql->execute();
         return $resultado= $sql->fetchAll();



       } else {

         //sino se envia el POST, entonces se mostraria los datos del año actual cuando se abra la pagina por primera vez

         $año=date("Y");
         $mes=date("n");

            $sql="select MONTHname(fecha_venta) as mes, MONTH(fecha_venta) as numero_mes, YEAR(fecha_venta) as ano, SUM(total_venta) as total_venta,tipo_pago_venta,estado_venta
            from ventas where YEAR(fecha_venta)=? and month(fecha_venta)=?  group by mes,tipo_pago_venta,estado_venta";
         

        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$año);
        $sql->bindValue(2,$mes);
         $sql->execute();
           return $resultado= $sql->fetchAll();



       }
    }




      public function get_venta_por_fecha($dni,$fecha_inicial,$fecha_final){

       $conectar=parent::conexion();
       parent::set_names();
           
         
           $date_inicial = $_POST["datepicker"];
           $date = str_replace('/', '-', $date_inicial);
           $fecha_inicial = date("Y-m-d", strtotime($date));

         
           $date_final = $_POST["datepicker2"];
           $date = str_replace('/', '-', $date_final);
           $fecha_final = date("Y-m-d", strtotime($date));


       $sql="select * from detalle_ventas where dni_cliente=? and fecha_venta>=? and fecha_venta<=? and estado_venta='1' or estado_venta='2';";

   
       $sql=$conectar->prepare($sql);

       $sql->bindValue(1,$dni);
       $sql->bindValue(2,$fecha_inicial);
       $sql->bindValue(3,$fecha_final);
       $sql->execute();

       return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
   }


     public function get_ventas_anio_actual(){

       $conectar=parent::conexion();
       parent::set_names();

       $sql="SELECT YEAR(fecha_venta) as ano, MONTHname(fecha_venta) as mes, SUM(total_venta) as total_venta_mes FROM ventas WHERE YEAR(fecha_venta)=YEAR(CURDATE()) and estado_venta='1' GROUP BY MONTHname(fecha_venta) desc";

       $sql=$conectar->prepare($sql);
       $sql->execute();
       return $resultado=$sql->fetchAll();

   }

   public function get_ventas_anio_actual_grafica(){

      $conectar=parent::conexion();
      parent::set_names();

       $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      
      $sql="SELECT  MONTHname(fecha_venta) as mes, SUM(total_venta) as total_venta_mes FROM ventas WHERE YEAR(fecha_venta)=YEAR(CURDATE()) and estado_venta='1' GROUP BY MONTHname(fecha_venta) desc";
          
          $sql=$conectar->prepare($sql);
          $sql->execute();

          $resultado= $sql->fetchAll();
            
            //recorro el array y lo imprimo
          foreach($resultado as $row){


         $mes= $output["mes"]=$meses[date("n", strtotime($row["mes"]))-1];
         $p = $output["total_venta_mes"]=$row["total_venta_mes"];

        echo $grafica= "{name:'".$mes."', y:".$p."},";

          }

   }

       public function get_cant_productos_por_fecha($dni,$fecha_inicial,$fecha_final){

         $conectar=parent::conexion();
         parent::set_names();

             $date_inicial = $_POST["datepicker"];
             $date = str_replace('/', '-', $date_inicial);
             $fecha_inicial = date("Y-m-d", strtotime($date));

           
             $date_final = $_POST["datepicker2"];
             $date = str_replace('/', '-', $date_final);
             $fecha_final = date("Y-m-d", strtotime($date));


         $sql="select sum(cantidad_venta) as total from detalle_ventas where dni_cliente=? and fecha_venta >=? and fecha_venta <=? and estado_detalle_v='1' or estado_detalle_v='2';";

     
         $sql=$conectar->prepare($sql);

         $sql->bindValue(1,$dni);
         $sql->bindValue(2,$fecha_inicial);
         $sql->bindValue(3,$fecha_final);
         $sql->execute();

         return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
     

        } 




  }