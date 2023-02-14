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
    <link rel="stylesheet" type="text/css" href="estilos-css/Estilos-RegistroUsuario.css" />
    <link rel="stylesheet" type="text/css" href="estilos-css/Estilo-Menu-Cuerpo.css" />
    <title>Registro Alumnos</title>
</head>
    <body>
        <header class="header-menu">
            <?php
                Generarmenu();
            ?>
        </header>

        <div class="Fondo-Formulario">
            <div></div>
        </div> 

        <div class="formulario-usuario">
        
            <?php
            if(!empty($_POST['DNIAlumne'])){
                $dni = $_POST['DNIAlumne'];
                $pas = $_POST['Password'];
                $Nom = $_POST['Nom'];
                $Cognoms = $_POST['Cognoms'];
                $Edat = $_POST['Edat'];
                $pasencript =  md5($pas);
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
                        <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=http://localhost/InfoBDN/ProfesoresAdmin.php"/>
                     <?php 
                }else{
                    //Realizamos la conexión a la bbdd 
                    $conexion=ConecxionBBDD ();

                    if($conexion == false){
                        mysqli_connect_errno();
                    }
                    else{
                        /*Llamada a funcion para revisar si el usuario ya existe en la bbdd*/
                        ValidarRegistro($conexion,$dni,$pasencript,$Nom,$Cognoms,$directorio, $Edat);
                    }  
                }
            }else{
                //generamos el formulario de registro.  //pasar a funcion
            ?>
                <form name="formulariRegistro" method="POST" enctype="multipart/form-data" action="#" >
                <h2>Registrate en InfoBDN</h2><br>

                        <label for="DNIAlumne">
                            DNI Alumne:   
                        </label >
                            <input type="text"  name="DNIAlumne" maxlength="9" id = "DNIAlumne" required/><br>

                        <label for="Nom">
                            Nom:   
                        </label >
                            <input type="text"  name="Nom" maxlength="15" id = "Nom" required/><br>

                        <label for="Cognoms">
                            Cognoms:   
                        </label >
                            <input type="text"  name="Cognoms" maxlength="15" id = "Cognoms" required/><br>

                        <label for="Edat">
                            Edat:
                        </label> 
                            <input type="number"  name="Edat" id="Edat" min="12" max="17" required/><br>

                        <label for="imagen">
                            Añadir Foto:
                        </label >
                            <input name="imagen" type="file" required accept=".png .jpg .jpeg"/>
                
                        <label for="Password">
                            Password:
                        </label >
                        <input type="password"  maxlength="15" id = "Password" name="Password" required /><br>  

                        <br>
                        <input type="submit" name="subir" value="Aceptar"/>
                </form>
                <?php
            }
            ?>
    
        </div>
        <div class="imagen-login"><br></div>
    </body>
</html>