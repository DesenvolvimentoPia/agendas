<h1>CONSULTAR HISTÓRICO</h1>

    <pagination total-items="totalItems" ng-model="currentPage" ng-change="pageChanged()" max-size="16" class="pagination-sm" items-per-page="itemsPerPage"></pagination>

	<div class="tituloResultados">
		<a class="linkTitulo3 selecionado" ng-click="ordenar2('id');">Dia e Hora</a><a  class="linkTitulo3" ng-click="ordenar2('evento');">Evento</a><a  class="linkTitulo3" ng-click="ordenar2('descricao');">Descrição</a><a  class="linkTitulo3" ng-click="ordenar2('usuario');">Usuário</a>
	</div>

	<div class="linhaResultado6" ng-repeat="y in records.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | orderBy:myOrderBy2">
		<div class="colunaResultado3">{{y.diaHora}}</div><div class="colunaResultado3">{{y.evento}}</div><div class="colunaResultado3">{{y.descricao}}</div><div class="colunaResultado3">{{y.usuario}}</div>
	</div>

    <pagination total-items="totalItems" ng-model="currentPage" ng-change="pageChanged()" max-size="16" class="pagination-sm" items-per-page="itemsPerPage"></pagination>

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

	var appHistorico = angular.module("appHistorico", ['ui.bootstrap'])
	.controller("myCtrlHistorico", function($scope) {
   
    $scope.records = [

	<?php

	$sql = "SELECT relatorios_historico.id, relatorios_historico.nome, hora, descricao, relatorios_usuarios.nome AS usuario FROM relatorios_historico LEFT JOIN relatorios_usuarios ON relatorios_historico.id_usuario = relatorios_usuarios.id  WHERE sistema = 7 ORDER BY relatorios_historico.id DESC";
	$res = sqlsrv_query($con, $sql);

	//echo $sql;

	$i = 0;
	 while($row = sqlsrv_fetch_array($res)) {
		if($i == 0) echo "{";
		else echo ", {";
		echo "'diaHora': '".$row['hora']->format('d/m/Y')."', 'evento': '".$row['nome']."', 'id': '".$row['id']."', 'descricao': '".$row['descricao']."', 'usuario': '".$row['usuario']."' }";
		$i++;
	}
	
	?>

    ];

      $scope.viewby = 50;
	  $scope.totalItems = $scope.records.length;
	  $scope.currentPage = 1;
	  $scope.itemsPerPage = $scope.viewby;
	  $scope.maxSize = 5; //Number of pager buttons to show

	  $scope.setPage = function (pageNo) {
	    $scope.currentPage = pageNo;
	  };

	  $scope.pageChanged = function() {
	    console.log('Page changed to: ' + $scope.currentPage);
	  };

	  $scope.setItemsPerPage = function(num) {
	  $scope.itemsPerPage = num;
	  $scope.currentPage = 1; //reset to first paghe
	}


      $scope.ordenar2 = function(y) {
      	if($scope.myOrderBy2 == y) y = "-"+y;
	    $scope.myOrderBy2 = y;
	  }
});

angular.bootstrap('#historico', ['appHistorico']);

</script>