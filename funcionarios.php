<h4>Funcionários</h4>

<?php

include "../sisti/conexao.php";

$sql = "SELECT * FROM relatorios_terceiros_funcionarios WHERE id_empresa = ".$_GET['id'];
$res = sqlsrv_query($con, $sql);
$i = 0;
while($row = sqlsrv_fetch_array($res)) {
	$func[$i]['nome'] = $row['nome'];
	$func[$i]['id'] = $row['id'];
	$i++;
}

if($i == 0) echo "<p>Nenhum Funcionário Cadastrado!</p>";

sort($func);

for($x = 0; $x < $i; $x++) {
?><div class='funcionarioQuadro' data-cod="<?=$func[$x]['id']?>"><?=$func[$x]['nome']?></div>
<?php } ?>