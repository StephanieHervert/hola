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
if(!isset($_GET['txtRol']) && !isset($_GET['txtOrden']) && !isset($_GET['txtUsuario']))
{
	header("location:".$ruta."pedidos.php");// sacamos al usuario
}
if($_GET['txtRol']=="" || $_GET['txtOrden']=="" || $_GET['txtUsuario']=="")
{
	header("location:".$ruta."pedidos.php");// sacamos al usuario
}

echo $qry = "update ordenes set EstatusOrden='".$_GET['txtRol']."' where idOrden=".$_GET['txtOrden']." and idUsuario=".$_GET['txtUsuario'];
$c = conectarBD();
mysqli_query($c, $qry);
mysqli_close($c);
header("location:" . $ruta . "pedidos.php");
?>
