<?php

$conn = mysqli_connect('localhost', 'root', 'Nguyenle&89', 'comment_section');


if (!$conn) {
  die("Connection Failed:".mysqli_connect_error());
}
