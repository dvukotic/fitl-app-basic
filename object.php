
<?php
//setLocale(LC_ALL, 'en_US.utf8', 'en_US');
setLocale(LC_NUMERIC, 'hr_HR.utf8');
setLocale(LC_MONETARY, 'hr_HR.utf8');
$id = $_REQUEST['id'];
$kupac = '';
$datum_rac = '';
$napomena = '';
if($id == 1) {
	$kupac = 'Veliki kupac d.o.o.';
	$datum_rac = '31.01.2017.';
	$stavke_rac = array(
		array("Rbr" => 1, "Stavka" => 'Najam', "Jed_cijena" => 4560.00, "Kolicina" => 1, "PDV_stopa" => 25, "PDV_iznos" => 0, "Ukupno" => 0), 
		array("Rbr" => 2, "Stavka" => 'Održavanje', "Jed_cijena" => 200.00, "Kolicina" => 4, "PDV_stopa" => 25, "PDV_iznos" => 0, "Ukupno" => 0),
		array("Rbr" => 3, "Stavka" => 'Servis', "Jed_cijena" => 1500.00, "Kolicina" => 1, "PDV_stopa" => 25, "PDV_iznos" => 0, "Ukupno" => 0)
	);
	$napomena = 'Ovo je napomena
	u više redova. 
	Da vidimo kako će biti formatirana';
}
else if ($id == 2)
{
	$kupac = 'Mali kupac d.o.o.';
	$datum_rac = '15.02.2017.';
	$stavke_rac = array(
		array("Rbr" => 1, "Stavka" => 'Najam', "Jed_cijena" => 800.00, "Kolicina" => 1, "PDV_stopa" => 25, "PDV_iznos" => 0, "Ukupno" => 0), 
		array("Rbr" => 2, "Stavka" => 'Servis', "Jed_cijena" => 200.00, "Kolicina" => 1, "PDV_stopa" => 25, "PDV_iznos" => 0, "Ukupno" => 0)
	);
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>fakturiraj.me</title>
		<style>
			h1, h2, h3, p, pre {
				font-family: arial, sans-serif;
			}
			table {
			    font-family: arial, sans-serif;
			    border-collapse: collapse;
			    width: 100%;
			}
			thead {
			    background-color: #dddddd;
			    border: 1px solid #aaaaaa;
			}

			tbody {
			    border: 1px solid #aaaaaa;
			}

			tfoot {
			    background-color: #dddddd;
			}
			td, th {
			    border: 1px solid #aaaaaa;
			    text-align: right;
			    padding: 8px;
			}			
		</style>
	</head>
	<body>
		<h1>Kupac: <?php echo $kupac ?></h1>
		<h2>Datum računa: <?php echo $datum_rac ?></h2>
		<h2>Broj računa: <?php echo $id?></h2>
		<table>
			<thead>
				<tr>
					<th width="5%"  style = "border: 1px solid #aaaaaa">Rbr</th>
					<th width="30%" style="text-align: left; border: 1px solid #aaaaaa">Artikal/usluga</th>
					<th width="10%" style = "border: 1px solid #aaaaaa">Jedinična<br>cijena</th>
					<th width="10%" style = "border: 1px solid #aaaaaa">Količina</th>
					<th width="5%"  style = "border: 1px solid #aaaaaa">PDV%</th>
					<th width="15%" style = "border: 1px solid #aaaaaa">PDV iznos</th>
					<th width="10%" style = "border: 1px solid #aaaaaa">Ukupno<br>s PDV-om</th>
				</tr>				
			</thead>
			<tbody>
				<?php
				$Iznos_bez_PDV_TOT = $PDV_TOT = $Ukupno_TOT = 0;
				foreach($stavke_rac as $k => $v) {
					$PDV_iznos = $v['Jed_cijena'] * $v['PDV_stopa'] / 100 * $v['Kolicina'];
					$Ukupno = $v['Jed_cijena'] * $v['Kolicina'] + $PDV_iznos;
					$Iznos_bez_PDV_TOT += $v['Jed_cijena'] * $v['Kolicina'];
					$PDV_TOT += $PDV_iznos;
					$Ukupno_TOT += $Ukupno;
					echo "<tr>";
						echo "<td>" . $v['Rbr'] 							. "</td>";
						echo "<td style='text-align: left'>" . $v['Stavka'] . "</td>";
						echo "<td>" . money_format('%n', $v['Jed_cijena']) 	. "</td>";
						echo "<td>" . $v['Kolicina'] 						. "</td>";
						echo "<td>" . $v['PDV_stopa'] 						. "</td>";
						echo "<td>" . money_format('%n', $PDV_iznos)		. "</td>";
						echo "<td>" . money_format('%n', $Ukupno)	 		. "</td>";
					echo "</tr>";			
				}
				?>				
			</tbody>
			<tfoot>
				<tr>
					<th colspan = '5' style = "background-color: #ffffff; border: 0px"></th>
					<th style = "border: 1px solid #aaaaaa">Ukupno bez PDV-a:</th>
					<th style = "border: 1px solid #aaaaaa"><?php echo money_format('%n', $Iznos_bez_PDV_TOT); ?></th>
				</tr>
				<tr>
					<th colspan = '5' style = "background-color: #ffffff; border: 0px"></th>
					<th style = "border: 1px solid #aaaaaa">Ukupno PDV:</th>
					<th style = "border: 1px solid #aaaaaa"><?php echo money_format('%n', $PDV_TOT); ?></th>
				</tr>
				<tr>
					<th colspan = '5' style = "background-color: #ffffff; border: 0px"></th>
					<th style = "border: 1px solid #aaaaaa">Sveukupno:</th>
					<th style = "border: 1px solid #aaaaaa"><?php echo money_format('%n', $Ukupno_TOT); ?></th>
				</tr>											
			</tfoot>
		</table>

		<h3>Napomena:</h3>
		<pre> 
			<?php echo $napomena ?>
		</pre>
	</body>
</html>