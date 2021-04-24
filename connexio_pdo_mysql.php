<?php 

    /* PDO database connection */
   
    $host = "localhost";   /* Server name */
    $dbname = "agenda_php_mysql";   /* Database name */
    $dbuser = "root"; /* Database user name */
    $userpass = ""; /* Database password */
    
    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

    $conn = new PDO($dsn, $dbuser, $userpass);
    
    if(!$conn){
    echo "Error. No connectat a la base de dades $dbname!";
    }
    