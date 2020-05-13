<?php
session_start();
include_once 'dbMySql.php';
$con = new DB_con();
$formatos=array('.jpg','.png','.gif','.ico');
// data insert code starts here.
if(isset($_POST['btn-save']))
{
     $nombre=$_FILES['archivo']['name'];
        $nombreTmp=$_FILES['archivo']['tmp_name'];
        $exte=substr($nombre, strrpos($nombre,'.'));
        if (in_array($exte,$formatos)) {
            if (move_uploaded_file($nombreTmp,"imagenes/$nombre")) {
                 //echo '<script> alert(" Exito al ingresar su imagen"); </script>';
                 //echo "<script> window.location='index.html'; </script>";
            }
        }
        else{
                echo '<script> alert(" Error al ingresar la imagen"); </script>';
                echo "<script> window.location='registrar.php'; </script>";

        }


	$fname = $_POST['first_name'];
	$lname = $_POST['last_name'];
    $aemail= $_POST['email'];
    $aci= $_POST['ci'];
    $ausuario= $_POST['usuario'];
	$apassword= $_POST['password'];
    $imagen = $nombre;


	$res=$con->insert($fname,$lname,$aemail,$aci,$ausuario,$apassword,$imagen);
	if($res)
	{
		
		?>
		<script>
        window.location='registrar.php'
		<?php
		session_start();
		$_SESSION['usuario'] = $ausuario;
		?>
        </script>
		<?php
		
	}
	else
	{
		?>
		<script>
		alert('error en el registro de usuario...');
        window.location='registrar.php'
        </script>
		<?php
	}
}
session_destroy();
if(isset($_POST['btn-login']))
{
	
    $lusuario= $_POST['usuario1'];
	$lpassword= $_POST['password1'];


	$res=$con->login($lusuario,$lpassword);
	if($res>0)
	{
		?>
		<script>
        window.location='servicio_o.php'
        </script>
		<?php
	}
	else
	{
		?>
		<script>
        window.location='registrar.php'
        </script>
		<?php
		session_start();
		$_SESSION['fallo_login'] = 1;
		unset($_SESSION['usuario']);
	}
}
// data insert code ends here.
?>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Inicio de Sesion</title>
	<link rel="stylesheet" href="estilos_form.css">
	<!-- Styles -->
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
	<!-- jQuery UI CSS -->
    <link href="assets/css/jquery-ui.css" rel="stylesheet">
    <!-- Uikit CSS -->
    <link href="assets/css/uikit.almost-flat.css" rel="stylesheet">
    <!-- OWL Carousel CSS -->
    <link href="assets/css/owl.carousel.css" rel="stylesheet">
    <link href="assets/css/owl.theme.css" rel="stylesheet">
    <!-- Template CSS -->
	<link href="assets/css/quotes.css" rel="stylesheet">
	<link href="assets/css/product.css" rel="stylesheet">
    <link href="citycab.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat+Alternates' rel='stylesheet' type='text/css'>
  </head>
  <body id="body" onload="initMap()" style="margin:0px; border:0px; padding:0px;">
    <!-- Wrap all page content -->
	  
    <div class="page-wrapper" id="page-top">
	  <header class="header-wrapper" id="header-wrapper" >
	    <!-- Main Navigation  -->
	    <div class="container main-navigation">
		  <div id="header" class="row">
            <div class="col-md-12 col-pad-0">
	          <!-- Fixed navbar -->
              <div class="navbar navbar-default navbar-fixed-top" role="navigation">
				<!-- Brand and toggle get grouped -->
				<div class="navbar-header">
				  <a id="offcanvas-toggler" class="navbar-toggle" data-toggle="collapse"></a>
                  <div class="navbar-brand">
                    <a href="index.html"><img src="images/logo.png" alt="Logo"></a>
                  </div>
				</div>
		        <h2 class="navbar-text navbar-right"><i class="glyphicon glyphicon-earphone glyphicon-align-left" aria-hidden="true"></i>70549046</h2>
                <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav navbar-nav-center">
                    <li><a href="index.html"> <b>Inicio</b>  </a></li>
                    <li class="active"><a href="about.html"><b>Inicie Sesion</b></a></li>
                  </ul>
                </div><!--/.nav-collapse -->
              </div>
			</div>
          </div>
		</div>
		<!-- /Main Navigation -->
	  </header>

      <!-- Gap -->
      <div id="taxiStripe" class="container-fluid gap-fullsize">
	  </div>
	  <!-- /Gap -->

      <!-- Lost Property -->
	  <section class="book-taxi" id="book-taxi">
        <div class="container">
	      <div class="row">			  
            <div class="col-md-6">
              <div> <h1 class="uk-text-yellow book-now">Registrese! y nosotros nos encargamos de los envios:</h1>
			  <?php  if(isset($_SESSION['usuario'])){echo "<h3 class='uk-text-green text-center'>Inicie Sesion, Por Favor!</h3>";}?>
              </div>
			  <div>
                <form class="form-horizontal col-lg-11" role="form" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="control-label label-left col-xs-3">NOMBRE:<em>*</em></label>
                    <div class="col-xs-9">
                      <input class="btn btn-block btn-info btn-sm" type="text" name="first_name" placeholder="Ingrese sus nombres" autocomplete="off" required >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label label-left col-xs-3">APELLIDOS:<em>*</em></label>
                    <div class="col-xs-9">
                      <input class="btn btn-block btn-info btn-sm" type="text" name="last_name" placeholder="Ingrese sus apellidos" autocomplete="off" required >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputStartDestination" class="control-label label-left col-xs-3">E-MAIL:<em>*</em></label>
                    <div class="col-xs-9">
                      <input class="btn btn-block btn-info btn-sm" type="email" name="email" placeholder="Ingrese su correo electronico" autocomplete="off" required pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" title="usuario@ejemplo.com">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label label-left col-xs-3">CI:<em>*</em></label>
                    <div class="col-xs-9">
                      <input class="btn btn-block btn-info btn-sm" type="number" name="ci" placeholder="Ingrese su Carnet de Identidad" autocomplete="off" required >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label label-left col-xs-3">USUARIO:<em>*</em></label>
                    <div class="col-xs-9">
                      <input class="btn btn-block btn-info btn-sm" type="text" name="usuario" placeholder="Ingrese un nombre de usuario" autocomplete="off" required pattern="[A-Za-z0-9]{5,20}" title="Letras y números. Tamaño mínimo: 5. Tamaño máximo: 20" >
                    </div>
                  </div>
				          <div class="form-group">
                    <label class="control-label label-left col-xs-3">CONTRASEÑA:<em>*</em></label>
                    <div class="col-xs-9">
                      <input class="btn btn-block btn-info btn-sm" type="password" name="password" placeholder="Ingrese una contraseña" autocomplete="off" required >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label label-left col-xs-3">FOTO DE C.I.:<em>*</em></label>
                    <div class="col-xs-9">
                      <input class="custom-file-input" type="file" name="archivo" autocomplete="off" required>
                    </div>
                  </div>
				<div class="form-group">
                    <div class="col-xs-offset-3 col-xs-9">
                      <p class="uk-text-black" type="text">Los campos con (<em>* </em>) son obligatorios</p>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-xs-offset-3 col-xs-9">
                      <button type="submit" name="btn-save" class="btn btn-primary">Registrarse</button>
                    </div>
                  </div>
                </form>
			  </div>
		    </div>
		    <div class="col-md-6">
              <div>
				<form method="post" class="col-lg-offset-0 col-lg-12" >
                        <table align="center" class="table1">
						<div>
                            <td>
                            <h1 class="uk-text-yellow book-now"><span>Inicie Sesion:</span></h1>
								<?php  if(isset($_SESSION['fallo_login'])){echo "<h3 class='uk-text-red text-center alert-danger'>Datos Incorrectos</h3>";}?>
                            </td>
                            <tr>
								<h4 class="uk-text-center"><td><label for="inputName" class="uk-text-yellow">Usuario:</label>
                                <div class="">
                                <input class="btn btn-block btn-info btn-xs" type="text" name="usuario1" placeholder="Usuario" pattern="[A-Za-z0-9]{5,20}" title="Letras y números. Tamaño mínimo: 5. Tamaño máximo: 20"/>
								</div></td></h4>
                            </tr>
                            <tr>
                                <td><label for="inputName" class="uk-text-yellow"><br>
                                  Contraseña:</label>
								 <div class="">
                              <h4 class="uk-text-center"><input class="btn btn-block btn-info btn-xs" type="password" name="password1" placeholder="Contraseña" /></div></td></h4>
                            </tr>
                            <tr>
                                <td>
                                    <h4 class="uk-text-center"><button style="margin-top: 10px" class="btn btn-success" type="submit" name="btn-login"><strong>Ingresar</strong></h4>
                                    </button>
                                </td>
                            </tr>


							</div>

                        </table>
						<div>
							<p><img data-uk-scrollspy="{cls:'uk-animation-slide-right', delay:600}"
									style="display: block; margin-right: auto; margin-left: auto;"
									src="images/pro.png" alt="about">
							</p>
						</div>
                    </form>
					
			  </div>
		    </div>
		  </div>
	    </div>
	  </section>
            <!-- Bottom -->
            <section class="bottom" id="bottom">
        <div class="container">
	      <div class="row bottom-row">
            <div class="col-md-4">
              <h3 class="header header-bottom">Sobre ChasquiExpress</h3>
	          <p>
			    Somos una empresa de envios que le ofrece comodidad, seguridad y rapidez al enviar cualquier objeto ya sea documentos o regalos sabemos lo importante que son para usted.
			  </p>
		    </div>
            <div class="col-md-4">
              <h3 class="header header-bottom">Departamentos de envio</h3>
		      <p>
                <i class="uk-icon-check "></i>&nbsp; <a href="faq.html#">La Paz</a><br>
                <i class="uk-icon-check "></i>&nbsp; <a href="faq.html#">Cochabamba</a><br>
                <i class="uk-icon-check "></i>&nbsp; <a href="faq.html#">Santa Cruz</a><br>
			  </p>
		    </div>
            <div class="col-md-4">
              <h3 class="header header-bottom">Contactanos</h3>
		      <p>
                <i class="uk-icon-envelope "></i>&nbsp; ChasquiExpress@gmail.com<br>
			    <i class="uk-icon-phone "></i>&nbsp; +591 78923858<br>
			    <i class="uk-icon-print "></i>&nbsp; +591 70549046<br>
			    <i class="uk-icon-building "></i>&nbsp; La Paz-Bolivia
			  </p>
		    </div>
		  </div>
	    </div>
	  </section>
	  <!-- /Bottom -->

	  <!-- Footer -->
      <footer class="footer-wrapper" id="footer-wrapper">
	    <div class="container">
		  <div id="footer" class="row">
            <div class="col-md-4">
			  <span class="copyright">copyright &copy;  2019 Chasqui Express</span>
			</div>
            <div class="col-md-4 uk-text-center">
              <div>
			    <a href="faq.html#" class="btn btn-inverse social"><i class="uk-icon-facebook"></i></a>
			    <a href="faq.html#" class="btn btn-inverse social"><i class="uk-icon-twitter"></i></a>
			    <a href="faq.html#" class="btn btn-inverse social"><i class="uk-icon-pinterest"></i></a>
			    <a href="faq.html#" class="btn btn-inverse social"><i class="uk-icon-google-plus"></i></a>
			    <a href="faq.html#" class="btn btn-inverse social"><i class="uk-icon-youtube-play"></i></a>
			  </div>
			  	<a class="totop" rel="nofollow" href="faq.html#page-top" title="Goto Top" data-uk-smooth-scroll><i class="uk-icon-caret-up"></i></a>
			</div>
	      </div>
        </div>
	  </footer>
      <!-- /Footer -->

	  <!-- Off Canvas Menu -->
      <div class="offcanvas-menu">
        <a class="close-offcanvas" href="faq.html#"><i class="uk-icon-remove"></i></a>
        <div class="offcanvas-inner">
	      <ul class="nav menu">
            <li class="active"><a href="index.html">Inicio</a></li>
            <li><a href="servicio.php">Solicite Servicio</a></li>
	      </ul>
        </div>
      </div>
	  <!-- /Off Canvas Menu -->

    </div>
    <!-- /Wrap all page content -->

    <!-- Scripts placed at the end of the document so the pages load faster -->

    <!-- Jquery scripts -->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>

    <!-- Uikit scripts -->
	<script src="assets/js/uikit.min.js"></script>

	<!-- OWL Carousel scripts -->
	<script src="assets/js/owl.carousel.min.js"></script>

    <!-- Template scripts -->
	<script src="assets/js/template.js"></script>

	<!-- Bootstrap core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
