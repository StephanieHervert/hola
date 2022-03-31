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
	//insertar el archivo en la BD
	echo $qry = "delete from listasdeseados where idProducto=".$_GET["idA"] . " and idUsuario=". $_SESSION["idU"];
	mysqli_query($c, $qry);
	$qry = "select * from carritocompras where idUsuario='".$_SESSION['idU']."' and idProducto=".$_GET["idA"];
	$rs = mysqli_query($c, $qry);
	if(mysqli_num_rows($rs)<=0)//no hay
	{
		$qry = "insert into carritocompras (idUsuario, idProducto) values ('".$_SESSION['idU']."', '".$_GET["idA"]."')";
		mysqli_query($c, $qry);
	}
	header("location:".$ruta."carrito.php");
}
else
{
	header("location:".$ruta."listaDeseados.php");
}
?>