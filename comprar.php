<?php
session_start();
include("funciones.php");
//autenticación
if(!isset($_SESSION["idU"]))
{
	header("location:".$ruta."login.php");// sacamos al usuario porq no esta autenticado.
}
else if(isset($_SESSION['idU']) && isset($_GET['precio']) && $_GET['precio']!="") //el usuario está autenticado
{	
	$c = conectarBD();
	$qry = "insert into ordenes (idUsuario, FechaCreacion, EstatusOrden, Monto) values ('".$_SESSION['idU']."', '".date("Y-m-d")."', 'Por Confirmar','".$_GET['precio']."')";
	mysqli_query($c, $qry);//Se agrega la Orden
	
	$qry = "select * from ordenes where idUsuario='".$_SESSION['idU']."' and EstatusOrden='Por Confirmar' and Monto=".$_GET['precio'];
	$rs = mysqli_query($c, $qry);//Se guarda los datos que agregaste de la orden
	$datosOrden = mysqli_fetch_array($rs);
	
	$qry = "select * from carritocompras where idUsuario=".$_SESSION['idU'];
	$rs = mysqli_query($c, $qry);//Se selecciona los productos que estan en el carrito del usuario
	if(mysqli_num_rows($rs)>0)
	{
		while($datosCarrito = mysqli_fetch_array($rs))
		{
			$qry = "select * from productos where idProducto=".$datosCarrito["idProducto"];
			$res = mysqli_query($c, $qry);//Se seleccionan los datos del producto
			$datosProductos = mysqli_fetch_array($res);
			
			$qry = "insert into detallesorden (idOrden, idProducto, Precio, Cantidad) values ('".$datosOrden["idOrden"]."', '".$datosProductos["idProducto"]."', '".$datosProductos["Precio"]."', '1')";
			mysqli_query($c, $qry);//Por cada producto que este en el carrito se crea un detalle de orden
		}
	}
	else// No tiene nada en el carrito.
	{
		header("location:".$ruta."carrito.php");
	}
	$qry = "delete from carritocompras where idUsuario=". $_SESSION["idU"];
	mysqli_query($c, $qry);
	
	header("location:".$ruta."verOrden.php?idO=".$datosOrden["idOrden"]);
}
?>