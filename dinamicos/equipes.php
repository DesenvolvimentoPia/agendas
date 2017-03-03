	<?php


	include "../../sisti/conexao.php";

	?>
	
	<div id="angularEquipes" ng-app="appAngularEquipes" ng-controller="myCtrlAngularEquipes">
		
	<input placeholder="Pesquisa Rápida" name="pesquisarEquipes" id="pesquisarEquipes" type="text" ng-model="filtro"><a id="adicionarEquipe">Adicionar</a>


	<a class="linhaResultado7 {{x.tipo}}" ng-repeat="x in recordsEquipes | orderBy:myOrderBy | filter: filtro">
		<div data-cod="{{x.id}}" class="colunaResultado colunaId status{{x.status}}" title="{{x.titulo}}">{{x.id}}<span class='editar'> - Editar</span></div><div class="colunaResultado">{{x.nome}}</div>
	</a>

	<div class="semResultados" ng-if="!recordsEquipes[0]">Nenhum Resultado.</div>

	</div>

	<script>

	$(function() {
		$('.linkTitulo7').click(function() {
			var elementos = document.getElementsByClassName('linkTitulo7');

		for (var x = 0; x < elementos.length; x++) {
			elementos[x].className = "linkTitulo7";
		}

		this.className = "linkTitulo7 selecionado";

		});
	});

	var app = angular.module("appAngularEquipes", []);
	app.controller("myCtrlAngularEquipes", function($scope) {
    
    $scope.recordsEquipes = [

	<?php

	$sql = "SELECT * FROM agendas_equipes ORDER BY id DESC";
	$res = sqlsrv_query($con, $sql);


	//echo $sql;
	$i = 0;
	while($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {

	if($row['status'] == 0) $titulo = "Pendente";
	else if($row['status'] == 1) $titulo = "Almox";
	else $titulo = "Baixa";


		if($i == 0) echo "{";
		else echo ", {";
		echo "'id': ".$row['id'].", 'nome': '".$row['nome']."' }";

		$i++;
	}
	
	?>

    ];
      $scope.ordenar = function(x) {
      	if($scope.myOrderBy == x) x = "-"+x;
	    $scope.myOrderBy = x;
	  }

});


$(function () {
	$( "section" ).delegate( ".colunaId", "click", function() {
	    var id = $(this).data('cod');
	    //alert("AQUI: "+id);
		//$('#atividadeDinamico').html('Carregando...');
		// Do an ajax request
		$.ajax({
		  url: "atividade.php?id="+id
		}).done(function(data) { // data what is sent back by the php page
		  $('#atividadeDinamico').html(data); // display data
		});

	});

	$('#adicionarEquipe').click(function() {

		//$('#atividadeDinamico').html('Carregando...');
		// Do an ajax request
		$.ajax({
		  url: "atividade.php?id=novo&tipo=<?=$tipo?>"
		}).done(function(data) { // data what is sent back by the php page
		  $('#atividadeDinamico').html(data); // display data
		});

	});
});

angular.bootstrap('#angularEquipes', ['appAngularEquipes']);
	
</script>










