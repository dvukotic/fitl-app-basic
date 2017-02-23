<?php
// Otvori konekciju
include 'db-connection.php';

// Pročitaj URL parametre
$page = $_REQUEST['page'];

// Pozovi odgovarajuće stranice
if ($page == 'show') {
	$id = $_REQUEST['id'];
	show($id);
} else if ($page == 'create') {
	create();
}

function show($id) {
	global $mysql;

	$kupac = '';
	$datum_rac = '';
	$napomena = '';

	// Query statement to execute
	$sql = 'SELECT * FROM tbl_invoices WHERE _id = ' . $id;
	// Execute query
	$query_result = $mysql->query($sql);
	// If there is some rows...
	if ($query_result->num_rows > 0) {
		// Fetch rows into an array
		$invoice = $query_result->fetch_assoc();
		echo '<pre>';
		print_r($invoice);
		echo '</pre>';
	}	

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

	// Load the view file
	include 'invoice-show-view.php';
}

function create() {
	// Load the create file
	include 'invoice-create-view.php';	
}
?>