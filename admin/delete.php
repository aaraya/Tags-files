<? 
//connect to db
include "includes/functions.inc";
db_connect();

//format the date the way MySQL likes it
	$year = substr($_POST["event_date"], 6, 4);
	$month = substr($_POST["event_date"], 0, 2);
	$day = substr($_POST["event_date"], 3, 2);
	$event_date = ($year.'-'.$month.'-'.$day);
	
	$event_id = $_POST['event_id'];

	$delete_event = mysql_query ("DELETE FROM event WHERE event_id = $event_id") or die(mysql_error());

	$delete_types = mysql_query ("DELETE FROM event_event_type WHERE event_id = $event_id") or die(mysql_error());

	$delete_schedule = mysql_query ("DELETE FROM event_schedule WHERE event_id = $event_id") or die(mysql_error());
	
	
	//delete tags too. . .
	
	$select_tags_query = mysql_query("SELECT tag 
									  FROM tags
								      WHERE event_id = $event_id") or die (mysql_error());
	
	
	$tag_items = array();
	while ($select_tags_array = mysql_fetch_assoc($select_tags_query)){

				foreach ($select_tags_array as $item){}
					$tag_items[] = "'" . $item . "'";
				   }
	
	if($tag_items[0] !=""){
			
		$tag_list = implode(", ", $tag_items);
		
		$update_tags = mysql_query("UPDATE tags
									SET frequency = frequency - 3
									WHERE tag in ($tag_list)") or die (mysql_error());
								
		$delete_tag = mysql_query("DELETE FROM tags 
							   	   WHERE event_id = $event_id") or die(mysql_error());
	}
// all is well, send us back to the main events page
header("Location: event_main.php?date=$event_date");
?>
