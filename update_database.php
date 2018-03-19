#!/usr/local/bin/php -d display_errors=STDOUT
<?php
print '<?xml version="1.0" encoding="utf-8" ?> ';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
<title>Update Calendar</title> 
</head>
<body>
<p>
<?php 

date_default_timezone_set('America/Los_Angeles');
$database = "dbdoreenchang.db";          


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
$table = "event_table";
$field1 = "timestamp";
$field2 = "name";
$field3 = "event_title";
$field4 = "event_message";

// Create the table
$sql= "CREATE TABLE IF NOT EXISTS $table (
$field1 int(12),
$field2 varchar(100),
$field3 varchar(300),
$field4 varchar(300)
)";
$result = $db->query($sql);

$date = $_POST['date'];
$time = $_POST['time'];
$name = $_POST['person'];
$title  = $_POST['event_title'];
$message = $_POST['event_message'];

$d = explode("-", $date);
$t = explode(":", $time);
$ts = mktime(intval($t[0]), $t[1], 0, intval($d[0]), $d[1], $d[2]);

$sql = "INSERT INTO $table ($field1, $field2, $field3, $field4) VALUES ($ts, '$name', '$title', '$message')";
$result = $db->query($sql);

$sql = "SELECT * FROM $table";
$result = $db->query($sql);


print "<table border='border'>\n";
print "  <tr>\n";
print "     <th> Timestamp </th>\n";
print "     <th> Name </th>\n";
print "     <th> Event Title </th>\n";
print "     <th> Event Message </th>\n";
print "  </tr>\n";

// obtain the results from the SELECT query as an array holding a record
// one iteration per record for this select query
while($record = $result->fetchArray())
{  
  print "  <tr>\n";

  // Fill in details here
  
  // Look at the slides to see how to extract the info from $record
  // Each iteration of the loop should write a table row
  
  print "<td>" . $record[$field1] . "</td>\n";
  print "<td>" . $record[$field2] . "</td>\n";
  print "<td>" . $record[$field3] . "</td>\n";
  print "<td>" . $record[$field4] . "</td>\n";
  print "  </tr>\n";
}
print "</table>\n";

echo "<a href= 'calendar2.php'> Click here to see Calendar </a>";

?>
</p>
</body>
</html>