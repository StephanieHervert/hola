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
if(isset($_POST["txtTitulo"]))
{
	//Verificar que se cargo el archivo en el servidor (se pueden enviar mas de 1 archivo)
	if(!empty($_FILES["archivo"]["tmp_name"]))
	{
		$nombre = $_FILES["archivo"]["name"];
		$tipo = $_FILES["archivo"]["type"];
		$nombre_temporal = $_FILES["archivo"]["tmp_name"];
		$tamaño = $_FILES["archivo"]["size"];
		$titulo = $_POST["txtTitulo"];
		$precio = $_POST["txtPrecio"];
		$descripcion = $_POST["txtDescripcion"];
		//Recuperar el contenido del archivo
		$fp = fopen($nombre_temporal,"r");
		$contenido = fread($fp,$tamaño);
		fclose($fp);
		
		//transformar los caracteres especiales
		$contenido = addslashes($contenido);
		
		//insertar el archivo en la BD																		Titulo, NombreOriginal, Precio, Descripcion, Tipo, Contenido
		$qry = "insert into productos (Titulo, NombreOriginal, Precio, Descripcion, TipoContenido, Contenido, Fecha) values ('$titulo', '$nombre', '$precio', '$descripcion', '$tipo', '$contenido','".date("Y-m-d")."')";
		mysqli_query($c, $qry);
		$msg = "<div class='alert alert-success' role='alert'>Se agrego correctamente el producto.</div>";
		if($_POST["txtCategoria"])
		{
			$qry = "select * from productos where Titulo='$titulo' and NombreOriginal='$nombre' and Precio='$precio' and Descripcion='$descripcion'";
			$rs = mysqli_query($c, $qry);
			$datos = mysqli_fetch_array($rs);
			$Categoria = $_POST["txtCategoria"];
			foreach($Categoria as $key => $cate)
			{
				$SID = mysqli_real_escape_string($c, $cate);
				$qry = "select idCategoria from categorias where NombreCategoria='$SID'";
				$res = mysqli_query($c, $qry);
				$categoria = mysqli_fetch_object($res);
				$qry = " insert into listascategorias (idCategoria, idProducto) values ('".$categoria->idCategoria."', '".$datos["idProducto"]."')";
				mysqli_query($c, $qry);
			}
		}
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
		document.getElementById("archivo").value==""||
		document.getElementById("txtPrecio").value==""||
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
<form class="container-sm" method="post" enctype="multipart/form-data" action="cargarArchivo.php" onsubmit="return validaFRM()">	
	<a class="btn btn-light float-lg-start" href="portada.php"><i class="fas fa-arrow-left"></i></a> 
	<div class="container-sm">
		<h3>Formulario para cargar productos</h3>
		<?php
			if($msg!="")echo "<div id=\"txtMsg\">$msg</div>";
		?> <br>
		Titulo del Producto: <input class="form-control me-2"  type="text" id="txtTitulo" name="txtTitulo"><br>
		Selecciona la foto:  <input class="form-control me-2"  type="file" id="archivo" name="archivo"><br>
		Selecciona la(s) Categoria(s):
		<select class="form-select" id="txtCategoria" name="txtCategoria[]" multiple>
		    <option value=""> </option>
			<?php 
				$qry = "select NombreCategoria from categorias";			
				$rs = mysqli_query($c, $qry);
				//Publicar el resultado de la consulta
				if(mysqli_num_rows($rs)>0)//Si hay usuarios
				{
					while($datos = mysqli_fetch_array($rs))
					{
						echo "<option value=".$datos["NombreCategoria"].">".$datos["NombreCategoria"]."</option>";
					}
				}
			?>
		</select>
		Precio del Producto: <input class="form-control me-2"  type="number" id="txtPrecio" name="txtPrecio"><br>
		Descripción del Producto:<textarea class="form-control me-2" rows="4" cols="70" id="txtDescripcion" name="txtDescripcion"></textarea><br>
		<div class="d-flex btn-group" role="group">
	  		<input class="form-control me-2 btn btn-outline-primary" type="submit" value="Cargar Producto">
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
