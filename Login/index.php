<?php
  session_start();
  
  if (isset($_SESSION['login_error'])) {
      $alert = $_SESSION["login_error"];
  }
  else {
      $alert = null;
  }
  
  
  //PARA REGRESAR A LA PELICULA SELECCIONADA
  if (isset($_SESSION['Regresar_Pelicula'])) {
    $Regresar_Pelicula = $_SESSION['Regresar_Pelicula'];

  }
  else{
      $Regresar_Pelicula = null;
  }
  
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Login PelixFlix</title>
  <!-- BOOTSTRAP CSS -->
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/bootstrap.css.map">
  <link rel="stylesheet" href="../css/fontawesome_all.css">
  <link rel="stylesheet" href="style.css">

  <!-- JS -->
  <script src="../js/sweetalert2.all.min.js"></script>
</head>
<body>
<?php    
      if ($alert == 1) {
        ?>
          <script>
            Swal.fire({
            title:'No existe la Cuenta!',
            icon:'error',
            timer:3000,
            timerProgressBar:true,
            })
          </script>
        <?php
            $_SESSION['login_error'] = null;
      }
    ?>

<div class="container">
	<section id="content">
		<form action="../Interfaz/Interfaz_Login.php" method="POST">
            <!-- INPUTS OCULTOS -->
            <input type="hidden" value="0" name="crud">
            <input type="hidden" name="Regresar_Pelicula" id="Regresar_Pelicula" value="<?php echo $Regresar_Pelicula ?>">
            <!----------------------->
			<h1>Login PelixFlix</h1>
			<div>
				<input type="text" name="Usuario" placeholder="Nombre de Usuario" required="" id="username" />
			</div>
			<div>
				<input type="password" name="Password" placeholder="Contraseña" required="" id="password" />
			</div>
			<div>
				<input type="submit" value="Continuar" />
				<a href="#">Olvidaste la Contraseña?</a>
				<a href="../Registrar/">Registrarse</a>
			</div>
		</form><!-- form -->
	</section><!-- content -->
</div><!-- container -->

</body>
</html>
