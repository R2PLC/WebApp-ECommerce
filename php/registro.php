<?php
    $con=mysqli_connect("localhost", "root", "", "botargas");

    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    // escape variables for security

    $nombre = mysqli_real_escape_string($con, $_POST['Nombrer']);
    $mail = mysqli_real_escape_string($con, $_POST['Emailr']);
    $telefono = mysqli_real_escape_string($con, $_POST['telefonor']);
    $direccion = mysqli_real_escape_string($con, $_POST['direccionr']);
    $tarjeta = mysqli_real_escape_string($con, $_POST['tarjetar']);
    $nacimiento = mysqli_real_escape_string($con, $_POST['nacimientor']);
    $contrasena = mysqli_real_escape_string($con, $_POST['contrasenar']);
    $sql="INSERT INTO usuario(nombre_usuario, mail, contrasena, fecha_nacimiento, permisos, telefono, direccion, tarjeta)
      VALUES ('$nombre', '$mail', '$contrasena', '$nacimiento',1, '$telefono', '$direccion', '$tarjeta');";
    if (!mysqli_query($con,$sql)) {
      die('Error: ' . mysqli_error($con));
    }
    mysqli_close($con);
    header("Location:../index.php");
  ?>