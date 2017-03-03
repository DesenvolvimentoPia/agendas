<?php

// Página de Calendário

?>

<div id="conteudoCinza" class="calendario">
	
	<?php

	$explodirUrl = explode("/", $_SERVER['REQUEST_URI']);

	if(count($explodirUrl) > 4) {
		$ano = $explodirUrl[2];
		$mes = $explodirUrl[3];
		$dia = $explodirUrl[4];

	include "sections/funcao-dia.tpl";

	}

	else include "sections/funcao-calendario.tpl"; ?>

</div>