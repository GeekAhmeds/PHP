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


try {
  if (isset($_POST['submit'], $_POST['username'], $_POST['password'], $_POST['usernameToTransact'], $_POST['amountTransact'])) {
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['usernameToTransact']) && !empty($_POST['amountTransact'])) {
          $pdo->beginTransaction();
          $stmt = $pdo->prepare('SELECT * FROM users WHERE username=:username AND password=:password');
          $stmt->execute([
            ':username' =>  $_POST['username'] ,   //$_POST['username'],
            ':password' =>  $_POST['password']    //$_POST['password']
          ]);
          if ($stmt->rowCount()) {
          $user_data = $stmt->fetchAll()[0];
          $user_salary = $user_data['salary'];
          $permission = $user_data['permission'];
          $salaryToTransact = $_POST['amountTransact'];   //$_POST[':transtSalary'];
          if ($user_salary >= $salaryToTransact && $permission == 1) {
            $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
            $stmt->bindValue(':username',$_POST['usernameToTransact']);
            $stmt->execute();
            if ($stmt->rowCount()) {
              $salary = $stmt->fetchAll()[0]['salary'];
              $totalSalaty = $salary + $salaryToTransact;
              $stmt = $pdo->prepare('UPDATE users SET salary = :salary WHERE username=:username');
              $stmt->execute([
                ':username' => $_POST['usernameToTransact'],
                ':salary'   => $totalSalaty,
              ]);
                  /*
                  When Write {  die();  } Here Or Somthing Wrong e.g Server Is Stopped
                  SQL Is Auto Commit  And It Can't Run Evrything After This Comment
                  */
                if ($stmt->rowCount()) {
                    $currentSalary = $user_salary - $salaryToTransact;
                    $stmt = $pdo->prepare('UPDATE users SET salary = :salary WHERE username=:username');
                    $stmt->execute([
                      ':salary' => $currentSalary , ':username' => $_POST['username']
                    ]);
                    if ($stmt->rowCount()) {
                      echo "Transaction Happened Successfully";
                    }
                    
                }else {
                  echo "Please Try Again Later";
                }
            }else {
              echo 'Sorry :( This User Not Registered';
            }
          }



          }
          $pdo->commit();



              }else {
                echo "Please Fill Input";
              }
            }
} catch (PDOException $e) {
  $pdo->rollBack();
die(print_r($e->getMessage()));
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Transaction</title>
  </head>
  <body>
    <form  action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
      <input type="text" name="username" placeholder="Enter Your UserName"><br />
      <input type="password" name="password" placeholder="Enter Your Password"><br />
      <input type="text" name="usernameToTransact" placeholder="Enter Your Username To Wish To Trasact Him"><br />
      <input type="text" name="amountTransact" placeholder="Amount"><br />
      <input type="submit" name="submit" value="Transact">
    </form>
  </body>
</html>
