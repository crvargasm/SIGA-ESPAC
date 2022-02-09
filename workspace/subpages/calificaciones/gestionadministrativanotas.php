<?php
session_start();
if (!isset($_SESSION['user']) && empty($_SESSION['user'])) {
  header('Location: ../logout.php');
}
$ID = $_GET['p$b423scer34432yi$unj1232asds34da34shs!???'] ?? '';    //ID Grupo
$ver = $_GET['a!¡v02ds3ass334de$?!!'] ?? '';   //Verificador Unico de Privacidad IntraWEB
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>Sistema Integral de Gestión Académica</title>
  <link rel="stylesheet" type="text/css" href="../../../libraries/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="css/styleC.css">
  <script src="../../../libraries/jquery-3.5.1.min.js"></script>
  <script src="../../../libraries/bootstrap/js/bootstrap.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    var cambiosHechos = false;

    function notaModificada(i) {
      var notasIngresadas = [];
      notasIngresadas[0] = conversor(document.getElementById("A" + i).value);
      notasIngresadas[1] = conversor(document.getElementById("A-E" + i).value);
      notasIngresadas[2] = conversor(document.getElementById("P" + i).value);
      notasIngresadas[3] = conversor(document.getElementById("L" + i).value);
      notasIngresadas[4] = conversor(document.getElementById("C-A" + i).value);
      var notafinal = 0;
      for (var index = 0; index < 5; index++) {
        if (notasIngresadas[index] != -1) {
          notafinal += notasIngresadas[index];
        } else {
          document.getElementById("Total" + i).value = "-";
          return false;
        }
      }
      notafinal = (notafinal / 5);
      document.getElementById("Total" + i).value = notafinal;
      cambiosHechos = true;
      return true;
    }

    function conversor(nota) {
      switch (nota) {
        case "E":
        case "e":
          return 5;
          break;
        case "B":
        case "b":
          return 3.75;
          break;
        case "D":
        case "d":
          return 3;
          break;
        case "":
          break;
        default:
          swal("Ingresa Una Opción Valida:", "Excelente: E - Bueno: B - Deficiente: D", "error");
          return -1;
      }
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="../../images/SIGA.ico">
</head>

<body>
  <div class="workspace">
    <?php
    require '../../database.php';
    $resultado = $conn->query("SELECT * FROM infoGrupo WHERE idGrupo='$ID';");
    $numerofilas = $resultado->num_rows;
    if ($numerofilas == 0) {
      echo '
        <script>
          swal("Upps...", "Algo falló al Cargar el Grupo! \n\n Contactate con Soporte Inmediatamente! (Código Error 205)", "error");
          window.close();
        </script>
      ';
    }
    $auxilio = $resultado->fetch_object();
    mysqli_close($conn);
    ?>

    <h4 class="mt-3">Bienvenido al Gestor Académico de Notas</h4>
    <p class="mb-n2">Por favor selecccione la Etapa y Módulo para modificar las notas del Grupo: <strong><?php echo $auxilio->nombreGrupo ?></strong></p>
    <!-- <p>Si el Grupo no tiene registrado ningun Módulo, por favor presione "<strong>Iniciar Historia Academia</strong>"</p> -->

    <div class="A">Nombre del Grupo: <strong><em><?php echo $auxilio->nombreGrupo; ?></em></strong></div>
    <div class="A">Parroquia: <strong><em><?php echo $auxilio->nombreParroquia; ?></em></strong></div>

    <?php
    $moduloActual = $auxilio->moduloActual;
    require '../../database.php';
    $resultado = $conn->query("SELECT * FROM modulo WHERE idModulo=$moduloActual;");
    $auxilio = $resultado->fetch_object();
    mysqli_close($conn);
    $etapaActual = $auxilio->Etapa_idEtapa;
    $moduloActualESPAC = $auxilio->identificadorESPAC;

    ?>
    <div class="container">
      <form class="etapaModulo" action="gestionadministrativanotas.php?p$b423scer34432yi$unj1232asds34da34shs!???=<?php echo $ID; ?>&a!¡v02ds3ass334de$?!!=<?php echo $ver; ?>" method="POST">
        <div class="form-row my-2">
          <div class="form-col col-4">
            <select id="lista1" class="custom-select custom-select-sm" name="lista1">
              <option selected disabled value=0>Seleccione la Etapa:</option>
              <?php
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
          <div class="form-col col-4">
            <div class="bloc" id="select2lista"></div>
          </div>
          <div class="form-col col-md-2">
            <input type="submit" class="btn btn-outline-success btn-sm" onclick="cargarNota();" name="send" value="Visualizar">
          </div>
          <div class="form-col">
            <button type="button" class="btn btn-outline-info btn-sm" onclick="cambiar();" name="moduloActual">Modulo Actual</button>
          </div>
        </div>
      </form>
    </div>

    <div id="consulta">
      <?php
      $verifyConsulta = false;
      if (isset($_POST['send'])) {
        $boton = $_POST['send'];
      } else {
        $boton = false;
      }
      $etapaSelect = $_POST['lista1'] ?? '';   //Etapa Seleccionada
      $moduloSelect = $_POST['lista2'] ?? '';   //Modulo Seleccionada
      $numfilas = 0;
      if ($boton != false && ($etapaSelect == 0 || $moduloSelect == 0)) {  //Verifica que NO este Vacia La Consulta
        echo '<script type="text/javascript">      
                swal("Uppps...", "Por favor Selecciona una Opción Válida e Intenta de Nuevo!","warning");
                
              </script>';
        $numfilas = -1;
      } elseif ($etapaSelect != 0 && $moduloSelect != 0) {  //Verifica La Etapa

        /*Buscamos Catequistas que: 
        1- Esten habilitados para la academia
        2- Esten Activos en el sistema
        3- Pertenezcan al Grupo seleccionado ($ID)
        */
        require '../../database.php';
        $result = $conn->query("SELECT * FROM catequista WHERE habilitarAcademia = true AND estadoCatequista = true AND GrupoTrabajo_idGrupo = '$ID';");
        $numfilas = $result->num_rows;

      ?>
        <div class="container-fluid">
          <p class="mb-2 text-danger bg-dark"><em>Módulo en Calificación :<strong><?php echo "$etapaSelect.$moduloSelect"; ?></strong></em></p>
          <div class="table-responsive-xl">
            <?php
            if ($numfilas > 0 && $boton != false) {
            ?>
              <form id="frmajax" method="POST">
                <div style="position: relative; height: 18.5em; overflow: auto; display: block;">
                  <input type="hidden" name="numfilas" value="<?php echo $numfilas; ?>">
                  <table class="table table-bordered table-striped table-sm table-hover">
                    <thead class="thead-dark">
                      <tr>
                        <th>ID</th>
                        <th>Catequista</th>
                        <th><abbr title="Asistencia a Clases">A</abbr></th>
                        <th class="px-0 mx-0"><abbr title="Autoevaluación">A-E</th>
                        <th><abbr title="Práctica">P</th>
                        <th><abbr title="Liderazgo">L</th>
                        <th class="px-0 mx-0"><abbr title="Compromiso Apostólico">C-A</th>
                        <th><abbr title="Nota Final Ponderada">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($numfilas > 0) {
                        for ($i = 0; $i < $numfilas; $i++) {
                          $aux = $result->fetch_object();
                          require '../../database.php';
                          $resulta = $conn->query("SELECT * FROM calificacionesaptitudinales WHERE Modulo_idModulo = $moduloSelect AND Etapa_id_EtapaxEstudiante = (SELECT id_EtapaxEstudiante FROM etapaxestudiante WHERE Catequista_idCatequista = '$aux->idCatequista');");
                          $numfs = $resulta->num_rows;
                          if ($numfs > 0) {
                            $verifyConsulta = true;
                            $nota = $resulta->fetch_object();
                            echo '  <tr>
                                      <td class="small p-2">' . $aux->cedulaCiudadania . '</td>
                                      <td class="col-5 p-2">' . $aux->nombreCatequista . ' ' . $aux->nombre2Catequista . ' ' . $aux->apellidoCatequista . ' ' . $aux->apellido2Catequista . '</td>
                                      <th><input form="frmajax" name="A' . $i . '" id="A' . $i . '" onkeyup="notaModificada(' . $i . ');" type="text" class="text-uppercase text-center m-0 font-weight-bold" style="border:0;background-color:#fdfdfe;" maxlength="1" size="1" value="' . $nota->asistencia . '"></th>
                                      <th><input form="frmajax" name="A-E' . $i . '" id="A-E' . $i . '" onkeyup="notaModificada(' . $i . ');" type="text" class="text-uppercase text-center m-0 font-weight-bold" style="border:0;background-color:#fdfdfe;" maxlength="1" size="1" value="' . $nota->autoevaluacion . '"></th>
                                      <th><input form="frmajax" name="P' . $i . '" id="P' . $i . '" onkeyup="notaModificada(' . $i . ');" type="text" class="text-uppercase text-center m-0 font-weight-bold" style="border:0;background-color:#fdfdfe;" maxlength="1" size="1" value="' . $nota->practica . '"></th>
                                      <th><input form="frmajax" name="L' . $i . '" id="L' . $i . '" onkeyup="notaModificada(' . $i . ');" type="text" class="text-uppercase text-center m-0 font-weight-bold" style="border:0;background-color:#fdfdfe;" maxlength="1" size="1" value="' . $nota->liderazgo . '"></th>
                                      <th><input form="frmajax" name="C-A' . $i . '" id="C-A' . $i . '" onkeyup="notaModificada(' . $i . ');" type="text" class="text-uppercase text-center m-0 font-weight-bold" style="border:0;background-color:#fdfdfe;" maxlength="1" size="1" value="' . $nota->compromisoApos . '"></th>
                                      <input form="frmajax" type="hidden" name="idCalificacion' . $i . '" value="' . $nota->idCalificacion . '">
                                      <th><input id="Total' . $i . '" type="text" class="text-uppercase text-center m-0 font-weight-bold" style="border:0;background-color:#fdfdfe;" maxlength="1" size="3" value="" readonly></th>
                                      <script>
                                        notaModificada(' . $i . ');
                                      </script>
                                    </tr>';
                          } else {
                            echo '
                              <script>
                                swal("Uppps...", "Los Estudiantes no tienen notas de cursos inferiores registrados \n\n Verifica e Intenta de Nuevo \n\n (error 202)","error");
                              </script>
                            ';
                            break;
                          }
                        }
                        mysqli_close($conn);
                      } else {
                        echo '
                              <script>
                                  swal("Uppps...", "No se encontraron Catequistas \n\n Verifica que estén habilitados e Intenta de Nuevo \n\n (error 203)","error");
                              </script>
                          ';
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </form>
          </div>

          <?php if ($verifyConsulta) { ?>
            <abbr title="Salir sin guardar cambios"><button class="btn btn-danger my-2" onclick="cancelar();">Cerrar</button></abbr>
            <abbr title="Guardar parcialmente las Notas"><button form="frmajax" class="btn btn-success my-2" id="guardar">Guardar Cambios</button></abbr>
            <abbr title="Registrar Notas Permanentemente"><button form="frmajax" class="btn btn-warning my-2" id="consolidar">Consolidar Notas</button></abbr>
          <?php } ?>
          <!-- Tener en cuenta la variable "$cambiosHechos" -->

        <?php
            } elseif ($numfilas == 0 && $boton != false) {
        ?>
          <script>
            swal("Upps...", "No se han encontrado los alumnos! \n\n Verifica e Intenta de Nuevo! (Código Error 204)", "error");
          </script>
      <?php
            }
          }
      ?>
        </div>
    </div>
  </div>
  </div>
  <?php require 'partials/footeer.php'; ?>
</body>

</html>

<script type="text/javascript">
  $(document).on("click", "#guardar", function() {
    for (var i = 0; i < <?php echo $numfilas; ?>; i++) {

      if (!notaModificada(i)) {
        return false; //Seguir mirando esta mondá!!!!!
      }

    }
    var datos = $('#frmajax').serialize();
    $.ajax({
      type: "POST",
      url: "partials/guardarNotas.php",
      data: datos,
      success: function(r) {
        if (r == 1) {
          swal("Perfecto...", "Cabios guardados con exito :)", "success");
        } else {
          swal("Upps... Algo falló!", "Verifica e Intenta de Nuevo :(", "error");
        }
      }
    });
    return false;
  });

  $(document).on("click", "#consolidar", function() {
    for (var i = 0; i < <?php echo $numfilas; ?>; i++) {

      if (!notaModificada(i)) {
        return false; //Seguir mirando esta mondá!!!!!
      }

    }
    var datos = $('#frmajax').serialize();
    $.ajax({
      type: "POST",
      url: "partials/consolidarModulo.php",
      data: datos,
      success: function(r) {
        if (r == 1) {
          swal("Perfecto...", "Modulo consolidado con exito :)", "success")
            .then((value) => {
              location.reload();
            });
        } else if (r == 2) {
          swal("Perfecto...", "Modulo consolidado con exito :)", "success")
            .then((value) => {
              swal("Iniciar Etapa...", "Para iniciar la siguiente etapa registra el escrutinio desde el apartado informes :)", "info")
                .then((willDelete) => {
                  if (willDelete) {
                    window.close();
                  }
                });
            });
        } else if (r == 3) {
          swal("Ou...", "El módulo ya había sido consolidado \n\n Si deseas Actualizar las Notas usa el botón \"Guardar Cambios\"", "warning");
        } else {
          swal("Upps...", "Algo falló al almacenar! \n\n Contactate con Soporte Inmediatamente! (Código Error 201)", "error");
        }
      }
    });
    return false;
  });

  function cambiar() {
    var etapa = [<?php echo $etapaActual; ?>];
    var modulo = parseInt(new String(parseFloat([<?php echo $moduloActualESPAC; ?>]).toString().slice(2, 3)));
    document.getElementById("lista1").selectedIndex = etapa;
    recargarLista();
    setTimeout(function() {
      document.getElementById("lista2").selectedIndex = modulo;
    }, 100);
  }

  $(document).ready(function() {
    recargarLista();
    $('#lista1').change(function() {
      recargarLista();
    });
  });

  function recargarLista() {
    $.ajax({
      type: "POST",
      url: "partials/obtenerModulos.php?p$b423scer34432yi$unj123=<?php echo $ID; ?>",
      data: "etapa=" + $('#lista1').val(),
      success: function(r) {
        $('#select2lista').html(r);
      }
    });
  }

  function cancelar() {
    if (cambiosHechos) {
      if (confirm("¿Seguro desea salir sin guardar cambios?")) {
        window.close();
      }
    } else {
      window.close();
    }
  }
</script>