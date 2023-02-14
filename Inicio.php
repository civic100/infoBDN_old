<?php
session_start();
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
            <div class="txt-logo">InfoBDN</div>
            <div><img src="adhesivo-badamoni.jpg" alt=""></div>

            <div>
                <nav>
                    <ul>
                        <li><a href="http://localhost/InfoBDN/Home.php">Home</a></li>
                        <li><a href="http://localhost/InfoBDN/MostrarProfesores.php">Profesores</a></li>
                        <li><a href="http://localhost/InfoBDN/MostrarCursos.php">Cursos</a></l>
                        <li><a href="http://localhost/InfoBDN/Login.php">Login</a></li>
                        <li><a href="http://localhost/InfoBDN/RegistroUsuarios.php">Registrarte</a></li>
                    </ul>
                </nav>
            </div>
        </header>

<?php
if(!empty ($_SESSION['dni']))  {
?>

<h2>Portal del Alumne</h2>
<a href='DarAlta.php'>Donar-se d’alta als cursos disponibles</a><br>
<a href='DarBaja.php'>Donar-se de baixa dels cursos</a><br>
<a href='Llista.php'>llistat dels cursos</a><br>
<a href='Sortir.php'>Sortir</a><br>

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