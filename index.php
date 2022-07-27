<?php
session_start();
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
  //echo "<br/>Sesión Iniciada!!! ";
?>
  <meta http-equiv="refresh" content="1;workspace/subpages/PortalAcademico.php">
<?php
}
?>
<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <title>Sistema Integral de Gestión Académica</title>
  <link rel="stylesheet" href="workspace/assets/css/styleA.css">
  <link rel="shortcut icon" href="workspace/images/SIGA.ico">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Orbitron&display=swap">
  <script src="libraries/jquery-3.5.1.min.js"></script>
  <meta http-equiv="refresh" content="1;workspace/login.php">
</head>

<body id="backindex">
  <div class="page" id="page">

    <div class="container">
      <div class="left2">
        <div class="logo"><img src="workspace/images/SIGA.ico" width="150" alt="SIGALogo"></div>
        <div class="login">SIGA - ESPAC</div>
        <div class="eula">BIENVENIDO AL SIGA - ESPAC</div>
      </div>
    </div>

    <div class="foot">
      <div id="copy">Iglesia de Nuestra Señora de la Candelaria | ©<?php echo date("Y"); ?></div>
      <div id="textfoot" title="adthos">adthos</div>
      <div id="separator"></div>
      <div id="imagefoot" title="adthos"><img src="workspace/images/adthos.png" width="30" alt="adthosLogo"></div>
    </div>

  </div>
</body>

</html>