<?php
session_start();
include("funciones.php");
//autenticación
if(!isset($_SESSION["idU"]))
{
	header("location:".$ruta."login.php");// sacamos al usuario porq no esta autenticado.
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
<title>Historial</title>
<link rel="stylesheet" type="text/css" href="estilos.css">
</head>

<body>
<?php
	encabezado();
	if(isset($_SESSION['idU'])) //el usuario está autenticado
	{	
		echo "<div class='container-xxl' style='height:450px'>";
		echo "<h3>Listar Ordenes</h3>";
		$qry = "select * from ordenes where idUsuario=".$_SESSION['idU'];
		$c = conectarBD();
		$rs = mysqli_query($c, $qry);
		if(mysqli_num_rows($rs)>0)//Si hay ordenes
		{
			echo "<table class='table table-dark table-striped table-bordered table-hover'>";
				echo "	<thead class='thead-dark'>";
				echo "		<tr>";
				echo "		<td scope='col'>Orden</td>";
				echo "		<td scope='col'>Fecha de Elaboraci&oacute;n</td>";
				echo "		<td scope='col'>Estatus de la Orden</td>";
				echo "		<td scope='col'>Monto</td>";
				echo "		<td scope='col'> </td>";
				echo "		</tr>";
				echo "	</thead>";
				$i=0;
				while($datos = mysqli_fetch_array($rs))
				{
					$i++;
					echo "<tr scope='row'>";
						echo "<td>".$i."</td>";
						echo "<td>".$datos["FechaCreacion"]."</td>";
						echo "<td>".$datos["EstatusOrden"]."</td>";
						echo "<td>".$datos["Monto"]."</td>";
						echo "<td><a href=\"verOrden.php?idO=".$datos["idOrden"]."\">Ver Orden</a>";
					echo "</tr>";
				}
				echo "</table>";
		}
		else//No hay documentos guardados
		{
			echo "<div class='h6' style='height:400px'><br><br>No Tiene ninguna Orden Creada</div>";
		}
		echo "</div>";
	}
	else
	{ 
		header("location:".$ruta."login.php");// sacamos al usuario porq no esta autenticado.
	}
	piePagina();
?>
</body>

</html>
