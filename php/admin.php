<!--A Design by W3layouts
   Author: W3layout
   Author URL: http://w3layouts.com
   License: Creative Commons Attribution 3.0 Unported
   License URL: http://creativecommons.org/licenses/by/3.0/
   -->
   <?php
   session_start();
   if(isset($_SESSION["id_user"])){
         $id_usuario=$_SESSION["id_user"];
         $nom=$_SESSION["nombre"];
         $bienvenida= "$nom";
      }else{
         session_unset();
         session_destroy();
         session_write_close();
         setcookie(session_name(),'',0,'/');
         header("Location:../index.php");
      }
      $mod=0;
      $con=mysqli_connect("localhost", "root", "", "botargas");
      // Check connection
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      if(isset($_SESSION['modificarwarn'])){
         echo "<div class='alert warning'><span class='closebtn'>&times;</span><strong>¡Woah!</strong> Modificaste un producto, Modifikeishon a product.</div>";
         unset($_SESSION['modificarwarn']);
      }
      if(isset($_SESSION['eliminarwarn'])){
         echo "<div class='alert'><span class='closebtn'>&times;</span><strong>¡Oh no!</strong> Eliminaste un producto, Elimineishon a product.</div>";
         unset($_SESSION['eliminarwarn']);
      }
      if(isset($_POST['eliminarbotargas'])){
         $selectOption = $_POST['eliminarbotargas'];
         $SQL = "DELETE FROM producto where id_producto='$selectOption'";
         $elimineishon= mysqli_query($con, $SQL);
         $_SESSION['eliminarwarn']=1;
         unset($_POST['eliminarbotargas']);
         echo "<script>window.location.href='admin.php'</script>";
      }
      
      if(isset($_SESSION['anadirwarn'])){
            
         echo "<div class='alert success'><span class='closebtn'>&times;</span><strong>¡Yeii!</strong> Insertaste un producto, a product.</div>";
         unset($_SESSION['anadirwarn']);
      }
      if(isset($_POST['personaje'])){
        $personaje= $_POST["personaje"];
        $precio= $_POST["precio"];
        $cantidad= $_POST["cantidad"];
        $id_proveedor= $_POST["proveedor"];
        $tipo="Botarga";
        $descripcion="Botarga de ".$personaje." la explora".$personaje;
        $imagen="/images/botargas/".$personaje.".jpg";
        $SQL = "INSERT INTO producto (tipo, personaje, precio, cantidad, descripcion, foto, id_proveedor) VALUES ('$tipo', '$personaje','$precio','$cantidad','$descripcion','$imagen', '$id_proveedor')";
         $anadirproductos = mysqli_query($con, $SQL);
         $_SESSION['anadirwarn']=1;
         unset($_POST['personaje']);
         echo "<script>window.location.href='admin.php'</script>";
           } 

           
      ?>
   <!DOCTYPE html>
<html lang="zxx">
   <head>
      <!-- For favicon png -->
		<link rel="shortcut icon" type="image/icon" href="../images/logo/dora.jpg"/>

        <title>Dora la VendeDora</title>
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
                  <div class="col-lg-5 col-md-4 logo-head">
                     <h1><a class="navbar-brand" href="admin.php">Dora la AdministraDora</a></h1>
                  </div>
                  <div class="col-lg-4 col-md-3 right-side-cart">
                     <div class="cart-icons">
                     <ul>
                           <?php
                                    echo  "<li>" . $bienvenida . "</li>";
                                    echo "<li><a class='nav-link' href='logout.php' id='navbar1' role='button' aria-haspopup='true' aria-expanded='false'> Log out</a></li>";
                                 ?>
                           </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      <!--//headder-->
      <!-- banner -->
      <div class="admin_page-banner two-img">
      </div>
      <section class="checkout py-lg-4 py-md-3 py-sm-3 py-3">
         <div class="container py-lg-5 py-md-4 py-sm-4 py-3">
            <div class="ads-grid_shop">
               <div class="shop_inner_inf">
                  <div class="privacy about">
                     <!--/tabs-->
                     <div class="responsive_tabs">
                        <div id="horizontalTab">
                           <ul class="resp-tabs-list">
                              <li>Productos</li>
                              <li>Añadir productos</li>
                              <li>Quitar productos</li>
                              <li>Modificar productos</li>
                              <li>Historial de compras</li>
                              <li>Usuarios y contraseñas</li>
                           </ul>
                           <div class="resp-tabs-container">
                           <!--TAB 0-->
                           <div class="tab0">
                                 <div class="row pay_info">
                                    <div class="col-md-12">
                                       <div style="height: 250px; , width: 100%;; overflow: auto">
                                          <table style="height: 400px" class="table table-bordered table-striped table-responsive-stack"  id="tableOne">
                                          <thead class="thead-dark">
                                          <tr><th>Id Producto</th> <th>Personaje</th> <th>Precio</th> <th>Cantidad en Almacén</th> <th>Descripción</th>
                                             <th>Foto</th> <th>Id Proveedor</th><th>Nombre Proveedor</th>
                                             <th>País Proveedor</th> </tr>
                                          <?php
                                             $todosproductos = mysqli_query($con,"SELECT * FROM  producto p, proveedor pp where p.id_proveedor=pp.id_proveedor order by p.id_producto;");
                                                if (mysqli_num_rows($todosproductos) > 0){
                                                      while($row = mysqli_fetch_array($todosproductos)) {
                                                         $id_producto=$row['id_producto'];
                                                         $personaje=$row['personaje'];
                                                         $precio=$row['precio'];
                                                         $cantidad=$row['cantidad'];
                                                         $descripcion=$row['descripcion'];
                                                         $foto=$row['foto'];
                                                         $id_proveedor=$row['id_proveedor'];
                                                         $nombre=$row['nombre'];
                                                         $pais=$row['pais'];
                                                         echo "<tr><td>";
                                                         echo $id_producto;
                                                         echo "</td><td>";
                                                         echo $personaje;
                                                         echo "</td><td>";
                                                         echo $precio;
                                                         echo "</td><td>";
                                                         echo $cantidad;
                                                         echo "</td><td>";
                                                         echo $descripcion;
                                                         echo "</td><td>";
                                                         echo $foto;
                                                         echo "</td><td>";
                                                         echo $id_proveedor;
                                                         echo "</td><td>";
                                                         echo $nombre;
                                                         echo "</td><td>";
                                                         echo $pais;
                                                         echo "</td></tr>";
                                                      }
                                                }
                                                
                                             ?>
                                          </table>
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>
                              <!--/tab_one-->
                              <div class="tab1">
                                 <div class="pay_info">
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                       <section class="creditly-wrapper wthree, w3_agileits_wrapper">
                                          <div class="credit-card-wrapper">
                                             <div class="first-row form-group">
                                                <div class="controls">
                                                   <label class="control-label">Personaje</label>
                                                   <input class="billing-address-name form-control" type="text" name="personaje" placeholder="Personaje" required="" oninput="validity.valid||(value='');">
                                                </div>
                                                <div class="w3_agileits_card_number_grids">
                                                   <div class="w3_agileits_card_number_grid_left">
                                                      <div class="controls">
                                                         <label class="control-label">Precio</label>
                                                         <input class="precio form-control" type="text" name="precio" inputmode="numeric"  required="" min="10" oninput="validity.valid||(value='');"
                                                          placeholder="$100">
                                                      </div>
                                                   </div>
                                                   <div class="w3_agileits_card_number_grid_right">
                                                      <div class="controls">
                                                         <label class="control-label">Cantidad en almacén</label>
                                                         <input class="security-code form-control" Â· inputmode="numeric" type="text" name="cantidad" placeholder="1" min="1" required="" oninput="validity.valid||(value='');">
                                                      </div>
                                                   </div>
                                                   <div class="w3_agileits_card_number_grid_left">
                                                      <div class="controls">
                                                         <label class="control-label">ID proveedor</label>
                                                         <input class="number proveedor form-control" type="text" name="proveedor" inputmode="numeric"  required="" max="4" min="1" oninput="validity.valid||(value='');"
                                                          placeholder="Proveedor">
                                                      </div>
                                                   </div>
                                                   <div class="clear"> </div>
                                                </div>
                                             </div>
                                             <button class="btn btn-primary submit" type="submit" value="Anadir" ><span>Añadir producto </span></button>
                                          </div>
                                       </section>
                                    </form>
                                 </div>
                              </div>
                              <!--//tab_one-->
                              <!--/tab_two-->
                              <div class="tab2">
                                 <div class="pay_info">
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                       <section class="creditly-wrapper wthree, w3_agileits_wrapper">
                                          <div class="credit-card-wrapper">
                                             <?php
                                             
                                             echo "<select class='form-select' data-live-search='true' name='eliminarbotargas' required='' oninput='validity.valid||(value='');'>";
                                                echo " <option value='0' selected>No se ha seleccionado nada</option>";
                                                $productos = mysqli_query($con,"SELECT id_producto, tipo, personaje, cantidad, descripcion, precio, foto, id_proveedor FROM  producto;");
                                                if (mysqli_num_rows($productos) > 0){
                                                      while($row = mysqli_fetch_array($productos)) {
                                                         $id_producto_el=$row['id_producto'];
                                                         $tipo=$row['tipo'];
                                                         $personaje=$row['personaje'];
                                                         $descripcion=$row['descripcion'];
                                                         $precio=$row['precio'];
                                                         $foto=$row['foto'];
                                                         $cantidad=$row['cantidad'];
                                                         echo $id_producto;
                                                         echo "<option value='$id_producto_el'>".$personaje.". ID: ". $id_producto_el." Cantidad: ". $cantidad."</option>";
                                                         
                                                      }
                                                }
                                                echo "</select>";
                                                   
                                                
                                             ?>

                                             <br>
                                             <button class="btn btn-danger submit"><span>Eliminar producto </span></button>
                                          </div>
                                       </section>
                                    </form>
                                 </div>
                              </div>
                              <!--/tab_two-->
                              <!--/tab_three-->
                              <div class="tab3">
                                 <div class="pay_info">
                                 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                       <section class="creditly-wrapper wthree, w3_agileits_wrapper">
                                          <div class="credit-card-wrapper">
                                             <?php
                                             
                                             echo "<select class='form-select' data-live-search='true' name='modificar' required='' oninput='validity.valid||(value='');'>";
                                                echo " <option value='0' selected>No se ha seleccionado nada</option>";
                                                $productos = mysqli_query($con,"SELECT id_producto, tipo, personaje, cantidad, descripcion, precio, foto, id_proveedor FROM  producto;");
                                                if (mysqli_num_rows($productos) > 0){
                                                      while($row = mysqli_fetch_array($productos)) {
                                                         $id_producto_el=$row['id_producto'];
                                                         $tipo=$row['tipo'];
                                                         $personaje=$row['personaje'];
                                                         $descripcion=$row['descripcion'];
                                                         $precio=$row['precio'];
                                                         $foto=$row['foto'];
                                                         $cantidad=$row['cantidad'];
                                                         $id_proveedor=$row['proveedor'];
                                                         echo $id_producto;
                                                         echo "<option value='$id_producto_el'>".$personaje.". ID: ". $id_producto_el." Cantidad: ". $cantidad."</option>";
                                                         
                                                      }
                                                }
                                                echo "</select><br><br>";
                                              
                                                   echo "<button class='btn btn-warning submit'><span>Modificar producto </span></button>" ;
                                       
                                                  
                                                
                                                if(isset($_POST['modificar'])){
                                                   $mod=0;
                                                   $selectOption = $_POST['modificar'];
                                                   $modproductos = mysqli_query($con,"SELECT id_producto, tipo, personaje, cantidad, descripcion, precio, foto, id_proveedor FROM  producto where id_producto='$selectOption';");
                                                   if (mysqli_num_rows($modproductos) > 0){
                                                         while($row = mysqli_fetch_array($modproductos)) {
                                                            $id_producto_m=$row['id_producto'];
                                                            $tipo=$row['tipo'];
                                                            $personaje=$row['personaje'];
                                                            $descripcion=$row['descripcion'];
                                                            $precio=$row['precio'];
                                                            $foto=$row['foto'];
                                                            $cantidad=$row['cantidad'];
                                                            $id_proveedor=$row['id_proveedor'];
                                                            
                                                         }
                                                   }
                                                      echo "<form method='post' action='<?php echo htmlspecialchars(".$_SERVER['PHP_SELF'].");?>'>";
                                                      echo "<section class='creditly-wrapper wthree, w3_agileits_wrapper'>";
                                                         echo "<div class='credit-card-wrapper'>";
                                                            echo "<div class='first-row form-group'>";
                                                                  echo "<div class='w3_agileits_card_number_grid_right'>";
                                                                     echo "<div class='controls'>";
                                                                        echo "<label class='control-label'>Id producto</label>";
                                                                        echo "<input class='id form-control' inputmode='numeric' type='text' name='idproductomod' value='$selectOption'  min='1' required='' oninput='validity.valid||(value='');'>";
                                                                     echo "</div>";
                                                                  echo "</div>";
                                                            echo " <div class='controls'>";
                                                                  echo "<label class='control-label'>Personaje</label>";
                                                                  echo "<input class='personaje form-control' type='text' name='personajemod' value='$personaje'  required='' oninput='validity.valid||(value='');'>";
                                                               echo "</div>";
                                                               echo "<div class='w3_agileits_card_number_grids'>";
                                                               echo " <div class='w3_agileits_card_number_grid_left'>";
                                                                     echo "<div class='controls'>";
                                                                        echo "<label class='control-label'>Precio</label>";
                                                                        echo "<input class='precio form-control' type='text' name='preciomod' value='$precio' inputmode='numeric'  required='' min='10' oninput='validity.valid||(value='');'
                                                                        >";
                                                                     echo "</div>";
                                                                  echo "</div>";
                                                                  echo "<div class='w3_agileits_card_number_grid_right'>";
                                                                     echo "<div class='controls'>";
                                                                        echo "<label class='control-label'>Descripción</label>";
                                                                        echo "<input class='descripcion form-control'  type='text' name='descripcionmod' value='$descripcion'  required='' oninput='validity.valid||(value='');'>";
                                                                     echo "</div>";
                                                                  echo "</div>";
                                                                  echo "<div class='w3_agileits_card_number_grid_right'>";
                                                                     echo "<div class='controls'>";
                                                                        echo "<label class='control-label'>Cantidad en almacén</label>";
                                                                        echo "<input class='cantidad form-control' inputmode='numeric' type='text' name='cantidadmod' value='$cantidad'  required='' oninput='validity.valid||(value='');'>";
                                                                     echo "</div>";
                                                                  echo "</div>";
                                                                  echo "<div class='w3_agileits_card_number_grid_right'>";
                                                                  echo "<div class='controls'>";
                                                                     echo "<label class='control-label'>Foto src</label>";
                                                                     echo "<input class='foto form-control'  type='text' name='fotomod' value='$foto'  required='' oninput='validity.valid||(value='');'>";
                                                                  echo "</div>";
                                                               echo "</div>";
                                                                  echo "<div class='w3_agileits_card_number_grid_left'>";
                                                                     echo "<div class='controls'>";
                                                                        echo "<label class='control-label'>ID proveedor</label>";
                                                                        echo "<input class='proveedor form-control' type='text' name='proveedormod' inputmode='numeric' value='$id_proveedor' required='' max='4' min='1' oninput='validity.valid||(value='');'
                                                                        >";
                                                                     echo "</div>";
                                                                  echo "</div>";
                                                                  echo "<div class='clear'> </div>";
                                                               echo "</div>";
                                                            echo "</div>";
                                                            echo "<button class='btn btn-primary submit' type='submit' value='modificarprod' ><span>Modificar producto </span></button>";
                                                         echo "</div>";
                                                      echo "</section>";
                                                   echo "</form>";
                                                   
                                                   
                                                }
                                                if(isset($_POST['idproductomod'])){
                                                   unset($_POST['modificar']);
                                                   $mod=0;
                                                   $id_producto_mod = $_POST['idproductomod'];
                                                   $personajemod=$_POST['personajemod'];
                                                   $descripcionmod=$_POST['descripcionmod'];
                                                   $preciomod=$_POST['preciomod'];
                                                   $fotomod=$_POST['fotomod'];
                                                   $cantidadmod=$_POST['cantidadmod'];
                                                   $id_proveedormod=$_POST['proveedormod'];
                                                   $modificar = mysqli_query($con,"UPDATE `producto` SET `personaje`='$personajemod',`precio`='$preciomod',`cantidad`='$cantidadmod',`descripcion`='$descripcionmod',`foto`='$fotomod',`id_proveedor`='$id_proveedormod' WHERE id_producto='$id_producto_mod';");
                                                   $_SESSION['modificarwarn']=1;
                                                   echo "<script>window.location.href='admin.php'</script>";
                                                }
                                             ?>

                                             <br>
                                             
                                          </div>
                                       </section>
                                    </form>
                                    
                                 </div>
                              </div>
                              <!--//tab_three-->

                              <div class="tab4">
                                 <div class="row pay_info">
                                    <div class="col-md-12">
                                       <div style="height: 250px; , width: 500px;; overflow: auto">
                                          <table style="height: 400px" class="table table-bordered table-striped table-responsive-stack"  id="tableOne">
                                          <thead class="thead-dark">
                                          <tr><th>Fecha</th> <th>Id Compra</th>
                                             <th>Productos</th> <th>Id Usuario</th><th>Nombre</th>
                                             <th>Monto Pagado</th> <th>Teléfono</th><th>Ciudad</th></tr>
                                          <?php
                                             $historial = mysqli_query($con,"SELECT h.id_compra, h.id_producto, h.fecha_compra, h.telefono, h.ciudad, u.nombre_usuario, h.monto, h.id_usuario FROM  historial h, usuario u where h.id_usuario=u.id_usuario;");
                                                if (mysqli_num_rows($historial) > 0){
                                                      while($row = mysqli_fetch_array($historial)) {
                                                         $id_producto=$row['id_producto'];
                                                         $id_compra=$row['id_compra'];
                                                         $fecha=$row['fecha_compra'];
                                                         $telefono=$row['telefono'];
                                                         $ciudad=$row['ciudad'];
                                                         $nombre=$row['nombre_usuario'];
                                                         $monto=$row['monto'];
                                                         $id_usuario=$row['id_usuario'];
                                                         echo "<tr><td>";
                                                         echo $fecha;
                                                         echo "</td><td>";
                                                         echo $id_compra;
                                                         echo "</td><td>";
                                                         echo $id_producto;
                                                         echo "</td><td>";
                                                         echo $id_usuario;
                                                         echo "</td><td>";
                                                         echo $nombre;
                                                         echo "</td><td>";
                                                         echo $monto;
                                                         echo "</td><td>";
                                                         echo $telefono;
                                                         echo "</td><td>";
                                                         echo $ciudad;
                                                         echo "</td></tr>";
                                                      }
                                                }
                                                
                                             ?>
                                          </table>
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>


                              <div class="tab5">
                                 <div class="row pay_info">
                                    <div class="col-md-12">
                                       <div style="height: 250px; , width: 500px;; overflow: auto">
                                          <table style="height: 400px" class="table table-bordered table-striped table-responsive-stack"  id="tableOne">
                                          <thead class="thead-dark">
                                          <tr><th>Id Usuario</th> <th>Nombre Usuario</th>
                                             <th>Tipo</th> <th>Contraseña</th><th>Mail</th>
                                             </tr>
                                          <?php
                                             $historial = mysqli_query($con,"SELECT id_usuario, nombre_usuario, permisos, contrasena, mail FROM  usuario;");
                                                if (mysqli_num_rows($historial) > 0){
                                                      while($row = mysqli_fetch_array($historial)) {
                                                         $nombre_usuario=$row['nombre_usuario'];
                                                         $permisos=$row['permisos'];
                                                         if($permisos==0){
                                                            $tipou="Administrador";
                                                         }else{
                                                            $tipou="Comprador";
                                                         }
                                                         $contrasena=$row['contrasena'];
                                                         $mail=$row['mail'];
                                                         $id_usuario=$row['id_usuario'];
                                                         echo "<tr><td>";
                                                         echo $id_usuario;
                                                         echo "</td><td>";
                                                         echo $nombre_usuario;
                                                         echo "</td><td>";
                                                         echo $tipou;
                                                         echo "</td><td>";
                                                         echo $contrasena;
                                                         echo "</td><td>";
                                                         echo $mail;
                                                         echo "</td></tr>";
                                                      }
                                                }
                                                
                                             ?>
                                          </table>
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                              </div>

                           </div>
                        </div>
                     </div>
                     <!--//tabs-->
                  </div>
               </div>
               <!-- //payment -->
               <div class="clearfix"></div>
            </div>
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
      <!-- easy-responsive-tabs -->
      <script src="../js/easy-responsive-tabs.js"></script>
      <script>
         $(document).ready(function () {
         	$('#horizontalTab').easyResponsiveTabs({
         		type: 'default', //Types: default, vertical, accordion           
         		width: 'auto', //auto or any width like 600px
         		fit: true, // 100% fit in a container
         		closed: 'accordion', // Start closed if in accordion view
         		activate: function (event) { // Callback function if tab is switched
         			var $tab = $(this);
         			var $info = $('#tabInfo');
         			var $name = $('span', $info);
         			$name.text($tab.text());
         			$info.show();
         		}
         	});
         	$('#verticalTab').easyResponsiveTabs({
         		type: 'vertical',
         		width: 'auto',
         		fit: true
         	});
         });
      </script>
      <!-- credit-card -->
      <script src="../js/creditly.js"></script>
      <link rel="stylesheet" href="css/creditly.css" type="text/css" media="all" />
      <script>
         $(function () {
         	var creditly = Creditly.initialize(
         		'.creditly-wrapper .expiration-month-and-year',
         		'.creditly-wrapper .credit-card-number',
         		'.creditly-wrapper .security-code',
         		'.creditly-wrapper .card-type');
         
         	$(".creditly-card-form .submit").click(function (e) {
         		e.preventDefault();
         		var output = creditly.validate();
         		if (output) {
         			// Your validated credit card output
         			console.log(output);
         		}
         	});
         });
      </script>
      <!-- //credit-card -->
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