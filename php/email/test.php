<?php
session_start();
$_SESSION["infoEmailArr"] = array("recipient" => "tuantran0722.inforevn@gmail.com","subject" => "Book order",
 "Type" => "Borrow",
 "Price" => "100$");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="email.php" method="post">
  <input type="submit" value="Submit">
</form>
    
</body>
</html>