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
    <link rel="stylesheet" type="text/css" href="estilos-css/Estilos-Login-Usu.css" />
    <link rel="stylesheet" type="text/css" href="estilos-css/Estilo-Menu-Cuerpo.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700&display=swap" rel="stylesheet"> 
    <title>Login alumnos</title>
</head>
    <body>
    <header class="header-menu">
        <?php
                Generarmenu();
            ?>
    </header>

    <div class="contenedor-central">
	    <h3 class="txt-contenedor-central">Inicio de sesión Usuario</h3>
    </div>
    <div class="linea-central"></div>

    <div class="formulario-admin">


    <?php
    //Parte del código que se ejecutara una vez el formulario este rellenado 
    if(!empty($_POST['DNIAlumne'])){
        //Guardamos las variables email y password para posteriormente enviarlas. 
        $dni = $_POST['DNIAlumne'];
        $pas = $_POST['Password'];
        $pasencript=md5($pas);
        //Realizamos la conexión a la bbdd 
        $conexion=ConecxionBBDD ();
        //Comprobamos que se ha realizado bien.
        if($conexion == false){
            mysqli_connect_errno();
        }
        //Si la conexión es correcto ejecutamos esta parte de código
        else{
            ValidarLogin($conexion,$dni,$pasencript);
        }   
        
    }else{

    ?>
        <form name="formulariUsuari" method="POST" action="#" >
                <label for="DNIAlumne">
                    Dni del Usuari:   
                </label >
                    <input type="text"  name="DNIAlumne" maxlength="9" id = "DNIAlumne" required/><br>
        
                <label for="Password">
                    Password:
                </label >
                <input type="password"  maxlength="15" id = "Password" name="Password" required /><br>
                <!--Si el usuario no está registrado mostramos el enlace que le lleva a la página de registro -->
                <input type="submit" name="subir" value="Aceptar"/><br>

                <a href='RegistroUsuarios.php'>Encara no estàs registrat</a>
        </form>
    <?php
    }
    ?>
    </div>
    <div class="imagen-login"><br></div>

</body>
</html>