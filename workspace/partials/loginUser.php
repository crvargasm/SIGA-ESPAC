<?php
try {
    require "../database.php";     //Incorporamos el código para consultas Delete
    $usuario = $_POST['user'] ?? '';     //Extraemos del serializado el valor de la variable
    $contrasena = $_POST['password'] ?? '';     //Extraemos del serializado el valor de la variable

    //Preparamos la consulta y la realizamos
    $result = $conn->query("SELECT * from usuarios 
                                WHERE username='$usuario';");
    $numfilas = $result->num_rows;
    if ($numfilas == 0) {

        $_SESSION = array();

        echo 0; //Indica que no existe el Usuario
    } else {
        $fetch = $result->fetch_object();
        if (password_verify($contrasena, $fetch->password)) {
            session_start();
            $_SESSION['idUser'] = $fetch->idUsuario;
            $_SESSION['user'] = $fetch->username;
            $_SESSION['nombre'] = $fetch->nombreUsuario;
            $_SESSION['apellido'] = $fetch->apellidoUsuario;

            echo 1; //Indica que el usuario se autenticó correctamente
        } else {
            $_SESSION = array();
            echo 9; //Indica que existe el usuario pero la contraseña es incorrecta
        }
    }
    mysqli_close($conn);    //Finalizamos la conexión
} catch (Exception $e) {
    $_SESSION = array();
    echo $e;
    //echo 2;         //Flag para indicar que ocurrió un error durante la consulta
}
