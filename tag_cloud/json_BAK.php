<?php

include "/web/docs/programs/includes/functions.inc";
db_connect();


if ($_GET['event_type_id']){

	$event_type_id = $_GET['event_type_id'];	
	
	$query=mysql_query("SELECT event_id
						FROM event						 
						WHERE event_type_id = $event_type_id");
	$event_id_array = array();
	
			 while($event_id_result = mysql_fetch_array($query)){
					foreach ($event_id_result as $key => $val){}
						$event_id_array[]=$val;
			 }
	

	$event_ids = implode(", ", $event_id_array);
		
	$query2 = mysql_query("SELECT DISTINCT tag AS tag, frequency  
						   FROM tags 					 
						   WHERE event_id in ($event_ids)");
						   
    //print_r($event_ids);
	
$json = '{ "tags": [';

for ($x = 0; $x < mysql_num_rows($query2); $x++) {
	$row = mysql_fetch_assoc($query2);
	$json .= json_encode($row);
	if ($x < mysql_num_rows($query2) -1)
		$json .= ', ';
	else
		$json .= ']}';
}
echo $json;
} 	


if($_REQUEST['date']){

	$date = $_GET['date'];	
	$query = mysql_query("SELECT DISTINCT tag AS tag, frequency 
						  FROM tags a, event_schedule c
						  WHERE a.event_id = c.event_id
					      AND c.event_date = '$date'");


   $json_exists = mysql_num_rows($query);
   
   if ($json_exists == 0){   
   		$json = " ";
   		echo $json;	
	}

  for ($x = 0; $x < mysql_num_rows($query); $x++) {
	  
	  $json = '{ "tags": [';	  
	  $row = mysql_fetch_assoc($query);
	  $json .= json_encode($row);

	  if ($x < mysql_num_rows($query) -1)
		  $json .= ', ';
	  else
		  $json .= ']}';
		}
  echo $json;

}


if($_GET['year'] && $_GET['month']){

	$year = $_GET['year'];
	$month = $_GET['month'];
	
	$query = mysql_query("SELECT DISTINCT tag AS tag, frequency 
						  FROM tags a, event_schedule c
						  WHERE a.event_id = c.event_id
					      AND MONTH(c.event_date) = '{$month}' AND YEAR(c.event_date) = '{$year}'");

$json = '{ "tags": [';
for ($x = 0; $x < mysql_num_rows($query); $x++) {
	$row = mysql_fetch_assoc($query);
	$json .= json_encode($row);

	if ($x < mysql_num_rows($query) -1)
		$json .= ', ';
	else
		$json .= ']}';

}

echo $json;

}


if (isset($_REQUEST['tag'])){

	$tag = $_REQUEST['tag'];
	
	$query = mysql_query("SELECT Distinct tag, frequency 
						  FROM tags
						  WHERE tag LIKE '%{$$tag}%' 
						  LIMIT 0, 30");

$json = '{ "tags": [';
for ($x = 0; $x < mysql_num_rows($query); $x++) {
	$row = mysql_fetch_assoc($query);
	$json .= json_encode($row);

	if ($x < mysql_num_rows($query) -1)
		$json .= ', ';
	else
		$json .= ']}';

}

echo $json;

}



if ($_POST['keywords'] && strlen(trim($_POST['keywords'])) > 0){

	$keywords = $_POST['keywords'];
	
	$query = mysql_query("SELECT Distinct tag, frequency 
						  FROM tags
						  WHERE tag LIKE '%{$keywords}%' ");

$json = '{ "tags": [';
for ($x = 0; $x < mysql_num_rows($query); $x++) {
	$row = mysql_fetch_assoc($query);
	$json .= json_encode($row);

	if ($x < mysql_num_rows($query) -1)
		$json .= ', ';
	else
		$json .= ']}';

}

echo $json;

}


/*


if($_REQUEST['date']){

	$date = $_GET['date'];	
	$query = mysql_query("SELECT DISTINCT tag AS tag, frequency 
						  FROM tags a, event_schedule c
						  WHERE a.event_id = c.event_id
					      AND c.event_date = '$date'");

$json = '{ "tags": [';
for ($x = 0; $x < mysql_num_rows($query); $x++) {
	$row = mysql_fetch_assoc($query);
	$json .= json_encode($row);

	if ($x < mysql_num_rows($query) -1)
		$json .= ', ';
	else
		$json .= ']}';

}

echo $json;

}


*/



?>



