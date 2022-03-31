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
<title>Art Quadrant</title>
<link rel="stylesheet" type="text/css" href="estilos.css">
</head>

<body>
<?php
	encabezado();
	$c = conectarBD();
?>  	
<!--Pagina-->
<div class="container">
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <ol class="carousel-indicators">
  	<?php
  		
  		$qry = "select * from productos order by Fecha desc limit 5";
  		$rs = mysqli_query($c, $qry);
  		if(mysqli_num_rows($rs)>0)//Si hay
		{
			$i=0;
			while($datos = mysqli_fetch_array($rs))
			{
				if($i==0)
					echo "<li data-bs-target='#carouselExampleIndicators' data-bs-slide-to=".$i." class='active'></li>";
				else
					echo "<li data-bs-target='#carouselExampleIndicators' data-bs-slide-to=".$i."></li>";
				$i++;
			}
		}
  	?>
  </ol>
  <div class="carousel-inner">
  <?php 
  	$rs = mysqli_query($c, $qry);
  	if(mysqli_num_rows($rs)>0)//Si hay
	{
		$i=0;
		while($datos = mysqli_fetch_array($rs))
		{
			if($i==0)
				echo "<div class='carousel-item active'>";
			else
				echo "<div class='carousel-item'>";
				$pos = strpos($datos["TipoContenido"],"image/");
				if($pos===false)//no es una imagen
				{
					echo "<td>La imagen no esta disponible</td>";
				}
				else//es una imagen
				{
					echo "<td><a href=\"verArchivo.php?idA=".$datos["idProducto"]."\"><img class='d-block w-100' src=\"imagen.php?idA=".$datos["idProducto"]."\" alt=\"".$datos["NombreOriginal"]."\"></a>";
				}
				echo "</div>";
			$i++;
		}
	}
  ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div><br><br>
<div class="container-sm">
<div class="row">
<?php
	$qry = "select * from productos order by Titulo asc limit 30";
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
?>
</div>
</div>
<?php
	piePagina();
?>  
</body>

</html>
