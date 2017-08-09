<?php
try {
/// To Connect To Database With PDO
   $pdo = new PDO('mysql:host=localhost;dbname=auth','root','',[
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    //////////////////////////////////////////////////
    PDO::ATTR_ERRMODE     => PDO::ERRMODE_SILENT
  ]);
  $pdo->exec('SET names utf8');
} catch (PDOException $e) {
  print_r($e->getMessage());
}
$stmt = $pdo->prepare('boddy dsnanu statment');
if (!$stmt) {
  //You Can Use errorCode() Function To Get More Info In Error
  echo "<pre>" . print_r($pdo->errorInfo(),true) . "</pre>";
}
/*
To Get More Info For Error Handling
Visit::
        http://php.net/manual/en/pdo.errorinfo.php
        http://php.net/manual/en/class.pdoexception.php
*/
