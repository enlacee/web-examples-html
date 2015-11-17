<?php

$uploads_dir = dirname(__DIR__) . '/assets/upload';

// valid and upload image
if (is_array($_FILES['image']) && ($_FILES['image']['error'] == UPLOAD_ERR_OK)) {
    $tmp_name = $_FILES["image"]["tmp_name"];
    $name = $_FILES["image"]["name"];
    move_uploaded_file($tmp_name, "$uploads_dir/$name");
    echo "ok";
}

// valid and upload dni
foreach ($_FILES["dni"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["dni"]["tmp_name"][$key];
        $name = $_FILES["dni"]["name"][$key];
        move_uploaded_file($tmp_name, "$uploads_dir/$name");
    }
}

$data_form = implode( ',', $_POST );

$response = array(
	'response'  => TRUE,
	'message'	=> $data_form
);

echo json_encode( $response );