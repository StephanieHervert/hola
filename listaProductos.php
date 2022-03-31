<?php
session_start();
include("funciones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/78ef894ec0.js" crossorigin="anonymous"></script>
<title>Productos</title>
<link rel="stylesheet" type="text/css" href="estilos.css">

</head>
<body>
<?php
	encabezado();
	$c = conectarBD();
?>  	
<!--Pagina-->
<div class="container-sm">
<div class="row">
	<div class='container-sm d-flex justify-content-between' role='group'>
	<form class='d-flex w-100' method='get' action='listaProductos.php'>
	<select class='form-select' id='txtCategoria' name='txtCategoria'>
		 <option value="">Categorías</option>
			<?php 
				$qry = "select * from categorias";			
				$res = mysqli_query($c, $qry);
				//Publicar el resultado de la consulta
				if(mysqli_num_rows($res)>0)//Si hay usuarios
				{
					while($datos = mysqli_fetch_array($res))
					{
						echo "<option value=".$datos["idCategoria"].">".$datos["NombreCategoria"]."</option>";
					}
				}
			?>
	</select>
    <input class='form-control me-2' type='search' id='search' name='search' placeholder='Search'>
	<button class='btn btn-outline-primary' type='submit'>Buscar</button>
	</form>
	</div>
	<?php
	$qry = "select * from productos order by Titulo asc limit 30";
	if(isset($_GET['search']) && isset($_GET['txtCategoria']))
	{
		if($_GET['search']!="" && $_GET['txtCategoria']!="")
		{
			$qry = "select p.* from productos as p, listascategorias as li where li.idProducto=p.idProducto and p.Titulo like'%".$_GET['search']."%' and li.idCategoria=".$_GET['txtCategoria'];
		}
		else if($_GET['search']!="" && $_GET['txtCategoria']=="")
		{
			$qry = "select * from productos where Titulo like'%".$_GET['search']."%' order by Titulo asc limit 30";
		}
		else if($_GET['search']=="" && $_GET['txtCategoria']!="")
		{
			$qry = "select p.* from productos as p, listascategorias as li where li.idProducto=p.idProducto and li.idCategoria=".$_GET['txtCategoria'];
		}
	}
  	$rs = mysqli_query($c, $qry);
  	if(mysqli_num_rows($rs)>0)//Si hay
	{
		$i=0;
		while($datos = mysqli_fetch_array($rs))
		{
			$i++;
			echo "<div class='card  w-25' style='height:650px;'>";
			echo "	<div class='card-body'>";
			$pos = strpos($datos["TipoContenido"],"image/");
			if($pos===false)//no es una imagen
			{
				echo "<td>La imagen no esta disponible</td>";
			}
			else//es una imagen
			{
				echo "<td><a href=\"verArchivo.php?idA=".$datos["idProducto"]."\"><img class='d-block w-100 h-75' src=\"imagen.php?idA=".$datos["idProducto"]."\" alt=\"".$datos["NombreOriginal"]."\"></a><br>";
			}
			echo "		<h5 class='card-title'>".$datos["Titulo"]."</h5>";
			echo "		<h6 class='card-title'>$".$datos["Precio"]."</h6>";
			echo "<div class='d-flex btn-group' role='group'>";
				echo "	<a  class='form-control me-2 btn btn-outline-primary' href='agregarCarrito.php?idA=".$datos["idProducto"]."'>Agregar Carrito</a>";
				echo "	<a  class='form-control me-2 btn btn-light' href='agregarDeseos.php?idA=".$datos["idProducto"]."'>Agregar Deseados</a>";
			echo "</div><br><br>";
		echo "	</div>";
	echo "</div>";
		}
	}
	else
	{
		echo "<h6 class='w-50' style='height:400px;'>No se encontro ningun producto con esas caracter&iacute;s</h6>";
	}

?>
</div>
</div>

<?php
	piePagina();
?>  
</body>

</html>
