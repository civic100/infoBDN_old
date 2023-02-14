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
    <link rel="stylesheet" type="text/css" href="estilos-css/Estilo-LoginAdmin.css" />
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


        <div class="contenedor-central">
            <h3 class="txt-contenedor-central">Inicio de sesión Admin</h3>
        </div>
        <div class="linea-central"></div>

        <div class="formulario-admin">
            <?php
            //Parte del código que se ejecutara una vez el formulario este rellenado 
            if(!empty($_POST['usuari'])){
                //Implementamos el fichero funciones para luego pasarle estas.
                //Guardamos las variables email y password para posteriormente enviarlas. 
                $usuario = $_POST['usuari'];
                $pas = $_POST['Password'];
                //Y creamos la variable sesión de la clave primaria que será el correo
                $_SESSION['admin'] = $usuario;

                //Realizamos la conexión a la bbdd 
                $conexion=ConecxionBBDD ();

                if($conexion == false){
                    mysqli_connect_errno();
                }
                //Si la conexión es correcto ejecutamos esta parte de código
                else{
                    ValidarLoginAdmin($conexion,$usuario,$pas);
                }   
            }else{
            /*
            *
            Formulario de Login Admin.
            *
            */
            ?>
                <form name="formulariAdmin" method="POST" action="LoginAdmin.php" >

                        <label for="usuari"> Usuari *   </label >
                            <input type="text"  name="usuari" maxlength="15" id = "usuari" required/><br>
                
                        <label for="Password"> Password * </label >
                            <input type="password"  maxlength="15" id = "Password" name="Password" required /><br>

                        <button type="submit" name="subir" value="Enviar">Enviar</button>

                </form>
            <?php
            }
            ?>
        </div>
        <div class="imagen-login"><br></div>

    </body>
</html>