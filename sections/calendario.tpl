<?php

// Página de Calendário

?><div id="breadcrumbs"><a href="<?=$lnk?>">Dashboard</a> <span class="separador">>></span> <a href="<?=$lnk?>calendario">Calendário</a></div>

<h1 id="tituloPagina">Calendário</h1>

<div id="conteudoCinza" class="calendario">
	
	<?php

	$explodirUrl = explode("/", $_SERVER['REQUEST_URI']);

	if(count($explodirUrl) > 2) {
		$ano = $explodirUrl[2];
		$mes = $explodirUrl[3];
		$dia = $explodirUrl[4];

	include "funcao-dia.html";

	}

	else include "funcao-calendario.html";

	?>

</div>