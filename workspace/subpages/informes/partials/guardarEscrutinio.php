<?php
$numfilas = $_POST['numfilas'] ?? '';

for ($i = 0; $i < $numfilas; $i++) {
    $E = $_POST['check' . $i . ''] ?? '';
    if (empty($E)) {
        $E = 0;
        continue;
    }

    $fecha = $_POST['fecha'] ?? '';
    $ID = $_POST['idCatequista' . $i . ''] ?? '';
    $Etapa = $_POST['etapaSeleccionada'] ?? '';

    require '../../../database.php';
    $result = $conn->query("UPDATE EtapaxEstudiante 
                                SET     fechaEscrutinio = '$fecha' 
                                WHERE   Catequista_idCatequista = '$ID' AND
                                        Etapa_idEtapa = '$Etapa'");
}
echo 1;
