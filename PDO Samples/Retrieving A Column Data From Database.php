<?php
try {
/// To Connect To Database With PDO
   ///
   $pdo = new PDO('mysql:host=localhost;dbname=auth','root','',[
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]);
} catch (PDOException $e) {
  print_r($e->getMessage());
}

//To Understand It Sersh In Manuale PHP.net
$stmt = $pdo->prepare('SELECT * FROM users WHERE username = "ahmed"');
$stmt->execute();
$stmt->bindColumn(1, $username);
$stmt->bindColumn(2, $password);
// Make While Loop For Fetch Data Receved From DB Using bindColumn();
while ($stmt->fetchAll(PDO::FETCH_BOUND)) {
  echo "HELLO " . $username . 'Your Password ' . $password;
}
