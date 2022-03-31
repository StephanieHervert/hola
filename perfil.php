<?php
session_start();
include("funciones.php");
//autenticación
if(!isset($_SESSION["idU"]))
{
	header("location:".$ruta."portada.php");// sacamos al usuario porq no esta autenticado.
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="78ef894ec0.js" crossorigin="anonymous"></script>
<title>Perfil</title>
<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
<?php
	encabezado();
	echo "<div class='container'>";
	if(isset($_SESSION['idU'])) //el usuario está autenticado
	{
		$qry = "select * from usuarios where idUsuario=". $_SESSION['idU'];
		$c = conectarBD();
		$rs = mysqli_query($c, $qry);
		$doc = mysqli_fetch_array($rs);
		
		echo "<a class='btn btn-light float-lg-start' href='portada.php'><i class='fas fa-arrow-left'></i></a><br><br><br>";
		echo "<h3>Perfil</h3><br>";
		echo "<b>Nombre Completo:</b> ".$doc["NombreCompleto"]."<br>";
		echo "<b>Usuario:</b> ".$doc["Usuario"]."<br>";
		echo "<b>Email:</b> ".$doc["Email"]."<br>";
		echo "<b>Pa&iacute;s:</b>".$doc["Pais"]."<br>";
		echo "<b>Direcci&oacute;n:</b>".$doc["Direccion"]."<br>";
		echo "<b>Ciudad:</b> ".$doc["Ciudad"]."<br>";
		echo "<b>Estado:</b> ".$doc["Estado"]."<br>";
		echo "<b>Codigo Postal:</b> ".$doc["CodigoPostal"]."<br><br>";
		echo "<div class='d-flex btn-group' role='group'>";
		echo "	<a  class='form-control me-2 btn btn-outline-primary' href='cambiaPwd.php'>Cambiar Contraseña</a>";
		echo "	<a  class='form-control me-2 btn btn-outline-primary' href='cambiaNombre.php'>Cambiar Nombre</a>";
		echo "	<a  class='form-control me-2 btn btn-outline-primary' href='cambiaDireccion.php'>Cambiar Direcci&oacute;n</a>";
		echo "</div><br><br>";
	}
	echo "</div>";
	piePagina();
?>
</body>

</html>
