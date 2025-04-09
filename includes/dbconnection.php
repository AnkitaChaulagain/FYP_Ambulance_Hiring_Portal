<?php
// Start of the PHP script

$con=mysqli_connect("localhost", "root", "", "eahpdb");
// This line attempts to establish a connection to the MySQL database
// "localhost" - the server the database is hosted on (usually same machine)
// "root" - the username for the database
// "" - the password for the database (empty in this case)
// "eahpdb" - the name of the database you're connecting to

if(mysqli_connect_errno()){
  // Checks if there was an error during the connection
echo "Connection Fail".mysqli_connect_error();
 // If there is an error, it prints "Connection Fail" followed by the error message
}

  ?>
<!-- end of the php script -->