<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/penjual.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $penjual = new penjual($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $penjual->id = $data->id;
  $penjual->id_akun = $data->id_akun;
  $penjual->nama = $data->nama;
  $penjual->stok = $data->stok;

  // Update penjual
  if($penjual->update()) {
    echo json_encode(
      array('message' => 'penjual Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'penjual Not Updated')
    );
  }