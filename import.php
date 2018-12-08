<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
// Name of the file
$filename = 'simrs_v3.sql';
// MySQL host
$mysql_host = 'localhost';
// MySQL username
$mysql_username = 'root';
// MySQL password
$mysql_password = '';
// Database name
$mysql_database = 'simrs_v3';

// Connect to MySQL server
mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
if (!mysql_select_db($mysql_database)) {
    echo("creating database!\n");
    mysql_query('CREATE DATABASE '.$mysql_database);
    mysql_select_db($mysql_database);
}
else{

    echo("Drop database!\n");
    mysql_query('DROP DATABASE '.$mysql_database);
    echo("Create database!\n");
    mysql_query('CREATE DATABASE '.$mysql_database);
    mysql_select_db($mysql_database);
}

echo("Import database!\n");
// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
 echo "Tables imported successfully";
?>