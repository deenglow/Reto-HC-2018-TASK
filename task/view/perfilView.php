<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>PAGINA PERFIL</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
            <h3>PAGINA PERFIL</h3>
            <div class="col-lg-7">
            <div>
                <form action="index.php?controller=proyecto&action=alta&idUsuario=<?php echo $_GET['idUsuario']; ?>" method="post">
                    <h3>Crear Proyecto</h3>
                    <hr/>
                    Nombre: <input type="text" name="nombre" class="form-control"/>
                    Descripcion: <input type="text" name="descripcion" class="form-control"/>
                    <input type="submit" value="Crear" class="btn btn-success"/>   
                </form>
            </div>
            <h3>LISTA DE SUS PROYECTOS</h3>
            <hr/>
        <section style="height:400px;overflow-y:scroll;">
            <?php foreach($data["proyectos"] as $proyecto) {?>
                Nombre: <?php echo $proyecto["nombre"]; ?> -
                Descripcion: <?php echo $proyecto["descripcion"]; ?> -
                <a href="index.php?controller=proyecto&action=delete&idUsuario=<?php echo $_GET['idUsuario']?>&idProyecto=<?php echo $proyecto['idProyecto']; ?>" class="btn btn-danger">Eliminar</a>&nbsp;
                <a href="index.php?controller=proyecto&action=proyectoVista&idProyecto=<?php echo $proyecto['idProyecto'];?>" class="btn btn-info">Ir Proyecto</a>&nbsp;
                <hr/>
            <?php } ?>
        </section>
            
             <h3>LISTA DE PROYECTOS DISPONIBLES</h3>
            <hr/>
        <section style="height:400px;overflow-y:scroll;">
            <?php foreach($data["proyectosDisponibles"] as $proyectoDisponible) {?>
                Nombre: <?php echo $proyectoDisponible["nombre"]; ?> -
                Descripcion: <?php echo $proyectoDisponible["descripcion"]; ?> -
                <a href="index.php?controller=proyecto&action=delete&idProyecto=<?php echo $proyectoDisponible['idProyecto']; ?>" class="btn btn-danger">Eliminar</a>&nbsp;
                <a href="index.php?controller=proyecto&action=proyectoVista&idProyecto=<?php echo $proyectoDisponible['idProyecto'];?>" class="btn btn-info">Ir Proyecto</a>&nbsp;
                <hr/>
            <?php } ?>
        </section>
            </div>
            <div class="col-lg-5">
                <h3>ARCHIVOS</h3> 
                
            </div>
        <footer class="col-lg-12">
            <hr/>
           Reto_3 - HERRAMIENTA COLABORATIVA - David Ramirez - <a href="#">dramirez.es</a> - Copyright &copy; <?php echo  date("Y"); ?>
        </footer>
    </body>
</html>