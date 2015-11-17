<?php
VAR_DUMP($_FILES);
exit;


$data_form = implode( ',', $_POST );
//$data_form = implode( ',', $_FILES['image']['name'] );

$response = array(
	'response'  => TRUE,
	'message'	=> $data_form
);

echo json_encode( $response );


/*
//echo "<pre>"; print_r( $_FILES['dni']['name'] );

session_start();

$data = $_FILES['dni']['name'];

$data_form = implode( ',', $_FILES['dni']['name'] );

$data_render = array();

	
		$name =  $_FILES['dni']['name'];
		$data_render[] = $name;
	

	echo "<pre>"; print_r( $_SESSION['files'] = $data_render );
*/

?>