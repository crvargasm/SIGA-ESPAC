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
      <div id="backa">
        <div id="titles">SELECCIONE EL ROL A ADMINISTRAR: </div>
        <div id="A">
          <a href="gestionCatequista.php">
            <div id="squareA"><img src="../images/iconos/catequista.png" alt="Catequista">
              <spam>CATEQUISTA</spam>
            </div>
          </a>
          <a href="gestionCoordinador.php">
            <div id="squareA"><img src="../images/iconos/coordinador.png" alt="Cordinador">
              <spam>COORDINADOR</spam>
            </div>
          </a>
          <a href="gestionGrupo.php">
            <div id="squareA"><img src="../images/iconos/grupo.png" alt="Grupo">
              <spam>GRUPO</spam>
            </div>
          </a>
        </div>
        <div id="B">
          <a href="gestionParroquia.php">
            <div id="squareA"><img src="../images/iconos/parroquia.png" alt="Parroquia">
              <spam>PARROQUIA</spam>
            </div>
          </a>
          <a href="gestionSacerdote.php">
            <div id="squareA"><img src="../images/iconos/sacerdote.png" alt="Sacerdote">
              <spam>SACERDOTE</spam>
            </div>
          </a>
          <a href="gestionDiocesis.php">
            <div id="squareA"><img src="../images/iconos/diocesis.png" alt="Diócesis">
              <spam>DIÓCESIS</spam>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>