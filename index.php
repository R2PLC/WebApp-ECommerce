<!--A Design by W3layouts
   Author: W3layout
   Author URL: http://w3layouts.com
   License: Creative Commons Attribution 3.0 Unported
   License URL: http://creativecommons.org/licenses/by/3.0/
   -->
   <?php
   session_start();
      $con=mysqli_connect("localhost", "root", "", "botargas");
      $adv="";
      $i=0;
    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
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
               $_SESSION["direc"]=$row['direccion'];
               $_SESSION["tarje"]=$row['tarjeta'];
               $_SESSION["telef"]=$row['telefono'];
               $_SESSION["id_user"]=$row['id_usuario'];
               $_SESSION["i"]=1;
               $_SESSION["nombre"]=$nom;
               $bienvenida= "$nom ";
               $i=1;
               $permisos=$row['permisos'];
               $_SESSION["id_sesion"]=session_id();
               if($permisos==0){
                  header("Location:php/admin.php");
               }
            }else{
               echo "<div class='alert'><span class='closebtn'>&times;</span><strong>¡Upsi Dupsi!</strong> Contraseña incorrecta. Si no se acuerda, ya valió.</div>";
            }
         } else {
           echo "<div class='alert'><span class='closebtn'>&times;</span><strong>¡Alerta intruso!</strong> Tu contraseña o usuario son incorrectos como tu modo de vida</div>";
         }
       } else {
         echo 'Error: '.mysql_error();
       }
       
   }
   if(isset($_SESSION['comprahecha'])){
      echo "<div class='alert success'><span class='closebtn'>&times;</span><strong>¡Zorro no te lo lleves!</strong> Te has llevado los productos</div>";
      unset($_SESSION['comprahecha']);
   }
   
                           
   ?> 
<!DOCTYPE html>
<html lang="zxx">
   <head>

      <!-- For favicon png -->
		<link rel="shortcut icon" type="image/icon" href="images/logo/dora.jpg"/>

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
      <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
      <!--//booststrap end-->
      <!-- font-awesome icons -->
      <link href="css/fontawesome-all.min.css" rel="stylesheet" type="text/css" media="all">
      <!-- //font-awesome icons -->
      <!-- For Clients slider -->
      <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="all" />
      <!--flexs slider-->
      <link href="css/JiSlider.css" rel="stylesheet">
      <!--Shoping cart-->
      <link rel="stylesheet" href="css/shop.css" type="text/css" />
      <!--//Shoping cart-->
      <!--stylesheets-->
      <link href="css/style.css" rel='stylesheet' type='text/css' media="all">
      <!--//stylesheets-->
      <link href="//fonts.googleapis.com/css?family=Sunflower:500,700" rel="stylesheet">
      <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
   </head>
   <body>
      <div class="header-outs" id="home">
         <div class="header-bar">
            <div class="container-fluid">
               <div class="hedder-up row">
                  <div class="col-lg-6 col-md-4 logo-head">
                     <h1><a class="navbar-brand" href="index.php ">Dora la VendeDora</a></h1>
                  </div>
                  <div class="col-lg-6 col-md-3 left-side-cart">
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
                                 <img src='images/botas.png'></img>
                                 </span>";
                                 echo "<h4 class='white'>Iniciar sesión<h4>";
                                 echo "</button>";
                           echo "</li>";
                                 }
                           if(session_status() === PHP_SESSION_ACTIVE){
                           echo "<li class='toyscart toyscart2 cart cart box_1' type='button' action='php/checkout.php' method='post'>";
                              echo "<form action='php/checkout.php'method='post' class='last'>";
                                
                                 echo "<button class='top_toys_cart' type='submit' name='submit' value=''>";
                                 echo "<span style='padding-right:3px; padding-top: 3px; display:inline-block;' >
                                 <img src='images/mochila.png'></img>
                                 </span>";
                                 echo "</button>";
                              echo "</form>";
                           echo "</li>";
                        
                                    echo "<li><a class='nav-link' href='php/logout.php' id='navbar1' role='button' aria-haspopup='true' aria-expanded='false'> Log out</a></li>";
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
                     <li class="nav-item active">
                        <a class="nav-link" href="index.php">Principal <span class="sr-only">(current)</span></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="php/shop.php" id="navbar1" role="button" aria-haspopup="true" aria-expanded="false">
                        Productos
                        </a>
                     </li>
                  </ul>
               </div>
            </nav>
         </div>


         <!-- Slideshow 4 -->
         <div class="slider text-center">
            <div class="callbacks_container">
               <ul class="rslides" id="slider4">
                  <li>
                     <div class="slider-img one-img">
                        <div class="container">
                           <div class="slider-info ">
                              <h5>Elige la mejor <br>botarga</h5>
                              <div class="bottom-info">
                                 <p>Las botargas son maravillosas y vienen de todos los colores y sabores</p>
                              </div>
                              <div class="outs_more-buttn">
                                 <a href="php/shop.php">Comprar ahora</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </li>
                  <li>
                     <div class="slider-img two-img">
                        <div class="container">
                           <div class="slider-info ">
                              <h5>Botargas para todas las<br>edades y gustos</h5>
                              <div class="bottom-info">
                                 <p>Las botargas no disciminan, pero si causan que otros te discriminen</p>
                              </div>
                              <div class="outs_more-buttn">
                                 <a href="php/shop.php">Comprar ahora</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </li>
                  <li>
                     <div class="slider-img three-img">
                        <div class="container">
                           <div class="slider-info">
                              <h5>Se tu personaje<br> favorito</h5>
                              <div class="bottom-info">
                                 <p>Si tu soñabas ser Peppa Pig, puedes serlo. O Dr. Simil... o incluso Elmo.</p>
                              </div>
                              <div class="outs_more-buttn">
                                 <a href="php/shop.php">Comprar ahora</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </li>
               </ul>
            </div>
            <!-- This is here just to demonstrate the callbacks -->
            <!-- <ul class="events">
               <li>Example 4 callback events</li>
               </ul>-->
            <div class="clearfix"></div>
         </div>
      </div>
      <!-- //banner -->
      <!-- about -->
      <section class="about py-lg-4 py-md-3 py-sm-3 py-3" id="about">
         <div class="container py-lg-5 py-md-5 py-sm-4 py-4">
            <h3 class="title text-center mb-lg-5 mb-md-4  mb-sm-4 mb-3">Mejores Productos</h3>
            <div class="row banner-below-w3l">
               <div class="col-lg-4 col-md-6 col-sm-6 text-center banner-agile-flowers">
                  <a href="php/shop.php"><img src="images/botargas/amlo.jpg" class="img-thumbnail" alt="">
                  <div class="banner-right-icon"></a>
                     <h4 class="pt-3">Botarga de AMLO</h4>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-6 text-center banner-agile-flowers">
                  <a href="php/shop.php"><img src="images/botargas/barney.jpg" class="img-thumbnail" alt="">
                  <div class="banner-right-icon"></a>
                     <h4 class="pt-3">Botarga de Barney</h4>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-6 text-center banner-agile-flowers">
                  <a href="php/shop.php"><img src="images/botargas/elmo.jpg" class="img-thumbnail" alt="">
                  <div class="banner-right-icon"></a>
                     <h4 class="pt-3">Botarga de Elmo</h4>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-6 mt-3 text-center banner-agile-flowers">
                  <a href="php/shop.php"><img src="images/botargas/dora.jpg" class="img-thumbnail" alt="">
                  <div class="banner-right-icon"></a>
                     <h4 class="pt-3">Botarga de Dora</h4>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-6 mt-3 text-center banner-agile-flowers">
                  <a href="php/shop.php"><img src="images/botargas/simi.jpg" class="img-thumbnail" alt="">
                  <div class="banner-right-icon"></a>
                     <h4 class="pt-3">Botarga de Dr.Simil</h4>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-6 mt-3 text-center banner-agile-flowers">
                  <a href="php/shop.php"><img src="images/botargas/peña.jpg" class="img-thumbnail" alt="">
                  <div class="banner-right-icon"></a>
                     <h4 class="pt-3">Botarga de Peña</h4>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- //about -->
      <!--new Arrivals -->
      <section class="blog py-lg-4 py-md-3 py-sm-3 py-3">
         <div class="container py-lg-5 py-md-4 py-sm-4 py-3">
            <h3 class="title clr text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">Productos Nuevos</h3>
            <div class="slid-img">
               <ul id="flexiselDemo1">
                  <li>
                     <div class="agileinfo_port_grid">
                        <img src="images/botargas/austin.jpg" alt=" " class="img-fluid" />
                        <div class="banner-right-icon">
                           <h4 class="pt-3">Botarga de Austin</h4>
                        </div>
                        <div class="outs_more-buttn">
                           <a href="php/shop.php">Comprar</a>
                        </div>
                     </div>
                  </li>
                  <li>
                     <div class="agileinfo_port_grid">
                        <img src="images/botargas/yunicua.jpg" alt=" " class="img-fluid" />
                        <div class="banner-right-icon">
                           <h4 class="pt-3">Botarga de Yunicua</h4>
                        </div>
                        <div class="outs_more-buttn">
                           <a href="php/shop.php">Comprar</a>
                        </div>
                     </div>
                  </li>
                  <li>
                     <div class="agileinfo_port_grid">
                        <img src="images/botargas/tyron.jpg" alt=" " class="img-fluid" />
                        <div class="banner-right-icon">
                           <h4 class="pt-3">Botarga de Tyron</h4>
                        </div>
                        <div class="outs_more-buttn">
                           <a href="php/shop.php">Comprar</a>
                        </div>
                     </div>
                  </li>
                  <li>
                     <div class="agileinfo_port_grid ">
                        <img src="images/botargas/tasha.jpg" alt=" " class="img-fluid" />
                        <div class="banner-right-icon">
                           <h4 class="pt-3">Botarga de Tasha</h4>
                        </div>
                        <div class="outs_more-buttn">
                           <a href="php/shop.php">Comprar</a>
                        </div>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </section>
      <!--//about -->
      
     
      
      <section class="about py-lg-4 py-md-3 py-sm-3 py-3">
         <div class="container py-lg-5 py-md-5 py-sm-4 py-3">
            <h3 class="title text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">Nosotros</h3>
            <div class="about-products-w3layouts">
            <p>Dora la VendeDora de Botargas es una empresa sin fines de lucro que busca hacerse millonaria a base de vender botargas.
               </p>
               <br>
               <p>Hola, soy Arturo, el creador de esta página. Vendo botargas para pagar mi beca y que mi papá no me golpeé.
               </p>
               <p class="my-lg-4 my-md-3 my-3">Mi profe me obligó a hacer esta página de internet. Era eso o reprobar.
               </p>
               <p>Compra una botarga o vete a la botarga :)
               </p>
               <p>Para más infomración, no me contactes porque no hay más información. Gracias.
               </p>
            </div>
         </div>
      </section>
      <!--//Product-about-->
      
      
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
      <script src='js/jquery-2.2.3.min.js'></script>
      <!--//js working-->
      <!-- cart-js -->
      <script src="js/minicart.js"></script>
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
      <!--responsiveslides banner-->
      <script src="js/responsiveslides.min.js"></script>
      <script>
         // You can also use "$(window).load(function() {"
         $(function () {
         	// Slideshow 4
         	$("#slider4").responsiveSlides({
         		auto: true,
         		pager:false,
         		nav:true ,
         		speed: 900,
         		namespace: "callbacks",
         		before: function () {
         			$('.events').append("<li>before event fired.</li>");
         		},
         		after: function () {
         			$('.events').append("<li>after event fired.</li>");
         		}
         	});
         
         });
      </script>
      <!--// responsiveslides banner-->	 
      <!--slider flexisel -->
      <script src="js/jquery.flexisel.js"></script>
      <script>
         $(window).load(function() {
         	$("#flexiselDemo1").flexisel({
         		visibleItems: 3,
         		animationSpeed: 3000,
         		autoPlay:true,
         		autoPlaySpeed: 2000,    		
         		pauseOnHover: true,
         		enableResponsiveBreakpoints: true,
         		responsiveBreakpoints: { 
         			portrait: { 
         				changePoint:480,
         				visibleItems: 1
         			}, 
         			landscape: { 
         				changePoint:640,
         				visibleItems:2
         			},
         			tablet: { 
         				changePoint:768,
         				visibleItems: 2
         			}
         		}
         	});
         	
         });
      </script>
      <!-- //slider flexisel -->
      <!-- start-smoth-scrolling -->
      <script src="js/move-top.js"></script>
      <script src="js/easing.js"></script>
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
      <script src="js/bootstrap.min.js"></script>
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