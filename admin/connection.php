<?php //connects to the database
  $server = 'localhost';
  $username = 'root';
  $password = '';
  $db = 'brownequipment';

  $conn = new mysqli($server, $username, $password);
  $conn->select_db($db);
?>
