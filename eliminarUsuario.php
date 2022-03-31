<?php
session_start();
include("funciones.php");
//verificar que el usuario este autenticado
if(!isset($_SESSION["idU"]))
{
	header("location:".$ruta."portada.php");// sacamos al usuario porq no esta autenticado.
}
//Verificar que se haya enviado el id del documento que requiero eliminar
if(isset($_GET["idU"]) && $_GET["idU"]!="")
{	
	if($_SESSION["idU"]!=$_GET["idU"])
	{
		if(RolDeUsuario($_SESSION["idU"])=="Administrador")
		{
			$c = conectarBD();
			$qry = "delete from listadeseados where idUsuario=".$_GET["idU"];
			mysqli_query($c, $qry);
			$qry = "delete from comentarios where idUsuario=".$_GET["idU"];
			mysqli_query($c, $qry);
			$qry = "delete from carritocompras where idUsuario=".$_GET["idU"];
			mysqli_query($c, $qry);
			$qry = "delete from usuarios where idUsuario=".$_GET["idU"];
			mysqli_query($c, $qry);
			mysqli_close($c);
			header("location:" . $ruta . "verUsuarios.php");
		}
	}
}
?>
