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
                   //alert(boton.values());
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
                
                //$('.añadirNotas').hide();
                
                $('.notas').click(function(){
                   
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
                <button class="btn btn-warning notas" value="<?php echo $tarea["idTarea"]?>">Notas</button>
                    <!--<div class="añadirNotas">
                        <div>
                            <form action="index.php?controller=nota&action=alta&id=<?php //echo $tarea["idTarea"]?>" method="post" >
                            <hr/>
                            Añadir nota: <textarea name="nota" class="form-control"></textarea
                            <input type="submit" value="Añadir" class="btn btn-success"/>
                            </form>
                        </div>
                    </div>-->
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
                
            </div>
            
        <footer class="col-lg-12">
            <hr/>
           Reto_3 - HERRAMIENTA COLABORATIVA - David Ramirez - <a href="#">dramirez.es</a> - Copyright &copy; <?php echo  date("Y"); ?>
        </footer>
    </body>
</html>