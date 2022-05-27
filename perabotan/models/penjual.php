<?php 
  class penjual {
    // DB stuff
    private $conn;
    private $table = 'penjual';

    // Penjual Properties
    public $id;
    public $id_akun;
    public $nama;
    public $stok;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Penjual
    public function read() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table . ' ORDER BY Id';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get penjual Satu satu
    public function read_single() {
          // Create query
          $query = 'SELECT * FROM ' . $this->table . ' WHERE Id = ?';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->id_akun = $row['id_akun'];
          $this->nama = $row['nama'];
          $this->stok = $row['stok'];
    }

    // Buat penjual
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET id_akun = :id_akun, nama = :nama, stok = :stok';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id_akun = htmlspecialchars(strip_tags($this->id_akun));
        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->stok = htmlspecialchars(strip_tags($this->stok));
 // Bind data
        $stmt->bindParam(':id_akun', $this->id_akun);
        $stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':stok', $this->stok);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Perbarui penjual
    public function update() {
      // Create query
      $query = 'UPDATE ' . $this->table . '
                            SET id_akun = :id_akun, nama = :nama, stok = :stok
                            WHERE id = :id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->id_akun = htmlspecialchars(strip_tags($this->id_akun));
      $this->nama = htmlspecialchars(strip_tags($this->nama));
      $this->stok = htmlspecialchars(strip_tags($this->stok));
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind data
      $stmt->bindParam(':id_akun', $this->id_akun);
      $stmt->bindParam(':nama', $this->nama);
      $stmt->bindParam(':stok', $this->stok);
      $stmt->bindParam(':id', $this->id);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Hapus penjual
    public function delete() {
      // Create query
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
// Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->id = htmlspecialchars(strip_tags($this->id));

      // Bind data
      $stmt->bindParam(':id', $this->id);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    } 

  }