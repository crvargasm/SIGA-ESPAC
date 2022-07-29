<?php
function vacio($e)
{
    if ($e == "") {
        return true;
    }
    return false;
}

try {
    $apellidoCatequista = $_POST['apellidoCatequista'] ?? '';     //Extraemos del serializado el valor de la variable
    $cedulaCatequista = $_POST['cedulaCatequista'] ?? '';     //Extraemos del serializado el valor de la variable
    $parroquia = $_POST['parroquia'] ?? 0;     //Extraemos del serializado el valor de la variable

    require '../../database.php';
    if (vacio($apellidoCatequista) && vacio($cedulaCatequista) && $parroquia == 0) {  //Verifica que NO este Vacia La Consulta
        //die('<br><b>Por favor ingrese un Parámetro de Busqueda</b></br>');
    } else {
        if (!vacio($apellidoCatequista) && vacio($cedulaCatequista) && $parroquia == 0) {  //Verifica SOLO Primer Apellido
            $result = $conn->query("SELECT * FROM infoCatequista WHERE (apellidoCatequista LIKE '$apellidoCatequista%' OR apellido2Catequista LIKE '$apellidoCatequista%')");
        }
        if (vacio($apellidoCatequista) && !vacio($cedulaCatequista) && $parroquia == 0) {  //Verifica SOLO ID del Catequista
            $result = $conn->query("SELECT * FROM infoCatequista WHERE cedulaCiudadania='$cedulaCatequista';");
        }
        if (vacio($apellidoCatequista) && vacio($cedulaCatequista) && $parroquia != 0) {  //Verfica SOLO Parroquia Catequista
            $result = $conn->query("SELECT * FROM infoCatequista WHERE parroquiaCatequista='$parroquia';");
        }
        if (!vacio($apellidoCatequista) && !vacio($cedulaCatequista) && $parroquia == 0) { //Verifica Primer Apellido y ID
            $result = $conn->query("SELECT * FROM infoCatequista WHERE cedulaCiudadania='$cedulaCatequista' AND (apellidoCatequista LIKE '$apellidoCatequista%' OR apellido2Catequista LIKE '$apellidoCatequista%')");
        }
        if (vacio($apellidoCatequista) && !vacio($cedulaCatequista) && $parroquia != 0) { //Verifica ID y Parroquia
            $result = $conn->query("SELECT * FROM infoCatequista WHERE cedulaCiudadania='$cedulaCatequista' AND parroquiaCatequista='$parroquia';");
        }
        if (!vacio($apellidoCatequista) && vacio($cedulaCatequista) && $parroquia != 0) {  //Verifica Primer Apellido y Parroquia
            $result = $conn->query("SELECT * FROM infoCatequista WHERE parroquiaCatequista='$parroquia' AND (apellidoCatequista LIKE '$apellidoCatequista%' OR apellido2Catequista LIKE '$apellidoCatequista%');");
        }
        if (!vacio($apellidoCatequista) && !vacio($cedulaCatequista) && $parroquia != 0) {  //Verifica TODOS
            $result = $conn->query("SELECT * FROM infoCatequista WHERE cedulaCiudadania='$cedulaCatequista' AND parroquiaCatequista='$parroquia' AND (apellidoCatequista LIKE '$apellidoCatequista%' OR apellido2Catequista LIKE '$apellidoCatequista%');");
        }
    }

    // $result = $conn->query("SELECT * FROM infoCatequista WHERE (apellidoCatequista LIKE '$apellidoCatequista') OR (apellido2Catequista LIKE '$apellidoCatequista') OR (cedulaCiudadania='$cedulaCatequista') OR (parroquiaCatequista='$parroquia')");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) $array[] = $row;
    $json = json_encode($array ?? '');
    echo $json;
} catch (Exception $e) {
    echo '-error';
    //echo $e;
}
