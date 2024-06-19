<?php

class Database
{
  protected $conn;
  protected $statement;
  

  // We have used PDO (PHP Data Objects) to connect to the database.
  protected function __construct(){
    try {
      $dsn = $this->buildDsn();
      $this->conn = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      ]);
    } catch (PDOException $e) {
      // Log error message
      error_log($e->getMessage());
      // Display a user-friendly message
      die('A database error occurred. Please try again later.');
    }
  }

  protected function buildDsn() : string
  {
    $db_details = [
      "host" => DB_HOST,
      "port" => DB_PORT,
      "dbname" => DB_NAME,
      "charset" => DB_CHARSET
    ];

    return "mysql:" . http_build_query($db_details, "", ";");
  }

}