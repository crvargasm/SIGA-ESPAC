<?php require '../../partials/verifySession.php';
if (empty($_GET)) {
  header('Location: index.php');
} elseif ($_GET['a!¡v02ds3ass334de$?!!'] != 1) {
  header('Location: index.php');
}
$ID = $_GET['p$b423scer34432yi$unj1232asds34da34shs!???'];  //ID Catequista
$ver = $_GET['a!¡v02ds3ass334de$?!!'];                      //Verificador Unico de Privacidad IntraWEB
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Sistema Integral de Gestión Académica</title>
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="../../images/SIGA.ico">
  <link rel="stylesheet" href="css/styleC.css">
  <link rel="stylesheet" type="text/css" href="../../../libraries/bootstrap/css/bootstrap.css">
  <script src="../../../libraries/jquery-3.5.1.min.js"></script>
  <script src="../../../libraries/bootstrap/js/bootstrap.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <div class="workspace">
    <div class="adw">

      <?php
      /*Buscamos....
      1- Vista infoGrupo(idGrupo, nombreGrupo, ParroquiaGrupo, moduloActual, estadoGrupo, idParroquia, nombreParroquia)
      2- Parroquia
      3- Modulo
      4- Etapa
      5- Catequistas que pertenezcan al grupo
      ---- ordenamos por "El primer grupo que fué registrado en el sistema"
      */
      require '../../database.php';
      $result = $conn->query("SELECT infogrupo.*, parroquia.*, modulo.*, etapa.*, count(catequista.idCatequista) from infogrupo, parroquia, modulo, etapa, catequista
                              WHERE infogrupo.Parroquia_idParroquia = parroquia.idParroquia 
                                AND infogrupo.moduloActual = modulo.idModulo
                                AND modulo.Etapa_idEtapa = etapa.idEtapa
                                AND catequista.GrupoTrabajo_idGrupo = infogrupo.idGrupo 
                                group by idGrupo;");
      $numfilasA = $result->num_rows;
      $aux = $result->fetch_object();
      mysqli_close($conn);
      ?>

      <center>
        <p class="mb-n2 pt-3"><strong>Por favor selecccione la etapa a la que corresponde el escrutinio a registrar:</strong></p>

        <div class="A">Nombre del Grupo: <strong><em><?php echo $aux->nombreGrupo; ?></em></strong></div>
        <div class="A">Parroquia: <strong><em><?php echo $aux->nombreParroquia; ?></em></strong></div>

        <form class="etapaModulo pt-1" action="registrarEscrutinio.php?p$b423scer34432yi$unj1232asds34da34shs!???=<?php echo $ID; ?>&a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" method="POST">
          <div class="form-row my-1 ml-5">
            <div class="form-col col-7">
              <select id="lista1" class="custom-select custom-select-sm" name="lista1">
                <option selected disabled value=0>Seleccione la Etapa:</option>
                <?php

                //Buscamos las Etapas alcanzadas por el grupo hasta el momento
                require '../../database.php';
                $resultado = $conn->query("SELECT * FROM etapa WHERE idEtapa <= (SELECT Etapa_idEtapa FROM modulo WHERE idModulo = (SELECT moduloActual FROM infogrupo WHERE idGrupo='$ID'));");
                $numerofilas = $resultado->num_rows;

                for ($ir = 0; $ir < $numerofilas; $ir++) {
                  $auxilio = $resultado->fetch_object();
                  echo '<option value="' . $auxilio->idEtapa . '">Etapa ' . $auxilio->idEtapa . ' - ' . $auxilio->nombreEtapa . '</option>';
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-col col-4 ml-4">
              <input type="submit" class="btn btn-outline-success btn-sm" onclick="cargarNota();" name="send" value="Visualizar">
            </div>
          </div>
        </form>
      </center>

      <form id="formEscrutinio" method="POST">
        <?php

        $verifyConsulta = false;
        if (isset($_POST['send'])) {
          $boton = $_POST['send'];
        } else {
          $boton = false;
        }
        $etapaSelect = $_POST['lista1'] ?? '';   //Etapa Seleccionada

        if ($boton != false && $etapaSelect != 0) {   //Seleccionamos una Etapa Válida
          /*Buscamos Catequistas:
          1- Pertenecientes al Grupo $ID.
          --- Ordenamos por "El primero que fue registrado en el sistema";
          2- Se encuentren activos.
          3- Se encuentren en Academia
          */
          require '../../database.php';
          $resulte = $conn->query("SELECT * from catequista WHERE GrupoTrabajo_idGrupo = '$ID' AND estadoCatequista=1 AND habilitarAcademia=1 order by idCatequista;");
          $numfilasC = $resulte->num_rows;
          mysqli_close($conn);

        ?>
          <input form="formEscrutinio" type="hidden" name="numfilas" value="<?php echo $numfilasC; ?>">
          <input form="formEscrutinio" type="hidden" name="etapaSeleccionada" value="<?php echo $etapaSelect; ?>">
          <center>
            <div style="position: relative; height: 15em; top:1em; width:40em; overflow: auto; display: block;">
              <table class="table table-bordered table-striped table-sm table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th>
                      <center>ID</center>
                    </th>
                    <th>
                      <center>Catequista</center>
                    </th>
                    <th>
                      <center>Asistió a Escrutinio</center>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for ($i = 0; $i < $numfilasC; $i++) {
                    $cate = $resulte->fetch_object();
                    echo
                    '<tr>
                    <td>
                      <center>' . $cate->cedulaCiudadania . '</center>
                    </td>
                    <td>
                      <center>' . $cate->nombreCatequista . ' ' . $cate->nombre2Catequista . ' ' . $cate->apellidoCatequista . ' ' . $cate->apellido2Catequista . '</center>
                    </td>
                    <td>
                      <center>
                        <div class="form-check form-check-inline">
                          <input form="formEscrutinio" class="form-check-input" type="checkbox" name="check' . $i . '" id="check' . $i . '" value="1">
                        </div>
                      </center>
                    </td>
                    <input form="formEscrutinio" type="hidden" name="idCatequista' . $i . '" value="' . $cate->idCatequista . '">
                  </tr>';
                  }
                  ?>

                </tbody>
              </table>
            </div>
          </center>

          <!-- Botones y Selección de Fechas -->
          <div class="mx-auto" style="width: 25em; padding-top: 2.5em;">
            <button type="button" class="btn btn-danger" onclick="cancelar()">Cancelar</button>
            <button type="button" class="btn btn-outline-dark mx-4" disabled>
              <input type="date" class="my-n2" id="fecha" name="fecha" value="" min="2016-01-01" max="<?php echo date("Y-m-d"); ?>">
            </button>
            <button type="button" class="btn btn-success" onclick="registrarEscrut()">Registrar</button>
          </div>

        <?php
        } elseif ($boton != false && $etapaSelect == 0){  //Presionamos pero no elegimos una Etapa
          echo '<script type="text/javascript">      
                swal("Uppps...", "Selecciona una Opción Válida","warning");
                
              </script>';
          $numfilas = -1;
        } 
        ?>
      </form>
    </div>
  </div>

  <div class="foota">
    <div id="copa">Iglesia de Nuestra Señora de la Candelaria | © <?php echo date("Y") ?> </div>
    <div id="textfoot" title="adthos">adthos</div>
    <div id="separator"></div>
    <div id="imagefoot" title="adthos"><img src="/workspace/images/adthos.png" width="30" alt="adthosLogo"></div>
  </div>
</body>

</html>

<script>
  function registrarEscrut() {
    var fecha = document.getElementById('fecha').value;
    if (fecha == '') {
      swal("Upps...", "Por favor selecciona una fecha e Intenta de Nuevo :D", "warning");
    } else {
      /*
      for (let index = 0; index < <?php echo $numfilasC ?>; index++) {
        if (document.getElementById('check' + index).checked) { //SI asistió
          
        } else { //No Asistió
          //alert(0);

        }
      }
      */

      var datos = $('#formEscrutinio').serialize();
      $.ajax({
        type: "POST",
        url: "partials/guardarEscrutinio.php",
        data: datos,
        success: function(r) {
          if (r == 1) {
            /* Crear Siguiente Etapa (2,3 o 4) y abrir calificaciones del Módulo 1 de dicho módulo*/
            swal("Perfecto...", "Escrutinio registrado con éxito :)", "success");
          } else {
            swal("Upps... Algo falló!", "Verifica e Intenta de Nuevo :(", "error");
          }
        }
      });
      return false;
    }
  }

  function cancelar() {
    swal({
      title: "Advertecia...",
      text: "Seguro que desea salir sin guardar los cambios...??? :s",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((salir) => {
      if (salir) {
        window.close();
      }
    });
  }
</script>