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
		$ct = $_GET['time_stamp'];

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
		
		function get_events($name, $ts){
			global $db;
			$sql = "SELECT * FROM event_table WHERE name == '$name' AND timestamp >= $ts AND timestamp < ($ts+3600)";
			$result = $db->query($sql);
			//$record = $result->fetchArray()
			while ($record = $result->fetchArray()){
				$s = $s . $record['event_title'] . ": ". $record['event_message']. "<br/>";
			}
			return $s;
			
		}
		
		 
		$hours_to_show = 12;

		
		if ($ct == ""){
			$ct = time();
		}

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
		echo "<th class = ", "'table_header'>", "Binbin", "</th>";
		echo "</tr>";

		function get_hour_string($ct){
			$ampm = date('a', $ct);
			$ctime = ceil(date('g', $ct));
 			$shour = $ctime . ".00" . $ampm;
			return $shour;
		}
		
		
		
		for ($i = 0; $i <= $hours_to_show; $i++) {
			
			if ($i == 0 || $i%2 == 0){
				$rnd = floor($ct/3600)*3600;
				$edoreen = get_events("Doreen", $rnd);
				$ealex = get_events("Alex", $rnd);
				$ebinbin = get_events("Binbin", $rnd);
				echo "<tr class = ", "'even_row'", ">";
				echo "<td class =" , "'hr_td'>", get_hour_string($ct) , "</td>";
				echo "<td> &nbsp;",$edoreen, "</td>";
				echo "<td>",$ealex,"</td>";
				echo "<td>",$ebinbin,"</td>";
				echo "</tr>";
				$ct += 3600;

			}
			else{
				$rnd = floor($ct/3600)*3600;
				$edoreen = get_events("Doreen", $rnd);
				$ealex = get_events("Alex", $rnd);
				$ebinbin = get_events("Binbin", $rnd);
				echo "<tr class = ", "'odd_row'", ">";
				echo "<td class =" , "'hr_td'>", get_hour_string($ct) , "</td>";
				echo "<td> &nbsp;",$edoreen, "</td>";
				echo "<td>",$ealex,"</td>";
				echo "<td>",$ebinbin,"</td>";
				echo "</tr>";
				$ct += 3600;

			}
		}

		echo "</table>";
		
		echo "<div>";
		echo "<form id = 'prev' method = 'get' action = 'calendar2.php'>";
		echo "<p>";
		//$ct = ($ct-(3600*25));
		echo "<input type='hidden' name='time_stamp' value='", ($ct-(3600*25)) , "'/>";
		echo "<input type='submit' value='Previous twelve hours'/>";
		echo "</p>";
		echo "</form>";
		
		echo "<form id = 'next' method = 'get' action = 'calendar2.php'>";
		echo "<p>";
		//$ct = ($ct-3600);
		echo "<input type='hidden' name='time_stamp' value='", ($ct-3600) , "'/>";
		echo "<input type='submit' value='Next twelve hours'/>";
		echo "</p>";
		echo "</form>";
		
		echo "<form id = 'today' method = 'get' action = 'calendar2.php'>";
		echo "<p>";
		echo "<input type='submit' value='Today'/>";
		echo "</p>";
		echo "</form>";
		
		echo "</div>";
		echo "</div>";
		
		?>

</body>
</html>