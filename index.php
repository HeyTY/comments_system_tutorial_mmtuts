<?php
    date_default_timezone_set('America/New_York');
    include "dbh.inc.php";
    include "comments.inc.php";
    session_start();
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./style.css">
</head>

<body>

<?php
echo"<form action='".getLogin($conn)."' method='POST'>
    <input type='text' name='uid' placeholder='Username'>
    <input type='text' name='pwd' placeholder='Password'>
    <button type='submit' name='loginSubmit'>Sign Up</button>
</form>";

echo"<form action='".userLogout()."' method='POST'>
    <button type='submit' name='logoutSubmit'>Logout</button>
</form>";


if (isset($_SESSION['id'])) {
    echo "You are logged!";
} else {
    echo "You are not logged in";
}


?>

<br><br>

<iframe width="854" height="480"
  src="https://www.youtube.com/embed/h--P8HzYZ74" frameborder="0" allowfullscreen>
</iframe>

  <?php
    echo "<form method='POST' action='".setComments($conn)."'>
      <input type='hidden' name='uid' value='Anonymous'>
      <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
      <textarea class='text1' name='message'></textarea>
      <div>
        <button type='submit' name='commentSubmit'>Add Comment</button>
      </div>
    </form>";

    getComments($conn);
  ?>
</body>
</html>

