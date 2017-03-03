<h1><?=$dia."/".$mes."/".$ano;?><a class="voltar" href="../<?=$mes;?>">Voltar</a></h1>

<div id="diaApp" ng-app="appDias" ng-controller="myCtrlDias">

<div class="categoriasDia"></div>

<input placeholder="Pesquisa Rápida" name="pesquisarDias" id="pesquisarDias" type="text" ng-model="filtro"><a id="adicionarDia">Adicionar</a>

<div class="tituloResultados">
	<a class="linkTitulo3 selecionado" ng-click="ordenar2('id');">Início</a><a  class="linkTitulo3" ng-click="ordenar2('evento');">Nome da Atividade</a><a  class="linkTitulo3" ng-click="ordenar2('descricao');">Descrição</a><a  class="linkTitulo3" ng-click="ordenar2('usuario');">Responsável</a>
</div>

<div class="linhaResultado6" ng-repeat="y in records | orderBy:myOrderBy2 | filter: filtro">
	<div class="colunaResultado3">{{y.diaHora}}</div><div class="colunaResultado3">{{y.evento}}</div><div class="colunaResultado3">{{y.descricao}}</div><div class="colunaResultado3">{{y.usuario}}</div>
</div>

	<div class="semResultados" ng-if="!records[0]">Nenhum Resultado.</div>

<script>

	$(function() {
		$('.linkTitulo3').click(function() {
			var elementos = document.getElementsByClassName('linkTitulo3');

		for (var x = 0; x < elementos.length; x++) {
			elementos[x].className = "linkTitulo3";
		}

		this.className = "linkTitulo3 selecionado";

		});
	});

	var appDias = angular.module("appDias", ['ui.bootstrap'])
	.controller("myCtrlDias", function($scope) {
   
    $scope.records = [

	<?php

	$sql = "SELECT a.*, b.nome as nomeUsuario FROM agendas_atividades a 
	        LEFT JOIN relatorios_usuarios b ON 
	        a.responsavel = b.id 
	        WHERE a.data = '".$ano."-".$mes."-".$dia."' ORDER BY a.id DESC";
	$res = sqlsrv_query($con, $sql);

	//echo $sql;

	$i = 0;
	 while($row = sqlsrv_fetch_array($res)) {

	 	if($row['diaTodo'] == '1') $inicio = 'Dia todo';
	 	else $inicio = $row['hora']->format('h:i');

		if($i == 0) echo "{";
		else echo ", {";
		echo "'diaHora': '".$inicio."', 'evento': '".$row['nome']."', 'id': '".$row['id']."', 'descricao': '".$row['descricao']."', 'usuario': '".$row['nomeUsuario']."' }";
		$i++;
	}
	
	?>

    ];

     

      $scope.ordenar2 = function(y) {
      	if($scope.myOrderBy2 == y) y = "-"+y;
	    $scope.myOrderBy2 = y;
	  }
});

angular.bootstrap('#diaApp', ['appDias']);

</script>

</div>