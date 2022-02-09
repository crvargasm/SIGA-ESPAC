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
          <p>Por favor Seleccione la Diócesis que desea Configurar:</p>
        </div>
        <div id="formconsulta">
          <form action="gestionDiocesis.php" method="POST">
            <select name="diocesis">
              <option disabled selected value=0>Seleccione la Diócesis:</option>
              <?php
              require '../database.php';
              $ver = 1;
              $result = $conn->query("SELECT * FROM diocesis WHERE estadoDiocesis='1';");
              $numfilas = $result->num_rows;
              for ($i = 0; $i < $numfilas; $i++) {
                $aux = $result->fetch_object();
                echo '<option value="' . $aux->idDiocesis . '">Diócesis de ' . $aux->nombreDiocesis . '</option>';
              }
              mysqli_close($conn);
              ?>
            </select>
            <input type="submit" name="send" value="Buscar">
            <button type="button" onclick="location.href='gestionDiocesis.php'">Limpiar</button>
          </form>
        </div>
        <div id="consulta">
          <?php
          $boton = $_POST['send'] ?? '';    //Pulso de Boton "Send"
          $diocesis = $_POST['diocesis'] ?? '';
          if ($boton == 0) {
            require '../database.php';
            $result = $conn->query("SELECT * FROM infoDiocesis;");
            $numfilas = $result->num_rows;
            mysqli_close($conn);
          } else {
            if ($boton != 0) {  //Verifica TODOS
              require '../database.php';
              $result = $conn->query("SELECT * FROM infoDiocesis WHERE idDiocesis=$diocesis;");
              $numfilas = $result->num_rows;
              mysqli_close($conn);
            }
          }
          ?>
          <div class="table">
            <?php
            if ($numfilas > 0 && $boton) {
              //echo '<br>Número de Resultados: '.$numfilas.'</br>';
              echo '
              </br>
              <center>
              <table width=\"100%\" border=\"1\">
                <tr>
                  <th><center><b>Diócesis</b></center></th>
                  <th><center><b>Obispo</b></center></th>
                  <th><center><b>Encargado ESPAC</b></center></th>
                  <th><center><b>País/Ciudad</b></center></th>
                  <th><center><b>Modificar</b></center></th>
                </tr>';
              for ($i = 0; $i < $numfilas; $i++) {
                $aux = $result->fetch_object();
                echo
                  '
                  <tr>
                    <td><center>Diócesis de ' . $aux->nombreDiocesis . '</center></td>
                    <td><center>' . $aux->nombreObispo . " " . $aux->nombre2Obispo . " " . $aux->apellidoObispo . " " . $aux->apellido2Obispo . '</center></td>
                    <td><center>' . $aux->nombreEncargado . " " . $aux->nombre2Encargado . " " . $aux->apellidoEncargado . " " . $aux->apellido2Encargado . '</center></td>
                    <td><center>' . $aux->pais . "/" . $aux->ciudadPrincipal . '</center></td>';
                $IDC = $aux->idDiocesis; ?>
                <td>
                  <center><a href="administracion/diocesis.php?p$b423scer34432yi$unj1232asds34da34shs!???=<?php echo $IDC; ?>&a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" target="_blank" onclick="window.open(this.href, this.target, 'width=650,height=350'); return false;"><input type="radio" name="bt" value=""></a></center>
                </td>
                </tr>
            <?php
              }
              echo '</table></center>';
            } elseif ($boton) {
              echo '<br><b>Diocesis No Registradas, por favor contacte con Soporte Técnico</b></br>';
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>