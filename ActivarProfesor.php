<?php
session_start();
?>

<?php
if(!empty ($_SESSION['admin']))  {
?>
<?php

    include("Funciones.php");
    //Realizamos la conexión a la bbdd 
    $conexion=ConecxionBBDD ();
    $id = $_GET["CodigoProfesor"]; 
    //Si la conexión con la base de datos falla informamos del error. 
    if ($conexion == false){
        mysqli_connect_error();
    }

    //Si la conexión es correcta, ejecutamos la siguiente parte de código
    else{
        //Llamamos a la función mostrar y borrar pasándole las id de los empleados y la conexión a la bbdd
        ActivarProfesor($id,$conexion);
        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=http://localhost/InfoBDN/ProfesoresAdmin.php"/>
        <?php
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
