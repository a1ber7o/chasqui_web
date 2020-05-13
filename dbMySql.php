<?php

class DB_con
{
	function __construct()
	{
		$conn = mysqli_connect( "localhost", "root", "","db_chasqui") or die ("No se ha podido conectar al servidor de Base de datos");
		//mysqli_select_db( $conn, "dbtuts" ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
	}
	public function login($usuario,$password)
	{
		$conn = mysqli_connect( "localhost", "root", "","db_chasqui");
		$password = md5($password);
		$consulta="SELECT COUNT(*) as contar from users where usuario = '$usuario' and password ='$password'";
		$consulta2= "SELECT id_usuario FROM users WHERE usuario = '$usuario' AND password = '$password' ";
		$res = mysqli_query($conn, $consulta);
		$res2 = mysqli_query($conn, $consulta2);
		$array = mysqli_fetch_array($res);
		$array2 = mysqli_fetch_array($res2);
		
		$id = implode(" ",$array2);
		mysqli_close($conn);
		session_start();
		$_SESSION['usuario']=$usuario;
		$_SESSION['id_usuario']= $id;
		return $array['contar'];
	}
	public function insert($fname,$lname,$email,$ci,$usuario,$password,$imagen)
	{
		$conn = mysqli_connect( "localhost", "root", "","db_chasqui");
		$password=md5($password);
		$consulta="INSERT INTO persona VALUES('$ci','$fname','$lname','$email')";
		mysqli_query($conn, $consulta);
		$consulta2="INSERT INTO users VALUES('','$usuario','$password','$ci','$imagen','3')";
		$res = mysqli_query($conn, $consulta2);
		mysqli_close($conn);
		return $res;
	}
	public function select_personal()
	{
		$conn = mysqli_connect( "localhost", "root", "","db_chasqui");
		$res=mysqli_query($conn, "SELECT users.id_usuario, persona.nombre, persona.apellido, persona.email, persona.ci, users.usuario, users.categoria, users.imagen, users.password FROM persona
INNER JOIN users ON persona.ci=users.ci_usuario WHERE (users.categoria = 2) OR (users.categoria = 1);");
		mysqli_close($conn);
		return $res;
	}
	public function select()
	{
		$conn = mysqli_connect( "localhost", "root", "","db_chasqui");
		$res=mysqli_query($conn, "SELECT users.id_usuario, persona.nombre, persona.apellido, persona.email, persona.ci, users.usuario, users.categoria, users.imagen, users.password FROM persona
INNER JOIN users ON persona.ci=users.ci_usuario WHERE users.categoria = 3;");
		mysqli_close($conn);
		return $res;
	}
	public function mensajeros()
	{
		$conn = mysqli_connect( "localhost", "root", "","db_chasqui");
		$res=mysqli_query($conn, "SELECT persona.nombre FROM persona
INNER JOIN users ON persona.ci=users.ci_usuario WHERE categoria='2';");
		mysqli_close($conn);
		return $res;
	}
	public function ultimo()
	{
		$conn = mysqli_connect( "localhost", "root", "","db_chasqui");
		$res=mysqli_query($conn, "SELECT MAX(id_servicio) FROM servicio;");
		mysqli_close($conn);
		return $res;
	}
	public function destino()
	{
		$conn = mysqli_connect( "localhost", "root", "","db_chasqui");
		$res=mysqli_query($conn, "SELECT id_servicio, user, origen, altura, largo, ancho, peso, lat_i, lng_i, destino, lat_f, lng_f, user_d, ci_d, cel_d, mensajero FROM servicio;");
		mysqli_close($conn);
		return $res;
	}
	public function delete($id){
		$conn = mysqli_connect( "localhost", "root", "","db_chasqui");
		$res=mysqli_query($conn, "DELETE a1, a2 FROM users AS a1 INNER JOIN persona AS a2
WHERE a1.ci_usuario=a2.ci AND a1.ci_usuario LIKE $id");
		mysqli_close($conn);
		return $res;
	}
	public function servicio_o($id_usuario,$user,$origen,$altura,$largo,$ancho,$peso,$lat_i,$lng_i)
	{
		$conn = mysqli_connect( "localhost", "root", "","db_chasqui");
		$consulta="INSERT INTO servicio VALUES('','$id_usuario','$user','$origen','$altura','$largo','$ancho','$peso','$lat_i','$lng_i','', '', '', '', '', '', '')";
		$res=mysqli_query($conn, $consulta);
		mysqli_close($conn);
		return $res;
	}
	public function servicio_d($destino,$lat_f,$lng_f,$nombre_d,$ci_d,$cel_d,$ultimo)
	{
		$conn = mysqli_connect( "localhost", "root", "","db_chasqui");
		$consulta="UPDATE `servicio` SET `destino` = '$destino', `lat_f` = '$lat_f', `lng_f` = '$lng_f', `user_d` = '$nombre_d', `ci_d` = '$ci_d', `cel_d` = '$cel_d' WHERE `servicio`.`id_servicio` = '$ultimo'";
		$res=mysqli_query($conn, $consulta);
		mysqli_close($conn);
		return $res;
	}

	public function update($fname,$lname,$email1,$ci1,$usuario1,$password2,$imagen,$rol){
		$conn = mysqli_connect( "localhost", "root", "","db_chasqui");
		$password2=md5($password2);
		mysqli_query($conn, "UPDATE users SET usuario='$usuario1', password='$password2', imagen='$imagen', categoria='$rol' WHERE ci_usuario='$ci1'");
		$res=mysqli_query($conn, "UPDATE persona SET nombre='$fname', apellido='$lname', email='$email1' WHERE ci='$ci1'");
		mysqli_close($conn);
		return $res;
	}
	public function update_s($fname,$lname,$email1,$ci1,$usuario1,$password2,$imagen,$user_id){
		$conn = mysqli_connect( "localhost", "root", "","db_chasqui");

		$res=mysqli_query($conn, "UPDATE servicio SET user = '$fname', origen = '$lname', destino = '$email1', user_d = '$ci1', ci_d = '$usuario1', cel_d = '$password2', mensajero = '$imagen' WHERE id_servicio = '$user_id'");
		mysqli_close($conn);
		return $res;
	}
}

?>
