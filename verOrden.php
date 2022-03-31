<?php
session_start();
include("funciones.php");
//autenticación
if(!isset($_SESSION["idU"]))
{
	header("location:".$ruta."login.php");// sacamos al usuario porq no esta autenticado.
}
else if(!isset($_GET['idO']) && $_GET['idO']=="") //el usuario está autenticado
{	
	header("location:".$ruta."historial.php");// sacamos al usuario porq no esta autenticado.
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
<title>Art Quadrant</title>
<link rel="stylesheet" type="text/css" href="estilos.css">
</head>

<body>
<?php
	encabezado();
	echo "<div class='container-xxl h-100'>";
	$c = conectarBD();
	$qry = "select * from ordenes where idUsuario='".$_SESSION['idU']."' and idOrden=".$_GET['idO'];
	$rs = mysqli_query($c, $qry);//Se guarda los datos que agregaste de la orden
	$Orden = mysqli_fetch_array($rs);
	echo "<a class='btn btn-light float-lg-start' href='historial.php'><i class='fas fa-arrow-left'></i></a>";
	echo "<h3>Orden</h3>";
	echo "<div class='h6'>Fecha de Creaci&oacute;n: ".$Orden["FechaCreacion"]."</div>";
	echo "<div class='h6'>Estatus de la Orden: ".$Orden["EstatusOrden"]."</div>";
	echo "<div class='h6'>Monto de la Orden: $".$Orden["Monto"]."</div>";
	$qry = "select p.* from productos as p, detallesorden as do where p.idProducto=do.idProducto and do.idOrden=".$Orden["idOrden"];
	$rs = mysqli_query($c, $qry);//Se selecciona los productos que estan en el carrito del usuario
	if(mysqli_num_rows($rs)>0)
	{
		echo "<table class='table table-dark table-striped table-bordered table-hover'>";
			echo "	<thead class='thead-dark'>";
			echo "		<tr>";
			echo "		<td scope='col'>#</td>";
			echo "		<td scope='col'>T&iacute;tulo</td>";
			echo "		<td scope='col'>Precio</td>";
			echo "		<td scope='col'>Descripci&oacute;n</td>";
			echo "		<td scope='col'>Imagen</td>";
			echo "		<td scope='col'>Cantidad</td>";
			echo "		</tr>";
			echo "	</thead>";
			$i=0;
		while($Productos = mysqli_fetch_array($rs))
		{
			$i++;
			$qry = "select * from detallesorden where idOrden='".$Orden["idOrden"]."' and idProducto=".$Productos["idProducto"];
			$rss = mysqli_query($c, $qry);//Por cada producto que este en el carrito se crea un detalle de orden
			$detalles = mysqli_fetch_array($rss);
			echo "<tr scope='row'>";
				echo "<td>".$i."</td>";
				echo "<td>".$Productos["Titulo"]."</td>";
				echo "<td>".$Productos["Precio"]."</td>";
				echo "<td>".$Productos["Descripcion"]."</td>";
				$pos = strpos($Productos["TipoContenido"],"image/");
				if($pos===false)//no es una imagen
				{
					echo "<td>La imagen no esta disponible</td>";
				}
				else//es una imagen
				{
					echo "<td><img style=\"withd:100px; height:100px\" src=\"imagen.php?idA=".$Productos["idProducto"]."\" alt=\"".$Productos["NombreOriginal"]."\"></td>";
				}
				echo "<td>".$detalles["Cantidad"]."</td>";
			echo "</tr>";
		}
		echo "</table><br>";
		$qry = "select * from informacion where idInformacion=8";
		$rs = mysqli_query($c, $qry);//Por cada producto que este en el carrito se crea un detalle de orden
		$info = mysqli_fetch_array($rs);
		echo "<div class='h3'>Paga en oxxo en la cuenta de Santander: ".$info["Descripcion"]."</div>";
		
		$qry = "select * from informacion where idInformacion=9";
		$rs = mysqli_query($c, $qry);//Por cada producto que este en el carrito se crea un detalle de orden
		$info = mysqli_fetch_array($rs);
		echo "<div class='h3'>o paga por <a href=".$info["Descripcion"]."> Paypal </a></div><br>";
		echo "<div class='h2'>¡¡Envia tu Ficha por alguna de nuestros Contactos!!</div>";
	}
	else// No tiene nada en el carrito.
	{
		header("location:".$ruta."historial.php");
	}
	echo "</div>";
	piePagina();
?>
</body>

</html>

