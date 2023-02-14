<?php
session_start();

if(!empty ($_SESSION['dni'])) {

    include("Funciones.php");
    //Realizamos la conexión a la bbdd 
    $conexion=ConecxionBBDD ();
    $idCurso = $_GET["CodigoCurso"]; 
    $idAlumno= $_SESSION['dni'];
    //Si la conexión con la base de datos falla informamos del error. 
    if ($conexion == false){
        mysqli_connect_error();
    }

    //Si la conexión es correcta, ejecutamos la siguiente parte de código
    else{
        //Llamamos a la función mostrar y borrar pasándole las id de los empleados y la conexión a la bbdd
       DesactivarCurso($idAlumno,$idCurso,$conexion);
        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=http://localhost/InfoBDN/Mostrar-MisCursos.php"/>
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