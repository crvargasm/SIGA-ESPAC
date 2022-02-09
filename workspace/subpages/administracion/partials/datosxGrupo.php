<?php
$parroquia = $_POST['parroquia'] ?? '';
$ID = $_GET['p$b423scer34432yi$unj123'] ?? '';
echo "<select class='qwert' id='lista2' tabindex='10'  name='lista2'>";

if ($ID != -1) {
  require '../../../database.php';
  $resultao = $conn->query("SELECT * FROM infoCatequista WHERE idCatequista='$ID'");
  $aux = $resultao->fetch_object();
  echo '<option selected="" value="' . $aux->GrupoTrabajo_idGrupo . '">' . $aux->nombreGrupo . '</option>';
  mysqli_close($conn);
} else {
  echo '<option disabled selected="" value=0>Seleccione el Grupo:</option>';
}

require '../../../database.php';
$resultado = $conn->query("SELECT * FROM grupotrabajo WHERE Parroquia_idParroquia='$parroquia' AND estadoGrupo=1");
$numerofilas = $resultado->num_rows;
for ($ir = 0; $ir < $numerofilas; $ir++) {
  $auxilio = $resultado->fetch_object();
  echo '<option value="' . $auxilio->idGrupo . '">' . $auxilio->nombreGrupo . '</option>';
}
mysqli_close($conn);
echo "</select>";
