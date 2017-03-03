	<?php


	include "../../sisti/conexao.php";

	?>
	
	<div id="angularAtividades" ng-app="appAngularAtividades" ng-controller="myCtrlAngularAtividades">
	
	<h2>Atividades de Hoje</h2>
	
	<input placeholder="Pesquisa Rápida" name="pesquisarAtividades" id="pesquisarAtividades" type="text" ng-model="filtro"><a id="adicionarAtividade">Adicionar</a>


	<a class="linhaResultado7 {{x.tipo}}" ng-repeat="x in recordsAtividades | orderBy:myOrderBy | filter: filtro">
		<div data-cod="{{x.id}}" class="colunaResultado colunaId status{{x.status}}" title="{{x.titulo}}">{{x.id}}<span class='editar'> - Editar</span></div><div class="colunaResultado">{{x.nome}}</div><div class="colunaResultado">{{x.categoria}}</div>
	</a>

	<div class="semResultados" ng-if="!recordsAtividades[0]">Nenhum Resultado.</div>

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

	var app = angular.module("appAngularAtividades", []);
	app.controller("myCtrlAngularAtividades", function($scope) {
    
    $scope.recordsAtividades = [

	<?php

	$sql = "SELECT agendas_atividades.*, a.nome AS nomeCategoria FROM agendas_atividades LEFT JOIN agendas_categorias a ON agendas_atividades.categoria = a.id WHERE agendas_atividades.status = '0' AND agendas_atividades.data = '".date('Y-m-d')."' ORDER BY agendas_atividades.id DESC";
	$res = sqlsrv_query($con, $sql);


	//echo $sql;
	$i = 0;
	while($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {

	if($row['status'] == 0) $titulo = "Pendente";
	else if($row['status'] == 1) $titulo = "Almox";
	else $titulo = "Baixa";


		if($i == 0) echo "{";
		else echo ", {";
		echo "'id': ".$row['id'].", 'categoria': '".$row['nomeCategoria']."', 'nome': '".$row['nome']."', 'status': '".$titulo."' }";

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
		  $('#atividadesDinamico').html(data); // display data
		});

	});

	$('#adicionarAtividade').click(function() {

		//$('#atividadeDinamico').html('Carregando...');
		// Do an ajax request
		$.ajax({
		  url: "atividade.php?id=novo&tipo=<?=$tipo?>"
		}).done(function(data) { // data what is sent back by the php page
		  $('#atividadesDinamico').html(data); // display data
		});

	});
});

angular.bootstrap('#angularAtividades', ['appAngularAtividades']);
	
</script>


















<div id="angularAtividadesAmanha" ng-app="appAngularAtividadesAmanha" ng-controller="myCtrlAngularAtividadesAmanha" >
	
	<h2>Atividades de Amanhã</h2>
	
	<input placeholder="Pesquisa Rápida" name="pesquisarAtividadesAmanha" id="pesquisarAtividadesAmanha" type="text" ng-model="filtro"><a id="adicionarAtividadeAmanha">Adicionar</a>


	<a class="linhaResultado7 {{x.tipo}}" ng-repeat="x in recordsAtividadesAmanha | orderBy:myOrderBy | filter: filtro">
		<div data-cod="{{x.id}}" class="colunaResultado colunaId status{{x.status}}" title="{{x.titulo}}">{{x.id}}<span class='editar'> - Editar</span></div><div class="colunaResultado">{{x.nome}}</div><div class="colunaResultado">{{x.categoria}}</div>
	</a>

	<div class="semResultados" ng-if="!recordsAtividadesAmanha[0]">Nenhum Resultado.</div>

	</div>

	<script>

	$(function() {
		$('.linkTitulo8').click(function() {
			var elementos = document.getElementsByClassName('linkTitulo8');

		for (var x = 0; x < elementos.length; x++) {
			elementos[x].className = "linkTitulo8";
		}

		this.className = "linkTitulo8 selecionado";

		});
	});

	var app = angular.module("appAngularAtividadesAmanha", []);
	app.controller("myCtrlAngularAtividadesAmanha", function($scope) {
    
    $scope.recordsAtividadesAmanha = [

	<?php

	$sql = "SELECT agendas_atividades.*, a.nome AS nomeCategoria FROM agendas_atividades LEFT JOIN agendas_categorias a ON agendas_atividades.categoria = a.id WHERE agendas_atividades.status = '0' AND agendas_atividades.data = '".date('Y-m-d', strtotime('tomorrow'))."' ORDER BY agendas_atividades.id DESC";
	$res = sqlsrv_query($con, $sql);

	//echo $sql;

	$i = 0;
	 while($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {

	if($row['status'] == 0) $titulo = "Pendente";
	else if($row['status'] == 1) $titulo = "Almox";
	else $titulo = "Baixa";

		if($i == 0) echo "{";
		else echo ", {";
		echo "'id': ".$row['id'].", 'categoria': '".$row['nomeCategoria']."', 'nome': '".$row['nome']."', 'status': '".$titulo."' }";

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

	$('#adicionarAtividadeAmanha').click(function() {

		//$('#atividadeDinamico').html('Carregando...');
		// Do an ajax request
		$.ajax({
		  url: "atividade.php?id=novo&tipo=<?=$tipo?>"
		}).done(function(data) { // data what is sent back by the php page
		  $('#atividadeDinamico').html(data); // display data
		});

	});
});

angular.bootstrap('#angularAtividadesAmanha', ['appAngularAtividadesAmanha']);
	
</script>