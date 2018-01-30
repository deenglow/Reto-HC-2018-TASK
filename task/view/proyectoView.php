<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>PAGINA PROYECTO</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
            $(document).ready(function (){
               $('.realizado').click(function(event){
                   var boton = $(this);
                   var idTarea=$(this).val();
                    $.ajax({
                        url: "index.php?controller=tarea&action=realizado",
                        data: {"idTarea":idTarea},
                        method: "POST",
                        success: function(result){
                            console.log(result);
                            boton.attr("disabled", true);
                            boton.append(" <span class='glyphicon glyphicon-ok'></span>");
                        }
                    });           
                }); 
                

                $('.notas').click(function(){
                   var boton=$(this);
                   boton.next().append('<div class="añadirNotas"><div><form method="post" class="form_notas"><hr/>Añadir nota: <textarea name="nota" class="form-control"></textarea></form><button class="btn btn-success submitNota">Añadir</button>&nbsp;<button class="btn btn-primary cerrarNota">Cerrar</button></div>');
                   $('.form_notas').attr('action','index.php?controller=nota&action=alta&idTarea='+boton.val());
                });
                     
                $('.container').on('click','.submitNota',function(){//para los componentes generados dinamicamente
                    var datos = $(this).prev().serialize();
                    var formulario = $(this).prev();
                    var btn=$(this);
                    $.ajax({
                        type:formulario.attr('method'), 
                        url: formulario.attr('action'),
                        data: datos,
                        success: function (data) { 
                            cerrarAñadirNota(formulario, btn);
                        } 
                    });
                });
                
                $('.container').on('click','.cerrarNota',function(){//para los componentes generados dinamicamente
                     var formulario = $(this).parent();
                     var btn=$(this);
                     cerrarAñadirNota(formulario);
                       
                });
                
                function cerrarAñadirNota(formulario){
                    formulario.parent().remove();
                    
                    
                }
                  
                $('.mostrarNotas').hide();
                
                $('.verNotas').click(function(){ 
                   var idTarea=$(this).val();
                   var posicionarmeDom=$(this).next().next().next();
                   $.ajax({
                        method: 'POST', 
                        url: 'index.php?controller=nota&action=mostrarNotas',
                        data: {"idTarea": idTarea},
                        success: function (data) { 
                               
                               console.log(data);
                               var notas=jQuery.parseJSON(data);
                               
                               notas.forEach(function(nota){
                                   
                                   posicionarmeDom.children('ul').append('<li class="list-group-item">'+nota.descripcion+'</li>');
                                   
                               });
                        } 
                   });

                   posicionarmeDom.show();
                   
                });
                
                $('.x').click(function(){ 
                   $(this).parent().parent().children('ul').empty();
                   $(this).parent().parent().hide();
                });
                
            }); 

        </script>
        <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
        </style>
    </head>
    <body class="container">
        <div class="col-lg-7">
        <h1><?php echo strtoupper($data['datosPrpyecto']->nombre) ?></h1>
        <hr>
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
                </form>
        <h3>LISTA DE SUS TAREAS</h3>
            <hr/>
        <section style="height:400px;overflow-y:scroll;">
            <?php foreach($data["tareas"] as $tarea) {?>
                Nombre: <?php echo $tarea["nombre"]; ?> -
                Fecha Vencimiento: <?php echo $tarea["fecha_vencimiento"]; ?> -
                <a href="index.php?controller=tarea&action=delete&idTarea=<?php echo $tarea["idTarea"]?>&idProyecto=<?php echo $tarea["idProyecto"]?>" class="btn btn-danger">Eliminar</a>&nbsp;
                <?php if($tarea["realizado"]==0) {?>
                            <button class="btn btn-info realizado"  value="<?php echo $tarea["idTarea"]?>">Realizado</button>
                <?php }else{ ?>
                            <button class="btn btn-info realizado"  value="<?php echo $tarea["idTarea"]?>" disabled ></span>Realizado <span class="glyphicon glyphicon-ok"></button>
                <?php } ?>
                            <button class="btn btn-warning  verNotas" value="<?php echo $tarea["idTarea"]?>">Ver Notas</button>
            
                <button class="btn btn-success notas" value="<?php echo $tarea["idTarea"]?>">Añadir Nota</button>
                <div></div>
                <div class="mostrarNotas">
                    <h4>NOTAS <button class="x">X</button> </h4>
                    <ul class="list-group"></ul>                  
                </div>
                <hr/>
            <?php } ?>
        </section>
            </div>
             <div class="col-lg-5">
                <h3>MENSAJES</h3> 
                <form action="index.php?controller=mensaje&action=alta&idProyecto=<?php echo $_GET['idProyecto']?>" method="post" >
                    <hr/>
                    Añadir mensaje: <textarea name="mensaje" class="form-control"></textarea>
                    <input type="submit" value="Añadir" class="btn btn-success"/>   
                </form>
                <section style="height:400px;overflow-y:scroll;">
                    <?php foreach($data["mensajes"] as $mensaje) {?>
                         Mensaje: <?php echo $mensaje["descripcion"]; ?> - 
                         fecha : <?php echo $mensaje["fecha"]; ?>
                        <hr/>
                    <?php } ?>
                </section>
                <hr style="border: 2px solid black;">
                <h3>Invitaciones</h3>
                
                
                
                
            </div>
            
        <footer class="col-lg-12">
            <hr/>
           Reto_3 - HERRAMIENTA COLABORATIVA - David Ramirez - <a href="#">dramirez.es</a> - Copyright &copy; <?php echo  date("Y"); ?>
        </footer>
    </body>
</html>