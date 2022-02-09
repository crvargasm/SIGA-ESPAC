<?php require '../../partials/verifySession.php';
if (empty($_GET)) {
  header('Location: ../index.php');
} elseif ($_GET['a!¡v02ds3ass334de$?!!'] != 1) {
  header('Location: ../index.php');
}
$ver = $_GET['a!¡v02ds3ass334de$?!!'];   //Verificador Unico de Privacidad IntraWEB
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>S.I.G.A. - E.S.P.A.C.</title>
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
      <h4>Bienvenido al Asistente para la Inserción de Datos</h4>
      <span>Inserte los datos necesarios y presione 'Guardar Cambios', de lo contrario 'Cancelar':</span>
      <form action="newCatequistas.php?a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" method="POST">
        <div class="fila">
          <span>Identificación Catequista:</span>
          <input type="text" autofocus tabindex="1" name="id" value="">
          <span>Primer Nombre Catequista:</span>
          <input type="text" tabindex="3" name="nom1" value="">
          <span>Primer Apellido Catequista:</span>
          <input type="text" tabindex="5" name="ape1" value="">
          <span>Dirección Catequista:</span>
          <input type="text" tabindex="7" name="dir" value="">
          <span>Teléfono Catequista:</span>
          <input type="text" tabindex="9" name="tel" value="">
          <input type="checkbox" name="coordinador" value=1><span> Habilitar Coordinación</span></input>
        </div>
        <div class="fila">
          <span>Parroquia Catequista:</span>
          <select id="lista1" tabindex="2" name="lista1">
            <option disabled selected value=0>Seleccione la Parroquia:</option>
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
          <input type="text" tabindex="4" name="nom2" value="">
          <span>Segundo Apellido Catequista:</span>
          <input type="text" tabindex="6" name="ape2" value="">
          <span>Ocupación Catequista:</span>
          <input type="text" tabindex="8" name="ocu" value="">
          <span>Grupo de Trabajo:</span>
          <div id="select2lista"></div>
          <input type="checkbox" name="academia" value=1 checked><span> Habilitar Academia</span></input>
        </div>
        <input type="button" name="rst" onclick="window.close()" value="Cancelar">
        <input type="submit" name="send" value="Guardar Cambios">
      </form>

      <?php
      //print_r($_POST);
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
        $result = $conn->query("INSERT INTO catequista (parroquiaCatequista, nombreCatequista, nombre2Catequista, apellidoCatequista, apellido2Catequista, ocupacionCatequista, direccionCatequista, telefonoCatequista, GrupoTrabajo_idGrupo, coordinadorHabilitar, estadoCatequista, cedulaCiudadania, habilitarAcademia)
                                  VALUES ('$parr', '$nom1', '$nom2', '$ape1', '$ape2', '$ocu', '$dir', '$tel', '$grupo', '$coor', '1', '$id', '$academi');");
        mysqli_close($conn);
        echo '<script type="text/javascript">window.close();</script>';
      } elseif ($send) {
        echo '<script type="text/javascript">window.alert("POR FAVOR INGRESE TODOS LOS CAMPOS");</script>';
      }
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

  function recargarLista() {
    $.ajax({
      type: "POST",
      url: "partials/datosxGrupo.php?p$b423scer34432yi$unj123=<?php $ID=-1; echo $ID; ?>",
      data: "parroquia=" + $('#lista1').val(),
      success: function(r) {
        $('#select2lista').html(r);
      }
    });
  }
</script>