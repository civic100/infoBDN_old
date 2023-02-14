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
    <link rel="stylesheet" type="text/css" href="estilos-css/Estilos-Miscursos.css" />
    <link rel="stylesheet" type="text/css" href="estilos-css/Estilo-Menu-Cuerpo.css" />
    <link rel="stylesheet" type="text/css" href="estilos-css/Estilo-Tablas.css" />
    <title>Indice</title>
</head>
    <body>
        <header class="header-menu">
            <?php
                Generarmenu();
            ?>
        </header>
        <?php
       if(!empty ($_SESSION['dniprofesor']))  {
            $id=$_SESSION['dniprofesor'];
        ?>
        <div class="imagen-Profe"><br></div>

        <div class="contenedor-central">
            <h3 class="txt-contenedor-central">Mis Cursos</h3>
        </div>
        <div class="linea-central"></div>

        <div class="Contenedor-Tabla">
                <?php
                //Realizamos la conexión a la bbdd 
                $conexion=ConecxionBBDD ();
                if($conexion == false){
                    mysqli_connect_errno();
                }
                else{
                    //Realizamos la consulta a la bbdd para mostrar todos los datos de la tabla empleados
                    $sql = "SELECT curso FROM matricula WHERE dni_alumno= '$id'";
                    $consulta = mysqli_query($conexion, $sql);

                    if ($consulta== false){
                        mysqli_error($conexion); 
                    }
                    else{
                        GenerarTablaEvaluacionesProfesor($conexion,$consulta);
                    }
                }
            ?>
            </div>
        <?php
        }else{
            print("Has d'esta validat per veure aquesta pàgina");
        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=http://localhost/InfoBDN/RegistroUsuarios.php"/>
        <?php
        }
        ?>
    </body>
</html>