
<?php

 
function MostreSemanas()
{
	$semanas[0] = "Domingo";
	$semanas[1] = "Segunda";
	$semanas[2] = "Terça";
	$semanas[3] = "Quarta";
	$semanas[4] = "Quinta";
	$semanas[5] = "Sexta";
	$semanas[6] = "Sábado";
 
	for( $i = 0; $i < 7; $i++ )
	 echo "<td>".$semanas{$i}."</td>";
 
}
 
function GetNumeroDias( $mes )
{
	$numero_dias = array( 
			'01' => 31, '02' => 28, '03' => 31, '04' =>30, '05' => 31, '06' => 30,
			'07' => 31, '08' =>31, '09' => 30, '10' => 31, '11' => 30, '12' => 31
	);
 
	if (((date('Y') % 4) == 0 and (date('Y') % 100)!=0) or (date('Y') % 400)==0)
	{
	    $numero_dias['02'] = 29;	// altera o numero de dias de fevereiro se o ano for bissexto
	}
 
	return $numero_dias[$mes];
}
 
function GetNomeMes( $mes )
{
     $meses = array( '01' => "Janeiro", '02' => "Fevereiro", '03' => "Março",
                     '04' => "Abril",   '05' => "Maio",      '06' => "Junho",
                     '07' => "Julho",   '08' => "Agosto",    '09' => "Setembro",
                     '10' => "Outubro", '11' => "Novembro",  '12' => "Dezembro"
                     );
 
      if( $mes >= 01 && $mes <= 12)
        return $meses[$mes];
 
        return "Mês deconhecido";
 
}
 
 
 
function MostreCalendario( $ano, $mes  )
{

	
	$numero_dias = GetNumeroDias( $mes );	// retorna o número de dias que tem o mês desejado
	$nome_mes = GetNomeMes( $mes );
	$diacorrente = 0;	
	$ant = $mes - 1;

	$anoAnt = $ano;
	$anoProx = $ano;

	if($ant < 10) $ant = "0".$ant;
	$prox = $mes + 1;
	if($prox < 10) $prox = "0".$prox;
	
	if($prox == 13) {
		$prox = "01";
		$anoProx++;
	}
	
	if($ant == 0) {
		$ant = "12";
		$anoAnt--;

	}
 
	$diasemana = jddayofweek( cal_to_jd(CAL_GREGORIAN, $mes,"01", $ano), 0 );	// função que descobre o dia da semana
 
	echo "<table border = 0 cellspacing = '0' align = 'center'>";
	 echo "<tr class='nome_mes'>";
     echo "<td class='nomeMes' colspan = 7><h3><a href='#' id='voltarMes'><</a>".$nome_mes." | ".$ano."<a href='#' id='avancarMes'>></a></h3></td>";
	 
	 echo "</tr>";
	 echo "<tr class='nomeDias'>";
	   MostreSemanas();	// função que mostra as semanas aqui
	 echo "</tr>";
	for( $linha = 0; $linha < 6 && ($diacorrente + 1) <= $numero_dias; $linha++ )
	{
 
 
	   echo "<tr>";
 
	   for( $coluna = 0; $coluna < 7; $coluna++)
	   {
		echo "<td height = 0 ";
 
		  if( ($diacorrente == ( date('d') - 1) && date('m') == $mes) )
		  {	
			   echo " id = 'dia_atual' ";
		  }
		  else
		  {
			     if(($diacorrente + 1) <= $numero_dias )
			     {
			         if( $coluna < $diasemana && $linha == 0)
				 {
					echo " id = 'dia_branco' ";
				 }
				 else
				 {
				  	echo " id = 'dia_comum' ";
				 }
			     }
			     else
			     {
				    echo " id = 'dia_branco' ";
			     }
		  }
		echo " align ='center' valign = 'center'>";
 
 
		   /* TRECHO IMPORTANTE: A PARTIR DESTE TRECHO É MOSTRADO UM DIA DO CALENDÁRIO (MUITA ATENÇÃO NA HORA DA MANUTENÇÃO) */
 
		      if( $diacorrente + 1 <= $numero_dias )
		      {
			 if( $coluna < $diasemana && $linha == 0)
			 {
			  	 echo " ";
			 }
			 else
			 {

			 		$soma = $diacorrente+1;
			  	if($soma < 10) $diaTexto = "0".$soma;
			  	else $diaTexto = $soma;
			if ("20".date("y-m-d") == $ano."-".$mes."-".$diaTexto) {
			  echo "<a class='diaCalendario hoje' href='#'>".++$diacorrente;
			}
			  else {
				echo "<a class='diaCalendario' href='#'>".++$diacorrente;
			  }

								

				   echo "</a>";
			 }
		      }
		      else
		      {
			break;
		      }
 
		   /* FIM DO TRECHO MUITO IMPORTANTE */
 
 
 
		echo "</td>";
	   }

	   for($w=0; $w < 6-$coluna; $w++) echo "<td id='dia_branco'></td>";
	   echo "</tr>";
	}
 
	echo "</table>";

		
}
 
function MostreCalendarioCompleto($ano, $mes)
{
	    echo "<table align ='center'>";
	    $cont = $mes+1;
	    for( $j = 0; $j < 12; $j++ )
	    {
		  echo "<tr>";
		  if($cont < 10) $cont = "0".$cont;

		  if($cont == 13) {
		  	$ano++;
		  	$cont = "01";
		  }
		  echo "<td>";
			MostreCalendario( $ano, $cont );  
 
		    $cont++;
		  echo "</td>";
		echo "</tr>";
	   }
	   echo "</table>";
}

?>



<?php

$mes = date('m');
$ano = date('Y');
MostreCalendario($ano, $mes);

?>
