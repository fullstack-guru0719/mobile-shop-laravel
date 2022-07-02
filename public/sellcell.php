<?php

// Database setup
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', 'NjUyZTI3YTE2M2Fm' );
define( 'DB_NAME', 'tronidb' );

// Initialise results array
$results = array( );

// Connect to database
$db_connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

if( !$db_connection ) {
	print('<p>Sorry, there was a database error.</p>');
	exit( );
}

// Select query on table products
$sql  = 'SELECT s.id, b.name AS brand, p.model, s.title AS capacity, n.title as carrier, s.excellent_offer, s.good_offer, s.fair_offer, s.poor_offer ';
$sql .= 'FROM tronidb.products AS p ';
$sql .= 'INNER JOIN tronidb.settings_brands AS b ON b.id = p.brand_id ';
$sql .= 'INNER JOIN tronidb.product_storages AS s ON s.product_id = p.id ';
$sql .= 'INNER JOIN tronidb.networks AS n ON n.id = s.network_id ';
$sql .= 'WHERE p.status = "Active" ';
$sql .= 'ORDER BY brand ASC, model ASC, capacity ASC, network ASC;';

$db_query_result = mysqli_query( $db_connection, $sql );

if( !$db_query_result ) {
	mysqli_close( $db_connection );
	print('<p>Sorry, there was a database error.</p>');
	exit( );
}

// Loop through the results and prepare to output as csv
$total_rows = mysqli_num_rows( $db_query_result );

for( $row = 0; $row < $total_rows; $row++ ) {

	$row_array = mysqli_fetch_assoc( $db_query_result );

	$results[] = array(
		'id' => $row_array['id'],
		'brand' => $row_array['brand'],
		'model' => $row_array['model'],
		'capacity' => $row_array['capacity'],
		'carrier' => $row_array['carrier'],
		'deeplink' => 'https://www.tronicspay.com/products/' . str_replace( ' ', '%20', $row_array['brand'] ) . '/' . str_replace( ' ', '%20', $row_array['model'] ),
		'excellent_offer' => $row_array['excellent_offer'],
		'good_offer' => $row_array['good_offer'],
		'fair_offer' => $row_array['fair_offer'],
		'poor_offer' => $row_array['poor_offer']
	);
}

// echo '<pre>';
// print_r( $results );
// echo '</pre>';

// Set output headers
header( 'Content-type: text/csv' );
header( 'Cache-Control: no-store, no-cache' );
header( 'Content-Disposition: attachment; filename="tronicspay_' . date( 'Y-m-d' ) . '.csv"' );

// Open output stream
$stream = fopen( 'php://output', 'w' );

$row = array(
	'id',
	'brand',
	'model',
	'capacity',
	'carrier',
	'deeplink',
	'price_new',
	'price_good',
	'price_poor',
	'price_broken'
);

fputcsv( $stream, $row, ',', '"' );

foreach( $results as $row ) {
	fputcsv( $stream, $row, ',', '"' );			
}

// Close output stream
fclose( $stream );

// Close connection with database
mysqli_close( $db_connection );

?>