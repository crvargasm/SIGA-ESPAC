<?php
$ID = $_GET['p$b423scer34432yi$unj123'];
require '../../../database.php';
$result = $conn->query("SELECT * FROM catequista WHERE habilitarAcademia = true AND estadoCatequista = true AND GrupoTrabajo_idGrupo = '$ID';");
$numfilas = $result->num_rows;
mysqli_close($conn);
if ($numfilas > 0) {
    for ($i = 0; $i < $numfilas; $i++) {
        $aux = $result->fetch_object();
        require '../../../database.php';
        $ins = $conn->query("INSERT INTO EtapaxEstudiante (Catequista_idCatequista, Etapa_idEtapa) 
                                    VALUES ('$aux->idCatequista', '1');");
        mysqli_close($conn);

        require '../../../database.php';
        $resulta = $conn->query("SELECT * FROM EtapaxEstudiante WHERE Catequista_idCatequista = '$aux->idCatequista' AND Etapa_idEtapa = '1';");
        $auxi = $resulta->fetch_object();
        mysqli_close($conn);

        require '../../../database.php';
        $ins = $conn->query("INSERT INTO calificacionesAptitudinales (`Etapa_id_EtapaxEstudiante`, `Modulo_idModulo`) 
                                    VALUES ('$auxi->id_EtapaxEstudiante', '1');");
        mysqli_close($conn);
    }

    require '../../../database.php';
    $upd = $conn->query("UPDATE grupotrabajo 
                            SET moduloActual = '1' 
                            WHERE (idGrupo = '$ID');");
    mysqli_close($conn);
    echo 1;
} else {
?>
    <script>
        alert("El grupo seleccionado no tiene estudiantes Habilitados para tener Historia Académica");
    </script>
<?php
}
