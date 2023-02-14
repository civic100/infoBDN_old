<?php
session_start();
?>

<?php
if(!empty ($_SESSION['dni'])||($_SESSION['admin'])||($_SESSION['dniprofesor']))  {
    session_destroy(); //Se destruye la sesión creada
?>
    <!--Nos redirige a la pagina principal. -->
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=http://localhost/InfoBDN/Login.php"/>
<?php
}else{
    print("Has d'esta validat per veure aquesta pàgina");
?>
    <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=http://localhost/InfoBDN/Login.php"/>
<?php
}
?>
