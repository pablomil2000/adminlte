<!--
//-- Notas
//-- La pag 4.27 se ve rara
//-- pag 4.40 => Para que mostrar la contraseña si esta cifrada?
-->


<!-- Header start -->
<?php include('views/modules/cabecera.php'); ?>
<!-- Header end -->

<!-- Site wrapper -->
<?php
// var_dump($_SESSION);

if (isset($_SESSION['admin'])) {
    include('views/modules/menu.php');  //!comanta esto para poder ver los var_dump()
}
//<!-- Content start -->

PlantillaCtr::whiteList('usuarios', 'login', 'logout', 'activar');
// PlantillaCtr::whiteList('usuarios', 'categorias', 'productos', 'productos', 'clientes', 'pedidos', 'nuevo-pedido', 'gestion-pedidos', 'informes', 'login', 'logout');
?>
<!-- Content end -->

<!-- footer start -->
<?php
if (isset($_SESSION['admin'])) {
    include('views/modules/footer.php');
}
?>

<!-- footer end -->