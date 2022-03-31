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
<title>Art Quadrant</title>
<link rel="stylesheet" type="text/css" href="estilos.css">
</head>

<body>
<?php
	encabezado();
	if(isset($_SESSION['idU'])) //el usuario está autenticado
	{	
		echo "<div class='container-xxl'>";
		echo "<h3>Listar información del sistema</h3>";
		$c = conectarBD();
		$qry = "select * from informacion";
		$rs = mysqli_query($c, $qry);
		//Publicar el resultado de la consulta
		if(mysqli_num_rows($rs)>0)//Si hay usuarios
		{
			echo "<table class='table table-dark table-striped table-bordered table-hover'>";
			echo "	<thead class='thead-dark'>";
			echo "		<tr>";
			echo "		<td scope='col'>#</td>";
			echo "		<td scope='col'>Nombre</td>";
			echo "		<td scope='col'>Fecha de Cargado</td>";
			echo "		<td scope='col'>Descripción</td>";
			echo "		<td scope='col'> </td>";
			echo "		</tr>";
			echo "	</thead>";
			$i=0;
			while($datos = mysqli_fetch_array($rs))
			{
				$i++;
				echo "<tr scope='row'>";
					echo "<td>".$i."</td>";
					echo "<td>".$datos["NombreInfo"]."</td>";
					echo "<td>".$datos["FechaCargado"]."</td>";
					echo "<td>".$datos["Descripcion"]."</td>";
					echo "<td><a class='btn btn-outline-light' href=\"editarInfo.php?idI=".$datos["idInformacion"]."\"><i class='fas fa-edit'></i></a></td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		else//No hay documentos guardados
		{
			echo "Actualemento no hay información en la BD";
		}
		echo "</div>";

			
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
