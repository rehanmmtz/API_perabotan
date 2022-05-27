<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/penjual.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $penjual = new penjual($db);

  // Get ID
  $penjual->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $penjual->read_single();

  // Create array
  $penjual_arr = array(
    'id_akun' => $penjual->id_akun,
    'nama' => $penjual->nama,
    'stok' => $penjual->stok
  );

  // Make JSON
  print_r(json_encode($penjual_arr));