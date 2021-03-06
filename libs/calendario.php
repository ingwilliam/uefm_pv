<?php
function calcula_numero_dia_semana($dia,$mes,$ano){
	$numerodiasemana = date('w', mktime(0,0,0,$mes,$dia,$ano));
	if ($numerodiasemana == 0) 
		$numerodiasemana = 6;
	else
		$numerodiasemana--;
	return $numerodiasemana;
}

//funcion que devuelve el �ltimo d�a de un mes y a�o dados
function ultimoDia($mes,$ano){
	$ultimo_dia=28;
	while (checkdate($mes,$ultimo_dia,$ano)){
	        $ultimo_dia++;
	}    
	$ultimo_dia--;
	return $ultimo_dia;
}

function dame_nombre_mes($mes){
	 switch ($mes){
	 	case 1:
			$nombre_mes="Enero";
			break;
	 	case 2:
			$nombre_mes="Febrero";
			break;
	 	case 3:
			$nombre_mes="Marzo";
			break;
	 	case 4:
			$nombre_mes="Abril";
			break;
	 	case 5:
			$nombre_mes="Mayo";
			break;
	 	case 6:
			$nombre_mes="Junio";
			break;
	 	case 7:
			$nombre_mes="Julio";
			break;
	 	case 8:
			$nombre_mes="Agosto";
			break;
	 	case 9:
			$nombre_mes="Septiembre";
			break;
	 	case 10:
			$nombre_mes="Octubre";
			break;
	 	case 11:
			$nombre_mes="Noviembre";
			break;
	 	case 12:
			$nombre_mes="Diciembre";
			break;
	}
	return $nombre_mes;
}

function mostrar_calendario($data,$mes,$ano){        
	//tomo el nombre del mes que hay que imprimir
	$nombre_mes = dame_nombre_mes($mes);
        //construyo la tabla general
	echo '<table class="tablacalendario" cellspacing="3" cellpadding="2" border="0">';
	echo '<tr><td colspan="7" class="tit">';
	//tabla para mostrar el mes el a�o y los controles para pasar al mes anterior y siguiente
	echo '<table width="100%" cellspacing="2" cellpadding="2" border="0"><tr><td class="messiguiente">';
	//calculo el mes y ano del mes anterior
	$mes_anterior = $mes - 1;
	$ano_anterior = $ano;
	if ($mes_anterior==0){
		$ano_anterior--;
		$mes_anterior=12;
	}
	echo '<a href="index.php?controlador=Evento&accion=evento&mes=' . $mes_anterior . '&anio=' . $ano_anterior .'"><img src="images/flechaatras.png" alt="anterior" /></a></td>';
	   echo '<td class="titmesano">' . $nombre_mes . " " . $ano . '</td>';
	   echo '<td class="mesanterior">';
	//calculo el mes y ano del mes siguiente
	$mes_siguiente = $mes + 1;
	$ano_siguiente = $ano;
	if ($mes_siguiente==13){
		$ano_siguiente++;
		$mes_siguiente=1;
	}
	echo '<a href="index.php?controlador=Evento&accion=evento&mes=' . $mes_siguiente . '&anio=' . $ano_siguiente . '"><img src="images/flecha3.png" alt="siguiente" /></a></td>';
	//finalizo la tabla de cabecera
	echo '</tr></table>';
	echo '</td></tr>';
	//fila con todos los d�as de la semana
	echo '	<tr>
				<td width="14%" class="diasemana"><span>Lun</span></td>
				<td width="14%" class="diasemana"><span>Mar</span></td>
				<td width="14%" class="diasemana"><span>Mie</span></td>
				<td width="14%" class="diasemana"><span>Jue</span></td>
				<td width="14%" class="diasemana"><span>Vie</span></td>
				<td width="14%" class="diasemana"><span>Sab</span></td>
				<td width="14%" class="diasemana"><span>Dom</span></td>
			</tr>';
	
	//Variable para llevar la cuenta del dia actual
	$dia_actual = 1;
	
	//calculo el numero del dia de la semana del primer dia
	$numero_dia = calcula_numero_dia_semana(1,$mes,$ano);
	//echo "Numero del dia de demana del primer: $numero_dia <br>";
	
	//calculo el �ltimo dia del mes
	$ultimo_dia = ultimoDia($mes,$ano);
	
	//escribo la primera fila de la semana
	echo "<tr>";
	for ($i=0;$i<7;$i++){

                $arrayEvento = $data->consultRegistroSql("SELECT * FROM evento WHERE month( fecha_inicio ) = $mes AND day( fecha_inicio ) = $dia_actual ");
            
                $idEvento = $arrayEvento["id"];

		if ($i < $numero_dia){
			//si el dia de la semana i es menor que el numero del primer dia de la semana no pongo nada en la celda
			if( $i > 4 )
                            echo '<td class="diainvalido finSemana"><span></span></td>';
                        else
                            echo '<td class="diainvalido"><span></span></td>';
			
                        
		} else {
			if( $i > 4 )
                        {
                            if( $idEvento )
                                echo '<td class="diavalido finSemana eventoActivo"><span><a href="index.php?controlador=Evento&accion=evento&dia='.$dia_actual.'&mes='.$mes.'&anio='.$ano.'">' . $dia_actual . '</a></span></td>';
                            else
                                echo '<td class="diavalido finSemana"><span>' . $dia_actual . '</span></td>';
                        }
                        else
                        {
                            if( $idEvento )
                                echo '<td class="diavalido eventoActivo"><span><a href="index.php?controlador=Evento&accion=evento&dia='.$dia_actual.'&mes='.$mes.'&anio='.$ano.'">' . $dia_actual . '</a></span></td>';
                            else
                                echo '<td class="diavalido"><span>' . $dia_actual . '</span></td>';
                        }
			$dia_actual++;
		}
	}
	echo "</tr>";
	
	//recorro todos los dem�s d�as hasta el final del mes
	$numero_dia = 0;
	while ($dia_actual <= $ultimo_dia){

                $arrayEvento = $data->consultRegistroSql("SELECT * FROM evento WHERE month( fecha_inicio ) = $mes AND day( fecha_inicio ) = $dia_actual ");
            
                $idEvento = $arrayEvento["id"];

		//si estamos a principio de la semana escribo el <TR>
		if ($numero_dia == 0)
			echo "<tr>";
		
                if( $numero_dia > 4 )
                {
                    if( $idEvento )
                        echo '<td class="diavalido finSemana eventoActivo"><span><a href="index.php?controlador=Evento&accion=evento&dia='.$dia_actual.'&mes='.$mes.'&anio='.$ano.'">' . $dia_actual . '</a></span></td>';
                    else
                        echo '<td class="diavalido finSemana"><span>' . $dia_actual . '</span></td>';
                }
                else
                {
                    if( $idEvento )
                        echo '<td class="diavalido eventoActivo"><span><a href="index.php?controlador=Evento&accion=evento&dia='.$dia_actual.'&mes='.$mes.'&anio='.$ano.'">' . $dia_actual . '</a></span></td>';
                    else
                        echo '<td class="diavalido"><span>' . $dia_actual . '</span></td>';
                }
                
		$dia_actual++;
		$numero_dia++;
		//si es el u�timo de la semana, me pongo al principio de la semana y escribo el </tr>
		if ($numero_dia == 7){
			$numero_dia = 0;
			echo "</tr>";
		}
	}
	
	//compruebo que celdas me faltan por escribir vacias de la �ltima semana del mes
	for ($i=$numero_dia;$i<7;$i++){
		echo '<td class="diainvalido"><span></span></td>';
	}
	
	echo "</tr>";
	echo "</table>";
}

function formularioCalendario($mes,$ano){
echo '
	<table align="center" cellspacing="2" cellpadding="2" border="0">
	<tr><form action="" method="POST">';
echo '
    <td align="center" valign="top">
		Mes: <br>
		<select name=mes>
		<option value="1"';
if ($mes==1)
 echo "selected";
echo'>Enero</option>
		<option value="2" ';
if ($mes==2) 
	echo "selected";
echo'>Febrero</option>
		<option value="3" ';
if ($mes==3) 
	echo "selected";
echo'>Marzo</option>
		<option value="4" ';
if ($mes==4) 
	echo "selected";
echo '>Abril</option>
		<option value="5" ';
if ($mes==5) 
		echo "selected";
echo '>Mayo</option>
		<option value="6" ';
if ($mes==6) 
	echo "selected";
echo '>Junio</option>
		<option value="7" ';
if ($mes==7) 
	echo "selected";
echo '>Julio</option>
		<option value="8" ';
if ($mes==8) 
	echo "selected";
echo '>Agosto</option>
		<option value="9" ';
if ($mes==9) 
	echo "selected";
echo '>Septiembre</option>
		<option value="10" ';
if ($mes==10) 
	echo "selected";
echo '>Octubre</option>
		<option value="11" ';
if ($mes==11) 
	echo "selected";
echo '>Noviembre</option>
		<option value="12" ';
if ($mes==12) 
    echo "selected";
echo '>Diciembre</option>
		</select>
		</td>';
echo '		
	    <td align="center" valign="top">
		A&ntilde;o: <br>
		<select name=anio>
	';
//este bucle se podr�a hacer dependiendo del n�mero de a�o que se quiera mostrar
//yo voy a mostar 10 a�os atr�s y 10 adelante de la fecha mostrada en el calendario
for ($anoactual=$ano-10; $anoactual<=$ano+10; $anoactual++){
	echo '<option value="' . $anoactual . '" ';
	if ($ano==$anoactual) {
		echo "selected";
	}
	echo '>' . $anoactual . '</option>';
}
echo '</select>
		</td>';
echo '
	<td align="center"><br/><input type="Submit" class="buscarEvento" value="Buscar"></td>
        </tr>
	</table>
	</form>';
}