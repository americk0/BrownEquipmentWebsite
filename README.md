# BrownEquipmentWebsite
A website created for a client who needed someone to rebuild his website.

## Viewing website
This site was originally built to run on [XAMPP](https://www.apachefriends.org/index.html) but should be able to run on other sites. MySQL was used as the database and in order to get the website to connect to the database, connection configuration can be found in admin/connection.php.

for example, in order to connect to a database named 'test' on a server named 'test.com' with username 'me' and password 'letmein', admin/connection.php would need to be filled in as

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

In order to get this website to work, a database will have to built first from the sql found in init/build-db.sql
