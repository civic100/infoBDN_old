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
    <link rel="stylesheet" type="text/css" href="estilos-css/Estilo-Tablas.css" />
    <link rel="stylesheet" type="text/css" href="estilos-css/Estilo-Menu-Cuerpo.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700&display=swap" rel="stylesheet"> 
    <title>Añadir Profesor</title>
</head>
</head>
    <body>
        <header class="header-menu">
            <?php
                Generarmenu();
            ?>
        </header>
        <?php
        if(!empty ($_SESSION['admin']))  {
            //Parte del código que se ejecutara una vez el formulario este rellenado 
            if(!empty($_POST['DNI'])){
                //Implementamos el fichero funciones para luego pasarle estas.
                //Guardamos las variables email y password para posteriormente enviarlas. 
                $DniProfesor = $_POST['DNI'];
                $NombreProfe = $_POST['Nombre'];
                $ApellidoProfe = $_POST['Apellido'];
                $Tituloacademico = $_POST['Titolacademic'];
                $pas = $_POST['password'];
                $pasencript  = md5($pas);
                if (is_uploaded_file ($_FILES['imagen']['tmp_name'])){
                    $nombreDirectorio = "img/";
                    $idUnico = time();
                    $nombreFichero = $idUnico . "-" .
                    $_FILES['imagen']['name'];
                    $directorio= $nombreDirectorio . $nombreFichero;
                    move_uploaded_file ($_FILES['imagen']['tmp_name'], $nombreDirectorio . $nombreFichero);
                    $tamano = $_FILES['imagen']['size'];
                    $tipo = $_FILES['imagen']['type'];
                }
                
                //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                    echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/> - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
                    ?>
                        <META HTTP-EQUIV="REFRESH" CONTENT="5;URL=http://localhost/InfoBDN/ProfesoresAdmin.php"/>
                    <?php 
                }   
                else{
                    //Y creamos la variable sesión de la clave primaria que será el correo
                    //Realizamos la conexión a la bbdd 
                    $conexion=ConecxionBBDD ();
                    //Comprobamos que se ha realizado bien.
                    if($conexion == false){
                        mysqli_connect_errno();
                    }

                    //Si la conexión es correcto ejecutamos esta parte de código
                    else{
                        AñadirProfesor($conexion,$DniProfesor,$NombreProfe,$ApellidoProfe,$Tituloacademico, $directorio ,$pasencript);
                    }  
                } 
            }else{

            ?>
             <div class="Contenedor-Tabla">
                <h2> Añadir Profesor </h2>
                <form name="formulariAdmin" method="POST" enctype="multipart/form-data" action="#" >
            
                        <label for="DNI">
                        DNI del profesor:
                        </label >
                            <input type="text"  maxlength="9" id = "DNI" name="DNI" required /><br>

                        <label for="Nombre">
                        Nombre del Profesor:
                        </label >
                            <input type="text"  maxlength="15" id = "Nombre" name="Nombre" required /><br>

                        <label for="Apellido">
                        Apellido del profesor:   
                        </label >
                            <input type="text"  name="Apellido" maxlength="15" id = "Apellido" required/><br>

                        <label for="Titolacademic">
                        Titol academic:
                        </label >
                            <input type="text"  maxlength="15" id = "Titolacademic" name="Titolacademic" required /><br>

                        <label for="imagen">
                        Añadir Foto:
                        </label >
                            <input name="imagen" type="file" required accept=".png .jpg .jpeg"/>
                            <br>
                            
                        <label for="password">
                        Contraseña:
                        </label >
                            <input type="password"  maxlength="15" id = "password" name="password" required /><br>

                        <input type="submit" name="subir" value="Aceptar"/>
                </form>

                
                <a href='ProfesoresAdmin.php'>Editar los Profesores</a><br>

            <?php
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