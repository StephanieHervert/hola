<?php
include("funciones.php");
	// los datos hayan sido pasados
	if(!isset($_GET['txtUsuario'])||
		!isset($_GET['txtNombreCompleto'])||
		!isset($_GET['txtPwd'])||
		!isset($_GET['txtRePwd'])||
		!isset($_GET['txtEmail'])||
		!isset($_GET['txtPais'])||
		!isset($_GET['txtDireccion'])||
		!isset($_GET['txtCiudad'])||
		!isset($_GET['txtEstado'])||
		!isset($_GET['txtCodigoPostal']))
	{
		header("location:" . $ruta . "registro.php?err=1");
	}
	else if($_GET['txtUsuario']==""|| $_GET['txtNombreCompleto']=="" || $_GET['txtPwd']=="" 
		|| $_GET['txtRePwd']==""|| $_GET['txtEmail']==""|| $_GET['txtPais']==""
		|| $_GET['txtDireccion']==""|| $_GET['txtCiudad']==""|| $_GET['txtEstado']==""
		|| $_GET['txtCodigoPostal']=="")
	{	
		header("location:" . $ruta . "registro.php?err=2");
	}
	else if($_GET['txtPwd']!=$_GET['txtRePwd'])
	{
		header("location:" . $ruta . "registro.php?err=3");
	}
	else
	{
		//$usuario = $_GET['txtUsuario'];
		//$pwd =$_GET['txtPwd'];
		//$email = $_GET['txtEmail'];
		
		extract($_GET);
	
		//conexion a la base de datos
		$c = conectarBD();
		
		//Crear la consuta SQL											son los mismo	". $txtUsuario. "','$txtPwd'
		$qry = "insert into usuarios (NombreCompleto, Usuario, Pwd, Email, Rol, Pais, Direccion, Ciudad, Estado, CodigoPostal) value('$txtNombreCompleto','$txtUsuario','$txtPwd','$txtEmail','General','$txtPais','$txtDireccion','$txtCiudad','$txtEstado','$txtCodigoPostal')";
		
		//ejecuta una consulta en la base de datos
		$rs = mysqli_query($c,$qry);
		echo "Registro completado";
		header("location:" . $ruta . "registro.php?err=4");
	}
?>