<?php
$numfilas = $_POST['numfilas'] ?? '';
for ($i = 0; $i < $numfilas; $i++) {
    $A = $_POST['A' . $i . ''] ?? '';
    $A_E = $_POST['A-E' . $i . ''] ?? '';
    $P = $_POST['P' . $i . ''] ?? '';
    $L = $_POST['L' . $i . ''] ?? '';
    $C_A = $_POST['C-A' . $i . ''] ?? '';
    $idCalificacion = $_POST['idCalificacion' . $i . ''] ?? '';
    require '../../../database.php';
    $result = $conn->query("UPDATE calificacionesAptitudinales 
                                SET asistencia = '$A', 
                                    autoevaluacion = '$A_E', 
                                    practica = '$P', 
                                    liderazgo = '$L', 
                                    compromisoApos = '$C_A' 
                                WHERE idCalificacion = '$idCalificacion';");
}
echo 1;
?>