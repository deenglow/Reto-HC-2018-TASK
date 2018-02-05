

 <?php
$usuarios= $_SESSION["usuario"]; 
include_once '.\view\viewGenerico\cabecera.php'; 

$idUsuario="";
foreach ($_SESSION["usuario"] as $usu){$idUsuario= $usu["idUsuario"];}
    ?>  

<!-- main -->

 <main class="dev">
  <!-- Sidebar -->
        <aside class="lateral dev">
            <div  style="height:400px">
               <img src="./assets/img/avatar.jpg" alt="Foto perfil" alt="avatar perfil">
            <?php 
            $usuarios= $_SESSION["usuario"];
            foreach($usuarios as $ususario) {?>
              <h3> <?php echo $ususario["nombre"]; ?> </h3>     
            <?php } ?>
              
              <!-- Invitaciones-->
              <div>
                    <label for="invitaciones_proyecto">Introduce email: </label><br>
                    <input type="text" name="invitaciones_proyecto" id="invitaciones_proyecto"/>
                    <form id="enviar_invitacion">
                        <input type="hidden" name="idProyecto" value=<?php echo $_GET['idProyecto'] ?>/>
                        <input type="hidden" name="idUsuario" value="" id="usuario_id"/>
                    </form>
                    <button id="invitar_usuario">Invitar</button>
     
                 </div>
                
                <div class="alert alert-success" role="alert" id="alertInfo">
                    Invitacion Enviada con Exito!!!
                </div>
                <div class="alert alert-danger" role="alert" id="alertInfoUsuario">
                    Usuario no existe
                </div><!-- Fin: Invitaciones-->
             
                
               
            </div>
            <!-- un div que tenga los participantes del proyecto--> 
 <!-- SECTION PARA EL CHAT -->
 <hr>
           <h1>CHAT</h1>   
         
          <div id="chat">         
              <div>         
            <?php foreach($data["mensajes"] as $mensaje) {?>
                  <p>  
                      Mensaje: <?php echo $mensaje["descripcion"]; ?> 
                      fecha : <?php echo $mensaje["fecha"]; ?>
                  </p>
                 -------------------------------------------------
            <?php } ?>
                  </div>
               
           </div>
            <div id="insertChat">
           <form action="index.php?controller=mensaje&action=alta&idProyecto=<?php echo $_GET['idProyecto']?>" method="post" id="formChat">
                  
                   <textarea name="mensaje" rows="1" class="form-control"></textarea>
                    <input type="submit" value="Añadir" class="btn btn-info"/>   
           </form>
          </div>  
        
        </aside>
  <!-- Contenido -->
        <section class="contenido dev">
            <h1><?php echo strtoupper($data['datosProyecto']->nombre)?> </h1>
            <!--<button type="button" class="btn btn-primary">
                Notificaciones <span class="badge badge-info"><?php// echo$data['numeroTareas']?></span>
            </button>-->
  <!-- TAREAS -->
            <ul class="dev">
                <?php foreach($data["tareas"] as $tarea) {?>
                   <div id="positproyecto"> 
                              <img src="./assets/img/amarillo2.png" alt="posit proyecto" id="posit">
                          <div>
                              <?php if($tarea["realizado"]==0) {?>
                                          <button class="btn btn-info realizado"  value="<?php echo $tarea["idTarea"]?>">Realizado</button>
                              <?php }else{ ?>
                                          <button class="btn btn-info realizado"  value="<?php echo $tarea["idTarea"]?>" disabled ></span>Realizado <span class="glyphicon glyphicon-ok"></button>
                              <?php } ?>
                              <a href="index.php?controller=tarea&action=delete&idTarea=<?php echo $tarea["idTarea"]?>&idProyecto=<?php echo $tarea["idProyecto"]?>" class="btn btn-danger">Eliminar</a>&nbsp;
                              <p>
                                 Nombre: <?php echo $tarea["nombre"]; ?> 
                                 Fecha Vencimiento: <?php echo $tarea["fecha_vencimiento"]; ?>
                              </p>
                              <button class="btn btn-warning  verNotas" value="<?php echo $tarea["idTarea"]?>">Ver Notas</button>
                              <button class="btn btn-success notas" value="<?php echo $tarea["idTarea"]?>">Añadir Nota</button>
                              <div></div>
                              <div class="mostrarNotas">
                                  <h4>NOTAS <button class="x">X</button> </h4>
                                  <ul style="color: black;"></ul>                  
                              </div>
                         </div>
                   </div>
                <?php } ?>
             </ul> 
        </section>
  <!-- modal añadir tareas-->
             
                   <form action="index.php?controller=tarea&action=alta&idProyecto=<?php echo $_GET['idProyecto']?>" method="post" >
                    <h3>Crear Tarea</h3>
                    <hr/>
                    Nombre: <input type="text" name="nombre" class="form-control"/>
                    Fecha de Vencimiento: <input type="date" name="FechaVencimiento" class="form-control"/>
                    <!-- Realizado: <select name="realizado" class="form-control">
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                               </select>-->
                    <input type="hidden" name="realizado" value="0">
                    <input type="submit" value="Crear" class="btn btn-success"/>   
                   </form><!-- fin añadir -->
                   
          <aside class="lateral dev">
            <div  style="height:80%">
           
            </div>
          <!-- SECTION PARA EL CHAT -->         
          <button type="button" class="btn-info">Añadir documentacion</button>       
           <div id="social">  
           <!-- Social -->
            <a href="#" class="dev">
                <img src="./assets/img/mail.png" alt="Correo-e">
                <span>Correo-e</span>
            </a>
            <a href="#" class="dev">
                <img src="./assets/img/twitter.png" alt="Twitter">
                <span>Twitter</span>
            </a>
           
          </div>
        </aside>

    <!-- OJO ESTO HAY QUE ORDENAR Y TERMINAR-->
   
    </main>

<script>
    $(document).ready(function(){

        $('#alertInfoUsuario').hide();
        $('#invitar_usuario').attr('disabled',true);
        
        $('#invitaciones_proyecto').blur(function(){
           var valorInput=$(this).val();
           $.ajax({
               url: "index.php?controller=usuarios&action=buscarUsuario&email="+valorInput,
               method:'POST',
               success: function(result){
                   console.log(result);
                   if(result==0){
                        $('#alertInfoUsuario').show();
                        $('#alertInfoUsuario').delay(2000).hide(600); 
                   }else{     
                       var datosObjeto=jQuery.parseJSON(result);
                       $('#invitaciones_proyecto').attr('disabled',true);
                       $('#invitar_usuario').removeAttr('disabled');
                       $('#usuario_id').attr('value',datosObjeto.idUsuario);
                   };    
               }
           });
              
        
        });
        
        $('body').on('click','#invitar_usuario',function(event){     
            event.preventDefault();
            var datos=$('#enviar_invitacion').serialize();
            $.ajax({
                url: "index.php?controller=proyecto&action=invitacion",
                method:"POST",
                data:datos,
                success:function(result){
                    console.log(result);
                    $('#alertInfo').show();
                    $('#alertInfo').delay(2000).hide(600); 
                }

            });

            $('#invitaciones_proyecto').attr('disabled',false);
            $('#invitar_usuario').attr('disabled',true);
            
        });
        
        
    });
</script>
    


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->

</body>
</html>

