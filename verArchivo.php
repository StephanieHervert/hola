<?php
session_start();
include("funciones.php");
//debe pasarse idA y debe tener contenido
if(!isset($_GET['idA']) || $_GET['idA']=="")
{
	header("location:".$ruta."portada.php");
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
<script src="https://kit.fontawesome.com/78ef894ec0.js" crossorigin="anonymous"></script>
<title>verArchivos</title>
<link rel="stylesheet" type="text/css" href="estilos.css">
</head>

<body>
<?php
	encabezado();
?>
<div class="container-xxl">
<?php
	//Publicar los datos del archivo que quiero visualizar
	$qry = "select * from productos where idProducto=".$_GET["idA"];
	$c = conectarBD();
	$rs = mysqli_query($c, $qry);
	$doc = mysqli_fetch_array($rs);
	
	//recorrer los datos del documento
	echo "<h3>Información del documento</h3>";
	echo "<b>Titulo:</b> ".$doc["Titulo"]."<br>";
	echo "<b>Precio:</b> ".$doc["Precio"]."<br>";
	echo "<b>Despcripcion:</b>".$doc["Descripcion"]."<br>";
	$pos = strpos($doc["TipoContenido"],"image/");
	if($pos===false)//no es una imagen
	{
		echo "<td>Alcualmente no esta disponible la imagen</td>";
	}
	else//es una imagen
	{
		echo "<td><img style=\"withd:100px; height:100px\" src=\"imagen.php?idA=".$doc["idProducto"]."\" alt=\"".$doc["NombreOriginal"]."\"></td>";
	}
	echo "<hr>";
	echo "<div class='d-flex btn-group' role='group'>";
		echo "	<a  class='form-control me-2 btn btn-outline-primary' href='agregarCarrito.php?idA=".$doc["idProducto"]."'>Agregar al Carrito</a>";
		echo "	<a  class='form-control me-2 btn btn-light' href='agregarDeseos.php?idA=".$doc["idProducto"]."'>Agregar a la Lista de Deseados</a>";
	echo "</div><br><br>";
?>
		<h4>Comentario</h4>
		<form method="get" action="agregarComentario.php">
			<textarea rows="4" cols="70" name="txtComentario"></textarea>
			<input type="hidden" name="idA" value="<?php echo $_GET['idA']; ?>">
			<input type="submit" value="comentar">
		</form>
		<h4>Comentarios actuales</h4>
		<?php
			$qry = "select * from comentarios where idProducto=".$_GET['idA'];
			$rs = mysqli_query($c, $qry);
			if(mysqli_num_rows($rs)>0)//si hay comentarios
			{
				while($comentario = mysqli_fetch_object($rs))
				{
					echo "Fecha: " .$comentario->Fecha . "<br>";
					echo "Comentario: " .$comentario->Comentario. "<br>";
					echo "<hr>";
				}
			}
			else//no hay comentarios
			{
				echo "Por el momento no tenmos comentarios.";
			}
		?>
</div>
<?php
	piePagina();
?>
</body>

</html>
