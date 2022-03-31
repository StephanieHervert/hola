<?php
session_start();
include("funciones.php");
//Validad si el usuario esta autenticado
if(isset($_GET["idA"]) && $_GET["idA"]!="")
{
	//Responder con l imagen
	$c = conectarBD();
	$qry = "select NombreOriginal, TipoContenido, Contenido from productos where idProducto=".$_GET['idA'];
	$rs = mysqli_query($c, $qry);
	$imagen = mysqli_fetch_array($rs);
	header("Content-type:".$imagen["TipoContenido"]);//cambia el tipo de contenido del archivo que se ressponde
	//header("Content-Disposition: attachment; filename=".$imagen["NombreOriginal"]);//obliga la descarga y a poner el nombre original
	echo $imagen["Contenido"];
	mysqli_close($c);
}

?>