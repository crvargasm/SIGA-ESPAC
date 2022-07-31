<?php
function vacio($e)
{
    if ($e == "") {
        return true;
    }
    return false;
}

try {
    $idGrupo = $_POST['idGrupo'] ?? '';     //Extraemos del serializado el valor de la variable

    require '../../database.php';
    $result = $conn->query("SELECT * FROM catequista WHERE GrupoTrabajo_idGrupo = '$idGrupo';");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) $array[] = $row;
    $json = json_encode($array ?? '');
    echo $json;
} catch (Exception $e) {
    echo '-error';
    //echo $e;
}
