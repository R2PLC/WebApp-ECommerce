<!--A Design by W3layouts
   Author: W3layout
   Author URL: http://w3layouts.com
   License: Creative Commons Attribution 3.0 Unported
   License URL: http://creativecommons.org/licenses/by/3.0/
   -->
   <?php
      session_start();
      $i=0;
      $con=mysqli_connect("localhost", "root", "", "botargas");
      $adv="";
      if(isset($_SESSION["id_user"])){
         $id_usuario=$_SESSION["id_user"];
         $nom=$_SESSION["nombre"];
         $bienvenida= "$nom";
      }else{
         session_unset();
         session_destroy();
         session_write_close();
         setcookie(session_name(),'',0,'/');
      }
    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();

    }
      //INICIO DE SESIÓN
    if(isset($_POST["Email"])){
      $e= $_POST["Email"];
      $c= $_POST["contrasena"];
      $result = mysqli_query($con,"SELECT contrasena FROM usuario where mail='$e';");
      if ($result) {
         if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            if($c==$row['contrasena']){
               session_start();
               $result = mysqli_query($con,"SELECT * FROM usuario where mail='$e';");
               $row = mysqli_fetch_array($result);
               $nom=$row['nombre_usuario'];
               $_SESSION["id_user"]=$row['id_usuario'];
               $_SESSION["i"]=1;
               $_SESSION["nombre"]=$nom;
               $id_usuario=$_SESSION["id_user"];
               $i=1;
               $_SESSION["id_sesion"]=session_id();
               $bienvenida= "$nom"; 
            }else{
               echo 'Contraseña incorrecta. Si no se acuerda, ya valió';
            }
         } else {
           echo 'Contraseña incorrecta o usuario incorrecto';
         }
       } else {
         echo 'Error: '.mysql_error();
       }
      
   }
                           
   ?> 
<!DOCTYPE html>
<html lang="zxx">
   <head>
      <!-- For favicon png -->
		<link rel="shortcut icon" type="image/icon" href="../images/logo/dora.jpg"/>

      <title>Dora la VendeDora</title>
      <!--meta tags -->
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="keywords" content="Toys Shop Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
         Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
      <script>
         addEventListener("load", function () {
         	setTimeout(hideURLbar, 0);
         }, false);
         
         function hideURLbar() {
         	window.scrollTo(0, 1);
         }
      </script>
      <!--//meta tags ends here-->
      <!--booststrap-->
      <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
      <!--//booststrap end-->
      <!-- font-awesome icons -->
      <link href="../css/fontawesome-all.min.css" rel="stylesheet" type="text/css" media="all">
      <!-- //font-awesome icons -->
      <!--Shoping cart-->
      <link rel="stylesheet" href="../css/shop.css" type="text/css" />
      <!--//Shoping cart-->
      <!--price range-->
      <link rel="stylesheet" type="text/css" href="../css/jquery-ui1.css">
      <!--//price range-->
      <!--stylesheets-->
      <link href="../css/style.css" rel='stylesheet' type='text/css' media="all">
      <!--//stylesheets-->
      <link href="//fonts.googleapis.com/css?family=Sunflower:500,700" rel="stylesheet">
      <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
   </head>
   <body>
      <?php
      if(isset($_POST['anadircarrito'])){
         echo "<div class='alert success'>";
            echo "<span class='closebtn'>&times;</span>"; 
            echo "<strong>¡Ñam Ñam Delicious!</strong> Se ha añadido a Mochila";
         echo "</div>";
      }
      
      ?>

      <!--headder-->
      <div class="header-outs" id="home">
         <div class="header-bar">
         <div class="container-fluid">
               <div class="hedder-up row">
                  <div class="col-lg-6 col-md-4 logo-head">
                     <h1><a class="navbar-brand" href="../index.php">Dora la VendeDora</a></h1>
                  </div>
                  <div class="col-lg-6 col-md-3 right-side-cart">
                     <div class="cart-icons">
                     <ul>
                     <?php
                                 if(session_status() === PHP_SESSION_ACTIVE){
                                    echo  "<li>" . $bienvenida . "</li>";
                                 }
                                 if(session_status() !== PHP_SESSION_ACTIVE){
                           echo "<li>";
                             echo " <button type='button' data-toggle='modal' data-target='#exampleModal'>"; 
                             echo "<span style='padding-right:3px; padding-top: 3px; display:inline-block;' >
                                 <img src='../images/botas.png'></img>
                                 </span>";
                                 echo "<h4 class='white'>Iniciar sesión<h4>";
                                 echo "</button>";
                           echo "</li>";
                                 }
                           if(session_status() === PHP_SESSION_ACTIVE){
                           echo "<li class='toyscart toyscart2 cart cart box_1' type='button' action='checkout.php' method='post'>";
                              echo "<form action='checkout.php'method='post' class='last'>";
                                
                                 echo "<button class='top_toys_cart' type='submit' name='submit' value=''>";
                                 echo "<span style='padding-right:3px; padding-top: 3px; display:inline-block;' >
                                 <img src='../images/mochila.png'></img>
                                 </span>";
                                 echo "</button>";
                              echo "</form>";
                           echo "</li>";
                        
                                    echo "<li><a class='nav-link' href='logout.php' id='navbar1' role='button' aria-haspopup='true' aria-expanded='false'> Log out</a></li>";
                           }
                                 ?>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light">
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                  <ul class="navbar-nav ">
                     <li class="nav-item">
                        <a class="nav-link" href="../index.php">Principal </a>
                     </li>
                     <li class="nav-item active">
                        <a class="nav-link" href="shop.php" id="navbar1" role="button" aria-haspopup="true" aria-expanded="false">
                        Productos<span class="sr-only">(current)</span>
                        </a>
                     </li>
                  </ul>
               </div>
            </nav>
         </div>


      <!-- banner -->
      <div class="inner_page-banner one-img">
      </div>
      <!--//banner -->

      <!--show Now-->  
      <!--show Now-->  
      <section class="contact py-lg-4 py-md-3 py-sm-3 py-3">
         <div class="container-fluid py-lg-5 py-md-4 py-sm-4 py-3">
            <h3 class="title text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">Botargas</h3>
            <div class="row">

                  <?php
                  $productos = mysqli_query($con,"SELECT id_producto, cantidad, tipo, personaje, descripcion, precio, foto FROM  producto;");
                  if (mysqli_num_rows($productos) > 0){
                        while($row = mysqli_fetch_array($productos)) {
                           $id_producto=$row['id_producto'];
                           $tipo=$row['tipo'];
                           $personaje=$row['personaje'];
                           $cantidad=$row['cantidad'];
                           $descripcion=$row['descripcion'];
                           $precio=$row['precio'];
                           $foto=$row['foto'];
                     echo "<div class='col-lg-3 col-md-2 col-sm-6 product-men women_two'>";
                        echo "<div class='product-toys-info'>";
                           echo "<div class='men-pro-item'>";
                              echo "<div class='men-thumb-item'>";
                                 echo "<img src='..$foto' class='img-thumbnail img-fluid' alt=''>";
                                 echo "<div class='men-cart-pro'>";
                                    echo "<div class='inner-men-cart-pro'>";
                                       echo "<a href=single.php?product_id=$id_producto class='link-product-add-cart'>Ver producto</a>";
                                    echo "</div>";
                                 echo "</div>";
                              echo "</div>";
                              echo "<div class='item-info-product'>";
                                 echo "<div class='info-product-price'>";
                                    echo "<div class='grid_meta'>";
                                       echo "<div class='product_price'>";
                                       echo "<h4>";
                                          echo "<a href='single.php'>$personaje</a>";
                                       echo "</h4>";
                                          echo "<div class='grid-price mt-2'>";
                                             echo "<span class='money '>$ $precio</span>";
                                          echo "</div>";
                                       echo "</div>";
                                    echo "</div>";
                           if(session_status() === PHP_SESSION_ACTIVE){
                              if($cantidad>0){
                                    echo "<div class='toys single-item hvr-outline-out'>";
                                    echo "<form method='post'>";
                                          echo "<input type='hidden' name='carritoproducto' value='$id_producto'>";
                                          echo "<input type='hidden' name='carritousuario' value='$id_usuario'>";
                                          echo "<button type='submit' name='anadircarrito' value='anadircarrito' class='toys-cart ptoys-cart add'>";
                                          echo "<i class='fas fa-cart-plus' ></i>";
                                          echo "</button>";
                                       echo "</form>";
                                    echo "</div>";
                              }else{
                                 echo "<br><br><br><div>Este producto no está disponible por el momento.</div>";
                              }
                           }
                                 echo "</div>";
                                 echo "<div class='clearfix'></div>";
                              echo "</div>";
                           echo "</div>";
                     echo "</div>";
                  echo "</div>";
                  }
               }else{
                  echo "No hay productos disponibles. Lo sentimos :(";
               }
                  ?>
                   <?php
                   $cantidad=1;
                     if(isset($_POST['anadircarrito']))
                     {  
                        $cu=$_POST['carritousuario'];
                        $cp=$_POST['carritoproducto'];
                        $quantity = mysqli_query($con,"SELECT cantidad, id_usuario, id_producto FROM carrito where id_usuario='$cu' and id_producto='$cp';");
                           if (mysqli_num_rows($quantity) > 0) {
                              $row = mysqli_fetch_array($quantity);
                              $cantidad=$row['cantidad'];
                              $cantidad=$cantidad+1;
                              $update = mysqli_query($con,"UPDATE carrito SET cantidad='$cantidad' where id_usuario='$cu' and id_producto='$cp';");
                           }else{
                              $SQL = "INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES ('$cu', '$cp', '$cantidad')";
                              $result = mysqli_query($con, $SQL);
                           }
                     }
                  ?>     
            </div>
         </div>
      </section>
      <!-- //show Now-->

      <!-- footer -->
      <footer class="py-lg-4 py-md-3 py-sm-3 py-3 text-center">
         <div class="copy-agile-right">
            <p> 
               © 2022 Dora la Vendedora. All Rights Reserved | Design mostly by <a href="http://www.W3Layouts.com" target="_blank">W3Layouts</a>
            </p>
         </div>
      </footer>
      <!-- //footer -->

      <!-- Modal 1-->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Iniciar sesión</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <div class="register-form">
                     <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="fields-grid">
                           <div class="styled-input">
                              <input type="email" placeholder="Email" name="Email" required="">
                           </div>
                           <div class="styled-input">
                              <input type="password" placeholder="Contraseña" name="contrasena" required="">
                           </div>
                           <button type="submit" class="btn subscrib-btnn">Iniciar sesión</button>
                           <a class="nav-link" data-toggle="modal" data-target="#Modal2">¿No tienes cuenta? Regístrate</a>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
               </div>
            </div>
         </div>
      </div>
      <!-- //Modal 1-->

      <!-- Modal 2-->
      <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Crear cuenta</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <div class="register-form">
                     <form method="post" action="php/registro.php">
                        <div class="fields-grid">
                           <div class="styled-input">
                              <input type="text" placeholder="Nombre completo" name="Nombrer" required="">
                           </div>
                           <div class="styled-input">
                              <input type="email" placeholder="Email" name="Emailr" required="">
                           </div>
                           <div class="styled-input">
                              <p>Fecha de nacimiento</p>
                              <input type="date" placeholder="Fecha de nacimiento" name="nacimientor" required="">
                           </div>
                           <div class="styled-input">
                              <p>Teléfono</p>
                              <input type="text" placeholder="Teléfono" name="telefonor" required="">
                           </div>
                           <div class="styled-input">
                              <p>Dirección</p>
                              <input type="text" placeholder="Dirección predeterminada" name="direccionr" required="">
                           </div>
                           <div class="styled-input">
                              <p>N° Tarejata</p>
                              <input type="text" placeholder="N° Tarjeta predeterminada" name="tarjetar" required="" inputmode="numeric" autocomplete="cc-number"
                                                            autocompletetype="cc-number" x-autocompletetype="cc-number" placeholder="&#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149;">
                           </div>
                           <div class="styled-input">
                              <p>Contraseña</p>
                              <input type="password" placeholder="Contraseña" name="contrasenar" required="">
                           </div>
                           <button type="submit" class="btn subscrib-btnn">Crear cuenta</button>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
               </div>
            </div>
         </div>
      </div>
      <!-- //Modal 2-->



      <!--js working-->
      <script src='../js/jquery-2.2.3.min.js'></script>
      <!--//js working-->
      <!-- cart-js -->
       <script src="../js/minicart.js"></script>
      <script>
         toys.render();
         
         toys.cart.on('toys_checkout', function (evt) {
         	var items, len, i;
         
         	if (this.subtotal() > 0) {
         		items = this.items();
         
         		for (i = 0, len = items.length; i < len; i++) {}
         	}
         });
      </script>
      <!-- //cart-js -->
		<!-- price range (top products) -->
		<script src="../js/jquery-ui.js"></script>
		<script>
			//<![CDATA[ 
			$(window).load(function () {
				$("#slider-range").slider({
					range: true,
					min: 0,
					max: 9000,
					values: [50, 6000],
					slide: function (event, ui) {
						$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
					}
				});
				$("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

			}); //]]>
		</script>
		<!-- //price range (top products) -->

      <!-- start-smoth-scrolling -->
       <script src="../js/move-top.js"></script>
      <script src="../js/easing.js"></script>
      <script>
         jQuery(document).ready(function ($) {
         	$(".scroll").click(function (event) {
         		event.preventDefault();
         		$('html,body').animate({
         			scrollTop: $(this.hash).offset().top
         		}, 900);
         	});
         });
      </script>
      <!-- start-smoth-scrolling -->
      <!-- here stars scrolling icon -->
      <script>
         $(document).ready(function () {
         
         	var defaults = {
         		containerID: 'toTop', // fading element id
         		containerHoverID: 'toTopHover', // fading element hover id
         		scrollSpeed: 1200,
         		easingType: 'linear'
         	};
         
         
         	$().UItoTop({
         		easingType: 'easeOutQuart'
         	});
         
         });
      </script>
      <!-- //here ends scrolling icon -->
      <!--bootstrap working-->
      <script src="../js/bootstrap.min.js"></script>
      <!-- //bootstrap working--> 
      <!--ALERTS-->
      <script>
         var close = document.getElementsByClassName("closebtn");
         var i;

         for (i = 0; i < close.length; i++) {
         close[i].onclick = function(){
            var div = this.parentElement;
            div.style.opacity = "0";
            setTimeout(function(){ div.style.display = "none"; }, 600);
         }
         }
      </script>
   </body>
</html>
