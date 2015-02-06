<?php
$wynik = $FP -> db_sq('SELECT * FROM mufaSpaw WHERE mufaSpawID = "'.(int)$_R -> mufaSpawID.'"');
 if(isset($_P -> mufaSpawID)){
	$relacja = $FP -> pobierzRelacjeLogicznaWlokna($wynik -> kabelWloknoID1);
	if(!empty( $relacja ))	
		echo $FP -> komunikat(false, false, 'Nie możesz usunąć spawu włókna które jest używane w relacji.<br>Usuń najpierw włókna z relacji a następnie usuń spaw z mufy');

	else if(!empty($_P -> mufaSpawID)){
			$zapytanie = $FP -> db_q('DELETE FROM mufaSpaw WHERE mufaSpawID = "'.$_P -> mufaSpawID.'"');
			echo $FP -> komunikat($zapytanie, 'Spaw nr <i>'.$_P -> mufaSpawID.'</i> został prawidłowo usunięty.<br><br><a href="?modul=mufy&co=listaSpawow&mufaID='.$wynik -> mufaID.'">Powrót do listy spawów</a>', 'Wystąpił błąd podczas usuwania spawu nr <i>'.$wynik -> mufaSpawID.'</i>');
			if($zapytanie)
				$FP -> log('Usunięto spaw włókien nr '.$wynik -> kabelWloknoID1.'/'.$wynik -> kabelID1.' i '.$wynik -> kabelWloknoID2.'/'.$wynik -> kabelID2.' z mufy nr '.$wynik -> mufaID);
		
	}
}

else{
$wlokno1 = $FP -> db_sq('SELECT kolorTubaID, kolorWloknoID FROM kabelWlokno WHERE kabelWloknoID = "'.$wynik -> kabelWloknoID1.'"');
$wlokno2 = $FP -> db_sq('SELECT kolorTubaID, kolorWloknoID FROM kabelWlokno WHERE kabelWloknoID = "'.$wynik -> kabelWloknoID2.'"');

$tuba1 = $FP -> kolor('tuba',$wlokno1 -> kolorTubaID);
$wlokno1 = $FP -> kolor('wlokno',$wlokno1 -> kolorWloknoID);
$tuba2 = $FP -> kolor('tuba',$wlokno2 -> kolorTubaID);
$wlokno2 = $FP -> kolor('wlokno',$wlokno2 -> kolorWloknoID);

?>
<form action="?modul=mufy&co=usunSpaw" method="POST">
<table align="center">
<tr>
<td colspan="2"><h3>Usuwanie spawu</h3>
<div class="usun"><b>Czy na pewno chcesz usunąć ten spaw?</b></div></td>
</tr>
<tr>
<td>ID</td>
<td><?php echo $wynik -> mufaSpawID ?><input type="hidden" name="mufaSpawID" value="<?php echo $wynik -> mufaSpawID ?>"></td>
</tr>
<td>Kabel A</td>
<td><b><?php echo $FP -> pobierzRelacjeKabla($wynik -> kabelID1); ?></b></td>
</tr>
<tr>
<td>Tuba A</td>
<td style="background-color: <?php echo $tuba1 -> kolorHTML ?>;border: 1px solid #656565; color: <?php echo $FP -> znajdzKolor($tuba1 -> kolorHTML) ?>"><?php echo $tuba1 -> kolor ?></td>
</tr>
<tr>
<td>Włókno A</td>
<td style="background-color: <?php echo $wlokno1 -> kolorHTML ?>;border: 1px solid #656565; color: <?php echo $FP -> znajdzKolor($wlokno1 -> kolorHTML) ?>"><?php echo $wlokno1 -> kolor ?></td>
</tr>
<tr>
<td colspan="2"><br></td>
</tr>
<td>Kabel B</td>
<td><b><?php echo $FP -> pobierzRelacjeKabla($wynik -> kabelID2); ?></b></td>
</tr>
<tr>
<td>Tuba B</td>
<td style="background-color: <?php echo $tuba2 -> kolorHTML ?>;border: 1px solid #656565; color: <?php echo $FP -> znajdzKolor($tuba2 -> kolorHTML) ?>"><?php echo $tuba2 -> kolor ?></td>
</tr>
<tr>
<td>Włókno B</td>
<td style="background-color: <?php echo $wlokno2 -> kolorHTML ?>;border: 1px solid #656565; color: <?php echo $FP -> znajdzKolor($wlokno2 -> kolorHTML) ?>"><?php echo $wlokno2 -> kolor ?></td>
</tr>
<tr>
<td>Opis</td>
<td><?php echo $wynik -> opis ?></td>
</tr>
<tr>
<td>Relacja</td>
<td><?php echo $FP -> pobierzRelacjeLogicznaWlokna($wynik -> kabelWloknoID1) ?></td>
</tr>
<tr>
<td colspan="2"><input type="submit" value="Usuń" class="usun"></td>
</tr>

</table>
</form>
<?php
}
?>