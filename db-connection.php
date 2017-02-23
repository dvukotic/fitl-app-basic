<?php
//setLocale(LC_ALL, 'en_US.utf8', 'en_US');
setLocale(LC_NUMERIC, 'hr_HR.utf8');
setLocale(LC_MONETARY, 'hr_HR.utf8');

// Database connection credentials
$servername = 'localhost';
$username = 'homestead';
$password = 'secret';
$database = 'fitl';

// Create connection
$mysql = new mysqli($servername, $username, $password);

// Check if connection is successfuly opened
if ($mysql->connect_error) {
	echo 'Neuspješno povezivanje na bazu';
	exit;
} else {
	// Connect to database
	$mysql->select_db($database);
}
?>