#!/usr/local/bin/php -d display_errors=STDOUT
<?php
print '<?xml version="1.0" encoding="utf-8" ?> ';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Calender</title>
<link rel="stylesheet" type="text/css" href="calendar.css" />
</head>
<body>
		<?php
		
		date_default_timezone_set('America/Los_Angeles'); 
		$hours_to_show = 12;
		$ct = time();
		$day = date('D', $ct);
		$month_day = date('F j', $ct);
		$cy = date('Y', $ct);
		$time = date('g:i a', $ct);
		echo "<div class = " , '"container"', ">";
		echo "<h1> Doreen Family Schedule for ", $day, ", ", $month_day, ", ",$cy, ", ", $time. "</h1>";

		echo "<table id = ", '"event_table"', ">";
		
		echo "<tr>";
		echo "<th class = ", "'hr_td'>", "&nbsp;", "</th>";
		echo "<th class = ", "'table_header'>", "Doreen", "</th>";
		echo "<th class = ", "'table_header'>", "Alex", "</th>";
		echo "<th class = ", "'table_header'>", "binibin", "</th>";
		echo "</tr>";

		function get_hour_string($ct){
			$ampm = date('a', $ct);
			$ctime = ceil(date('g', $ct));
 			$shour = $ctime . ".00" . $ampm;
			return $shour;
		}
		
		for ($i = 0; $i <= $hours_to_show; $i++) {
			if ($i == 0 || $i%2 == 0){
				echo "<tr class = ", "'even_row'", ">";
				echo "<td class =" , "'hr_td'>", get_hour_string($ct) , "</td>";
				echo "<td>", "</td>";
				echo "<td>", "</td>";
				echo "<td>", "</td>";
				echo "</tr>";
				$ct += 3600;

			}
			else{
				echo "<tr class = ", "'odd_row'", ">";
				echo "<td class =" , "'hr_td'>", get_hour_string($ct) , "</td>";
				echo "<td>", "</td>";
				echo "<td>", "</td>";
				echo "<td>", "</td>";
				echo "</tr>";
				$ct += 3600;

			}
		}

		echo "</table>";
		echo "</div>";
		
		?>

</body>
</html>