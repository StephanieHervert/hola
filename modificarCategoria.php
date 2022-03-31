<?php
session_start();
include("funciones.php");
$msg = "";
$c = conectarBD();
//verificar que el usuario este autenticado
if(!isset($_SESSION["idU"]))
{
	header("location:".$ruta."portada.php");// sacamos al usuario porq no esta autenticado.
}
//verificar que el usuario esté autorizdo para estar en esta página.
$rolUsr = RolDeUsuario($_SESSION["idU"]);
if($rolUsr!="Administrador")
{
	header("location:".$ruta."portada.php");// sacamos al usuario porq no esta autarizado.
}
//validar que se hayan pasado los datos
if(isset($_POST["txtTitulo"]) && isset($_POST["txtDescripcion"]))
{
	if($_POST["txtTitulo"]!="" && $_POST["txtDescripcion"]!="")
	{
		$titulo = $_POST["txtTitulo"];
		$descripcion = $_POST["txtDescripcion"];
		//insertar el archivo en la BD															
		$qry = "update categorias set NombreCategoria='$titulo', Descripcion='$descripcion' where idCategoria=".$_GET['idC'];
		mysqli_query($c, $qry);
		$msg = "<div class='alert alert-success' role='alert'>Se actualizo correctamente la Catelgoria de: ".$_POST["txtTitulo"]."</div>";
	}
	else
	{
		$msg = "<div class='alert alert-danger' role='alert'>Favor de llenar todo el formulario</div>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/78ef894ec0.js" crossorigin="anonymous"></script>
<title>Cargar Producto</title>
<link rel="stylesheet" type="text/css" href="estilos.css">
<script type="text/javascript">
function validaFRM()
{
	if(document.getElementById("txtTitulo").value==""|| 
		document.getElementById("txtDescripcion").value=="")
	{
		document.getElementById("txtMsg").innerHTML = "<div class='alert alert-danger' role='alert'>Todo los datos son requeridos</div>";
		return false;
	}
	else
	{
		return true;
	}
}
</script>
</head>
<body>
<?php
	encabezado();
?>
<div style="height:100px"></div>
<form class="container-sm" method="post" enctype="multipart/form-data" action="modificarCategoria.php?idC=<?php echo $_GET['idC']; ?>" onsubmit="return validaFRM()">	
<a class="btn btn-light float-lg-start" href="administracion.php"><i class="fas fa-arrow-left"></i></a> 
	<div class="container-sm">
		<h3>Formulario para cargar categor&iacute;a</h3>
		<?php
			if($msg!="")echo "<div id=\"txtMsg\">$msg</div>";
		?> <br>
		Titulo de la Categor&iacute;a: <input class="form-control me-2"  type="text" id="txtTitulo" name="txtTitulo"><br>
		Descripción del Producto:<textarea class="form-control me-2" rows="4" cols="70" id="txtDescripcion" name="txtDescripcion"></textarea><br>
		<div class="d-flex btn-group" role="group">
	  		<input class="form-control me-2 btn btn-outline-primary" type="submit" value="Actualizar Categor&iacute;a">
			<input class="form-control me-2 btn btn-light" type="reset" value="Reinicar Formularío">
		</div><br><br>
	</div>
</form>
<div style="height:100px"></div>
<?php
	piePagina();
?>
</body>
</html>
