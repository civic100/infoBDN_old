<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilos.css" />
    <title>Editar Curso</title>
</head>
<body>
<?php
if(!empty ($_SESSION['admin']))  {
?>
<?php
  
    //Implementamos el fichero funciones para luego pasarle estas.
    include("Funciones.php");
    //Realizamos la conexión a la bbdd 
    $conexion=ConecxionBBDD ();
    $id = $_GET["CodigoProfesor"]; 
    //Parte del código que se ejecutara una vez el formulario este rellenado 
    if(!empty($_POST['nom'])){
    //Implementamos el fichero funciones para luego pasarle estas.
    //Guardamos las variables email y password para posteriormente enviarlas. 
    $DniProfesor = $_POST['DNI'];
    $NombreProfe = $_POST['nom'];
    $ApellidoProfe = $_POST['Apellido'];
    $Tituloacademico = $_POST['Tituloacademico'];
    $ContraseñaProfesor = $_POST['pass'];

    //Y creamos la variable sesión de la clave primaria que será el correo
    //Realizamos la conexión a la bbdd 
  
    //Comprobamos que se ha realizado bien.
    if($conexion == false){
        mysqli_connect_errno();
    }
    //Si la conexión es correcto ejecutamos esta parte de código
    else{
        EditarProfesor($conexion,$DniProfesor,$NombreProfe,$ApellidoProfe,$Tituloacademico, $Foto ,$ContraseñaProfesor);
    }   
    }else{
        $sql = "SELECT * FROM profesores WHERE dni = '$id'";
        $result=mysqli_query($conexion, $sql);
        while ($row=mysqli_fetch_array($result)){
            ?>
            <h2> Editar Profesor </h2>
            <form name="formulariAdmin" method="POST" action="#" >
                    <label for="DNI">
                    DNI Profesor:
                    </label >
                        <input type="text"  maxlength="15" id = "DNI" name="DNI" readonly value=" <?php echo $row['dni'];?>" /><br>

                    <label for="nom">
                    Nombre del profesor:
                    </label >
                        <input type="text"  maxlength="15" id = "nom" name="nom" required value=" <?php echo $row['nombre'];?>" /><br>

                    <label for="Apellido">
                    Apellido del profesor:   
                    </label >
                        <input type="int"  name="Apellido" maxlength="15" id = "Apellido" required value=" <?php echo $row['apellido'];?>" /><br>

                    <label for="Tituloacademico">
                    Titulo academico: 
                    </label >
                        <input type="text"  maxlength="15" id = "Tituloacademico" name="Tituloacademico" required value=" <?php echo $row['tituloacademico'];?>" /><br>
            
                    <label for="pass">
                    Contraseña:
                    </label >
                        <input type="password"  maxlength="15" id = "pass" name="pass" required value=" <?php echo $row['contraseña'];?>" /><br>

                    <input type="submit" name="subir" value="Aceptar"/>
            </form>

            
            <a href='ProfesoresAdmin.php'>Editar los Profesores</a><br>

        <?php
        }
    }
    ?>
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