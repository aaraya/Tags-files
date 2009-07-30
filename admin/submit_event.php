<? 
//print_r($_POST); die;

//validation
if ($_POST["is_event_active"] == "on")
	{$is_event_active = 1;}
else
	{$is_event_active = 0;}
if ($_POST["is_members_only"] == "on")
	{$is_members_only = 1;}
else
	{$is_members_only = 0;}
if ($_POST["is_member_event"] == "on")
	{$is_member_event = 1;}
else
	{$is_member_event = 0;}
if ($_POST["show_buy_button"] == "on")
	{$show_buy_button = 1;}
else
	{$show_buy_button = 0;}
	
if ($_POST["show_buy_button2"] == "on")
	{$show_buy_button2 = 1;}
else
	{$show_buy_button2 = 0;}
	
if ($_POST["show_buy_button3"] == "on")
	{$show_buy_button3 = 1;}
else
	{$show_buy_button3 = 0;}

if ($_POST["show_event_date_flag"] == "on")
	{$show_event_date_flag = 1;}
else
	{$show_event_date_flag = 0;}

	
if(trim($_POST["event_title"]) == "") {
	$errortext = '<li>Title is required</li>';
	}
else{$event_title = addslashes($_POST["event_title"]);}

//accessibility options
if ($_POST["access_chair"] == "on")
	{$access_chair = 1;}
else
	{$access_chair = 0;}
if ($_POST["access_audio"] == "on")
	{$access_audio = 1;}
else
	{$access_audio = 0;}
if ($_POST["access_tty"] == "on")
	{$access_tty = 1;}
else
	{$access_tty = 0;}
if ($_POST["access_largeprint"] == "on")
	{$access_largeprint = 1;}
else
	{$access_largeprint = 0;}
if ($_POST["access_cc"] == "on")
	{$access_cc = 1;}
else
	{$access_cc = 0;}
if ($_POST["access_sign"] == "on")
	{$access_sign = 1;}
else
	{$access_sign = 0;}
if ($_POST["access_braille"] == "on")
	{$access_braille = 1;}
else
	{$access_braille = 0;}
if ($_POST["access_touch"] == "on")
	{$access_touch = 1;}
else
	{$access_touch = 0;}

$event_code = trim($_POST["event_code"]);
$event_code2 = trim($_POST["event_code2"]);
$event_code3 = trim($_POST["event_code3"]);
$ticket_code = trim($_POST["ticket_code"]);
$ticket_code2 = trim($_POST["ticket_code2"]);
$ticket_code3 = trim($_POST["ticket_code3"]);
$event_desc = str_replace("--", "&#151;", str_replace("\r\n", "<br />",addslashes($_POST["FCKeditor1"])));
$alt_highlight_link = addslashes($_POST["alt_highlight_link"]);
if(trim($_POST["event_short_desc"]) == "") {
	$errortext = $errortext.'<li>Short description is required</li>';
	}
else{$event_short_desc = str_replace("--", "&#151;", addslashes($_POST["event_short_desc"]));}
if(trim($_POST["event_location"]) == "") {
	$errortext = $errortext.'<li>Location is required</li>';
	}
else{$event_location = addslashes($_POST["event_location"]);}
if(trim($_POST["event_time_desc"]) == "") {
	$errortext = $errortext.'<li>Time is required</li>';
	}
else{$event_time_desc = addslashes($_POST["event_time_desc"]);}

if(trim($event_code2 != "") && trim($_POST["event_time_desc2"]) == "") {
	$errortext = $errortext.'<li>Second Session time is required</li>';
	}
else{$event_time_desc2 = addslashes($_POST["event_time_desc2"]);}


if(trim($event_code3 != "") && trim($_POST["event_time_desc3"]) == "") {
	$errortext = $errortext.'<li>Second Session time is required</li>';
	}
else{$event_time_desc3 = addslashes($_POST["event_time_desc3"]);}

if(trim($_POST["event_price_data"]) == "") {
	$errortext = $errortext.'<li>Price is required</li>';
	}

else{$event_price_data = addslashes($_POST["event_price_data"]);}

$event_note = str_replace("\"", "'",addslashes($_POST["event_note"]));
$event_img_caption = addslashes($_POST["event_img_caption"]);
$event_img_credit = addslashes($_POST["event_img_credit"]);
$event_tag = addslashes($_POST["event_tag"]);

//time handling
function check_time($str)
{
//returns 1 if valid time, 0 if not
if (ereg("([0-1][0-9]|[2][0-4])(:[0-5][0-9])", $str))
return 1;
else
return 0;
}

//check duration format (hhh:mm)
function check_duration($str)
{
//returns 1 if valid format, 0 if not
if (ereg("([1-9]?[0-9]{2})(:[0-5][0-9])", $str))
return 1;
else
return 0;
}

if(strlen(trim($_POST["event_start_time"])) != 0){

	if(check_time($_POST["event_start_time"]) == 0 && trim($_POST["event_start_time"]) != ""){
	$errortext = $errortext.'<li>Incorrect Start Time Format</li>';
	}
	elseif(trim($_POST["event_start_time"] != "" )){
	$event_start_time = substr($_POST["event_start_time"], 0, 2) . substr($_POST["event_start_time"], 3, 2) . '00';
	}
	else{$event_start_time = 'NULL';
	}

	if(check_duration($_POST["event_duration"]) == 0 && trim($_POST["event_duration"]) != ""){
	$errortext = $errortext.'<li>Incorrect Event Duration Format</li>';
	}
	elseif(trim($_POST["event_duration"] != "" )){
	$event_duration = substr($_POST["event_duration"], 0, 2) . substr($_POST["event_duration"], 3, 2) . '00';
	}
	else{$event_duration = 'NULL';
	}
}else{$event_start_time = 'NULL'; $event_duration = 'NULL';}

if(strlen(trim($_POST["event_start_time2"])) != 0){

	if(check_time($_POST["event_start_time2"]) == 0 && trim($_POST["event_start_time2"]) != ""){
	$errortext = $errortext.'<li>Incorrect Start Time (Second Session) Format</li>';
	}
	elseif(trim($_POST["event_start_time2"] != "" )){
	$event_start_time2 = substr($_POST["event_start_time2"], 0, 2) . substr($_POST["event_start_time2"], 3, 2) . '00';
	}
	else{$event_start_time2 = 'NULL';}

	if(check_time($_POST["event_duration2"]) == 0 && trim($_POST["event_duration2"]) != ""){
	$errortext = $errortext.'<li>Incorrect Event Duration (Second Session) Format</li>';
	}
	elseif(trim($_POST["event_duration2"] != "" )){
	$event_duration2 = substr($_POST["event_duration2"], 0, 2) . substr($_POST["event_duration2"], 3, 2) . '00';
	}
	else{$event_duration2 = 'NULL';
	}
}else{$event_start_time2 = 'NULL'; $event_duration2 = 'NULL';}


if(strlen(trim($_POST["event_start_time3"])) != 0){

	if(check_time($_POST["event_start_time3"]) == 0 && trim($_POST["event_start_time3"]) != ""){
	$errortext = $errortext.'<li>Incorrect Start Time (Second Session) Format</li>';
	}
	elseif(trim($_POST["event_start_time3"] != "" )){
	$event_start_time3 = substr($_POST["event_start_time3"], 0, 2) . substr($_POST["event_start_time3"], 3, 2) . '00';
	}
	else{$event_start_time3 = 'NULL';}

	if(check_time($_POST["event_duration3"]) == 0 && trim($_POST["event_duration3"]) != ""){
	$errortext = $errortext.'<li>Incorrect Event Duration (Second Session) Format</li>';
	}
	elseif(trim($_POST["event_duration3"] != "" )){
	$event_duration3 = substr($_POST["event_duration3"], 0, 2) . substr($_POST["event_duration3"], 3, 2) . '00';
	}
	else{$event_duration3 = 'NULL';
	}
}else{$event_start_time3 = 'NULL'; $event_duration3 = 'NULL';}


//end validation

/*$connection = mysql_connect ("localhost", "com_dbadmin", "0o9i8u7y" ) or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("com_calendar", $connection);*/

//connect to db
include_once "includes/functions.inc";
db_connect();
 	
//begin image upload
include "includes/img_upload2.inc";

$event_primary_type = $_POST['event_type'][0];
//get image/document paths for this event type from database
$q_event_path=mysql_query ("SELECT event_img_path, event_doc_path, img_max_size, img_thumb_size FROM event_type WHERE event_type_id = $event_primary_type");	
	while ($row = mysql_fetch_assoc($q_event_path))
		{
		$event_img_path = $row["event_img_path"];
		$event_doc_path = $row["event_doc_path"];
		$img_max_size = $row["img_max_size"];
		$img_thumb_size = $row["img_thumb_size"];
		}

//adding image for the first time or replacing current image
if(is_uploaded_file($_FILES['event_img']['tmp_name']))
	{
	//create a filename for the image
	if (isset($event_code) && $event_code != "") //use event code if possible
		{
		$img_filename = rand(100, 300).$event_code;
		}
	else //create a random filename
		{
		$img_filename = rand(10000, 30000).$event_type.$is_members_only;
		}
	$event_img_filename = uploadImage($_FILES['event_img']['tmp_name'], '/web/docs'.$event_img_path, '/web/docs'.$event_img_path.'thumbs/', $img_max_size, $img_max_size, $img_filename, TRUE, $img_thumb_size, $img_thumb_size);
	}
//the image is there but is not being changed
elseif(isset($_POST['event_img_filename']))
	{
		$event_img_filename = $_POST['event_img_filename'];
	}
//there is no image
else
	{
		$event_img_filename = '';
	}
//end image upload

//adding document for the first time or replacing current doc
if(is_uploaded_file($_FILES['event_doc']['tmp_name']))
{
	$target_path = '/web/docs'.$event_doc_path . basename($_FILES['event_doc']['name']); 

  if(move_uploaded_file($_FILES['event_doc']['tmp_name'], $target_path)) {
      echo "The file ".  basename($_FILES['event_doc']['name']). 
      " has been uploaded"; 
  		$event_doc_filename = basename($_FILES['event_doc']['name']);
	} else{
      echo "There was an error uploading the file, please try again!"; die;
  }
//the document is there but is not being changed
}elseif(isset($_POST['event_doc_filename'])){
		$event_doc_filename = $_POST['event_doc_filename'];
}else{//there is no document being uploaded
		$event_doc_filename = '';
}//end document upload

if(isset($errortext) && $errortext != "") //if there are errors
	{
		$event_start_time = $_POST['event_start_time'];
		$event_start_time2 = $_POST['event_start_time2'];
		$event_start_time3 = $_POST['event_start_time3'];
		$event_duration = $_POST['event_duration'];
		$event_duration2 = $_POST['event_duration2'];
		$event_duration3 = $_POST['event_duration3'];
		include "add_event.php";} //go back to add event page
else{ //otherwise, insert or update as necessary

	//format the date the way MySQL likes it
	$year = substr($_POST["event_date"], 6, 4);
	$month = substr($_POST["event_date"], 0, 2);
	$day = substr($_POST["event_date"], 3, 2);
	$event_date = ($year.'-'.$month.'-'.$day);
	
	//echo $_POST['ampm']; break;
	
	//convert start times to use 24-hour clock 123000
	if($event_start_time != 'NULL')
	{
			if ($_POST['ampm'] == "pm" && substr($event_start_time, 0, 2) < 12)
			{
			$event_start_time = substr($event_start_time, 0, 2) + 12 .  substr($event_start_time, 2, 2) . substr($event_start_time, 4, 2) ;
			}
			else
			{
			$event_start_time = substr($event_start_time, 0, 2) .  substr($event_start_time, 2, 2). substr($event_start_time, 4, 2);
			}
			//create event_end_time
			$event_end_timestamp = mktime(substr($event_start_time, 0, 2) + substr($event_duration, 0, 2), substr($event_start_time, 2, 2) + substr($event_duration, 2, 2), 0);

			$event_end_time = date("His", $event_end_timestamp);
	}else{$event_start_time = 'NULL'; $event_duration = 'NULL'; $event_end_time = 'NULL';}
		
	if($event_start_time2 != 'NULL')
	{
		if ($_POST['ampm2'] == "pm" && substr($event_start_time2, 0, 2) < 12)
			{
			$event_start_time2 = substr($event_start_time2, 0, 2) + 12 .  substr($event_start_time2, 2, 2) . substr($event_start_time2, 4, 2) ;
			}
			else
			{
			$event_start_time2 = substr($event_start_time2, 0, 2) .  substr($event_start_time2, 2, 2). substr($event_start_time2, 4, 2);
			}
			//create event_end_time2
			$event_end_timestamp2 = mktime(substr($event_start_time2, 0, 2) + substr($event_duration2, 0, 2),substr($event_start_time2, 2, 2) + substr($event_duration2, 2, 2), 0);

			$event_end_time2 = date("His", $event_end_timestamp2);
	}else{$event_start_time2 = 'NULL'; $event_duration2 = 'NULL'; $event_end_time2 = 'NULL';}
	
	
	if($event_start_time3 != 'NULL')
	{
		if ($_POST['ampm3'] == "pm" && substr($event_start_time3, 0, 2) < 12)
			{
			$event_start_time3 = substr($event_start_time3, 0, 2) + 12 .  substr($event_start_time3, 2, 2) . substr($event_start_time3, 4, 2) ;
			}
			else
			{
			$event_start_time3 = substr($event_start_time3, 0, 2) .  substr($event_start_time3, 2, 2). substr($event_start_time3, 4, 2 );
			}
			//create event_end_time2
			$event_end_timestamp3 = mktime(substr($event_start_time3, 0, 2) + substr($event_duration3, 0, 2),substr($event_start_time3, 2, 2) + substr($event_duration3, 2, 2), 0);

			$event_end_time3 = date("His", $event_end_timestamp3);
	}else{$event_start_time3 = 'NULL'; $event_duration3 = 'NULL'; $event_end_time3 = 'NULL';}
	
	
	/*echo('event_start_minutes = ' . substr($event_start_time, 2, 2));
	echo('event_duration_minutes is ' . substr($event_duration, 2, 2));
	echo('event_start_time is ' . $event_start_time);
	echo('event_start_time2 is ' . $event_start_time2);
	echo('event_end_time is ' . $event_end_time);
	echo('event_end_time2 is ' . $event_end_time2);
	echo('event_duration is ' . $event_duration);
	echo('event_duration2 is ' . $event_duration2);
	break;*/
	
	//update existing event
	if(isset($_POST["event_id"]) && trim($_POST["event_id"]) != "") 
	{
	$event_id = $_POST["event_id"];
	
	//update event details
	$update_result = mysql_query("
		UPDATE event 
		SET event_title = '$event_title', event_type_id = '$event_primary_type', event_code = '$event_code', event_code2 = '$event_code2', event_code3 = 	  
		'$event_code3',ticket_code = '$ticket_code', ticket_code2 = '$ticket_code2', ticket_code3 = '$ticket_code3', event_desc = '$event_desc', alt_highlight_link = '$alt_highlight_link', event_short_desc = '$event_short_desc', event_tag = '$event_tag',  event_location = '$event_location', event_time_desc = '$event_time_desc', event_time_desc2 = '$event_time_desc2', event_time_desc3 = '$event_time_desc3',event_price_data = '$event_price_data', event_note = '$event_note', event_doc_filename = '$event_doc_filename', event_img_filename = '$event_img_filename', event_img_caption = '$event_img_caption', event_img_credit = '$event_img_credit', is_event_active = '$is_event_active', is_members_only = '$is_members_only', is_member_event = '$is_member_event', show_buy_button = '$show_buy_button', show_buy_button2 = '$show_buy_button2', show_buy_button3 = '$show_buy_button3', access_chair = '$access_chair', access_audio = '$access_audio', access_tty  = '$access_tty', access_largeprint = '$access_largeprint', access_cc  = '$access_cc', access_sign = '$access_sign', access_braille  = '$access_braille', access_touch  = '$access_touch'
		WHERE event_id = '$event_id'");
		
//code for updating and deleting event tags follows. This code is meant to be just enough to work and could use 
//refactoring. C.N. 

//get incoming tags. parse, and fill into an array. 
$raw_tags = $_POST['taggies'];
$raw_tag_count = count($raw_tags);
$input_tag_array = split(',', $raw_tags);
$count_new = count($input_tag_array);

//find out how many tags currently 
//correspond to the event being updated. 
$orig_tag_query=mysql_query("SELECT tag FROM tags WHERE event_id=$event_id");
$orig_tag_array = array();
while($orig_tags_result = mysql_fetch_array($orig_tag_query)){
	foreach ($orig_tags_result as $key => $val){}
	$orig_tag_array[]=$val;
}

$count_old = count($orig_tag_array);
if($count_old != $count_new){
	if ($count_new > $count_old){	
		if ($count_new > $count_old && $orig_tag_array[0] == " "){
			foreach ($input_tag_array as $key => $value){
				$sql_add = "INSERT INTO tags (tag, frequency, event_id)
					        VALUES ('$value', 5, $event_id )";
			
				echo $sql_add; echo "count_new > count_old && orig_tag_array[0]";
			$query = mysql_query($sql_add);
		}
	}
	
	//New tags are greater than old tags and the 
	//input array is NOT equal to the orginal array
	
	if($count_new > $count_old && $input_tag_array != $orig_tag_array && $orig_tag_array[0] !=""){
		$tag_diff_new  = array_diff($input_tag_array, $orig_tag_array);
		$tag_diff_orig = array_diff($orig_tag_array, $input_tag_array);

		foreach ($tag_diff_new as $key => $value){

			$sql = "INSERT INTO tags (event_id, tag, frequency)
				    VALUES ('$event_id', '$value', 5)";
		
			echo $sql; echo "count_new > count_old && input_tag_array != orig_tag_array";
			
			
		$query = mysql_query($sql);
	}
	foreach ($tag_diff_orig as $key => $value) {  		
		$sql_del = "DELETE FROM tags
				    WHERE tag = '$value'
					AND event_id = $event_id";	
		$query3 = mysql_query($sql_del);

	}
}

}

if($count_new < $count_old){
	//The input tags are empty. We find this by 
	//inspecting at the first key/value pair in the array.
	if ($input_tag_array[0] == " "){
		foreach($orig_tag_array as $key => $value){
			$sql = "DELETE FROM tags		
				    WHERE event_id = $event_id";	    	    	
			$query = mysql_query($sql);

			$sql_freq = "UPDATE tags
						 SET frequency = frequency - 3
						 WHERE tag = '$value'";		 
			$query2 = mysql_query($sql_freq);

		}
	}
	if ($input_tag_array[0] != " ") {
		//We have a smaller amount of tags than originally: 
		//delete the old and insert the new
		$tag_diff_new  = array_diff($input_tag_array, $orig_tag_array);
		$tag_diff_orig = array_diff($orig_tag_array, $input_tag_array);

		foreach ($tag_diff_new as $key => $value){

			$sql = "INSERT INTO tags (event_id, tag, frequency)
					VALUES ('$event_id', '$value', 5)";
		
			echo $sql; echo "input_tag_array[0]";
			$query = mysql_query($sql);

	}
	foreach ($tag_diff_orig as $key => $value) {  		
		$sql_del = "DELETE FROM tags
					WHERE tag = '$value'
					AND event_id = $event_id";	
		$query3 = mysql_query($sql_del);

	}
}
}	
}

//tags are are the same count.
//Tags are equal in size, but we want to get rid of divergent tags
if ($count_new == $count_old && $input_tag_array != $orig_tag_array ){

	$tag_diff_new  = array_diff($input_tag_array, $orig_tag_array);
	$tag_diff_orig = array_diff($orig_tag_array, $input_tag_array);


	
	foreach ($tag_diff_orig as $key => $value) {  			

		$sql_del = "DELETE FROM tags
					WHERE tag = '$value'
					AND event_id = $event_id";
	
		$query3 = mysql_query($sql_del);
	}

	foreach ($tag_diff_new as $key => $value){
		$sql_insert = "INSERT tags (event_id, tag, frequency)
					   VALUES ($event_id, '$value', 5)";

	
	$query4 = mysql_query($sql_insert);
	
	
  }
}



//End Tagging code. 
	
	//if update failed
		if (!$update_result) {
  	 		$message  = 'Invalid Update query: ' . mysql_error() . "\n";
   			$message .= 'Whole query: ' . $update_result;
   	die($message);
	}
	
	//update event types
	$clear_event_types = mysql_query("DELETE FROM event_event_type WHERE event_id = '$event_id'");
	
	for($i = 0; $i <= (count($_POST['event_type']) - 1); $i++)
	{
		if(strlen($_POST['event_type'][$i]) > 0)
		{
			$event_type = $_POST['event_type'][$i];
			$event_subtype = $_POST['event_subtype'][$i];
			$event_sub_subtype = $_POST['event_sub_subtype'][$i];
			
		 	mysql_query ("INSERT INTO event_event_type (event_id, event_type_id, event_subtype_id, event_sub_subtype_id) VALUES ('$event_id', '$event_type', '$event_subtype', '$event_sub_subtype')") or die(mysql_error());
		}//end if
		
		//$update_event_type = mysql_query ("UPDATE event_event_type SET event_type_id = '$event_type', event_subtype_id = '$event_subtype', event_sub_subtype_id = '$event_sub_subtype' WHERE event_id = '$event_id'");
	
	}//end for loop
	
 	$sql = "UPDATE event_schedule 
	  		SET event_date = '$event_date', 
				event_start_time = $event_start_time, 
				event_duration = $event_duration, 
				event_end_time = $event_end_time, 
				event_start_time2 = $event_start_time2, 
				event_duration2 = $event_duration2, 
				event_end_time2 = $event_end_time2,
				event_start_time3 = $event_start_time3, 
				event_duration3 = $event_duration3, 
				event_end_time3 = $event_end_time3,
				show_event_date_flag = $show_event_date_flag
	WHERE event_id = $event_id";

	//update event date, time, and highlight flags
	$update_date_result = mysql_query ($sql);

		//if date update failed
		if (!$update_date_result) {
  	 $message  = 'Invalid Date Update query: ' . mysql_error() . "\n";
   		$message .= 'Whole query: ' . $sql;
   	die($message);
		}
	}
	elseif(!$_POST['event_id']) //insert a new event
	{
	$insert_result = mysql_query ("INSERT INTO event 
	(event_title, event_type_id, event_code, ticket_code, event_code2, ticket_code2, event_code3, ticket_code3, event_desc, alt_highlight_link, event_short_desc, event_tag, event_location,	event_time_desc, event_time_desc2, event_time_desc3, event_price_data, event_note,  event_doc_filename, event_img_filename, event_img_caption, event_img_credit, is_event_active, is_members_only, is_member_event, show_buy_button, show_buy_button2, show_buy_button3, access_chair, access_audio, access_tty, access_largeprint, access_cc, access_sign, access_braille, access_touch) 
	VALUES 
	('$event_title', '$event_primary_type', '$event_code', '$ticket_code', '$event_code2', '$ticket_code2', '$event_code3', '$ticket_code3', '$event_desc', '$alt_highlight_link', '$event_short_desc', '$event_tag', '$event_location', '$event_time_desc', '$event_time_desc3', '$event_time_desc3', '$event_price_data', '$event_note', '$event_doc_filename', '$event_img_filename', '$event_img_caption', '$event_img_credit', '$is_event_active', '$is_members_only', '$is_member_event', '$show_buy_button', '$show_buy_button2', '$show_buy_button3','$access_chair', '$access_audio', '$access_tty', '$access_largeprint', '$access_cc', '$access_sign', '$access_braille', '$access_touch')");



  //if something went wrong
		if (!$insert_result) {
  	 $message  = 'Invalid Insert query: ' . mysql_error() . "\n";
   		$message .= 'Whole query: ' . $insert_result;
   	die($message);
		}

	//get the event_id of the newly inserted record
	$event_id = mysql_insert_id(); 

	//add the event types to the event_event_type table 
	
	for($i = 0; $i <= (count($_POST['event_type']) - 1); $i++)
	{
		if(strlen($_POST['event_type'][$i]) > 0)
		{
			$event_type = $_POST['event_type'][$i];
			$event_subtype = $_POST['event_subtype'][$i];
			$event_sub_subtype = $_POST['event_sub_subtype'][$i];
			
		 	mysql_query ("INSERT INTO event_event_type (event_id, event_type_id, event_subtype_id, event_sub_subtype_id) VALUES ('$event_id', '$event_type', '$event_subtype', '$event_sub_subtype')") or die(mysql_error());
		}//end if
		
		//$update_event_type = mysql_query ("UPDATE event_event_type SET event_type_id = '$event_type', event_subtype_id = '$event_subtype', event_sub_subtype_id = '$event_sub_subtype' WHERE event_id = '$event_id'");
	
	}//end for loop
	
	//$insert_event_type_result = mysql_query ("INSERT INTO event_event_type (event_id, event_type_id, event_subtype_id, event_sub_subtype_id) VALUES ('$event_id', '$event_type', '$event_subtype', '$event_sub_subtype')") or die(mysql_error());
	 
	//add the event date to the event_schedule table
	$sched_result = mysql_query ("INSERT INTO event_schedule (event_id, event_date, event_start_time, event_duration, event_end_time, event_start_time2, event_duration2, event_end_time2, event_start_time3, event_duration3, event_end_time3, show_event_date_flag) VALUES ('$event_id', '$event_date', '$event_start_time', '$event_duration', '$event_end_time', '$event_start_time2', '$event_duration2', '$event_end_time2', '$event_start_time3', '$event_duration3', '$event_end_time3','$show_event_date_flag')") or die(mysql_error());
	

//add tags if they are entered in our form.

if ($_POST['taggies']){

	$raw_tags = $_REQUEST['taggies'];

	$tag_array = split(',', $raw_tags);
	foreach($tag_array as $arr){

		$arr = trim($arr);
		$sql = "SELECT tag
				FROM tags
				WHERE tag='$arr'";

		$query2 = mysql_query($sql); 	   	
		$rows_from_query = mysql_num_rows($query2); 

		if ($rows_from_query == 0){

			$sql_add = "INSERT INTO tags (tag, frequency, event_id)
						VALUES ('$arr', 5, $event_id )";

		$query = mysql_query($sql_add);			

	}

	if ($rows_from_query > 0){
		
		
		$sql_find = "SELECT frequency FROM tags WHERE tag='$arr'";
		$query3 = mysql_query($sql_find);
		$array = mysql_fetch_assoc($query3);	

		$freq = $array['frequency'];
		
		$arr = trim($arr);
		
		$sql_add = "INSERT INTO tags (tag, frequency, event_id)
					VALUES ('$arr', ($freq + 3), $event_id )";
	
		$query = mysql_query($sql_add);


		$sql_ticker = "UPDATE tags
				   	   SET frequency= ($freq + 3) 
				   	   WHERE tag = '$arr'";

		$query = mysql_query($sql_ticker);				   

}
}
}
 //we know this is an update if the event_id is in our $_GET.


 	//if something went wrong	
	if (!$sched_result) {
  	 $message  = 'Invalid Insert Schedule query: ' . mysql_error() . "\n";
   		$message .= 'Whole query: ' . $sched_result;
   	die($message);}
	
	}//end else statement

// all is well, send us back to the main events page
//header("Location: event_main.php?date=$event_date");

}//end update/insert routine

?>