<?php
session_start();
include("funciones.php");//no debe de ver nada arriba de estas lineas.
$msg = "";
if(!isset($_GET['txtUsuario'])&&
	!isset($_GET['txtPwd']))
{
	$msg = "<div class='alert alert-danger' role='alert'>Todos los datos son requeridos.</div>";
}

if(isset($_GET['err']) && $_GET['err']!="")
{
	if($_GET['err']=="1") $msg = "";
}
if(isset($_POST['txtUsuario']) && isset($_POST['txtPwd']))
{
	if($_POST['txtUsuario']!="" && $_POST['txtPwd'])
	{
		//conectar a la BD de datos
		$c = conectarBD();
		//generamos la consulta
		$qry = "select * from usuarios where Usuario='".$_POST['txtUsuario']."'	and Pwd='".$_POST['txtPwd']."'";
		$rs = mysqli_query($c, $qry);
		if(mysqli_num_rows($rs)>0)// usuario si se autentico
		{
			$datosUsuario = mysqli_fetch_array($rs);
			//Hacer el rendreccionamiento porGet
			//header("location:http://localhost/FundamentosWeb/PHP-SQL/portada.php?idU=" . $datosUsuario["idUsuario"]");
			//establece el session en el servidor
			//$_SESSION['']
			$_SESSION['idU'] = $datosUsuario["idUsuario"];
			$_SESSION['nombre'] = $datosUsuario["Usuario"];
			header("location:". $ruta ."portada.php");
		}
		else
		{
			$msg = "<div class='alert alert-danger' role='alert'>El usuario / contraseña no son correctos.</div>";
		}
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
<title>Formulario de Inisia Sección</title>
<link rel="stylesheet" type="text/css" href="estilos.css">
</head>

<body>
<?php
	encabezado();
?>
<div style="height:100px"></div>
<form class='container-sm w-50' method='post' action='login.php'><br><br>
	<a class="btn btn-light float-lg-start" href="portada.php"><i class="fas fa-arrow-left"></i></a><br><br>
	<div class='container-sm'>
		<h3>Inicia Sesión para realizar pedidos!!</h3><br>
		<?php
			if($msg != '') echo $msg;
		?><br>
		Usuario: <input class='form-control me-2' type='text' id='txtUsuario' name='txtUsuario' placeholder='User Name'><br>
		Contrase&ntilde;a: <input class='form-control me-2' type='password' id='txtPwd' name='txtPwd'placeholder='*******'>
		<button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#ForgotPwd">&iquest;Olvidaste tu contraseña?</button><br>
		<a class="btn btn-link" href='registro.php'>&iquest;No tienes cuenta?</a><br><br>
		<div class='btn-group' role='group'>
			<input class='form-control me-2 btn btn-outline-primary' type='submit' value='Iniciar Sesi&oacute;n'>
		</div><br><br>
		<?php TermiCondi();?>
	</div><br><br>
</form><br><br><br>

<!-- Overlay de olvidaste tu contraseña-->
<div class="modal fade" id="ForgotPwd" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">¿Olvidaste tu Contraseña?</h5>
        <button type="button" class="btn btn-btn-light" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
      </div>
      <div class="modal-body">
		Email:<br>
		<input class="form-control me-2" type="email" id="txtEmail" name="txtEmail" placeholder="name@example.com"><br>
      </div>
      <div class="modal-footer">	  	
        <button type="button" class="btn btn-btn-light" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline-primary">Enviar</button>
      </div>
    </div>
  </div>
</div>

<div style="height:100px"></div>
<?php
	piePagina();
?>
</body>

</html>
