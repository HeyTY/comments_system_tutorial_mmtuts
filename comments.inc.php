<?php

// Comments
function setComments($conn) {
  if (isset($_POST['commentSubmit'])) {
    $uid = $_POST['uid'];
    $date = $_POST['date'];
    $message = $_POST['message'];

    $sql = "INSERT INTO comments (uid,date,message) VALUES('$uid', '$date', '$message')";
    $result = mysqli_query($conn, $sql);
    header("Location: ./index.php");
  }
}


function getComments($conn) {
  $sql = "SELECT * FROM comments";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['uid'];
    $sql2 = "SELECT * FROM user WHERE id='$id'";
    $result2 = mysqli_query($conn, $sql2);

    if ($row2 = mysqli_fetch_assoc($result2)) {
      echo "<div class='comments-box'><p>";
      echo $row2['uid']."<br>";
      echo $row['date']."<br>";
      echo nl2br($row['message']);
      echo "</p>";

      if (isset($_SESSION['id'])) {
        if ($_SESSION['id'] == $row2['id'] ) {

            echo "<form class='delete-form' method='POST' action='".deleteComments($conn)."'>
               <input type='hidden' name='cid' value='".$row['cid']."'>
               <button type='submit' name='commentDelete'>Delete</button>
            </form>
        
            <form class='edit-form' method='POST' action='editcomments.php'>
                <input type='hidden' name='cid' value='".$row['cid']."'>
                <input type='hidden' name='uid' value='".$row['uid']."'>
                <input type='hidden' name='date' value='".$row['date']."'>
                <input type='hidden' name='message' value='".$row['message']."'>
               <button name=''>Edit</button>
            </form>";
        } else {
          echo "<form class='edit-form' method='POST' action='replycomments.php'>
                <input type='hidden' name='cid' value='".$row['cid']."'>
                <input type='hidden' name='uid' value='".$row['uid']."'>
                <input type='hidden' name='date' value='".$row['date']."'>
                <input type='hidden' name='message' value=''>
               <button name=''>Reply</button>
            </form>";
        }
      } else {
        echo "<p class='commentReplyMessage'>You need to be logged in to reply</p>";
      }
    echo"</div>";
    }
  }
}

function editComments($conn) {
  if (isset($_POST['commentSubmit'])) {
    $cid = $_POST['cid'];
    $uid = $_POST['uid'];
    $date = $_POST['date'];
    $message = $_POST['message'];

    $sql = "UPDATE comments SET message='$message' WHERE cid='$cid'";
    $result = mysqli_query($conn, $sql);
    header("Location: ./index.php");
  }
}

function replyComments($conn) {
  if (isset($_POST['replySubmit'])) {
    $cid = $_POST['cid'];
    $uid = $_POST['uid'];
    $date= $_POST['date'];
    $message = $_POST['message'];

    $sql = "INSERT INTO comments (uid,date,message) VALUES('$uid', '$date', '$message')";
    $result = mysqli_query($conn,$sql);
    header("Location: ./index.php");
  }
}

function deleteComments($conn) {
  if (isset($_POST['commentDelete'])) {
    $cid = $_POST['cid'];

    $sql = "DELETE FROM comments WHERE cid='$cid'";
    $result = mysqli_query($conn, $sql);
    header("Location: ./index.php");
  }
}

// User Authentication

function getLogin($conn) {
  if (isset($_POST['loginSubmit'])) {
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    $sql = "SELECT * FROM user WHERE uid='$uid' AND pwd='$pwd'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
      if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['id'] = $row['id'];
        header("Location: index.php?loginsuccess");
        exit();
      }
    } else {
      header("Location: index.php?loginfailed");
      exit();
    }
  }
}

function userLogout() {
  if (isset($_POST['logoutSubmit'])) {
    session_start();
    session_destroy();
    header("Location: index.php");
    exit();
  }
}


