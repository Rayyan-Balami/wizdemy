<?php

/**
 * Database class
 * 
 * This class contains methods for connecting to a database
 * 
 * methods: __construct, buildDsn
 */
class Database
{
  protected $conn;
  protected $statement;
  

  protected function __construct(){
    $dsn = $this->buildDsn();
    $this->conn = new PDO($dsn, DB_USER, DB_PASS, [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  /**
   * Build a DSN string
   * 
   * @return string The DSN string
   */
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
