#!/usr/local/bin/php -d display_errors=STDOUT
<?php

$database = "ajax.db";          


try  
{     
     $db = new SQLite3($database);
}
catch (Exception $exception)
{
    echo '<p>There was an error connecting to the database!</p>';

    if ($db)
    {
        echo $exception->getMessage();
    }
        
}


// define tablename and field names for a SQLite3 query to create a table in a database
$table = "votes";
$field1 = "yes";
$field2 = "no";


// Create the table
$sql= "CREATE TABLE IF NOT EXISTS $table (
$field1 int(100),
$field2 int(100)
)";
$result = $db->query($sql);

$v = $_GET['vote'];
if ($v == 'yes'){
	$sql = "INSERT INTO $table ($field1, $field2) VALUES (1,0)";
}
else if($v == 'no'){
	$sql = "INSERT INTO $table ($field1, $field2) VALUES (0,1)";
}
$result = $db->query($sql);

//$sql = "INSERT INTO $table ($field1, $field2) VALUES (0,0)";

$sql = "SELECT count(*) FROM $table WHERE $field1 == 1";
$result = $db->query($sql);
$record = $result->fetchArray();
$numy = $record['count(*)'];

$sql = "SELECT count(*) FROM $table WHERE $field2 == 1";
$result = $db->query($sql);
$record1 = $result->fetchArray();
$numn = $record1['count(*)'];

echo $numy, ", ", $numn;

?>