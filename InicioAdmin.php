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
    <link rel="stylesheet" type="text/css" href="estilos-css/Estilo-InicioAdmin.css" />
    <link rel="stylesheet" type="text/css" href="estilos-css/Estilo-Menu-Cuerpo.css" />
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

        <?php
        if(!empty ($_SESSION['admin']))  {
        ?>
            <div class="contenedor-central">
                <h3> <a href='CursosAdmin.php'>Cursos</a></h3><br>
                <h3> <a href='ProfesoresAdmin.php'>Professors</a></h3><br>
                <h3> <a href='Salir.php'>Sortir</a></h3><br>
            </div>

        <?php
        }else{
            print("Has d'esta validat per veure aquesta pàgina");
        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=http://localhost/InfoBDN/RegistroUsuarios.php"/>
        <?php
        }
        ?>
        <div class="imagen-login"><br></div>
    </body>
</html>