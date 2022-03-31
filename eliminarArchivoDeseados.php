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
	$c = conectarBD();
	echo $qry = "delete from listasdeseados where idProducto=".$_GET["idA"] . " and idUsuario=". $_SESSION["idU"];
	mysqli_query($c, $qry);
	mysqli_close($c);
	header("location:" . $ruta . "listaDeseados.php");
}
?>
