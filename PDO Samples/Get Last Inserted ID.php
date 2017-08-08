<?php
try {
/// To Connect To Database With PDO
   ///
   $pdo = new PDO('mysql:host=localhost;dbname=auth','root','',[
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ]);
  $pdo->exec('SET names utf8');

} catch (PDOException $e) {
  print_r($e->getMessage());
}

//(REPLACE TABLE_NAME {COLUMN} VALUES)
$stmt = $pdo->prepare('REPLACE users(username) VALUES (:username)');
$stmt->execute(['username' => 'mahmoud']);
if ($stmt->rowCount()) {

  echo $pdo->lastInsertID();
}


