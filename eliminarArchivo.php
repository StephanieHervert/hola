<?php
session_start();
include("funciones.php");
//verificar que el usuario este autenticado
if(!isset($_SESSION["idU"]))
{
	header("location:".$ruta."portada.php");// sacamos al usuario porq no esta autenticado.
}

//Verificar que se haya enviado el id del documento que requiero eliminar
if(isset($_GET["idA"]) && $_GET["idA"]!="")
{
	
	if(RolDeUsuario($_SESSION["idU"])=="Administrador")
	{
		$c = conectarBD();
		echo $qry = "delete from listascategorias where idProducto=".$_GET["idA"];
		mysqli_query($c, $qry);
		echo $qry = "delete from carritocompras where idProducto=".$_GET["idA"];
		mysqli_query($c, $qry);
		echo $qry = "delete from listasdeseados where idProducto=".$_GET["idA"];
		mysqli_query($c, $qry);
		echo $qry = "delete from comentarios where idProducto=".$_GET["idA"];
		mysqli_query($c, $qry);
		echo $qry = "delete from productos where idProducto=".$_GET["idA"];
		mysqli_query($c, $qry);
		mysqli_close($c);
	}	
	header("location:" . $ruta . "administracion.php");
}
?>
