<?php 
include('menu.php');
header ('Content-type: text/html; charset=utf-8');

$URL = $_GET["urlreceta"];
$nombrereceta = htmlentities($_GET["nombrereceta"]);	
$filtro = $_GET["filtro"];
$id = $_GET["id"];
$flag=0;

$navigator_user_agent = (isset($_SERVER['HTTP_USER_AGENT'])) ? strtolower($_SERVER['HTTP_USER_AGENT']):'';
if(stristr($navigator_user_agent, "trident")){
$URL = $URL;
$nombrereceta = $nombrereceta;	
$filtro = $filtro;
$flag=1;
}

?>
			
		<!-- Main -->
			<section class="wrapper style1">
				<div class="container">
					<p>&nbsp;</p>	
	                
 	               		
    				<div class='micaja2'>
	               		<div class='izq2'>
	               			<div class='micontenido2'>
			               	<h3><?php echo "Receta - ".$nombrereceta; ?></h3>
			               	<p>&nbsp;</p>	
			               	<?php
								if($flag==0){// PDF resultado
								//echo "<embed src='".$URL."' style='position:relative;top:10px;bottom:0px;'>";
								//echo "<embed width='100' height='100' src='".$URL."' frameborder='0'></embed>";
								echo "<object data='".$URL."' type='application/pdf' width='100' height='100'>";
		  						echo "<p>Usted no tiene instalado el plugin. <a href='".$URL."'> Puede descargar la receta en formato PDF haciendo click en este link.</a></p>";
		  						echo "</object>";
								}
								else{
									echo "<iframe src='LibreriaPDF/web/viewer.php?url=".$URL."' width='678' height='678' frameborder=0 scrolling='no'></iframe>";
								}
							?>
							</div>	
						</div>
						<div class='der2'>
							<div class='micontenido2'>
							<p><b>Otras recetas</b></p>
							<?php															
								$consultarec=mysql_query("SELECT URL, recetanombre, publico, id FROM diannakennedy WHERE ".$filtro." AND id <> ".$id." ORDER BY recetanombre LIMIT 5", $conexion);								
								$i = 1;
								$j = 1;
								while($registros=mysql_fetch_array($consultarec))
								{									
									$j += 1;
									if ($j <= 5)
									{
										if(!is_null($registros[0]))	
										{																											
											echo "<span style='white-space: pre-wrap;padding:0px;'><a href='muestrareceta.php?urlreceta=".$registros[0]."&nombrereceta=".$registros[1]."&filtro=".$filtro."&id=".$registros[3]."'><img src='images/thumb".$i.".jpg' width='30' height='30' alt='' /> ".$registros[1]."</a></span><br><br>";
										}
										else
											echo "<span style='white-space: pre-wrap;padding:0px;'><a href='#'><img src='images/thumb".$i.".jpg' width='30' height='30' alt='' /> ".$registros[1]."<br><span style='color:gray;'>Próximamente</span></a></span><br><br>";
									}
									$i += 1;
								    if ($i == 4)
								    	$i = 1;
								}

								
								$ingredientes = mysql_query("SELECT ingredientelocal FROM diannakennedy WHERE id = '".$id."'", $conexion);
								$listaingrediente = mysql_result($ingredientes,0);	
								if (!empty($listaingrediente))	
								{
									echo "<br><p><b>Ingredientes</b></p>";									
									$lista=explode(",", $listaingrediente);
									foreach ($lista as $valor) {
 									   echo "<a target='_blank' href='http://bdi.conabio.gob.mx/fotoweb/Grid.fwx?archiveId=5062&columns=4&rows=8&search=".trim($valor)."' style='white-space: nowrap;'>".$valor."</a><br>";
									}
								}
								
								
							?>	
							</div>						
						</div>
					</div>
				</div>               
			</section>			

		<?php include('footer.php') ?>

