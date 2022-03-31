<?php
session_start();
include("funciones.php");
//recuperar la bandera de registraUsuario.php
$msg = "";
//Validad si el usuario esta autenticado
if(!$_SESSION["idU"])
{
	header("location:" . $ruta . "login.php");
}
//Identificar si se pasaron los datos por formulario
if(isset($_POST["txtPwdActual"]) && isset($_POST["txtNewPwd"]) && isset($_POST["txtReNewPwd"]))
{
	if($_POST["txtPwdActual"]!="" && $_POST["txtNewPwd"]!="" && $_POST["txtReNewPwd"]!="")
	{
		$c = conectarBD();
		$con = conectarBD();
		$qry = "select Pwd from usuarios where idUsuario=" .$_SESSION["idU"];
		$rs = mysqli_query($con, $qry);
		$datoUrs = mysqli_fetch_object($rs);
		if($_POST["txtPwdActual"]==$datoUrs->Pwd)
		{
			$qry = "update usuarios set Pwd='" . $_POST["txtNewPwd"] . "' where idUsuario='" . $_SESSION["idU"] . "' and Pwd='" . $_POST["txtPwdActual"] . "'";
			mysqli_query($c, $qry);
			$msg = "<div class='alert alert-success' role='alert'>Se cambio correctamente la contraseña</div>";
		}else
		{			
			$msg = "<div class='alert alert-danger' role='alert'>La contraseña actual no coincide</div>";
		}
		mysqli_close($c);
	}
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
<title>Cambiar Contraseña</title>
<link rel="stylesheet" type="text/css" href="estilos.css">
<script type="text/javascript">
function validaFRM()
{
	if(document.getElementById("txtPwdActual").value==""||
		document.getElementById("txtNewPwd").value==""||
		document.getElementById("txtReNewPwd").value=="")
	{
		document.getElementById("txtMsg").innerHTML = "<div class='alert alert-danger' role='alert'>Todo los datos son requeridos</div>";
		return false;
	}
	else if(document.getElementById("txtNewPwd").value != document.getElementById("txtReNewPwd").value)
	{
		document.getElementById("txtMsg").innerHTML = "<div class='alert alert-danger' role='alert'>La contraseña nueva con coincide con la contraseña de confirmación</div>";
		document.getElementById("txtNewPwd").value="";
		document.getElementById("txtReNewPwd").value="";
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
<form class='container-sm w-50' method="post" action="cambiaPwd.php" onsubmit="return validaFRM()">
	<a class="btn btn-light float-lg-start" href="perfil.php"><i class="fas fa-arrow-left"></i></a><br><br>
	<h3>Formularo de actualización de contraseña</h3>
	<?php
		if($msg!="")echo "<div id='txtMsg'>$msg</div>";
	?> 
	<br>
	Ingresa la contraseña actual <input class='form-control me-2' type="password" id="txtPwdActual" name="txtPwdActual"><br>
	Escribe tu nueva Contraseña: <input class='form-control me-2' type="password" id="txtNewPwd" name="txtNewPwd"><br>
	Re escribe tu nueva Contraseña: <input class='form-control me-2' type="password" id="txtReNewPwd" name="txtReNewPwd"><br>
	<div class='btn-group' role='group'>
		<input class='form-control me-2 btn btn-outline-primary' type='submit' value='Iniciar Sesi&oacute;n'>
	</div><br><br>
</form><br><br>
<div style="height:100px"></div>
<?php
	piePagina();
?>
</body>

</html>
