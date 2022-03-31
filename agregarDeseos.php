<?php
session_start();
include("funciones.php");
$c = conectarBD();
//verificar que el usuario este autenticado
if(!isset($_SESSION["idU"]))
{
	header("location:".$ruta."login.php");// sacamos al usuario porq no esta autenticado.
}
else if(isset($_GET["idA"]))
{
	//insertar el la lista de deseos en la BD
	$qry = "select * from listasDeseados where idUsuario='".$_SESSION['idU']."' and idProducto=".$_GET["idA"];
	$rs = mysqli_query($c, $qry);
	if(mysqli_num_rows($rs)<=0)//no hay
	{
		$qry = "insert into listasDeseados (idUsuario, idProducto) values ('".$_SESSION['idU']."', '".$_GET["idA"]."')";
		mysqli_query($c, $qry);
	}
	header("location:".$ruta."listaDeseados.php");
}
else
{
	header("location:".$ruta."listaProductos.php");
}
?>