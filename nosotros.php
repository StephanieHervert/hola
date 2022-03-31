<?php
session_start();
include("funciones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/78ef894ec0.js" crossorigin="anonymous"></script>
<title>Art Quadrant</title>
<link rel="stylesheet" type="text/css" href="estilos.css">
</head>

<body>
<?php
	encabezado();
?>  	
<!--Pagina-->
<div class="container-sm">
	<div class="container-fluid d-flex">
		<img class="container-fluid w-25 justify-content-center" src="Imagenes/portada.jpg" alt="Portada">
		<div class="container-sm w-75">
			<h1>¿Quienes somos?</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae justo arcu. Nulla eget euismod nulla. Phasellus iaculis sapien vel nunc aliquet, tincidunt euismod arcu maximus. Pellentesque malesuada tellus non laoreet maximus. Donec non justo placerat, luctus sem sed, tincidunt dolor. Nam venenatis enim a odio auctor, vehicula mattis velit blandit. Quisque lacinia sem tellus, eu sagittis nulla pharetra a. Nam condimentum gravida leo, id efficitur lectus tincidunt at. In sapien nunc, aliquet et hendrerit sed, euismod quis purus. Etiam blandit orci in ultrices condimentum. Aliquam erat volutpat.</p>
		</div>
	</div><br><br><br>
	<div class="container-fluid d-flex">
		<div class="container-sm w-75">
			<h1>Autor de las Obras</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae justo arcu. Nulla eget euismod nulla. Phasellus iaculis sapien vel nunc aliquet, tincidunt euismod arcu maximus. Pellentesque malesuada tellus non laoreet maximus. Donec non justo placerat, luctus sem sed, tincidunt dolor. Nam venenatis enim a odio auctor, vehicula mattis velit blandit. Quisque lacinia sem tellus, eu sagittis nulla pharetra a. Nam condimentum gravida leo, id efficitur lectus tincidunt at. In sapien nunc, aliquet et hendrerit sed, euismod quis purus. Etiam blandit orci in ultrices condimentum. Aliquam erat volutpat.</p>
			<h1>Auto Biografía</h1>
			<p>Ut venenatis semper dui, non tempor dolor cursus vel. Donec venenatis pellentesque pellentesque. Nunc non lobortis massa, at ornare purus. Donec ultricies lacus non lectus tincidunt dignissim. Sed massa nisi, feugiat quis maximus id, tristique ut enim. Aliquam mollis mauris ut nunc laoreet tempus. Pellentesque et mi tempor, cursus dolor at, tempor orci. Vestibulum lobortis urna eget velit dignissim, eget luctus mauris cursus. Pellentesque eget sollicitudin lorem. Nam elementum sagittis molestie. Praesent est massa, lobortis in dui faucibus, iaculis iaculis tortor. Duis eget vulputate diam.Sed maximus aliquam dictum. Etiam nunc libero, pharetra in justo eu, tincidunt volutpat nisl. In sit amet nulla ut mi ultricies pulvinar a sit amet ex. Nullam cursus enim a mauris auctor, eget auctor magna imperdiet.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae justo arcu. Nulla eget euismod nulla. Phasellus iaculis sapien vel nunc aliquet, tincidunt euismod arcu maximus. Pellentesque malesuada tellus non laoreet maximus. Donec non justo placerat, luctus sem sed, tincidunt dolor. Nam venenatis enim a odio auctor, vehicula mattis velit blandit. Quisque lacinia sem tellus, eu sagittis nulla pharetra a. Nam condimentum gravida leo, id efficitur lectus tincidunt at. In sapien nunc, aliquet et hendrerit sed, euismod quis purus. Etiam blandit orci in ultrices condimentum. Aliquam erat volutpat.</p>
		</div><br>
		<img class="container-fluid justify-content-center" src="Imagenes/mi.jpg" alt="Autor">
	</div><br><br>
	<h1>Princiapales Obras</h1><br><br>
	<div class="container-fluid d-flex row">
		<div class="container-sm w-75 col">
			<h3>Anubis</h3>
			<img class="container-fluid justify-content-center" src="Imagenes/anubis.jpg" alt="anubis">
		</div><br>
		<div class="container-sm w-75 col">
			<h3>Arbol</h3>
			<img class="container-fluid justify-content-center" src="Imagenes/arbolacuralas.jpg" alt="arbol">
		</div><br>
		<div class="container-sm w-75 col">
			<h3>Bosque de Noche</h3>
			<img class="container-fluid justify-content-center" src="Imagenes/bosquenocturno.jpg" alt="bosque">
		</div>
	</div><br><br>
	<div class="container-fluid d-flex row">
		<div class="container-sm w-75 col">
			<h3>Colibrí</h3>
			<img class="container-fluid justify-content-center" src="Imagenes/colibri.jpg" alt="colibri">
		</div><br>
		<div class="container-sm w-75 col">
			<h3>Caminando Bajo la Noche</h3>
			<img class="container-fluid justify-content-center" src="Imagenes/lacalle.jpg" alt="calle">
		</div><br>
		<div class="container-sm w-75 col">
			<h3>Caballo</h3>
			<img class="container-fluid justify-content-center" src="Imagenes/caballo.jpg" alt="caballo">
		</div><br>
	</div>

</div>
<?php
	piePagina();
?>  
</body>

</html>
