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
if(!isset($_GET['txtRol']) && !isset($_GET['txtUsuario']))
{
	header("location:".$ruta."verUsuarios.php");// sacamos al usuario
}
if($_GET['txtRol']=="" || $_GET['txtUsuario']=="")
{
	header("location:".$ruta."verUsuarios.php");// sacamos al usuario
}

$qry = "update usuarios set Rol='".$_GET['txtRol']."' where idUsuario=".$_GET['txtUsuario'];
$c = conectarBD();
mysqli_query($c, $qry);
mysqli_close($c);
header("location:" . $ruta . "verUsuarios.php");
?>
