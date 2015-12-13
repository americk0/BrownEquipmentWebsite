# BrownEquipmentWebsite
A website created for a client who needed someone to rebuild his website.

## Viewing website
This site was originally built to run on [XAMPP](https://www.apachefriends.org/index.html) but should be able to run on other servers. MySQL was used as the database and in order to get the website to connect to the database, connection must be configured in admin/connection.php.

## Example Connection Configuration
In order to connect to a database named 'test' on a server named 'test.com' with username 'me' and password 'letmein', admin/connection.php would need to be filled in as

```php
<?php //connects to the database
  $server = 'test.com';
  $username = 'me';
  $password = 'letmein';
  $db = 'test';

  $conn = new mysqli($server, $username, $password);
  $conn->select_db($db);
?>
```

## Creating the database
In order to get this website to work, a database will have to built from the sql code found in init/build-db.sql. This sql file can be imported directly into PHPMyAdmin if you are using XAMPP. This has not been tested with database management systems other than PHPMyAdmin on XAMPP.
