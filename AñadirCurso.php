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
        //Implementamos el fichero funciones para luego pasarle estas.
        //Parte del código que se ejecutara una vez el formulario este rellenado 
        if(!empty($_POST['nom'])){
            //Implementamos el fichero funciones para luego pasarle estas.
            //Guardamos las variables email y password para posteriormente enviarlas. 
            $NombreCurso = $_POST['nom'];
            $Descripcion = $_POST['descripcio'];
            $duracion = $_POST['horadurada'];
            $fechaincio = $_POST['datainici'];
            $fechafin = $_POST['datafi'];
            $profesor = $_POST['select1'];

            //Y creamos la variable sesión de la clave primaria que será el correo

            //Realizamos la conexión a la bbdd 
            $conexion=ConecxionBBDD ();
            
            //Comprobamos que se ha realizado bien.
            if($conexion == false){
                mysqli_connect_errno();
            }
            //Si la conexión es correcto ejecutamos esta parte de código
            else{
            AñadirCurso($conexion,$NombreCurso,$Descripcion,$duracion,$fechaincio, $fechafin ,$profesor); 
            }   
        }else{

        ?>
        <div class="Contenedor-Tabla">
            <h2> Añadir Curso </h2>
            <form name="formulariAdmin" method="POST" action="#" >
        
                <label for="nom">
                    Nombre del Curso:
                </label >
                    <input type="text"  maxlength="15" id = "nom" name="nom" required /><br>

                <label for="descripcio">
                    Descripcion del Curso:
                </label >
                    <input type="text"  maxlength="40" id = "descripcio" name="descripcio" required /><br>

                <label for="horadurada">
                    Hora durada del curs:   
                </label >
                    <input type="int"  name="horadurada" maxlength="15" id = "horadurada" required/><br>

                <label for="datainici">
                    Data de inici del Curso:
                </label >
                    <input type="date"  maxlength="15" id = "datainici" name="datainici" required /><br>

                <label for="datafi">
                    Data de fi del Curso:
                </label >
                    <input type="date"  maxlength="15" id = "datafi" name="datafi" required /><br>
                        
                <label for="profesor">
                    Nombre del Profesor:
                </label >
                    <?php
                        $conexion=ConecxionBBDD ();
                        //Comprobamos que se ha realizado bien.
                        if($conexion == false){
                            mysqli_connect_errno();
                        }
                        //Si la conexión es correcto ejecutamos esta parte de código
                        else{
                            $sql='SELECT * FROM profesores';
                            $consulta = mysqli_query($conexion, $sql);
                            ?>  
                            <?php
                            ?> 
                                <select name='select1' id = 'select1'>"
                            <?php
                                while($fila=mysqli_fetch_array($consulta)){
                                    echo "<option value='".$fila['dni']."'>".$fila['nombre']."</option>";
                                }
                            ?> 
                                </select>
                            <?php
                            }
                        ?>
                        <br>
                        <?php
                    ?>
                <input type="submit" name="subir" value="Aceptar"/>
            </form>
            <a href='CursosAdmin.php'>Editar los Cursos</a><br>
       
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