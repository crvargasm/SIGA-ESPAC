<?php
function vacio($e)
{
    if ($e == "") {
        return true;
    }
    return false;
}

try {
    $parroquia = $_POST['parroquia'] ?? 0;     //Extraemos del serializado el valor de la variable

    require '../../database.php';
    if ($parroquia == 0) {  //Verifica que NO este Vacia La Consulta
        // $result = $conn->query("SELECT * FROM infoGrupo");
    } elseif ($parroquia != 0) {  //Verifica La parroquia
        $result = $conn->query("SELECT * FROM infoGrupo WHERE Parroquia_idParroquia='$parroquia'");
    }

    // $result = $conn->query("SELECT * FROM infoCatequista WHERE (apellidoCatequista LIKE '$apellidoCatequista') OR (apellido2Catequista LIKE '$apellidoCatequista') OR (cedulaCiudadania='$cedulaCatequista') OR (parroquiaCatequista='$parroquia')");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) $array[] = $row;
    $json = json_encode($array ?? '');
    echo $json;
} catch (Exception $e) {
    echo '-error';
    //echo $e;
}
