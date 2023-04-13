
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

    


       <!--VISTA MODAL PARA VER DETALLE COMPRA EN VISTA MODAL-->
     <?php require_once("modal/detalle_compra_modal.php");?>
    
   
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