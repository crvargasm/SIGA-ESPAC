<?php require '../partials/verifySession.php'; ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Sistema Integral de Gestión Académica</title>
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="../images/SIGA.ico">
  <link rel="stylesheet" href="../assets/css/stylePage.css">
</head>

<body>
  <?php require '../partials/headerPA.php'; ?>
  <div id="page">
    <?php require '../partials/menulist.php'; ?>
    <div class="dashboard">
      <a href="administracion.php">
        <div class="backButtom"><img src="../images/iconos/back.svg" alt="Volver"></div>
      </a>
      <a onclick="history.go(0)">
        <div class="refreshButtom"><img src="../images/iconos/reload.svg" alt="Actualizar"></div>
      </a>
      <div class="backc">
        <div id="titles">
          <p>Por favor Ingrese Primer Apellido, Cédula del Catequista o Seleccione la Parroquia a la que pertenece el Catequista:</p>
        </div>
        <div id="formconsulta">
          <form action="gestionCatequista.php" method="POST">
            <input type="text" name="apellido" placeholder="Ingrese Primer Apellido">
            <input type="text" name="ID" placeholder="Ingrese C.C. del Catequista">
            <select name="parroquia">
              <option disabled selected value=0>Seleccione la Parroquia del Catequista:</option>
              <?php
              require '../database.php';
              $ver = 1;
              $result = $conn->query("SELECT idParroquia, nombreParroquia FROM parroquia");
              $numfilas = $result->num_rows;
              for ($i = 0; $i < $numfilas; $i++) {
                $aux = $result->fetch_object();
                echo '<option value="' . $aux->idParroquia . '">Parroquia ' . $aux->nombreParroquia . '</option>';
              }
              mysqli_close($conn);
              ?>
            </select>
            <?php $valueSel = $_POST['parroquia'] ?? ''; ?>
            <input type="submit" name="send" value="Buscar">
            <button type="button" onclick="location.href='gestionCatequista.php'">Limpiar</button>
            <a target="_blank" href="administracion/newCatequistas.php?a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" onclick="window.open(this.href, this.target, 'width=650,height=560'); return false;"><button type="button">Añadir</button></a>
          </form>
        </div>
        <div id="consulta">
          <?php
          $boton = $_POST['send'] ?? '';    //Pulso de Boton "Send"
          $apellido = $_POST['apellido'] ?? '';
          $id = $_POST['ID'] ?? '';
          if (empty($apellido) && empty($id) && $valueSel == 0 && $boton) {  //Verifica que NO este Vacia La Consulta
            die('<br><b>Por favor ingrese un Parámetro de Busqueda</b></br>');
          } else {
            if (!empty($apellido) && empty($id) && $valueSel == 0 && $boton) {  //Verifica SOLO Primer Apellido
              require '../database.php';
              $result = $conn->query("SELECT * FROM infoCatequista WHERE apellidoCatequista LIKE '$apellido%'");
              $numfilas = $result->num_rows;
            }
            if (empty($apellido) && !empty($id) && $valueSel == 0 && $boton) {  //Verifica SOLO ID del Catequista
              require '../database.php';
              $result = $conn->query("SELECT * FROM infoCatequista WHERE cedulaCiudadania=$id");
              $numfilas = $result->num_rows;
            }
            if ($valueSel != 0 && empty($apellido) && empty($id) && $boton) {  //Verfica SOLO Parroquia Catequista
              require '../database.php';
              $result = $conn->query("SELECT * FROM infoCatequista WHERE parroquiaCatequista=$valueSel");
              $numfilas = $result->num_rows;
            }
            if (!empty($apellido) && !empty($id) && $valueSel == 0 && $boton) { //Verifica Primer Apellido y ID
              require '../database.php';
              $result = $conn->query("SELECT * FROM infoCatequista WHERE cedulaCiudadania=$id AND apellidoCatequista LIKE '$apellido%'");
              $numfilas = $result->num_rows;
            }
            if (empty($apellido) && !empty($id) && $valueSel != 0 && $boton) { //Verifica ID y Parroquia
              require '../database.php';
              $result = $conn->query("SELECT * FROM infoCatequista WHERE cedulaCiudadania=$id AND parroquiaCatequista=$valueSel");
              $numfilas = $result->num_rows;
            }
            if (!empty($apellido) && empty($id) && $valueSel != 0 && $boton) {  //Verifica Primer Apellido y Parroquia
              require '../database.php';
              $result = $conn->query("SELECT * FROM infoCatequista WHERE parroquiaCatequista=$valueSel AND apellidoCatequista LIKE '$apellido%'");
              $numfilas = $result->num_rows;
            }
            if (!empty($apellido) && !empty($id) && $valueSel != 0 && $boton) {  //Verifica TODOS
              require '../database.php';
              $result = $conn->query("SELECT * FROM infoCatequista WHERE cedulaCiudadania=$id AND parroquiaCatequista=$valueSel AND apellidoCatequista LIKE '$apellido%'");
              $numfilas = $result->num_rows;
            }
          }
          ?>
          <div class="table">
            <?php
            if ($numfilas > 0 && $boton) {
              echo '<br>Número de Resultados: ' . $numfilas . '</br>';
              echo '
              </br>
              <center>
              <table width=\"100%\" border=\"1\">
                <tr>
                  <th><center><b>C.C.</b></center></th>
                  <th><center><b>Nombres</b></center></th>
                  <th><center><b>Apellidos</b></center></th>
                  <th><center><b>Parroquia</b></center></th>
                  <th><center><b>Grupo de Trabajo</b></center></th>
                  <th><center><b>Estado</b></center></th>
                  <th><center><b>Coordinador</b></center></th>
                  <th><center><b>Modificar</b></center></th>
                </tr>';
              for ($i = 0; $i < $numfilas; $i++) {
                $aux = $result->fetch_object();
                echo
                '
                  <tr>
                    <td><center>' . $aux->cedulaCiudadania . '</center></td>
                    <td><center>' . $aux->nombreCatequista . " " . $aux->nombre2Catequista . '</center></td>
                    <td><center>' . $aux->apellidoCatequista . " " . $aux->apellido2Catequista . '</center></td>
                    <td><center>' . $aux->nombreParroquia . '</center></td>
                    <td><center>' . $aux->nombreGrupo . '</center></td>
                    <td><center>';
                if ($aux->estadoCatequista == 2) {
                  echo 'Graduado';
                } elseif ($aux->estadoCatequista == 1) {
                  echo 'Activo';
                } else {
                  echo 'Inactivo';
                }
                echo '</center></td>
                    <td><center>';
                if ($aux->coordinadorHabilitar == 0) {
                  echo 'No';
                } else {
                  echo 'Si';
                }
                echo '</center></td>';
                $IDC = $aux->idCatequista; ?>
                <td>
                  <center><a href="administracion/catequistas.php?p$b423scer34432yi$unj1232asds34da34shs!???=<?php echo $IDC; ?>&a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" target="_blank" onclick="window.open(this.href, this.target, 'width=650,height=560'); return false;"><input type="radio" name="bt" value=""></a></center>
                </td>
                </tr>
            <?php
              }
              echo '</table></center>';
              mysqli_close($conn);
            } elseif ($boton) {
              echo '<br><b>Catequistas No Encontrados</b></br>';
              mysqli_close($conn);
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>