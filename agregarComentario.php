<?php
session_start();
include("funciones.php");
//Validad si el usuario esta autenticado
if(!$_SESSION["idU"])
{
	header("location:" . $ruta . "login.php");
}
else if(!isset($_GET["txtComentario"]) || $_GET["txtComentario"]=="")
{
	header("location:" . $ruta . "verProducto.php?idA=".$_GET["idA"]);
}
else if(isset($_GET["idA"]) && $_GET["idA"]!="")
{
	//Inserta el Comentario
	$c = conectarBD();
	//$date=
	echo $qry = "insert into comentarios (idUsuario, idProducto, Fecha, Comentario) values (".$_SESSION['idU'].",".$_GET['idA'].",'".date("Y-m-d")."','".$_GET['txtComentario']."')";
	$rs = mysqli_query($c, $qry);
	mysqli_close($c);
	header("location:" . $ruta . "verArchivo.php?idA=".$_GET["idA"]);
}


?>