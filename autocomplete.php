<?php
header( 'Content-type: text/html; charset=utf-8' );
require('config.php');

$search = $_POST['ingrediente'];

$query_services = mysql_query("SELECT id, nombre FROM ingredientes WHERE nombre like '" . $search . "%' ORDER BY nombre DESC LIMIT 6", $conexion);
while ($row_services = mysql_fetch_array($query_services)) 
    echo '<div><a class="suggestelement" data="'.$row_services['nombre'].'" id="'.$row_services['id'].'">'.$row_services['nombre'].'</a></div>';

?>
