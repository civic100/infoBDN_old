<?php
/*
*
generar barra de menu
*
*/
function  Generarmenu(){
    ?>
    <div class="txt-logo">InfoBDN</div>
    <div><img class="img-logo" src="adhesivo-badamoni.jpg" alt=""></div>
    <?php
    // Menú para alumnos
    if(!empty ($_SESSION['dni'])){
    ?>
    <div>
        <nav>
            <ul>
                <li><a href="http://localhost/InfoBDN/Home.php">Home</a></li>
                <li><a href="http://localhost/InfoBDN/MostrarProfesores.php">Profesores</a></li>
                <li><a href="http://localhost/InfoBDN/Mostrar-MisCursos.php">Mis Cursos</a></li>
                <li><a href="http://localhost/InfoBDN/Salir.php">Salir</a></li>
                <li> <?php echo($_SESSION['nombre']) ; ?> </li>
                <li> <?php echo( "<img class='img-sesion' src=". $_SESSION['imagen'].">" ) ;?> </li>
            </ul>
        </nav>
    </div>
   
    <?php
    // Menú para profesores
    }elseif(!empty ($_SESSION['dniprofesor'])){
    ?>
    <div>
        <nav>
            <ul>
                <li><a href="http://localhost/InfoBDN/Home.php">Home</a></li>
                <li><a href="http://localhost/InfoBDN/EvaluacionesAlumnos.php">Evaluaciones</a></li>
                <li><a href="http://localhost/InfoBDN/Salir.php">Salir</a></li>
                <li> <?php echo($_SESSION['nombre']) ; ?> </li>
                <li> <?php echo( "<img class='img-sesion' src=". $_SESSION['imagen'].">" ) ;?> </li>
            </ul>
        </nav>
    </div>

    <?php
      // Menú para Admin
        }elseif(!empty ($_SESSION['admin'])){
            ?>
            <div>
                <nav>
                    <ul>
                        <li><a href="http://localhost/InfoBDN/InicioAdmin.php">Inicio</a></li>
                        <li><a href="http://localhost/InfoBDN/CursosAdmin.php">Cursos</a></li>
                        <li><a href="http://localhost/InfoBDN/ProfesoresAdmin.php">Profesores</a></li>
                        <li><a href="http://localhost/InfoBDN/Salir.php">Salir</a></li>
                    </ul>
                </nav>
            </div>
            <?php
    // Menú para usuarios no registrados/logeados.
    }else{
    ?>
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
    <?php
    }
}
?>


<?php
/*
*
Conexión a la base de datos.
*
*/
function ConecxionBBDD (){
     $conexion = mysqli_connect("localhost","root","","infobdn");
    return $conexion; 
}

/*
*
Validar el inicio de sesión del usuario Admin.
*
*/
function ValidarLoginAdmin($conexion,$dni,$pas){
    //En la siguiente consulta comprobamos los datos introducidos en la bbdd del usuario Admin.
    $sql = "SELECT * FROM administrador WHERE dni = '$dni' AND contraseña = '$pas'";
    $consulta = mysqli_query($conexion, $sql);

    //Si son correctos ejecuta esta parte de código redireccionado a la página de edición del Admin.
    if(mysqli_num_rows($consulta)>0){
        //Generamos la variable de sesión de Admin.
        $_SESSION['admin'] = $dni;
        ?>  
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=http://localhost/InfoBDN/InicioAdmin.php"/>
        <?php

    //En caso contrario ejecutamos esta parte del código recargando la página
    }else{
        print("Contraseña o correo electrónico erróneos");
        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=http://localhost/InfoBDN/LoginAdmin.php"/>
        <?php
        }
        mysqli_close($conexion);
    }

/*
*
Tabla de los cursos en la página de Admin
*
*/   
function generarTablaCursos($consulta){
    //función para contar las filas generadas por la consulta
    $numlinies = mysqli_num_rows($consulta);
    echo ("Hi ha ".$numlinies." Cursos");
    echo"<table>";
    echo "<tr>";
    echo"<th>Eliminar</th>";
    echo"<th>Editar</th>";
    echo"<th>Codi</th>";
    echo"<th>Nombre</th>";
    echo "<th>descripcio</th>";
    echo "<th>horadurada</th>";
    echo "<th>datainici</th>";
    echo "<th>datafi</th>";
    echo "<th>profesor</th>";
    echo "<th>Activo</th>";
    echo "</tr>";
    foreach($consulta as $curso => $campo){
        //Guardamos en la variable CodiCurso el código del curso para su posterior uso.
        $CodiCurso=$campo["codigo"];
        echo "<tr>";

        //Comprobamos por el campo activo de la base de datos, si este está a 1 o 0 dependiendo de este valor se mostrará la opción de activarlo o desactivarlo
        if($campo['activo']=='0'){ echo "<td> <a href=ActivarCursos.php?CodigoCurso=$CodiCurso>Activar</a></td>"; } 
        else{ echo "<td> <a href=EliminarCursos.php?CodigoCurso=$CodiCurso>Desactivar</a></td>"; }

        //Mostramos la opción de editar el curso pasándole la variable anteriormente guardada.
        echo "<td> <a href=EditarCursos.php?CodigoCurso=$CodiCurso>Editar</a></td>";
        
        //Imprimimos todos los datos de los empleados 
        foreach($campo as $dato){
            echo "<td> $dato </td>";
        }
    }
    echo "</tr>";
    echo"</table>";   
    echo "</br>";
   
}

/*
*
Código para desactivar el curso seleccionado.
*
*/   
function EliminarCursos($id,$conexion){
    //Actualizamos el valor del campo activo de la base de datos a 0.
    $sql = "UPDATE cursos SET activo = '0' WHERE codigo = '$id'";
    $activo = mysqli_query($conexion, $sql);
}
/*
*
Código para activar el curso seleccionado.
*
*/  
function ActivarCursos($id,$conexion){
    //Actualizamos el valor del campo activo de la base de datos a 1.
    $sql = "UPDATE cursos SET activo = '1' WHERE codigo = '$id'";
    $activo = mysqli_query($conexion, $sql);
}

/*
*
Añadir Curso.
*
*/ 
function AñadirCurso($conexion,$NombreCurso,$Descripcion,$duracion,$fechaincio, $fechafin ,$profesor){
    $sql = "SELECT * FROM cursos WHERE nombre = '$NombreCurso'";
    $consulta = mysqli_query($conexion, $sql);

    //Comprobamos si el curso ya está en la base de datos, en caso de que este ejecutamos el código dentro del if.
    if(mysqli_num_rows($consulta)>0){
        print("Este Curso ya esta registrado.");
        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=http://localhost/InfoBDN/AñadirCurso.php"/>
        <?php  
    //Si es un nuevo curso ejecutamos esta parte del código.         
    }else{
        $sql = "INSERT INTO cursos (codigo, nombre, descripcion, horas, fechainicio, fechafinal, profesor) VALUES ('NULL','$NombreCurso', '$Descripcion', '$duracion', '$fechaincio', '$fechafin', '$profesor')";
        //Controlamos que se guarde correctamente.
        if (mysqli_query($conexion, $sql)) {
            echo "Nuevo Curso registrado";
            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=http://localhost/InfoBDN/CursosAdmin.php"/>
            <?php
        } else {mysqli_connect_errno();}
            //Y al terminar el registro del curso redirigimos a la misma página para continuar.
    }
    mysqli_close($conexion);
}

/*
*
Editar Curso.
*
*/ 
function EditarCurso($id,$conexion,$codigo,$NombreCurso,$Descripcion,$duracion,$fechaincio, $fechafin ,$profesor){ 
    //Se realiza un update con los valores pasados
    $sql = "UPDATE cursos SET codigo = '$codigo', nombre = '$NombreCurso', descripcion = '$Descripcion' , horas = '$duracion', fechainicio = '$fechaincio', fechafinal = '$fechafin', profesor ='$profesor' WHERE codigo = '$id' ";
    //Y al terminar el registro del curso redirigimos a la misma página para continuar.
    if (mysqli_query($conexion, $sql)) {
        echo "Nuevo Curso actualizado";
        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=http://localhost/InfoBDN/CursosAdmin.php"/>
        <?php
    } else { mysqli_connect_errno(); }
    mysqli_close($conexion);
}

/*
*
Tabla de los profesores en la página de Admin
*
*/ 
function generarTablaProfesores($consulta){
    $numlinies = mysqli_num_rows($consulta); 
    echo ("Hi ha ".$numlinies." Profesors");
    echo"<table>";
    echo "<tr>";
    echo"<th>Eliminar</th>";
    echo"<th>Editar</th>";
    echo"<th>DNI</th>";
    echo"<th>Nombre</th>";
    echo "<th>Apellido</th>";
    echo "<th>Titol academic</th>";
    echo "<th>Foto</th>";
    echo "<th>Contraseña</th>";
    echo "<th>Activo</th>";
    echo "</tr>";
    foreach($consulta as $persona => $campo){
        $CodiProfesor=$campo["dni"];
        echo "<tr>";
        if($campo['activo']=='0'){
            echo "<td> <a href=ActivarProfesor.php?CodigoProfesor=$CodiProfesor>Activar</a></td>";
        } 
        else{
            echo "<td> <a href=EliminarProfesor.php?CodigoProfesor=$CodiProfesor>Desactivar</a></td>";
        }    
        echo "<td> <a href=EditarProfesor.php?CodigoProfesor=$CodiProfesor>Editar</a></td>";

        foreach($campo as $dato => $dato1){
            if($campo['foto']==$dato1){
                echo "<td> <img width='50' height='50' src=".$dato1."></td>";
            }else{
                echo "<td> $dato1 </td>";
            }
        }
    }
    echo "</tr>";
    echo"</table>";   
    echo "</br>";
    
}


/*
*
Añadir Profesor.
*
*/ 
function AñadirProfesor($conexion,$DniProfesor,$NombreProfe,$ApellidoProfe,$Tituloacademico, $nombreDirectorio ,$pasencript){
    $sql = "SELECT * FROM alumnos WHERE dni = '$DniProfesor'";     
    $sql2 = "SELECT * FROM profesores WHERE dni = '$DniProfesor'";
    $consulta2 = mysqli_query($conexion, $sql2);    
    $consulta = mysqli_query($conexion, $sql);

    if(mysqli_num_rows($consulta)>0 || mysqli_num_rows($consulta2)>0 ){
        print("Este Dni ya esta registrado.");
        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=http://localhost/InfoBDN/RegistroUsuarios.php"/>
        <?php                  
    }else{
        $sql = "INSERT INTO profesores (dni, nombre, apellido, tituloacademico, foto, contraseña) VALUES ('$DniProfesor', '$NombreProfe', '$ApellidoProfe', '$Tituloacademico', '$nombreDirectorio', '$pasencript')";
        if (mysqli_query($conexion, $sql)) {
            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=http://localhost/InfoBDN/ProfesoresAdmin.php"/>
            <?php   
        } else { mysqli_connect_errno(); }
    }
    mysqli_close($conexion);  
}

/*
*
Código para desactivar el profesor seleccionado.
*
*/  
function EliminarProfesores($id,$conexion){
    $sql = "UPDATE profesores SET activo = '0' WHERE dni = '$id'";
    $consulta = mysqli_query($conexion, $sql);
    $sql2 = "UPDATE cursos SET activo = '0' WHERE profesor = '$id'";
    $consulta2 = mysqli_query($conexion, $sql2);
}

/*
*
Código para activar el profesor seleccionado.
*
*/  
function ActivarProfesor($id,$conexion){
    $sql = "UPDATE profesores SET activo = '1' WHERE dni = '$id'";
    $consulta = mysqli_query($conexion, $sql);
}
    
/*
*
Editar Profesor.
*
*/
function EditarProfesor($conexion,$DniProfesor,$NombreProfe,$ApellidoProfe,$Tituloacademico, $Foto ,$ContraseñaProfesor){  
    $sql = "UPDATE profesores SET nombre = '$NombreProfe', apellido = '$ApellidoProfe' , tituloacademico = '$Tituloacademico', foto = '$Foto', contraseña = '$ContraseñaProfesor' WHERE dni = '$DniProfesor' ";
    if (mysqli_query($conexion, $sql)) {
        echo "Nuevo Curso editado";
        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=http://localhost/InfoBDN/ProfesoresAdmin.php"/>
        <?php
    } else { mysqli_connect_errno(); }
    mysqli_close($conexion);
}


/*
*
Validar LoginAlumnos/LoginProfesores.
*
*/
function ValidarLogin($conexion,$dni,$pas){
    //En la siguente consulta comprobamos los datos introducidos en la bbdd.
    $sql = "SELECT * FROM alumnos WHERE dni = '$dni' AND contraseña = '$pas'";
    $consulta = mysqli_query($conexion, $sql);
    
    //si son correctos ejecuta esta parte del código
    if(mysqli_num_rows($consulta)>0){
        //una vez validado generamos la sesion.
        $_SESSION['dni'] = $dni;
        while ($row = $consulta->fetch_assoc()) {
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['imagen'] = $row['foto'];
        }
        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=http://localhost/InfoBDN/Home.php"/>
        <?php
    //si no son correctos ejecuta esta parte del código y asi comprarlo en la tabla profesores.
    }else{   
        $sql2 = "SELECT * FROM profesores WHERE dni = '$dni' AND contraseña = '$pas'";
        $consulta2 = mysqli_query($conexion, $sql2);
        if(mysqli_num_rows($consulta2)>0){
            //una vez validado generamos la sesion.
            $_SESSION['dniprofesor'] = $dni;
            while ($row = $consulta2->fetch_assoc()) {
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['imagen'] = $row['foto'];
            }
            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=http://localhost/InfoBDN/Home.php"/>
            <?php
        }else{
            print("Contraseña o correo electrónico erróneos");
            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=http://localhost/InfoBDN/Login.php"/>
            <?php
            mysqli_close($conexion);
        }
    }
}

/*
*
Validar Regsitro.
*
*/
function ValidarRegistro($conexion,$dni,$pasencript,$Nom,$Cognoms,$directorio,$Edat){
        // comprobamos que no exista en ninguna de las dos tablas.
        $sql = "SELECT * FROM alumnos WHERE dni = '$dni'";     
        $sql2 = "SELECT * FROM profesores WHERE dni = '$dni'";
        $consulta2 = mysqli_query($conexion, $sql2);    
        $consulta = mysqli_query($conexion, $sql);

        if(mysqli_num_rows($consulta)>0 || mysqli_num_rows($consulta2)>0 ){
            print("Este Dni ya esta registrado.");
            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=http://localhost/InfoBDN/RegistroUsuarios.php"/>
            <?php              
        }else{
            //Si el correo no está registrado, hacemos un insert de los datos introducidos a la base de datos
            $sql = "INSERT INTO alumnos (dni, nombre, apellido, edad, foto, contraseña) VALUES ('$dni', '$Nom', '$Cognoms',' $Edat','$directorio','$pasencript')";
            //Controlamos que se guarde correctamente.
            if (mysqli_query($conexion, $sql)) {
                    echo "Nuevo Alumno registrado";
                    //una vez validado generamos la sesion.
            } else {
                mysqli_connect_errno();
            }
            //y al terminar el registro redirigimos a la página del menú del portal.
            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=http://localhost/InfoBDN/Login.php"/>
            <?php
            }
        mysqli_close($conexion);
    }

/*
*
Editar Profesor.
*
*/
function generarTablaProfesores2($consulta){
    //Mostramos la tabla con los empleados actuales
    
    foreach($consulta as $persona => $campo){
        echo"<table>";
        echo "<tr>";
        echo "<tr>";
        if($campo['activo']=='1'){
            //Imprimimos los profesores activos.
            echo "<td> <img width='50' height='50' src=". $campo['foto'].">".$campo['nombre'] .' '.$campo['apellido']."</td>";
            /*echo "<td>" .$campo['nombre'] ."</td>";
            echo "<td>". $campo['apellido']. "</td>";*/
        }
        echo "</tr>";
         echo"</table>"; 
    }
    
}

/*
*
Editar Profesor.
*
*/
function  GenerarTablaCursosHome($consulta){
    //Mostramos la tabla con los empleados actuales
    
    foreach($consulta as $persona => $campo){
    echo"<table>";
    echo "<tr>";
        echo "<tr>";
        if($campo['activo']=='1'){
            //Imprimimos los profesores activos.
               /* echo "<td> <img width='50' height='50' src=". $campo['foto'] ."</td>";*/
                echo "</br>";
                echo "<td>" .$campo['nombre'] ."</td>";
                echo "<td>". $campo['descripcion']. "</td>";
                echo "<td>". $campo['fechainicio']. "</td>";
                echo "<td>". $campo['fechafinal']. "</td>";

                $CodiCurso=$campo["codigo"];
                echo "<tr>";
                echo "<td> <a href=DarAltaCursoUsu.php?CodigoCurso=$CodiCurso>Darme de alta</a></td>"; } 
            }
    echo "</tr>";
    echo"</table>";   
    
}
      
    
/*
*
DarAltaCursos
*
*/
function  DarAltaCurso($idAlumno,$idCurso,$conexion){
    //Actualizamos el valor del campo activo de la base de datos a 1.
    $activo = '1';
    $sql = "INSERT matricula (dni_alumno, curso, nota, activo) VALUES ('$idAlumno','$idCurso','',' $activo')";
    $a = mysqli_query($conexion, $sql);
}
/*
*
DarAltaCursos
*
*/
function DesactivarCurso($idAlumno,$idCurso,$conexion){
    //Actualizamos el valor del campo activo de la base de datos a 1.
    $sql = "DELETE * FROM  matricula WHERE dni_alumno = '$idAlumno' AND curso = '$idCurso'";
    $a = mysqli_query($conexion, $sql);
}
/*
*
DarAltaCursos
*
*/
function  GenerarTablaMisCursos($conexion,$consulta){
    //Mostramos la tabla con los empleados actuales
    
    foreach($consulta as $persona => $campo){
        echo"<table>";
        echo "<tr>";
        echo"<th>Curso</th>";
        echo"<th>Nota</th>";
        echo"<th>Opcion</th>";
        echo "<tr>";
     
            //Imprimimos los profesores activos.
            /* echo "<td> <img width='50' height='50' src=". $campo['foto'] ."</td>";*/
            echo "</br>";
            $idcurso=$campo['curso'];
            $sql="SELECT nombre FROM cursos WHERE codigo = $idcurso ";
            $consulta = mysqli_query($conexion, $sql);
              
            while($fila=mysqli_fetch_array($consulta)){
                echo "<td>" .$fila['nombre'] ."</td>";
            }
                
            echo "<td>". $campo['nota']. "</td>";

            $CodiCurso=$campo["dni_alumno"];
            if($campo['activo']=='0'){
                echo "<td> <a href=ActivarCurso.php?CodigoCurso=$CodiCurso>Darme de alta</a></td>"; 
            } 
            else{
                echo "<td> <a href=DarbajaCursoUsu.php?CodigoCurso=$CodiCurso>Desmatricular</a></td>";
            }    
            
        echo "</tr>";
        echo"</table>";   
    }
}

function GenerarTablaEvaluacionesProfesor($conexion,$consulta){
 
    foreach($consulta as $persona => $campo){
        echo"<table>";
        echo "<tr>";
        echo"<th>Curso</th>";
        echo"<th>Nota</th>";
        echo"<th>Opcion</th>";
        echo "<tr>";
        if($campo['activo']=='1'){
            echo "</br>";
            $idcurso=$campo['curso'];
            $sql="SELECT nombre FROM cursos WHERE codigo = $idcurso ";
            $consulta = mysqli_query($conexion, $sql);
              
            while($fila=mysqli_fetch_array($consulta)){
                echo "<td>" .$fila['nombre'] ."</td>";
            }
            echo "<td>". $campo['nota']. "</td>";
            $nota=$campo['nota'];
            echo "<td> <a href=#?CodigoProfesor=$nota>Poner Nota</a></td>";    
            }
        echo "</tr>";
        echo"</table>";   
    }
       
       
}