<!--A Design by W3layouts
   Author: W3layout
   Author URL: http://w3layouts.com
   License: Creative Commons Attribution 3.0 Unported
   License URL: http://creativecommons.org/licenses/by/3.0/
   -->
   <?php
      session_start();
      $count=0;
      $productos="";
      $con=mysqli_connect("localhost", "root", "", "botargas");
      $adv="";
    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $nom=$_SESSION["nombre"];
    $bienvenida= "$nom";
    $countar=0;
    
    if(isset($_COOKIE["nuevacantidad"])){
      $value= $_COOKIE["valor"];
      $nuevacantidad= $_COOKIE["nuevacantidad"];
      #header("Refresh:2");
    # $remover = mysqli_query($con,"DELETE FROM  carrito where id_producto='$value' AND c.id_usuario='$_SESSION[id_user]';");
      
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
      <!--checkout-->
      <link rel="stylesheet" type="text/css" href="../css/checkout.css">
      <!--//checkout-->
      <link href="../css/easy-responsive-tabs.css" rel='stylesheet' type='text/css' />
      <!--stylesheets-->
      <link href="../css/style.css" rel='stylesheet' type='text/css' media="all">
      <!--//stylesheets-->
      <link href="//fonts.googleapis.com/css?family=Sunflower:500,700" rel="stylesheet">
      <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
   </head>
   <body>
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
                                    echo  "<li>" . $bienvenida . "</li>";
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
                     <li class="nav-item">
                        <a class="nav-link" href="shop.php" id="navbar1" role="button" aria-haspopup="true" aria-expanded="false">
                        Productos
                        </a>
                     </li>
                  </ul>
               </div>
            </nav>
         </div>
      <!--//headder-->

        <!-- banner -->
        <div class="inner_page-banner one-img">
      </div>
      <!--//banner -->
   
         <!-- top Products -->
         <section class="checkout py-lg-4 py-md-3 py-sm-3 py-3">
            <div class="container py-lg-5 py-md-4 py-sm-4 py-3">
               <div class="shop_inner_inf">
                  <div class="privacy about">
                     <h3>Mochila<span> Mochila</span></h3>
                     <div class="checkout-right">
                        <?php
                        $carrito = mysqli_query($con,"SELECT p.tipo, p.personaje, p.descripcion, p.precio, p.foto FROM  carrito c, producto p where c.id_producto=p.id_producto AND c.id_usuario='$_SESSION[id_user]';");
                        while($row = mysqli_fetch_array($carrito)) {$count++;}
                        echo "<h4>Su Mochila contiene: <span>$count Productos</span></h4>";       
                        echo "<table class='timetable_sub'>";
                           echo "<thead>";
                             echo " <tr>";
                                 echo "<th>No.</th>";
                                 echo "<th>Producto</th>";
                                 echo "<th>Cantidad</th>";
                                 echo "<th>Nombre del producto</th>";
                                 echo "<th>Precio Unitario</th>";
                                 echo "<th>Remover</th>";
                              echo "</tr>";
                           echo "</thead>";
                           echo "<tbody>";
                           $count=0;
                           $carrito = mysqli_query($con,"SELECT p.id_producto, c.cantidad, p.tipo, p.personaje, p.descripcion, p.precio, p.foto FROM  carrito c, producto p where c.id_producto=p.id_producto AND c.id_usuario='$_SESSION[id_user]';");
                              if (mysqli_num_rows($carrito) > 0){
                                    while($row = mysqli_fetch_array($carrito)) {
                                       $count++;
                                       $tipo=$row['tipo'];
                                       $personaje=$row['personaje'];
                                       $idprod=$row['id_producto'];
                                       $descripcion=$row['descripcion'];
                                       $precio=$row['precio'];
                                       $foto=$row['foto'];
                                       $cantidad=$row['cantidad'];
                                       $countar=$countar+$cantidad;
                                       for($i=1;$i<=$cantidad;$i++){
                                          $productos=$productos.",".$idprod;
                                       } 
                                       $rem='rem'.$count;
                                       $close='close'.$count;
                                    echo "<tr class='$rem'>";
                                    echo "<td class='invert'>$count</td>";
                                    echo "<td class='invert-image'><a href='shop.php'><img src='..$foto' alt=' ' class='img-responsive'></a></td>";
                                    echo "<td class='invert'>";
                                       echo "<div class='quantity'>";
                                          echo "<div class='quantity-select'>";
                                             echo "<form method='post'>";
                                                echo "<input type='hidden' name='mas' value='$cantidad'>";
                                                echo "<input type='hidden' name='prood' value='$idprod'>";
                                                echo "<button class='entry value-plus' name='plus'>&nbsp;</button>";
                                             echo "</form>";
                                             echo "<div class='entry value'><span> $cantidad</span></div>";
                                             echo "<form method='post'>";
                                                echo "<input type='hidden' name='menos' value='$cantidad'>";
                                                echo "<input type='hidden' name='prood' value='$idprod'>";
                                                echo "<button class='entry value-minus' name='minus'>&nbsp;</button>";
                                             echo "<form method='post'>";
                                          echo "</div>";
                                       echo "</div>";
                                    echo "</td>";
                                    echo "<td class='invert'>$personaje</td>";
                                    echo "<td class='invert'>$precio</td>";
                                    echo "<td class='invert'>";
                                    echo "<form method='post'>";
                                       echo "<div class='rem' >";
                                          echo "<input type='hidden' name='quitarproducto' value='$idprod'>";
                                          echo "<button type='submit' class='close1' data-value='.$rem' name='close'> </button>";
                                       echo "</div>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                    if(isset($_POST['close']))
                                    { 
                                       $cp=$_POST['quitarproducto'];
                                       $elim = mysqli_query($con,"DELETE FROM carrito where id_usuario='$_SESSION[id_user]' and id_producto='$cp';");
                                       echo "<script>window.location.href='checkout.php'</script>";
                                    }
                                    if(isset($_POST['plus']))
                                    { 
                                       $mas=$_POST['mas'];
                                       $prod=$_POST['prood'];
                                       $cantmas1=$mas+1;
                                       $mas1 = mysqli_query($con,"UPDATE carrito SET cantidad='$cantmas1' where id_usuario='$_SESSION[id_user]' and id_producto='$prod';");
                                       echo "<script>window.location.href='checkout.php'</script>";
                                    }
                                    if(isset($_POST['minus']))
                                    { 
                                       $menos=$_POST['menos'];
                                       if($menos>1){
                                          $prod=$_POST['prood'];
                                          $cantmenos1=$menos-1;
                                          $menos1 = mysqli_query($con,"UPDATE carrito SET cantidad='$cantmenos1' where id_usuario='$_SESSION[id_user]' and id_producto='$prod';");   
                                       echo "<script>window.location.href='checkout.php'</script>";
                                       }
                                    }
                                    }
                              }else{
                                 echo "No hay nada en la mochila";
                              }
                              $_SESSION['count']=$countar;
                              #$_SESSION['SQLcantidad']='UPDATE producto SET cantidad=';
                              $_SESSION['productos']=$productos;
                              ?>
                           </tbody>
                        </table>
                     </div>
                     <div class="checkout-left">
                        <div class="col-md-4 checkout-left-basket">
                           <h4>My Mochila</h4>
                           <?php
                             
                              $total=100;
                              $carrito = mysqli_query($con,"SELECT p.personaje, c.cantidad, p.precio FROM  carrito c, producto p where c.id_producto=p.id_producto AND c.id_usuario='$_SESSION[id_user]';");
                              if (mysqli_num_rows($carrito) > 0){
                                 echo "<ul>";
                                    while($row = mysqli_fetch_array($carrito)) {
                                       $personaje=$row['personaje'];
                                       $cantidad=$row['cantidad'];
                                       $total=$total+($precio*$cantidad);
                                       $precio=$row['precio'];
                              
                              echo "<li>$personaje   x$cantidad <i>-</i> <span>$".($precio*$cantidad). "</span></li>";
                                    }
                                    echo "<li>Costo de envío <i>-</i> <span>$100.00</span></li>";
                                 echo "<li class='total'>Total <i>-</i> <span>$$total.00 MXN</span></li>";
                                 $_SESSION["monto"]=$total;
                                 }else{
                                    echo"<li>La mochila está vacía</li>";
                                 }
                                 echo "</ul>";
                           ?>
                        </div>
                        <div class="col-md-8 address_form">
                           <h4>Información</h4>
                           <form action="payment.php" method="post" >
                              <section class="creditly-wrapper wrapper">
                                 <div class="information-wrapper">
                                    <div class="first-row form-group">
                                       <div class="controls">
                                          <label class="control-label">Nombre completo: </label>
                                          <input class="billing-address-name form-control" type="text" name="Nombre" placeholder="Nombre completo" value="<?php echo $nom ?>" required="">
                                       </div>
                                       <div class="card_number_grids">
                                          <div class="card_number_grid_left">
                                             <div class="controls">
                                                <label class="control-label">Teléfono móvil:</label>
                                                <input class="form-control" type="text" name="Telefono" value="<?php echo $_SESSION["telef"] ?>"
               placeholder="Teléfono móvil" required="">
                                             </div>
                                          </div>
                                          <div class="card_number_grid_right">
                                             <div class="controls">
                                                <label class="control-label">Dirección de entrega: </label>
                                                <input class="form-control" type="text" name="Direccion" placeholder="Dirección" value="<?php echo $_SESSION["direc"] ?>" required="">
                                             </div>
                                          </div>
                                          <div class="clear"> </div>
                                       </div>
                                       <div class="controls">
                                          <label class="control-label">Ciudad/Estado: </label>
                                          <input class="form-control" type="text" name="Ciudad" placeholder="Ciudad/Estado" required="">
                                       </div>
                                    </div>
                                    <?php
                                    if($count!=0){
                                       echo "<button class='submit check_out'>Pagar</button>";
                                    }
                                    
                                    ?>
                                 </div>
                              </section>
                           </form>
                        </div>
                        <div class="clearfix"> </div>
                        <div class="clearfix"></div>
                     </div>
                  </div>
               </div>
               <!-- //top products -->
            </div>
      </section>
      
      <!-- footer -->
      <footer class="py-lg-4 py-md-3 py-sm-3 py-3 text-center">
         <div class="copy-agile-right">
            <p> 
               © 2022 Dora la Vendedora. All Rights Reserved | Design mostly by <a href="http://www.W3Layouts.com" target="_blank">W3Layouts</a>
            </p>
         </div>
      </footer>
      <!-- //footer -->

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
      <!--// cart-js -->
      <!--quantity-->
      <script>
         $('.value-plus').on('click', function () {
         	var divUpd = $(this).parent().find('.value'),
         		newVal = parseInt(divUpd.text(), 10) + 1;
         	divUpd.text(newVal);
            createCookie("nuevacantidad", newVal, "10");
         });
         
         $('.value-minus').on('click', function () {
         	var divUpd = $(this).parent().find('.value'),
         		newVal = parseInt(divUpd.text(), 10) - 1;
         	if (newVal >= 1) divUpd.text(newVal);
            createCookie("nuevacantidad", newVal, "10");
         });
      </script>
      <!--quantity-->
      <!--closed-->
      <script>
         $(document).ready(function (c) {
         	$('.close1').on('click', function (c) {
               var value = $(this).data('value');
               // Creating a cookie after the document is ready
               createCookie("valor", value, "10");
         		$(value).fadeOut('slow', function (c) {
         			$(value).remove();
         		});
         	});
         });
         // Function to create the cookie
         function createCookie(name, value, days) {
                  var expires;
                     
                  if (days) {
                     var date = new Date();
                     date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                     expires = "; expires=" + date.toGMTString();
                  }
                  else {
                     expires = "";
                  }
                     
                  document.cookie = escape(name) + "=" + 
                     escape(value) + expires + "; path=/";
               }
      </script>
      <!--//closed-->
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
   </body>
</html>