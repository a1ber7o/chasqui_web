<?php
session_start();
if($_SESSION['usuario']!='lpilcov')
{
	header("Location:registrar.php");
}
include_once 'dbMySql.php';
$con = new DB_con();
$formatos=array('.jpg','.png','.gif','.ico');
$table = "users";
$res1=$con->mensajeros($table);


if(isset($_POST['modificar_s']))
{
    $id= $_POST['id_servicio'];
    $nombre = $_POST['user'];
    $apellido = $_POST['origen'];
    $email= $_POST['destino'];
    $ci= $_POST['user_d'];
    $usuario= $_POST['ci_d'];
    $password= $_POST['cel_d'];
}
if(isset($_POST['modificar_datos']))
{
    $user_id = $_POST['user_id'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email1= $_POST['Memail'];
    $ci1 = $_POST['Mci'];
    $usuario1= $_POST['Musuario'];
    $password2= $_POST['Mpassword'];
    $imagen = $_POST['mensajero'];
    $res=$con->update_s($fname,$lname,$email1,$ci1,$usuario1,$password2,$imagen,$user_id);
    if($res)
    {
        ?>
        <script>
        alert('Exito al modificar');
        window.location='solicitudes.php'
        </script>
        <?php
    }
    else
    {
        ?>
        <script>
        alert('Error al modificar');
        window.location='modificar_s.php'
        </script>
        <?php
    }
    }

// data insert code ends here.
?>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Meta -->
    <meta name="description" content="Geo Taxi.">
	<meta name="keywords" content="boostrap, responsive, html5, css3, jquery, theme, uikit, multicolor, parallax, retina, taxi business" />
    <meta name="author" content="dhsign">
	<meta name="robots" content="index, follow" />
	<meta name="revisit-after" content="3 days" />
    <title>Modificar Usuario</title>
	<link rel="stylesheet" href="estilos_form.css">
	<!-- Styles -->
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
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

  <body>
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
		        <h2 class="navbar-text navbar-right"><i class="glyphicon glyphicon-earphone glyphicon-align-left" aria-hidden="true"></i> 70549046</h2>
                <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav navbar-nav-center">
                    <li><a href="solicitudes.php">Solicitudes</a></li>
                    <li class="active"><a href="usuarios.php">Asignar Solicitud</a></li>

                    <li><a href="salir.php">Cerrar Sesion</a></li>
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

    <div id="taxiStripe" style="margin: 1rem; padding: 1rem;" align="center">
    <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo $id; ?>">
    <table class="table table-striped table-bordered table-condensed" style="width:50%;">

    <tr>
      <th class="title">DATOS</th>
    </tr>

    <tr >
      <td>Usuario Origen:<input class="form-control" type="text" name="first_name" placeholder="Nombre" value="<?php echo $nombre;?>" required /></td>
    </tr>
    <tr>

    <td>Detalles de Origen:<input class="form-control" type="text" name="last_name" placeholder="Apellido"  value="<?php echo $apellido; ?>" required /></td>
    </tr>
    <tr>
    <td>Detalles de Destino:<input class="form-control" type="text" name="Memail" placeholder="Email" value="<?php echo $email; ?>" required /></td>
    </tr>
     <tr>
    <td>Nombre del Destinatario:<input class="form-control" type="text" name="Mci" placeholder="C.I." value="<?php echo $ci; ?>" required /></td>
    </tr>

     <tr>
    <td>CI de Destinatario:<input class="form-control" type="text" name="Musuario" placeholder="Usuario"  value="<?php echo $usuario; ?>"; required /></td>
    </tr>
     <tr>
    <td>Celular de Destinatario:<input class="form-control" type="text" name="Mpassword" placeholder="Contraseña"  value="<?php echo $password; ?>" required /></td>
    </tr>
    <tr>
    <td>Mensajero:<select class="form-control" name="mensajero">
			<?php
			          while ($valores = mysqli_fetch_array($res1)) {
			            echo '<option value="'.$valores[nombre].'">'.$valores[nombre].'</option>';
			          }
			        ?>

</select></td>
    </tr>
    <tr>
    <td>
    <button type="submit" name="modificar_datos"><strong>Modificar</strong></button></td>
     </form>
    </tr>
    </table>
    </div>
    </div>

</div>


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
