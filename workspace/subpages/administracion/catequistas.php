<?php require '../../partials/verifySession.php';
if (empty($_GET)) {
  header('Location: index.php');
} elseif ($_GET['a!¡v02ds3ass334de$?!!'] != 1) {
  header('Location: index.php');
}
$ID = $_GET['p$b423scer34432yi$unj1232asds34da34shs!???'];    //ID Catequista
$ver = $_GET['a!¡v02ds3ass334de$?!!'];   //Verificador Unico de Privacidad IntraWEB
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Sistema Integral de Gestión Académica</title>
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="../../images/SIGA.ico">
  <link rel="stylesheet" href="../../assets/css/stylePage.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>

<body>
  <div id="auxPage">
    <div class="headerAux">
      <div class="textname">
        <p>SISTEMA INTEGRAL DE GESTIÓN ACADÉMICA</p>
      </div>
      <div class="separator"></div>
      <img src="../../images/SIGA.ico" alt="sigaEspac.ico">
    </div>
    <div id="editForm">
      <?php require '../../database.php';
      $result = $conn->query("SELECT * FROM infoCatequista WHERE idCatequista=$ID;");
      $numfilas = $result->num_rows;
      $aux = $result->fetch_object();
      mysqli_close($conn);
      ?>
      <h4>Bienvenido al Asistente para la Actualización de Datos</h4>
      <span>Modifique los datos necesarios y presione 'Guardar Cambios', de lo contrario 'Cancelar':</span>
      <form action="catequistas.php?p$b423scer34432yi$unj1232asds34da34shs!???=<?php echo $ID; ?>&a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" method="POST">
        <div class="fila">
          <span>Identificación Catequista:</span>
          <input type="text" name="id" tabindex="1" value="<?php echo $aux->cedulaCiudadania; ?>">
          <span>Primer Nombre Catequista:</span>
          <input type="text" name="nom1" tabindex="3" value="<?php echo $aux->nombreCatequista; ?>">
          <span>Primer Apellido Catequista:</span>
          <input type="text" name="ape1" tabindex="5" value="<?php echo $aux->apellidoCatequista; ?>">
          <span>Dirección Catequista:</span>
          <input type="text" name="dir" tabindex="7" value="<?php echo $aux->direccionCatequista; ?>">
          <span>Teléfono Catequista:</span>
          <input type="text" name="tel" tabindex="9" value="<?php echo $aux->telefonoCatequista; ?>">
          <input type="checkbox" name="coordinador" value=1 <?php if ($aux->coordinadorHabilitar == 1) {
                                                              echo 'checked';
                                                            } ?>><span> Habilitar Coordinación</span></input>
        </div>
        <div class="fila">
          <span>Parroquia Catequista:</span>
          <select id="lista1" tabindex="2" name="lista1">
            <option selected value=<?php echo $aux->parroquiaCatequista; ?>><?php echo $aux->nombreParroquia; ?></option>
            <?php
            require '../../database.php';
            $resultado = $conn->query("SELECT idParroquia, nombreParroquia FROM parroquia");
            $numerofilas = $resultado->num_rows;
            for ($ir = 0; $ir < $numerofilas; $ir++) {
              $auxilio = $resultado->fetch_object();
              echo '<option value="' . $auxilio->idParroquia . '">' . $auxilio->nombreParroquia . '</option>';
            }
            mysqli_close($conn);
            ?>
          </select>
          <span>Segundo Nombre Catequista:</span>
          <input type="text" name="nom2" tabindex="4" value="<?php echo $aux->nombre2Catequista; ?>">
          <span>Segundo Apellido Catequista:</span>
          <input type="text" name="ape2" tabindex="6" value="<?php echo $aux->apellido2Catequista; ?>">
          <span>Ocupación Catequista:</span>
          <input type="text" name="ocu" tabindex="8" value="<?php echo $aux->ocupacionCatequista; ?>">
          <span>Grupo de Trabajo:</span>
          <div id="select2lista"></div>
          <input type="checkbox" name="academia" value=1 <?php if ($aux->habilitarAcademia == 1) {
                                                            echo 'checked';
                                                          } ?>><span> Habilitar Academia</span></input>
        </div>
        <input type="button" name="rst" onclick="window.close()" value="Cancelar">
        <?php
        $estado = $aux->estadoCatequista;
        if ($estado == 1) {
        ?><input type="submit" name="disable" value="Deshabilitar Catequista"><?php
                                                                            } elseif ($estado == 0) {
                                                                              ?><input type="submit" name="able" value="Habilitar Catequista"><?php
                                                                                                                                            }
                                                                                                                                              ?>
        <input type="submit" name="send" value="Guardar Cambios">
      </form>

      <?php
      //print_r($_POST);
      try {
        $disable = $_POST['disable'] ?? '';
      } catch (\Exception $e) {
      }
      try {
        $able = $_POST['able'] ?? '';
      } catch (\Exception $e) {
      }
      $send = $_POST['send'] ?? '';
      $id = $_POST['id'] ?? '';
      $nom1 = $_POST['nom1'] ?? '';
      $nom2 = $_POST['nom2'] ?? '';
      $ape1 = $_POST['ape1'] ?? '';
      $ape2 = $_POST['ape2'] ?? '';
      $parr = $_POST['lista1'] ?? '';
      $dir = $_POST['dir'] ?? '';
      $ocu = $_POST['ocu'] ?? '';
      $tel = $_POST['tel'] ?? '';
      $grupo = $_POST['lista2'] ?? '';
      $academi = $_POST['academia'] ?? '';      //Corregir error con CHECKBOXXXX
      if (empty($academi)) {
        $academi = 0;
      }
      $coor = $_POST['coordinador'] ?? '';
      if (empty($coor)) {
        $coor = 0;
      }
      if ($send && !empty($id) && !empty($nom1) && !empty($ape1) && !empty($parr) && !empty($dir) && !empty($ocu) && !empty($tel) && !empty($grupo)) {
        require '../../database.php';
        $result = $conn->query("UPDATE infoCatequista
                                  SET cedulaCiudadania='$id',
                                  nombreCatequista='$nom1',
                                  nombre2Catequista='$nom2',
                                  apellidoCatequista='$ape1',
                                  apellido2Catequista='$ape2',
                                  parroquiaCatequista='$parr',
                                  direccionCatequista='$dir',
                                  ocupacionCatequista='$ocu',
                                  telefonoCatequista='$tel',
                                  GrupoTrabajo_idGrupo='$grupo',
                                  coordinadorHabilitar='$coor',
                                  habilitarAcademia='$academi'
                                  WHERE idCatequista=$ID;");
        mysqli_close($conn);
        echo '<script type="text/javascript">window.close();</script>';
      } elseif ($send) {
        echo '<script type="text/javascript">window.alert("POR FAVOR INGRESE TODOS LOS CAMPOS");</script>';
      }

      //Habilitar o Deshabilitar Catequista
      require '../../database.php';
      if ($estado == 1 && $disable) {          //Inhabilitar
        $resulta = $conn->query("UPDATE infoCatequista
                                  SET estadoCatequista='0'
                                  WHERE idCatequista=$ID;");
        echo '<script type="text/javascript">window.close();</script>';
      } elseif ($estado == 0 && $able) {       //Habilitar
        $resulta = $conn->query("UPDATE infoCatequista
                                  SET estadoCatequista='1'
                                 WHERE idCatequista=$ID;");
        echo '<script type="text/javascript">window.close();</script>';
      }
      mysqli_close($conn);
      ?>
    </div>
  </div>
</body>

</html>

<script type="text/javascript">
  $(document).ready(function() {
    //$('#lista1').val(1);
    recargarLista();

    $('#lista1').change(function() {
      recargarLista();
    });
  })
</script>
<script type="text/javascript">
  function recargarLista() {
    $.ajax({
      type: "POST",
      url: "partials/datosxGrupo.php?p$b423scer34432yi$unj123=<?php echo $ID; ?>",
      data: "parroquia=" + $('#lista1').val(),
      success: function(r) {
        $('#select2lista').html(r);
      }
    });
  }
</script>