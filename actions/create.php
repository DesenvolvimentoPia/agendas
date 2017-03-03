<?php

include "conexao.php";

if(!empty($_POST['hiddenCreate'])) {

		$chaves = array_keys($_POST);
		for($x = 0; $x < count($chaves); $x++){
			$chave = $chaves[$x];
			$_POST[$chave] = str_replace('"', "&quot;", $_POST[$chave]);
			$_POST[$chave] = str_replace("'", "&#039;", $_POST[$chave]);
		}


	if(!empty($_POST['hiddenNovoAtividade'])) {


		$cortar = explode("/", $_POST['inputDataNotaFiscal']);
		$dataNota = $cortar[2]."-".$cortar[1]."-".$cortar[0];

		$pasta = "notas/";

		if(isset($_FILES['inputNotaFiscal']['name'])) {
			$notaFiscal = $pasta ."-".$_POST['inputNumeroNota']. basename($_FILES['inputNotaFiscal']['name']);
			move_uploaded_file($_FILES['inputNotaFiscal']['tmp_name'], $notaFiscal);
		}

		$_POST['inputModelo'] = str_replace("'", '"', $_POST['inputModelo']);

		if(isset($_POST['inputDisponivel']) && $_POST['inputDisponivel'] == 1) $disponivel = 1;
		else $disponivel = 0;

		$patrimonios = explode(";", $_POST['inputPatrimonio']);
		for($i = 0; $i < count($patrimonios); $i++) {

			$sql = "INSERT INTO relatorios_equipamentos (tipo, patrimonio, marca, modelo, tag, nota_fiscal, fornecedor, cnpj, data_nf, link, observacao, disponivel, garantia, status) VALUES ('".$_POST['inputTipo']."', '".$patrimonios[$i]."', '".$_POST['inputMarca']."', '".$_POST['inputModelo']."', '".$_POST['inputTag']."', '".$_POST['inputNumeroNota']."', '".$_POST['inputFornecedor']."', '".$_POST['inputCnpj']."', '".$dataNota."', '".$notaFiscal."', '".$_POST['inputObservacao']."', '".$disponivel."', '".$_POST['inputGarantia']."','".$_POST['inputStatus']."')";
			$res = sqlsrv_query($con, $sql);		
			$resultado = "Equipamento Inserido com Sucesso!";	

			$lastRes = sqlsrv_query($con, "SELECT SCOPE_IDENTITY()");
			$lastId = sqlsrv_fetch_array($lastRes)[0];

			$sql1 = "INSERT INTO relatorios_historico (nome, hora, descricao, id_usuario, sistema, id_item) VALUES ('Equipamento Inserido', '".date("Y-m-d H:i:s")."', 'O Equipamento foi Inserido com Sucesso!', '".$_SESSION['userId']."', '7', '".$lastId."')";
			$res1= sqlsrv_query($con, $sql1);

		}

			//echo $sql;

	}


	
}