<?php
$ruta = "http://localhost/FundamentosWeb/ProyectoWeb/";

function encabezado()
{
echo "<nav class='navbar navbar-expand-md navbar-dark bg-dark'>";
echo "<nav class='navbar navbar-expand-md navbar-dark bg-dark container-sm'>";
echo "	<a class='navbar-brand ms-2' href='portada.php'><h1>Art Quadrant</h1></a>";
echo "	<button type='button' class='navbar-toggler' data-bs-toggle='collapse' data-bs-target='#navbarCollapse'>";
echo "		<span class='navbar-toggler-icon'></span>";//icono de hamburguesa.   
echo "	</button>";
echo "	<div class='collapse navbar-collapse justify-content-between' id='navbarCollapse'>";
echo "		<div class='navbar-nav ms-3'>";
echo "        	<a class='nav-item nav-link active' href='portada.php'>Inicio</a>";
echo "          <a class='nav-item nav-link' 		href='listaProductos.php'>Productos</a>";
echo "          <div class='d-flex nav-item dropdown mega-dropdown'>";
echo "          	<a class='nav-link dropdown-toggle' data-bs-toggle='dropdown' href='#'>Categor&iacute;a</a>";
echo "              <div class='dropdown-menu mega-dropdown-menu'>";
echo "              	<div class='container justify-content-center' style='width:400px'>";
echo "                		<div class='row'>";
							$c = conectarBD();
							$qry = "select * from categorias";			
							$res = mysqli_query($c, $qry);
							//Publicar el resultado de la consulta
							if(mysqli_num_rows($res)>0)//Si hay usuarios
							{
								while($datos = mysqli_fetch_array($res))
								{
echo "                				<div class='col'>";
echo "									<a class='dropdown-item col w-100' style='' href='listaProductos.php?txtCategoria=".$datos["idCategoria"]."&search='>".$datos["NombreCategoria"]."</a>";
echo "                				</div>";
								}
							}
echo "						</div>";
echo "					</div>";
echo "				</div>";
echo "			</div>";
echo "        	<a class='nav-item nav-link' 		href='nosotros.php'>Quienes Somos</a>";
	if(isset($_SESSION['idU'])) //el usuario esta autenticado
	{
		$rolUsr = RolDeUsuario($_SESSION["idU"]);
		if($rolUsr=="Administrador")
		{
			echo "<div class='navbar-nav ml-auto'>";
	        echo "	<div class='nav-item dropdown'>";
	        echo "    	<a href='#' class='nav-link dropdown-toggle' data-bs-toggle='dropdown'>Administraci&oacute;n</a>";
	        echo "        <div class='dropdown-menu'>";
	        echo "				<a href='verUsuarios.php' class='dropdown-item'>Lista de Usuarios</a>";
	        echo "				<a href='pedidos.php' class='dropdown-item'>Control de Pedidos</a>";
	        echo "				<a href='administracion.php' class='dropdown-item'>Control de Productos y Categor&iacute;as</a>";
	        echo "				<a href='cambiarInformacion.php' class='dropdown-item'>Control de Informaci&oacute;n</a>";
	        echo "        </div>";
	        echo "    </div>";
	        echo "</div>";

			//menu del usuario administrador
		}
		//menu del usuario autenticado
		echo "<div class='navbar-nav ml-auto'>";
        echo "	<div class='nav-item dropdown'>";
        echo "    	<a class='nav-link dropdown-toggle' data-bs-toggle='dropdown'>Bienvenido ". $_SESSION['nombre'] . "</a>";
        echo "        <div class='dropdown-menu'>";
        echo "        	<a href='perfil.php' class='dropdown-item'>Perfil</a>";
        echo "          <a href='listaDeseados.php' class='dropdown-item'>Lista de Deseados</a>";
        echo "          <a href='carrito.php' class='dropdown-item'>Carrito de Compras</a>";
        echo "          <a href='historial.php' class='dropdown-item'>Historia de Compras</a>";
        echo "          <a href='logout.php' class='dropdown-item'>Salir</a>";
        echo "        </div>";
        echo "    </div>";
        echo "</div>";
	}
	else
	{ 
		//menu del usuario general
		echo "<div class='navbar-nav ml-auto'>";
        echo "	<div class='nav-item dropdown'>";
        echo "    	<a href='#' class='nav-link dropdown-toggle' data-bs-toggle='dropdown'>User Account</a>";
        echo "        <div class='dropdown-menu'>";
        echo "        		<a href='login.php?err=1' class='dropdown-item'>Iniciar Sesi&oacute;n</a>";
        echo "          	<a href='registro.php' class='dropdown-item'>Register</a>";
        echo "        </div>";
        echo "    </div>";
        echo "</div>";
	}
echo "			</div>";
echo "	</div>";
echo "</nav>";
echo "</nav><br><div style='height:50px'></div>";
}
function Search()
{
    echo "	<input class='form-control me-2' type='search' id='search' name='search' placeholder='Search'>";
    echo "	<button class='btn btn-outline-primary' type='submit'>Buscar</button>";
}
function TermiCondi()
{
echo "<p class='h6'>Esta pagina esta bajo los <button type='button' class='btn btn-link' data-bs-toggle='modal' data-bs-target='#TerminosCondiciones'>Terminos y Condiciones</button> de Art Quadrant</p>";
echo "<!-- Overlay de terminos y condiciones-->";
echo "<div class='modal fade' id='TerminosCondiciones' tabindex='-1' role='dialog'>";
echo "  <div class='modal-dialog' role='document'>";
echo "    <div class='modal-content'>";
echo "      <div class='modal-header'>";
echo "        <h5 class='modal-title'>Terminos y Condiciones</h5>";
echo "        <button type='button' class='btn btn-btn-light' data-bs-dismiss='modal'><i class='fas fa-times'></i></button>";
echo "      </div>";
echo "      <div class='modal-body'>";
echo "      Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut odio feugiat, malesuada lorem aliquam, egestas sem. Praesent mauris dui, consequat vel nisi sit amet, pulvinar dignissim nunc. Nunc cursus iaculis lectus, fringilla imperdiet nibh tempor quis. Fusce lobortis auctor risus, nec blandit est fringilla ac. Cras maximus pulvinar odio, ac sollicitudin dolor facilisis in. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed maximus et ligula at iaculis.In dignissim dapibus odio sit amet consequat. Aenean pharetra porttitor diam at semper. Nam dictum tincidunt dictum. Donec pellentesque lobortis rutrum. Cras interdum volutpat nisi, porta lacinia magna ornare sed. Integer eu dictum lacus. In tristique leo quis tortor venenatis, eu egestas odio congue. Sed eu rhoncus massa. Proin a hendrerit ligula. Suspendisse mollis pretium diam a lobortis. Donec non ex auctor, porta lectus ac, tincidunt enim. In pharetra dui sapien, sodales aliquet ligula accumsan sed. Nulla pulvinar rutrum dolor in malesuada.Morbi nec sapien massa. Aliquam ultricies quis arcu sit amet placerat. Morbi lobortis suscipit nunc eu bibendum. Pellentesque rutrum semper erat ac imperdiet. In et tempus elit. Etiam sit amet risus quis purus feugiat maximus. Aenean diam dui, luctus nec lorem et, blandit elementum tortor. Nulla dictum id odio ut porttitor.";
echo "      </div>";
echo "      <div class='modal-footer'>	";  	
echo "        <button type='button' class='btn btn-btn-light' data-bs-dismiss='modal'>Cancelar</button>";
echo "        <button type='button' class='btn btn-outline-primary' data-bs-dismiss='modal'>Aceptar</button>";
echo "      </div>";
echo "    </div>";
echo "  </div>";
echo "</div>";

}
function piePagina()
{
$c = conectarBD();
echo "<div style='height:150px'></div>";
echo "<div class='bg-dark'><br>";
echo "<div class='container bg-dark text-white'>";
	echo "<h1>Contactanos</h1>";
	echo "<h4>Art Quadrant</h4>";
	echo "<div class='row'>";
		echo "<div class='col-4'>";
			echo "<h3>Direcci&oacute;n</h3>";
			$qry = "select * from informacion where idInformacion=3";
			$res = mysqli_query($c, $qry);
			if(mysqli_num_rows($res)>0)//si hay comentarios
			{
				while($cate = mysqli_fetch_object($res))
				{
					echo "<p>".$cate->Descripcion."</p>";
				}
			}
		echo "</div>";
		echo "<div class='col'>";
			echo "<h3>Telefono</h3>";
			$qry = "select * from informacion where idInformacion=1 or idInformacion=2";
			$res = mysqli_query($c, $qry);
			if(mysqli_num_rows($res)>0)//si hay comentarios
			{
				while($cate = mysqli_fetch_object($res))
				{
					echo "<p>".$cate->Descripcion."</p>";
				}
			}
		echo "</div>";
		echo "<div class='col'>";
			echo "<h3>Correo</h3>";
			$qry = "select * from informacion where idInformacion=4";
			$res = mysqli_query($c, $qry);
			if(mysqli_num_rows($res)>0)//si hay comentarios
			{
				while($cate = mysqli_fetch_object($res))
				{
					echo "<p>".$cate->Descripcion."</p>";
				}
			}
		echo "</div>";
		echo "<div class='col'>";
			echo "<h3>Redes Sociales</h3>";
			$qry = "select * from informacion where idInformacion=5";
			$res = mysqli_query($c, $qry);
			if(mysqli_num_rows($res)>0)//si hay comentarios
			{
				while($cate = mysqli_fetch_object($res))
				{
					echo "<a href='$cate->Descripcion'><i class='fab fa-facebook-square btn btn-outline-primary w-25'></i></a>";
				}
			}
			$qry = "select * from informacion where idInformacion=6";
			$res = mysqli_query($c, $qry);
			if(mysqli_num_rows($res)>0)//si hay comentarios
			{
				while($cate = mysqli_fetch_object($res))
				{
					echo "<a href='$cate->Descripcion'><i class='fab fa-instagram-square btn btn-outline-primary w-25'></i></a>";
				}
			}
			$qry = "select * from informacion where idInformacion=7";
			$res = mysqli_query($c, $qry);
			if(mysqli_num_rows($res)>0)//si hay comentarios
			{
				while($cate = mysqli_fetch_object($res))
				{
					echo "<a href='$cate->Descripcion'><i class='fab fa-twitter-square btn btn-outline-primary w-25'></i></a>";
				}
			}
		echo "</div>";
	echo "</div>";
echo "</div></div>";
}
function conectarBD()
{
	$conn = mysqli_connect("localhost","root","","artquadrant");
	return $conn;
}
function RolDeUsuario($idUsuario)
{
	$con = conectarBD();
	$qry = "select Rol from usuarios where idUsuario=" .$idUsuario;
	$rs = mysqli_query($con, $qry);
	$datoUrs = mysqli_fetch_object($rs);
	mysqli_close($con);
	return $datoUrs->Rol;
}
?>
