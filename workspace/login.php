<?php
  session_start();
  if (isset($_SESSION['user']) && !empty($_SESSION['user'])){
    //echo "<br/>Sesión Iniciada!!! ";
    header('Location: subpages/PortalAcademico.php');
    } ?>
<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title>Sistema Integral de Gestión Académica</title>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images/SIGA.ico">
		<link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body id="login">
    <?php require 'partials/header.php' ?>
    <div id="formi">
      <h3>Ingrese su Usuario y Contraseña:</h3>
      <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="Ingrese Su Usuario">
        <input type="password" name="password" placeholder="Ingrese Su Contraseña">
        <input type="submit" name="send" value="Iniciar Sesión">
        <?php  //<span><p>o <a href="signup.php">Registrese</a></p></span>?>
      </form>
    </div>
    <div id="loginUser">
      <?php
      if(isset($_POST['send'])) {
       $boton = $_POST['send']; //Pulso de Boton "Send"
      }
        if (isset($boton) && isset($_POST['username']) && isset($_POST['password'])) {
          require 'database.php';
          $username = $_POST['username'];
          $password = $_POST['password'];
          $query = "SELECT * FROM usuarios WHERE username = '$username'";
          $result = $conn->query($query);
          $numfilas = $result->num_rows;
          if ($numfilas == 0) {
            $_SESSION = array();
            session_destroy();
            ?>
              <script>
                alert("Usuario No Encontrado, Verifique e Intente Nuevamente.");
              </script>
            <?php
            //die("Usuario No Encontrado, Verifique e Intente Nuevamente.");
          } else{
            //echo "Numero de filas encontradas: " . $numfilas . "<br/>";
            $aux = $result->fetch_object();
            $hashPass = $aux->password;
            mysqli_close($conn);
            //echo "Id. Usuario: ".$aux->idUsuario." Usuario: ".$aux->username." password ".$aux->password;
          }

          if (password_verify ($password, $hashPass)) {
            //echo "<br/>Sesión Iniciada!!! ";
            session_start();    //Iniciamos Sesión en PHP
            $_SESSION['user'] = $aux->username;
            $_SESSION['nombre'] = $aux->nombreUsuario;
            $_SESSION['apellido'] = $aux->apellidoUsuario;
            header('Location: subpages/PortalAcademico.php');
          } else {
            $_SESSION = array();
            session_destroy();
            ?>
              <script>
                alert("Contraseña Incorrecta, Verifique e Intente Nuevamente.");
              </script>
            <?php
          }

        } elseif (isset($boton)) {
          $_SESSION = array();
          session_destroy();
          ?>
            <script>
              alert("Por favor complete todos los Campos e Intente Nuevamente.");
            </script>
          <?php
          //die('POR FAVOR COMPLETE TODOS LOS CAMPOS!!!');
        }
      ?>
    </div>
  </body>
</html>
