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
$stmt = $pdo->prepare('SELECT username FROM users WHERE username=:username');
$stmt->execute([
'username' => 'ahmed'
]);
if ($stmt->rowCount()) {
  foreach ($stmt->fetchALL() as $value) {
    print_r($value);
  }
}else {
  echo "No Such User";
}
echo $stmt->columnCount();