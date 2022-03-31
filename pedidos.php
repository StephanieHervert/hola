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
	echo "<div class='container-xxl'>";
	if(isset($_SESSION['idU'])) //el usuario está autenticado
	{
		$rolUsr = RolDeUsuario($_SESSION["idU"]);
		if($rolUsr=="Administrador")
		{	
			echo "<div class='container-xxl' style='height:450px'>";
			echo "<h3>Listar Ordenes</h3>";
			$qry = "select * from ordenes";
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
							echo "<td>";
							?>
							<form method="get" action="actualizaEstado.php">
								<div class="d-flex">
									<select class="form-select me-2 w-50" name="txtRol">
										<?php
											if($datos["EstatusOrden"]=="Por Confirmar")
											{
												echo "<option selected value=\"Por Confirmar\">Por Confirmar</option>";
												echo "<option value=\"En Progreso\">En Progreso</option>";
												echo "<option value=\"Completada\">Completada</option>";	
											}
											else if($datos["EstatusOrden"]=="En Progreso")
											{
												echo "<option value=\"Por Confirmar\">Por Confirmar</option>";
												echo "<option selected value=\"En Progreso\">En Progreso</option>";
												echo "<option value=\"Completada\">Completada</option>";
											}
											else if($datos["EstatusOrden"]=="Completada")
											{
												echo "<option value=\"Por Confirmar\">Por Confirmar</option>";
												echo "<option value=\"En Progreso\">En Progreso</option>";
												echo "<option selected value=\"Completada\">Completada</option>";
											}
										?>
									</select>
									<input type="hidden" value="<?php echo $datos["idOrden"] ?>" name="txtOrden">
									<input type="hidden" value="<?php echo $datos["idUsuario"] ?>" name="txtUsuario">
									<input class="btn btn-outline-light btn-sm" type="submit" value="Actualizar">
								</div>
							</form>
						<?php
							echo "</td>";
							echo "<td>".$datos["Monto"]."</td>";
							echo "<td><a href=\"verOrden.php?idO=".$datos["idOrden"]."\">Ver Orden</a>";
						echo "</tr>";
					}
					echo "</table>";
			}
			else//No hay documentos guardados
			{
				echo "<div class='h6' style='height:400px'><br><br>No se encontro ningun Orden</div>";
			}
			echo "</div>";
		}
	}
	echo "</div>";
?>
</body>

</html>
