<?php
    date_default_timezone_set('America/New_York');
    include "dbh.inc.php";
    include "comments.inc.php";
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./style.css">
</head>

<body>

<?php
$cid        = $_POST['cid'];
$uid        = $_POST['uid'];
$date       = $_POST['date'];
$message    = $_POST['message'];

echo "<form method='POST' action='".editComments($conn)."'>
      <input type='hidden' name='cid' value='".$cid ."'>
      <input type='hidden' name='uid' value='".$uid ."'>
      <input type='hidden' name='date' value='".$date."'>
      <textarea class='text1' name='message'>".$message ."</textarea>
      <div>
        <button type='submit' name='commentSubmit'>Edit Comment</button>
      </div>
    </form>";


?>
</body>
</html>