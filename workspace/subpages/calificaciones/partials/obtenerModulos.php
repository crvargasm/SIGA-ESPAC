<?php
$etapa = $_POST['etapa'] ?? '';
$ID = $_GET['p$b423scer34432yi$unj123'];
echo "<select id='lista2' name='lista2' class='custom-select custom-select-sm'>";
echo "<option selected disabled value=0>Seleccione el Modulo:</option>";

require '../../../database.php';
$resultao = $conn->query("SELECT * FROM infoGrupo WHERE idGrupo='$ID'");
$aux = $resultao->fetch_object();
$numerofilas = $resultao->num_rows;
mysqli_close($conn);

$moduloActual = $aux->moduloActual;
if($numerofilas==0){
  echo '<option disable value="-1">Error</option>';
  die();
}
if ($moduloActual != 0) {
  require '../../../database.php';
  $resultado = $conn->query("SELECT * FROM modulo WHERE Etapa_idEtapa = $etapa AND idModulo<='$moduloActual'");
  $numerofilas = $resultado->num_rows;
  for ($ir = 0; $ir < $numerofilas; $ir++) {
    $auxilio = $resultado->fetch_object();
    echo '<option value="' . $auxilio->idModulo . '">' . $auxilio->identificadorESPAC . ' - ' . $auxilio->nombreModulo . '</option>';
  }
  mysqli_close($conn);
} else {
  echo '<option disabled selected="" value=0>Sin Modulos Registrados:</option>';
}
echo "</select>";
