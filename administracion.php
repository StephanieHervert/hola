<?php
session_start();
include("funciones.php");
//autenticación
if(!isset($_SESSION["idU"]))
{
	header("location:".$ruta."portada.php");// sacamos al usuario porq no esta autenticado.
}
// auntorización
$rolUsr = RolDeUsuario($_SESSION["idU"]);
if($rolUsr!="Administrador")
{
	header("location:".$ruta."portada.php");// sacamos al usuario porq no esta autarizado.
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
<title>Lista de Administración</title>
<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
<?php
	encabezado();
	echo "<div class='container-fluid'>";
	if(isset($_SESSION['idU'])) //el usuario está autenticado
	{
		$rolUsr = RolDeUsuario($_SESSION["idU"]);
		if($rolUsr=="Administrador")
		{	
			echo "<div class='container-sm d-flex justify-content-between' role='group'>";
			echo "	<a  class='form-control me-2 btn btn-outline-primary' href='cargarArchivo.php'>Agregar Producto</a>";
			echo "	<a  class='form-control me-2 btn btn-outline-primary' href='cargarCategoria.php'>Agregar Categor&iacute;a</a>";
			echo "	<form class='d-flex w-100' method='get' action='administracion.php'>";
					Search();
			echo "	</form>";
			echo "</div><br><br>";
			$c = conectarBD();
			$qry = "select * from productos";			
			if(isset($_GET['search'])&& $_GET['search']!="")
			{
				$qry = "select * from productos where Titulo like'%".$_GET['search']."%'";
			}
			$rs = mysqli_query($c, $qry);
			//Publicar el resultado de la consulta
			echo "<div class='d-flex justify-content-around' role='group'>";
			echo "	<div class=''><h3>Productos</h3></div>";
			echo "	<div class=''><h3>Categorias</h3></div>";
			echo "</div><br><br>";
			echo "<div class='d-flex justify-content-around' role='group'>";
			if(mysqli_num_rows($rs)>0)//Si hay
			{
				echo "<table class='table table-dark table-striped table-bordered table-hover w-50'>";
				echo "	<thead class='thead-dark'>";
				echo "		<tr>";
				echo "		<td scope='col'>#</td>";
				echo "		<td scope='col'>T&iacute;tulo</td>";
				echo "		<td scope='col'>Precio</td>";
				echo "		<td scope='col'>Descripci&oacute;n</td>";
				echo "		<td scope='col'>Imagen</td>";
				echo "		<td scope='col'>Categor&iacute;as</td>";
				echo "		<td scope='col'> </td>";
				echo "		</tr>";
				echo "	</thead>";
				$i=0;
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
							echo "<td><img style=\"withd:250px; height:250px\" src=\"imagen.php?idA=".$datos["idProducto"]."\" alt=\"".$datos["NombreOriginal"]."\"></td>";
						}
						echo "<td>";
						$qry = "select * from listascategorias as l, categorias as c where l.idProducto=".$datos["idProducto"]." and l.idCategoria=c.idCategoria";
						$res = mysqli_query($c, $qry);
						if(mysqli_num_rows($res)>0)//si hay comentarios
						{
							while($cate = mysqli_fetch_object($res))
							{
								echo $cate->NombreCategoria."<br>";
							}
						}
						else//no hay comentarios
						{
							echo "No tiene categor&iacute;a asignada.";
						}

						echo "</td>";
						echo "<td><a href=\"verArchivo.php?idA=".$datos["idProducto"]."\">VerArchivo</a> | <a href=\"modificarArchivo.php?idA=".$datos["idProducto"]."\">Modificar Archivo</a> | <a href=\"eliminarArchivo.php?idA=".$datos["idProducto"]."\">Eliminar</a></td>";
					echo "</tr>";
				}
				echo "</table><br>";
			}
			else
			{
				echo "<h6 class='w-50'>No se encontro ningun producto</h6>";
			}
			echo "<div style='width:10px'></div>";
			//Categorias
			$qry = "select * from categorias";			
			if(isset($_GET['search'])&& $_GET['search']!="")
			{
				$qry = "select * from categorias where NombreCategoria like '%".$_GET['search']."%'";
			}
			$rs = mysqli_query($c, $qry);
			//Publicar el resultado de la consulta
			if(mysqli_num_rows($rs)>0)//Si hay usuarios
			{
				echo "<table class='table table-dark table-striped table-bordered table-hover w-50'>";
				echo "	<thead class='thead-dark'>";
				echo "		<tr>";
				echo "		<td scope='col'>#</td>";
				echo "		<td scope='col'>Categor&iacute;a</td>";
				echo "		<td scope='col'>Descripci&oacute;n</td>";
				echo "		<td scope='col'> </td>";
				echo "		</tr>";
				echo "	</thead>";
				$i=0;
				while($datos = mysqli_fetch_array($rs))
				{
					$i++;
					echo "<tr scope='row'>";
						echo "<td>".$i."</td>";
						echo "<td>".$datos["NombreCategoria"]."</td>";
						echo "<td>".$datos["Descripcion"]."</td>";
						echo "<td><a href='modificarCategoria.php?idC=".$datos["idCategoria"]."'>Modificar</a> | <a href=\"eliminarCategoria.php?idA=".$datos["idCategoria"]."\">Eliminar</a></td>";
					echo "</tr>";
				}
				echo "</table>";
			}
			else
			{
				echo " <h6 class='w-50'>No se encontro ninguna categor&iacute;a</h6>";
			}
			echo "</div><br><br>";
		}
	}
	echo "</div>";
?>
</body>

</html>
