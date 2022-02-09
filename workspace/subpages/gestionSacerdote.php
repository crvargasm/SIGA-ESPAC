<?php require '../partials/verifySession.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

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
        <div class="backButtom"><img src="../images/iconos/back.svg" alt=""></div>
      </a>
      <a onclick="history.go(0)">
        <div class="refreshButtom"><img src="../images/iconos/reload.svg" alt=""></div>
      </a>
      <div class="backz">
        <div id="titles">
          <p>Por favor Ingrese el Nombre, o Seleccione la Parroquia a la que esta asignado el Sacerdote:</p>
        </div>
        <div id="formconsulta">
          <form action="gestionSacerdote.php" method="POST">
            <input type="text" name="nombreSace" placeholder="Ingrese El Nombre del Sacerdote">
            <select name="parroquia">
              <option disabled selected value=0>Seleccione la Parroquia:</option>
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
            <?php
            $parroq = $_POST['parroquia'] ?? '';
            $nombre = $_POST['nombreSace'] ?? ''; ?>
            <input type="submit" name="send" value="Buscar">
            <button type="button" onclick="location.href='gestionSacerdote.php'">Limpiar</button>
            <a target="_blank" href="administracion/newSacerdote.php?a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" onclick="window.open(this.href, this.target, 'width=650,height=400'); return false;"><button type="button">Añadir</button></a>
          </form>
        </div>
        <div id="consulta">
          <?php
          $boton = $_POST['send'] ?? '';    //Pulso de Boton "Send"
          if ($parroq == 0 && empty($nombre) && $boton) {  //Verifica que NO este Vacia La Consulta
            require '../database.php';
            $result = $conn->query("SELECT idParroco, concat(nombreParroco,' ',nombre2Parroco,' ',apellidoParroco,' ',apellido2Parroco)as nombreSacerdote, autoridad, estadoParroco FROM parroco WHERE autoridad!='Diácono' ORDER BY nombreParroco;");
            $numfilas = $result->num_rows;
          } elseif ($parroq != 0 && empty($nombre) && $boton) {  //Busca Por Parroquia
            require '../database.php';
            $result = $conn->query("SELECT idParroco, concat(nombreParroco,' ',nombre2Parroco,' ',apellidoParroco,' ',apellido2Parroco) as nombreSacerdote, autoridad, estadoParroco, nombreParroquia
                                    FROM infoparroquias
                                    WHERE autoridad!='Diácono'
                                    AND idParroquia='$parroq';");
            $numfilas = $result->num_rows;
          } elseif ($parroq == 0 && !empty($nombre) && $boton) {   //Busca Por Nombre
            require '../database.php';
            $result = $conn->query("SELECT idParroco, concat(nombreParroco,' ',nombre2Parroco,' ',apellidoParroco,' ',apellido2Parroco) as nombreSacerdote, autoridad, estadoParroco
                                    FROM parroco
                                    WHERE autoridad!='Diácono'
                                    AND concat(nombreParroco,' ',nombre2Parroco,' ',apellidoParroco,' ',apellido2Parroco) LIKE '$nombre%';");
            $numfilas = $result->num_rows;
          } elseif ($parroq != 0 && !empty($nombre) && $boton) {   //Busca Por Nombre y parroquia
            require '../database.php';
            $result = $conn->query("SELECT idParroco, concat(nombreParroco,' ',nombre2Parroco,' ',apellidoParroco,' ',apellido2Parroco) as nombreSacerdote, autoridad, estadoParroco, nombreParroquia
                                    FROM infoparroquias
                                    WHERE autoridad!='Diácono'
                                    AND idParroquia=$parroq
                                    AND concat(nombreParroco,' ',nombre2Parroco,' ',apellidoParroco,' ',apellido2Parroco) LIKE '$nombre%';");
            $numfilas = $result->num_rows;
          }
          ?>
          <div class="table">
            <?php
            if ($numfilas > 0 && $boton) {
              echo '
              <br>
              <center>
              <table width=\"100%\" border=\"1\">
                <tr>
                  <th><center><b>Nombre Sacerdote</b></center></th>
                  <th><center><b>Autoridad</b></center></th>
                  <th><center><b>Estado</b></center></th>
                  <th><center><b>Modificar</b></center></th>
                </tr>';
              for ($i = 0; $i < $numfilas; $i++) {
                $aux = $result->fetch_object();
                echo
                  '
                  <tr>
                    <td><div id="pli">' . $aux->nombreSacerdote . '</div></td>
                    <td><center>' . $aux->autoridad . '</center></td>
                    <td><center>';
                if ($aux->estadoParroco == 1) {
                  echo 'Activo';
                } else {
                  echo 'Inactivo';
                }
                echo '</center></td>';
                $IDC = $aux->idParroco; ?>
                <td>
                  <center><a href="administracion/sacerdotes.php?p$b423scer34432yi$unj1232asds34da34shs!???=<?php echo $IDC; ?>&a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" target="_blank" onclick="window.open(this.href, this.target, 'width=650,height=400'); return false;"><input type="radio" name="bt" value=""></a></center>
                </td>
                </tr>
            <?php
              }
              echo '</table></center>';
              mysqli_close($conn);
            } elseif ($boton) {
              echo '<br><b>Sacerdote No Encontrado</b></br>';
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