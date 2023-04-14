
<?php

  require_once("../config/conexion.php");

    if(isset($_SESSION["id_usuario"])){
    
        

?>


<!-- INICIO DEL HEADER - LIBRERIAS -->
<?php require_once("header.php");?>

<!-- FIN DEL HEADER - LIBRERIAS -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
   
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Detalle Cuenta Corriente 
       
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
    
   <div id="resultados_ajax"></div>
   <div class="panel panel-default">
        
        <div class="panel-body">

         <div class="btn-group text-center">
          <a href="compras.php" id="add_button" class="btn btn-primary btn-lg" ><i class="fa fa-plus" aria-hidden="true"></i> Nueva Compra</a>
         </div>
         <div class="btn-group text-center">
          <a href="compras.php" id="add_button" class="btn btn-primary btn-lg" ><i class="fa fa-plus" aria-hidden="true"></i> Nueva Compra</a>
         </div>


       </div>
      </div>

    


       <!--VISTA MODAL PARA VER DETALLE VENTA EN VISTA MODAL-->
       <?php require_once("modal/detalle_venta_modal.php");?>
    
   
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de Compras</h3>
              
            </div>
           
            <!-- /.box-header -->
            <div class="box-body">
             <table id="cuenta_corriente_data" class="table table-bordered table-striped">
                 <div></div>
                <thead>
                <tr>
                 
                  <th>Fecha Venta</th>
                  <th>Número Venta</th>
                  <th>Total</th>
                  <th>Ver Detalle</th>
             
                  
                 
                </tr>
                </thead>
                
              </table>
              <div class="box-body">
              <table class="table table-striped">
                <thead>
                <tr class="bg-success">
                    <th ></th> 
                    <th ></th>   
                    <th ></th>  
                    <th class="col-lg-4">TOTAL</th> 
                    
                </tr>
                </thead>


                <tbody>
                      <tr class="bg-gray">
                         
                        <td></td>
                        <td></td>
                        <td></td>
                      
                        <!--IMPORTANTE: hay que poner el name=total en el h4 para que lo pueda enviar, NO se envia si lo pones en el input hidden-->
                        <td class="col-lg-4"><h4 id="total" name="total"> 0.00</h4><input type="hidden" name="total_compra" id="total_compra"></td>
                               
                     
                      </tr>

                       
                </tbody>
           
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

   
  

   <?php require_once("footer.php");?>

<script type="text/javascript" src="js/cuenta_corriente_detalle.js"></script>


<?php
   
  } else {

         header("Location:".Conectar::ruta()."index.php");
     }

?>