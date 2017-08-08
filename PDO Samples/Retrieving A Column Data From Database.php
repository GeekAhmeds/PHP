<?php
try {
/// To Connect To Database With PDO
   ///
  $pdo = new PDO('mysql:host=localhost;dbname=auth','root','',[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION

  ]);


} catch (PDOException $e) {
  print_r($e->getMessage());
}
