<?php
session_start();
include("funciones.php");
//autenticación
if(!isset($_SESSION["idU"]))
{
	header("location:".$ruta."login.php");// sacamos al usuario porq no esta autenticado.
}
$cant = '1';
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
<title>Art Quadrant</title>
<link rel="stylesheet" type="text/css" href="estilos.css">
<script type="text/javascript">
</script>
</head>
<body>
<?php
	encabezado();
	if(isset($_SESSION['idU'])) //el usuario está autenticado
	{	
		echo "<div class='container-xxl h-100'>";
		echo "<h3>Carrito de Compras</h3>";
		$qry = "select p.* from productos as p, carritocompras as c where p.idProducto=c.idProducto and c.idUsuario=".$_SESSION['idU'];
		$c = conectarBD();
		$rs = mysqli_query($c, $qry);
		//Publicar el resultado de la consulta
		if(mysqli_num_rows($rs)>0)//Si hay usuarios
		{
			echo "<table class='table table-dark table-striped table-bordered table-hover'>";
				echo "	<thead class='thead-dark'>";
				echo "		<tr>";
				echo "		<td scope='col'>#</td>";
				echo "		<td scope='col'>T&iacute;tulo</td>";
				echo "		<td scope='col'>Precio</td>";
				echo "		<td scope='col'>Descripci&iacute;n</td>";
				echo "		<td scope='col'>Imagen</td>";
				echo "		<td scope='col'> </td>";
				echo "		</tr>";
				echo "	</thead>";
				$i=0;
				$precio=0;
				while($datos = mysqli_fetch_array($rs))
				{
					$i++;
					echo "<tr scope='row'>";
						echo "<td>".$i."</td>";
						echo "<td>".$datos["Titulo"]."</td>";
						echo "<td>".$datos["Precio"]."</td>";
						echo "<td>".$datos["Descripcion"]."</td>";
						$pos = strpos($datos["TipoContenido"],"image/");
						if($pos===false)//no es una imagen
						{
							echo "<td>La imagen no esta disponible</td>";
						}
						else//es una imagen
						{
							echo "<td><img style=\"withd:100px; height:100px\" src=\"imagen.php?idA=".$datos["idProducto"]."\" alt=\"".$datos["NombreOriginal"]."\"></td>";
						}
						$precio+=($datos["Precio"] * $cant);
						echo "<td><a href=\"verArchivo.php?idA=".$datos["idProducto"]."\">VerArchivo</a> | <a href=\"eliminarArchivoCarrito.php?idA=".$datos["idProducto"]."\">Eliminar</a></td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "Total=".$precio;
				echo "	<a  class='form-control me-2 btn btn-outline-primary' href='comprar.php?precio=".$precio."'>Comprar</a>";
		}
		else//No hay documentos guardados
		{
			echo "<div class='h6' style='height:400px'><br><br>Actualemento no hay productos en tu carrito</div>";
		}
		echo "</div>";
	}
	else
	{ 
		login();
	}
	piePagina();
?>
</body>

</html>
