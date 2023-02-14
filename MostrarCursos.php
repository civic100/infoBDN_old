<?php
session_start();
include("Funciones.php");
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilos-css/Estilo-MostrarCursos.css" />
    <link rel="stylesheet" type="text/css" href="estilos-css/Estilo-Menu-Cuerpo.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700&display=swap" rel="stylesheet"> 
    <title>Indice</title>
</head>
    <body>
        <header class="header-menu">
            <?php
                Generarmenu();
            ?>
        </header>

        <div class="imagen-Profe"><br></div>

        <div class="Fondo-Profesor">
                <div class="Titulo-Profesor"> <h1 class="titulo-contenedor-profesor">Nuestro Centro Academico</h1></div>
                <div class="Texto-Profesor"> <p class="txt-contenedor-profesor">Soy un párrafo. Haga clic aquí para agregar su propio texto y editarme. Es fácil. Simplemente haga clic en "Editar texto" o haga doble clic en mí para agregar su propio contenido y realizar cambios en la fuente.</p></div>
        </div> 

        <div class="contenedor-central">
            <h3 class="txt-contenedor-central">Cursos</h3>
        </div>
        <div class="linea-central"></div>

        <div class="Contenedor-Profesores">
            <div class="box">
                <?php
                    //Realizamos la conexión a la bbdd 
                    $conexion=ConecxionBBDD ();
                    if($conexion == false){
                        mysqli_connect_errno();
                    }
                    else{
                        //Realizamos la consulta a la bbdd para mostrar todos los datos de la tabla empleados
                        $sql = "SELECT * FROM cursos";
                        $consulta = mysqli_query($conexion, $sql);

                        if ($consulta== false){
                            mysqli_error($conexion); 
                        }
                        else{
                            GenerarTablaCursosHome($consulta);
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>