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
      <h3>Ingrese los datos para su Registro:</h3>

      <form action="signup.php" method="POST">
        <input type="text" name="username" placeholder="Ingrese Su Usuario">
        <input type="text" name="name" placeholder="Ingrese Su Nombre">
        <input type="text" name="lastname" placeholder="Ingrese Su Apelido">
        <input type="password" name="password" placeholder="Ingrese Su Contraseña">
        <input type="password" name="confirmPassword" placeholder="Confirme su Contraseña">
        <select name="rango">
          <option value="Z">Seleccione los Privilegios de Usuario</option>
          <option value="A">ADMINISTRATIVO</option>
          <option value="B">OPERATIVO</option>
        </select>
        <input type="submit" name="send" value="Registrarse">
        <p><span>o <a href="login.php">Ingrese al Aplicativo</a></span></p>
      </form>
    </div>
    <div id="loginUser2">
     <?php
       $boton = $_POST['send'];  //Pulso de Boton "Send"
       if ($boton && !empty($_POST['username']) && !empty($_POST['name']) && !empty($_POST['lastname']) && !empty($_POST['password']) && !empty($_POST['confirmPassword']) && $_POST['rango']!='Z') {
         require 'database.php';
         $username = $_POST['username'];
         $name = $_POST['name'];
         $lastname = $_POST['lastname'];
         $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
         $confirmPassword = $_POST['confirmPassword'];
         $rango = $_POST['rango'];

         if ($confirmPassword == $_POST['password']) {
           $sql = "INSERT INTO usuarios(username, nombreUsuario, apellidoUsuario, password, privilegioRango, estadoUsuario) VALUES('$username', '$name', '$lastname','$password', '$rango', 1)";
           if ($conn->query($sql) === true) {
               echo 'USUARIO REGISTRADO';
               header('Location: index.php');
           } else{
             die("En estos momentos el Servidor presenta un Error: " . $conn->error);
           }
         } else {
             die("LAS CONTRASEÑAS NO COINCIDEN... INTENTE DE NUEVO...");
         }

         mysqli_close($conn);
       } elseif ($boton) {
         echo 'POR FAVOR COMPLETE TODOS LOS CAMPOS';
       }
     ?>
    </div>
  </body>
</html>
