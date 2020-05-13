<?php
session_start();
if($_SESSION['usuario']!='lpilcov')
{
	header("Location:registrar.php");
}
include_once 'dbMySql.php';
$con = new DB_con();
$table = "users";
$res=$con->destino($table);

if (isset($_POST['eliminar'])) {
    $id=$_POST['id'];
    $res=$con->delete($id);

    if ($res) {
      ?>
     <script>
        alert('Exito al eliminar');
        window.location='usuarios.php'
    </script>
    <?php
    }

    else{
        ?>
        <script>
            alert('Error al eliminar');
            window.location='usuarios.php'
        </script>
        <?php
    }
}

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
    <title>Solicitudes</title>
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
		        <h2 class="navbar-text navbar-right"><i class="glyphicon glyphicon-earphone glyphicon-align-left" aria-hidden="true"></i> 78923858</h2>
                <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav navbar-nav-center">
                    <li class="active"><a href="solicitudes.php">Solicitudes</a></li>
                    <li><a href="usuarios.php">Clientes</a></li>
					<li><a href="personal.php">Personal</a></li>
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


	<div id="content" style=" margin-top:10px; float:center; width:auto;;">
  <div class="container">
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-condensed">
      <tr>
        <th class="title_usuarios" colspan="17">LISTA DE SOLICITUDES</th>
      </tr>
			<tr>
				<th class="title">Usuario</th>
				<th class="title">Detalle de Origen</th>
				<th class="title">Altura</th>
				<th class="title">Largo</th>
				<th class="title">Ancho</th>
				<th class="title">Peso</th>
				<th class="title" colspan="2">Cordenadas Origen</th>
				<th class="title">Detalle de Destino</th>
				<th class="title" colspan="2" >Cordenadas Destino</th>
				<th class="title">Usuario Destino</th>
				<th class="title">CI Destino</th>
				<th class="title">Celular Destino</th>
				<th class="title">Mensajero</th>
				<th class="title" colspan="2">Opciones</th>
		</tr>
	<?php
		while($row=mysqli_fetch_row($res))
			{
				?>
						<tr>
						<td><?php echo $row[1]; ?></td>
						<td><?php echo $row[2]; ?></td>
						<td><?php echo $row[3]; ?></td>
						<td><?php echo $row[4]; ?></td>
						<td><?php echo $row[5]; ?></td>
						<td><?php echo $row[6]; ?></td>
						<td><?php echo $row[7]; ?></td>
						<td><?php echo $row[8]; ?></td>
						<td><?php echo $row[9]; ?></td>
						<td><?php echo $row[10]; ?></td>
						<td><?php echo $row[11]; ?></td>
						<td><?php echo $row[12]; ?></td>
						<td><?php echo $row[13]; ?></td>
						<td><?php echo $row[14]; ?></td>
						<td><?php echo $row[15]; ?></td>
						<td>

							 <form action="modificar_s.php" method="post">
											 <input type="hidden" name="id_servicio" value="<?php echo $row[0]; ?>">
											 <input type="hidden" name="user" value="<?php echo $row[1]; ?>">
											 <input type="hidden" name="origen" value="<?php echo $row[2]; ?>">
											 <input type="hidden" name="altura" value="<?php echo $row[3]; ?>">
											 <input type="hidden" name="largo" value="<?php echo $row[4]; ?>">
											 <input type="hidden" name="ancho" value="<?php echo $row[5]; ?>">
											 <input type="hidden" name="peso" value="<?php echo $row[6]; ?>">
											 <input type="hidden" name="lat_i" value="<?php echo $row[7]; ?>">
											 <input type="hidden" name="lng_i" value="<?php echo $row[8]; ?>">
											 <input type="hidden" name="destino" value="<?php echo $row[9]; ?>">
											 <input type="hidden" name="lat_f" value="<?php echo $row[10]; ?>">
											 <input type="hidden" name="lng_f" value="<?php echo $row[11]; ?>">
											 <input type="hidden" name="user_d" value="<?php echo $row[12]; ?>">
											 <input type="hidden" name="ci_d" value="<?php echo $row[13]; ?>">
											 <input type="hidden" name="cel_d" value="<?php echo $row[14]; ?>">
											 <input type="hidden" name="mensajero" value="<?php echo $row[15]; ?>">
											 <input class="update_delete" type="submit" value="Asignar Mensajero" name="modificar_s">
								</form>
						</td>
						<td>
								<form action="solicitudes.php" method="post">
								<input type="hidden" name="id" value="<?php echo $row[4]; ?>">
								<input class="update_delete" type="submit" value="Finalizar" name="finalizar">
								 </form>
						</td>
						</tr>
						<?php
	}
		?>
		</table>
    </div>
    </div>

<a href="solicitudes.php">
 <button style="margin: 10px 0px 10px 200px" class="btn btn-primary" type="submit"><strong>Actulizar</strong></button>
</a>

    </div>
</div>
      <!-- Bottom -->
      <section class="bottom" id="bottom">
        <div class="container">
	      <div class="row bottom-row">
            <div class="col-md-4">
              <h3 class="header header-bottom">Sobre Chasqui Express</h3>
	          <p>
			    Somos una empresa de envios que le ofrece comodidad, seguridad y rapidez al enviar cualquier objeto ya sea documentos o regalos sabemos lo importante que son para usted.
			  </p>
		    </div>
            <div class="col-md-4">
              <h3 class="header header-bottom">Departamentos para envio</h3>
		      <p>
                <i class="uk-icon-check "></i>&nbsp; <a href="faq.html#">La Paz</a><br>
                <i class="uk-icon-check "></i>&nbsp; <a href="faq.html#">Cochabamba</a><br>
                <i class="uk-icon-check "></i>&nbsp; <a href="faq.html#">Santa Cruz</a><br>
			  </p>
		    </div>
            <div class="col-md-4">
              <h3 class="header header-bottom">Contactanos</h3>
		      <p>
                <i class="uk-icon-envelope "></i>&nbsp; Chasqui Express@gmail.com<br>
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
            <li><a href="solicitudes.php">Solicitudes</a></li>
            <li><a href="usuarios.php">Clientes</a></li>
            <li><a href="salir.php">Cerrar Sesion</a></li>
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
