#!/usr/local/bin/php
<?php
print '<?xml version="1.0" encoding="utf-8" ?> ';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>My First PHP Embedded Page</title>
</head>
<body>
	<p>
		<?php
		date_default_timezone_set('America/Los_Angeles'); 
		$year = 1997;
		$ct = time();
		$cy = date('Y', $ct);
		
		echo "<table border = 1px>";

		for($year; $year <= $cy; $year++){
			$ts = mktime (0,0,0,11,25,$year);
			$line = date('n/j/Y', $ts);
			$day = date('l', $ts);
			echo "<tr>";
			echo "<td>", $line, "</td>";
			echo "<td>", $day, "</td>";
			echo "</tr>";
		}

		echo "</table>";
		
		?>
	</p>
</body>