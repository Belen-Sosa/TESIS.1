 <!--FORMULARIO VENTANA MODAL-->

 <div id="pago_cc_modal" class="modal fade">
      
      <div class="modal-dialog">
        
         <form method="post" id="usuario_form">

            <div class="modal-content">
              
               <div class="modal-header">

                 <button type="button" class="close" data-dismiss="modal">&times;</button>

                 <h4 class="modal-title">Agregar Usuario</h4>
                 

               </div>


               <div class="modal-body">

              
          
          <label>Cargo</label>
           <select class="form-control" id="cargo" name="cargo" required>
              <option value="">-- Selecciona cargo --</option>
              <option value="1" selected>Administrador</option>
              <option value="0">Empleado</option>
           </select>
           <br />
         
          <label>Teléfono</label>
          <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono" required pattern="[0-9]{0,15}"/>
          <br />
          
         

              
           <br/><br/>

         <!--LISTA DE PERMISOS-->

               <div class="form-group">
                  <label for="" class="col-lg-1 control-label">Permisos</label>

                    <div class="col-lg-6">

                      <ul style="list-style:none;" id="permisos">
                   
                  
                      </ul>
                      
                    </div>

               </div>

           <!--FIN LISTA DE PERMISOS-->
                 

        </div>


               <div class="modal-footer">

                 <input type="hidden" name="id_usuario" id="id_usuario"/>

                 <button type="submit" name="action" id="btnGuardar" class="btn btn-success pull-left" value="Add"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
         
          <button type="button" onclick="limpiar()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
            
                 

               </div>



            </div>
           

         </form>


      </div>

    </div>