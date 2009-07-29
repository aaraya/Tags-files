<?session_start();

if(!$_SESSION['username']){header ("Location: login.php");}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Create/Update Event</title>



<?php 
//get event types for select box
/*$connection=mysql_connect ("localhost", "com_dbpublic", "0o9i8u7y") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("com_calendar", $connection);*/

//connect to db
include_once "includes/functions.inc";
db_connect();

if(strlen($_SESSION['event_types_allowed']) > 0){
	$q_event_type=mysql_query ("SELECT * FROM event_type WHERE event_type_id IN (".$_SESSION['event_types_allowed'].")");
	$event_img_class = "mr_upload";
}else{
  $q_event_type=mysql_query ("SELECT * FROM event_type WHERE is_active = 1");
  $q_event_subtype=mysql_query ("SELECT * FROM event_subtype WHERE is_active = 1");
  $q_event_sub_subtype=mysql_query ("SELECT * FROM event_sub_subtype WHERE is_active = 1");
 	$event_img_class = "upload";
}
//if event_id supplied, get that event
if(isset($_GET["event_id"]))
{
	$event_id = $_GET["event_id"];
	/*$connection=mysql_connect ("localhost", "com_dbpublic", "0o9i8u7y") or die ('I cannot connect to the database because: ' . mysql_error());
	mysql_select_db ("com_calendar_test", $connection);*/
	
	$q_get_event_types=mysql_query ("
		SELECT 	event_event_type.event_type_id, 
				event_event_type.event_subtype_id, 
				event_event_type.event_sub_subtype_id
		FROM event, event_event_type
		WHERE event.event_id = {$event_id}
		AND event.event_id = event_event_type.event_id");
		
	
	/*$numrows = mysql_num_rows($q_get_event_types);
	
	for($i = 0; $i <= $numrows; $i++){
	
	
	
	}
	
	$i = 0; while ($row = mysql_fetch_assoc($q_event_types))
		{	
			$i++;
			$event_type_id = $row["event_type_id"].$i;
			$event_subtype_id = $row["event_subtype_id"].$i;
			$event_sub_subtype_id = $row["event_sub_subtype_id"].$i;
		}*/
	
	
	$q_event=mysql_query ("
		SELECT 	event.event_title, 
						event.event_code, 
						event.event_code2,
						event.event_code3, 
						event.ticket_code, 
						event.ticket_code2,
						event.ticket_code3, 
						event.event_location, 
						event.event_time_desc, 
						event.event_time_desc2, 
						event.event_time_desc3,
						event.event_price_data, 
						event.event_desc, 
						event.alt_highlight_link,
						event.event_short_desc,
						event.event_tag,
						event.is_event_active,
						event.is_members_only,
						event.is_member_event,
						event.event_note, 
						event.show_buy_button,
						event.show_buy_button2,
						event.show_buy_button3,
						event.event_doc_filename,
						event.event_img_filename, 
						event.event_img_caption, 
						event.event_img_credit, 
						event.access_chair,
						event.access_audio,
						event.access_tty,
						event.access_largeprint,
						event.access_cc,
						event.access_sign,
						event.access_braille,
						event.access_touch,
						event_schedule.event_date,
						event_schedule.event_start_time,
						event_schedule.event_duration,
						event_schedule.event_start_time2,
						event_schedule.event_start_time3,
						event_schedule.event_duration2,
						event_schedule.event_duration3, 
						event_schedule.show_event_date_flag,
						event_type.event_img_path,
						event_type.event_doc_path
		FROM event, event_schedule, event_type, event_event_type
		WHERE event.event_id = {$event_id}
		AND event.event_id = event_schedule.event_id
		AND event.event_type_id = event_type.event_type_id");


/*
removed 2 items  and content came back.
, tags
AND event.event_id =  tags.event_id

Need to look at update / del function.
for tags, enters a empty val.


*/
	while ($row = mysql_fetch_assoc($q_event))
	{
	$event_title = $row["event_title"];
	$event_code = $row["event_code"];
	$event_code2 = $row["event_code2"];
	$event_code3 = $row["event_code3"];
	$ticket_code = $row["ticket_code"];
	$ticket_code2 = $row["ticket_code2"];
	$ticket_code3 = $row["ticket_code3"];
	$event_location = $row["event_location"];
	$event_time_desc = $row["event_time_desc"];
	$event_time_desc2 = $row["event_time_desc2"];
	$event_time_desc3 = $row["event_time_desc3"];
	$event_price_data = $row["event_price_data"];
	$event_desc = str_replace("&#151;", "--", str_replace("<br />", "\r\n", $row["event_desc"]));
	$alt_highlight_link = $row['alt_highlight_link'];
	$event_short_desc = str_replace("&#151;", "--", $row["event_short_desc"]);
	$event_tag = $row["event_tag"];
	$event_note = stripslashes($row["event_note"]);
	$event_doc_path = $row["event_doc_path"];
	$event_img_path = $row["event_img_path"];
	$event_doc_filename = $row["event_doc_filename"];
	$event_img_filename = $row["event_img_filename"];
	$event_img_caption = $row["event_img_caption"];
	$event_img_credit = $row["event_img_credit"];
	$event_type = $row["event_type_id"];
	$event_subtype = $row["event_subtype_id"];
	$event_sub_subtype = $row["event_sub_subtype_id"];
	$is_event_active = $row["is_event_active"];
	$is_members_only = $row["is_members_only"];
	$is_member_event = $row["is_member_event"];
	$show_buy_button = $row["show_buy_button"];
	$show_buy_button2 = $row["show_buy_button2"];
	$show_buy_button3 = $row["show_buy_button3"];
	$show_event_date_flag = $row["show_event_date_flag"];
	$access_chair = $row["access_chair"];
	$access_audio = $row["access_audio"];
	$access_tty = $row["access_tty"];
	$access_largeprint = $row["access_largeprint"];
	$access_cc = $row["access_cc"];
	$access_sign = $row["access_sign"];
	$access_braille = $row["access_braille"];
	$access_touch = $row["access_touch"];
	
	$year = substr($row["event_date"], 0, 4);
	$month = substr($row["event_date"], 5, 2);
	$day = substr($row["event_date"], 8, 2);
	$event_date = ($month.'/'.$day.'/'.$year);
	$tags = $row['tag'];

	
	if(strlen(trim($row["event_start_time"])) != 0){
		$event_start_time = substr($row["event_start_time"], 0, 5); 
		$event_duration = substr($row["event_duration"], 0, 5);
		
		//convert start times to use 12-hour clock
		if (substr($event_start_time, 0, 2) > 12)
			{
				$event_start_time = (substr($event_start_time, 0, 2) - 12) . ":" . substr($event_start_time, 3, 2);
				$ampm = "pm";
				if(strlen($event_start_time) == 4)
				{
					$event_start_time = "0".$event_start_time;
				}
			}
		elseif (substr($event_start_time, 0, 2) == 12)
			{
				$ampm = "pm";
			}
		elseif (substr($event_start_time, 0, 2) == 00)
			{
				$temp_start_time = 12 . substr($event_start_time, 3, 2);
				$event_start_time = $temp_start_time;
				$ampm = "am"; 
			}
		else
			{
				$ampm = "am"; 
			}
		
		}
		
	if(strlen(trim($row["event_start_time2"])) != 0)
	{
		$event_start_time2 = substr($row["event_start_time2"], 0, 5); 
		$event_duration2 = substr($row["event_duration2"], 0, 5);
	
		//convert start times to use 12-hour clock
		if (substr($event_start_time2, 0, 2) > 12)
		{
			$event_start_time2 = (substr($event_start_time2, 0, 2) - 12) . ":" . substr($event_start_time2, 3, 2);
			$ampm2 = "pm";
			if(strlen($event_start_time2) == 4)
			{
				$event_start_time2 = "0".$event_start_time2;
			}
		}
		elseif (substr($event_start_time2, 0, 2) == 12)
		{
			$ampm2 = "pm";
		}
		elseif (substr($event_start_time2, 0, 2) == 00)
		{
			$temp_start_time2 = 12 . substr($event_start_time2, 2, 6);
			$event_start_time2 = $temp_start_time2;
			$ampm2 = "am";
		}
		else
		{
			$ampm2 = "am";
		}
	
	}
	
		if(strlen(trim($row["event_start_time3"])) != 0)
		{
			$event_start_time3 = substr($row["event_start_time3"], 0, 5); 
			$event_duration3 = substr($row["event_duration3"], 0, 5);
	
		//convert start times to use 12-hour clock
			if (substr($event_start_time3, 0, 2) > 12)
			{
				$event_start_time3 = (substr($event_start_time3, 0, 2) - 12) . ":" . substr($event_start_time3, 3, 2);
				$ampm3 = "pm";
				if(strlen($event_start_time3) == 4)
				{
					$event_start_time3 = "0".$event_start_time3;
				}
			}
		elseif (substr($event_start_time3, 0, 2) == 12)
		{
			$ampm3 = "pm";
		}
		elseif (substr($event_start_time3, 0, 2) == 00)
		{
			$temp_start_time3 = 12 . substr($event_start_time3, 2, 6);
			$event_start_time3 = $temp_start_time3;
			$ampm3 = "am";
		}
		else
		{
			$ampm3 = "am";
		}
	
		}
	
	}	
}	
else
{
	$event_id = '';
}	
//initialize form variables
if(isset($event_title)){;}else{$event_title = "";}
if(isset($event_code)){;}else{$event_code = "";}
if(isset($event_code2)){;}else{$event_code2 = "";}
if(isset($event_code3)){;}else{$event_code3 = "";}
if(isset($ticket_code)){;}else{$ticket_code = "";}
if(isset($ticket_code2)){;}else{$ticket_code2 = "";}
if(isset($ticket_code3)){;}else{$ticket_code3 = "";}
if(isset($event_location)){;}else{$event_location = "";}
if(isset($event_time_desc)){;}else{$event_time_desc = "";}
if(isset($event_time_desc2)){;}else{$event_time_desc2 = "";}
if(isset($event_time_desc3)){;}else{$event_time_desc3 = "";}
if(isset($event_price_data)){;}else{$event_price_data = "";}
if(isset($event_desc)){;}else{$event_desc = "";}
if(isset($event_short_desc)){;}else{$event_short_desc = "";}
if(isset($event_tag)){;}else{$event_tag = "";}
if(isset($event_note)){;}else{$event_note = "";}
if(isset($event_img_path)){;}else{$event_img_path = "";}
if(isset($event_doc_path)){;}else{$event_doc_path = "";}
if(isset($event_doc_filename)){;}else{$event_doc_filename = "";}
if(isset($event_img_filename)){;}else{$event_img_filename = "";}
if(isset($event_img_caption)){;}else{$event_img_caption = "";}
if(isset($event_img_credit)){;}else{$event_img_credit = "";}
if(isset($event_start_time)){;}else{$event_start_time = "";}
if(isset($event_duration)){;}else{$event_duration = "";}
if(isset($event_start_time2)){;}else{$event_start_time2 = "";}
if(isset($event_start_time3)){;}else{$event_start_time3 = "";}
if(isset($event_duration2)){;}else{$event_duration2 = "";}
if(isset($event_duration3)){;}else{$event_duration3 = "";}
if(isset($access_chair)){;}else{$access_chair = "0";}
if(isset($access_audio)){;}else{$access_audio = "0";}
if(isset($access_tty)){;}else{$access_tty = "0";}
if(isset($access_largeprint)){;}else{$access_largeprint = "0";}
if(isset($access_cc)){;}else{$access_cc = "0";}
if(isset($access_sign)){;}else{$access_sign = "0";}
if(isset($access_braille)){;}else{$access_braille = "0";}
if(isset($access_touch)){;}else{$access_touch = "0";}

if(isset($_GET["event_date"])){$event_date = $_GET["event_date"];}
elseif(!isset($_GET["event_date"])&&isset($_POST["event_date"])){$event_date = $_POST["event_date"];}
elseif(isset($event_date)){;}else{$event_date = "";}
?>
	
<script type="text/javascript" src="includes/calendarDateInput.js">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://www.jasonmoon.net/
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/

</script>
<script language="javascript" src="/common/js/prototype.js" type="text/javascript">
</script>
<script language="javascript" src="/common/js/scriptaculous.js" type="text/javascript">
</script>	
<script language="javascript" src="/common/js/scriptaculous/controls.js" type="text/javascript">
</script>	
<link rel="stylesheet" href="/admin/common/css/styles.css" type="text/css" />
<?php include "includes/calendar1.inc"; ?>
</head>
<body>
<div id="content">
	<img src="/admin/event/images/header_programs_admin.jpg" alt="American Museum of Natural History"/> 

<?php include "includes/welcome.inc";?> 

<div id="prop"></div>
	<div id="menu">
	<?php include "includes/generate_calendar.inc";?> 
	</div>
	<?php include "/web/secure_docs/common/includes/navmenu.inc";?>
	
<? if(isset($errortext)){echo('<ul class="error">'.$errortext.'</ul>');} ?>
<h1 class="orange">
	<? if($event_id != ''){echo('Update');}else{echo('Create');} ?> an Event </h1> 
<? 
//display image if one exists
if($event_img_filename != "")
	{
	//display the image
	echo('<img class="'.$event_img_class.'" alt="'.$event_img_path.$event_img_filename.'" src="http://yoda.amnh.org'.$event_img_path.$event_img_filename.'" />');
	}
?>
<form enctype="multipart/form-data" action="submit_event.php" method="post">
<?
echo('<input type="hidden" name="event_id" value="'.$event_id.'" />');
// and add a hidden field with the image path and filename
if($event_img_filename != "")
	{
	echo('<input type="hidden" name="event_img_path" value="'.$event_img_path.'" />');
	echo('<input type="hidden" name="event_img_filename" value="'.$event_img_filename.'" />');
	}
//same for uploaded document	
if($event_img_filename != "")
	{
	echo('<input type="hidden" name="event_doc_path" value="'.$event_doc_path.'" />');
	echo('<input type="hidden" name="event_doc_filename" value="'.$event_doc_filename.'" />');
	}
?>
<p>Title: <input class="formtitle" type="text" maxlength="255" size="30" value="<?=$event_title?>" name="event_title" /></p>

<? if(isset($_GET["event_id"]))
{
	$i = 0; $numrows = mysql_num_rows($q_get_event_types);
	while ($row = mysql_fetch_assoc($q_get_event_types))
		{	$i++;
			$event_type_id = $row["event_type_id"];
			$event_subtype_id = $row["event_subtype_id"];
			$event_sub_subtype_id = $row["event_sub_subtype_id"];
	?>
			<p><a class="field" href="/admin/phpmyadmin/sql.php?lang=en-iso-8859-1&server=1&db=com_calendar&table=event_type&sql_query=SELECT+%2A+FROM+%60event_type%60&pos=0&goto=tbl_properties_structure.php">Categories <? if($i>1) echo $i?>:</a>
			<select class="formreq" name="event_type[]">
    		<?if($i!=1){?><option selected value=""></option><?}?>
				<?	
    		while ($row = mysql_fetch_assoc($q_event_type))
    		{
      		if(isset($event_type_id) && $event_type_id == $row["event_type_id"])
					{ 
      			echo "<option selected=\"selected\" value=\"{$row["event_type_id"]}\">{$row["event_type_desc"]}</option>";}
      		else
  				{
      			echo "<option value=\"{$row["event_type_id"]}\">{$row["event_type_desc"]}</option>";
  				}
      	}
    		mysql_data_seek($q_event_type, 0);//set pointer to first element--do this so we can reuse the same query in the next loop
				?>
  		</select></p>
      <?
			if(strlen($_SESSION['event_types_allowed']) != 0)
				{?>
      		<input type="hidden" name="event_subtype" value="1">
      		<input type="hidden" name="event_sub_subtype" value="1">
      <?}else{?>
      <p><a class="field" href="/admin/phpmyadmin/sql.php?lang=en-iso-8859-1&server=1&db=com_calendar&table=event_subtype&sql_query=SELECT+%2A+FROM+%60event_subtype%60&pos=0&goto=tbl_properties_structure.php">&nbsp;</a>
			<select class="form" name="event_subtype[]">
    		<?	
    		while ($row = mysql_fetch_assoc($q_event_subtype))
    		{
    			if(isset($event_subtype_id) && $event_subtype_id == $row["event_subtype_id"])
					{ 
    				echo "<option selected=\"selected\" value=\"{$row["event_subtype_id"]}\">{$row["event_subtype_desc"]}</option>";
					}else{
    				echo "<option value=\"{$row["event_subtype_id"]}\">{$row["event_subtype_desc"]}</option>";}
    		}
    		mysql_data_seek($q_event_subtype, 0);
				?>
    	</select></p>
    	<p><a class="field" href="/admin/phpmyadmin/sql.php?lang=en-iso-8859-1&server=1&db=com_calendar&table=event_sub_subtype&sql_query=SELECT+%2A+FROM+%60event_sub_subtype%60&pos=0&goto=tbl_properties_structure.php">&nbsp;</a>
			<select class="form" name="event_sub_subtype[]">
  		<?	
  		while ($row = mysql_fetch_assoc($q_event_sub_subtype))
  		{
    		if(isset($event_sub_subtype_id) && $event_sub_subtype_id == $row["event_sub_subtype_id"]){ 
    			echo "<option selected=\"selected\" value=\"{$row["event_sub_subtype_id"]}\">{$row["event_sub_subtype_desc"]}</option>";}
    		else{
    			echo "<option value=\"{$row["event_sub_subtype_id"]}\">{$row["event_sub_subtype_desc"]}</option>";}
    		}
  		mysql_data_seek($q_event_sub_subtype, 0);?>
			<?}?>
  	</select></p>
	<?}//end outer while loop?>
	
	<?for($i = $numrows; $i < 3; $i++){//add an event_type field or two if necessary?>
	
		<p>Add'l Category:
	<select class="form" name="event_type[]">
		<option selected value=""></option>
		<?	
		while ($row = mysql_fetch_assoc($q_event_type))
		{
			echo "<option value=\"{$row["event_type_id"]}\">{$row["event_type_desc"]}</option>";
		}
		mysql_data_seek($q_event_type, 0);?>
	</select></p>
	<input type="hidden" name="event_subtype[]" value="1">
  <input type="hidden" name="event_sub_subtype[]" value="1">
	<?}?>

<?}else{//if adding a new event?>

<p><a class="field" href="/admin/phpmyadmin/sql.php?lang=en-iso-8859-1&server=1&db=com_calendar&table=event_type&sql_query=SELECT+%2A+FROM+%60event_type%60&pos=0&goto=tbl_properties_structure.php">Category:</a>
	<select class="formreq" name="event_type[]">
		<?	
		while ($row = mysql_fetch_assoc($q_event_type))
		{
		if(isset($event_type_id) && $event_type_id == $row["event_type_id"]){ 
			echo "<option selected=\"selected\" value=\"{$row["event_type_id"]}\">{$row["event_type_desc"]}</option>";}
		else{
			echo "<option value=\"{$row["event_type_id"]}\">{$row["event_type_desc"]}</option>";}
		}
		mysql_data_seek($q_event_type, 0);?>
	</select></p>
<?if(strlen($_SESSION['event_types_allowed']) != 0){?>
	<input type="hidden" name="event_subtype[]" value="1">
		<input type="hidden" name="event_sub_subtype[]" value="1">
<?}else{?>
<p><a class="field" href="/admin/phpmyadmin/sql.php?lang=en-iso-8859-1&server=1&db=com_calendar&table=event_subtype&sql_query=SELECT+%2A+FROM+%60event_subtype%60&pos=0&goto=tbl_properties_structure.php">&nbsp;</a>
	<select class="form" name="event_subtype[]">
		<?	
		while ($row = mysql_fetch_assoc($q_event_subtype))
		{
			if(isset($event_subtype_id) && $event_subtype_id == $row["event_subtype_id"])
			{ 
				echo "<option selected=\"selected\" value=\"{$row["event_subtype_id"]}\">{$row["event_subtype_desc"]}</option>";
			}else{
				echo "<option value=\"{$row["event_subtype_id"]}\">{$row["event_subtype_desc"]}</option>";
			}//end if
		}//end while
		?>
	</select></p>
<p><a class="field" href="/admin/phpmyadmin/sql.php?lang=en-iso-8859-1&server=1&db=com_calendar&table=event_sub_subtype&sql_query=SELECT+%2A+FROM+%60event_sub_subtype%60&pos=0&goto=tbl_properties_structure.php">&nbsp;</a>
	<select class="form" name="event_sub_subtype[]">
		<?	
		while ($row = mysql_fetch_assoc($q_event_sub_subtype))
		{
			if(isset($event_sub_subtype_id) && $event_sub_subtype_id == $row["event_sub_subtype_id"])
			{ 
				echo "<option selected=\"selected\" value=\"{$row["event_sub_subtype_id"]}\">{$row["event_sub_subtype_desc"]}</option>";
			}else{
				echo "<option value=\"{$row["event_sub_subtype_id"]}\">{$row["event_sub_subtype_desc"]}</option>";
			}//end if
		}//end while
		?>
	</select></p>
	<p>2<sup>nd</sup> Category:
	<select class="form" name="event_type[]">
		<option selected value=""></option>
		<?	
		while ($row = mysql_fetch_assoc($q_event_type))
		{
			echo "<option value=\"{$row["event_type_id"]}\">{$row["event_type_desc"]}</option>";
		}
		mysql_data_seek($q_event_type, 0);?>
	</select></p>
	<p>3<sup>rd</sup> Category:
	<select class="form" name="event_type[]">
		<option selected value=""></option>
		<?	
		while ($row = mysql_fetch_assoc($q_event_type))
		{
			echo "<option value=\"{$row["event_type_id"]}\">{$row["event_type_desc"]}</option>";
		}
		?>
	</select></p>
	<input type="hidden" name="event_subtype[]" value="1">
  <input type="hidden" name="event_sub_subtype[]" value="1">
	<input type="hidden" name="event_subtype[]" value="1">
  <input type="hidden" name="event_sub_subtype[]" value="1">
	<?}//end event types allowed if statement?>
<?}//end if new event statement?>	

<?if(strlen($_SESSION['event_types_allowed']) == 0){?>
<p title="Uncheck this for pending events" alt="Uncheck this for pending events">Active Event?
	<input class='form' type='checkbox' 
	<? if(isset($is_event_active) && $is_event_active == "1"){echo("checked");}?>
	name='is_event_active' /></p>
<p>Member Event<sup class="note">1</sup>:
	<input class='form' type='checkbox' 
	<? if(isset($is_member_event) && $is_member_event == "1"){echo("checked");}?>
	name='is_member_event' /></p>
<p>Members Only<sup class="note">2</sup>:
	<input class='form' type='checkbox' 
	<? if(isset($is_members_only) && $is_members_only == "1"){echo("checked");}?>
	name='is_members_only' /></p>

<!-- session 1 -->
<p>Event Code: <input class="form" type="text" maxlength="10" size="10" value="<?=$event_code?>" name="event_code" /></p> 
<p>Ticket Code: <input class="form" type="text" maxlength="11" size="10" value="<?=$ticket_code?>" name="ticket_code" /> </p>
<p>Show Buy Button: 
	<input type='checkbox' class="form"
	<? if(isset($show_buy_button) && $show_buy_button == "1"){echo("checked");}?>
	name='show_buy_button' /></p> 

<?}?>
<p>Time: (<em>text</em>) <input class="formreq" type="text" maxlength="255" size="30" value="<?=$event_time_desc?>" name="event_time_desc" /></p>
<p>Start Time: (<em>hh:mm</em>) <input class="formreq" type="text" maxlength="5" size="5" value="<?=$event_start_time?>" name="event_start_time" /><select class="form3req" name="ampm"><option <?if(!isset($ampm)||$ampm==""){?>selected<?}?> value=""></option><option <?if(isset($ampm)&&$ampm=="am"){?>selected<?}?> value="am">AM</option><option <?if(isset($ampm)&&$ampm=="pm"){?>selected<?}?> value="pm">PM</option></select></p>
<p>Duration: (<em>hh:mm</em>) <input class="formreq" type="text" maxlength="5" size="5" value="<?=$event_duration?>" name="event_duration" /></p>
														
<!--end session 1 -->



<p>Location: <input class="formreq" type="text" maxlength="100" size="30" value="<?=$event_location?>" name="event_location" /></p>

<?if(strlen($_SESSION['event_types_allowed']) == 0){?>
<p>Price: <input class="formreq" type="text" maxlength="255" size="30" value="<?=$event_price_data?>" name="event_price_data" /></p>
<?}else{?><input type="hidden" name="event_price_data" value="NA"><?}?>
<table><!--date input-->
	<tr>
		<td><span style="margin-left:17px;">Date<sup class="note">3</sup>:</span> <? 
	if($event_date != ""){
		echo("<script type=\"text/javascript\">DateInput('event_date', true, 'MM/DD/YYYY', '{$event_date}')</script>");}
	else{
		echo("<script type=\"text/javascript\">DateInput('event_date', true, 'MM/DD/YYYY')</script>");}
	?></td>
	</tr>
</table><!--end date input-->

<br />
<p>Show Date<sup class="note">4</sup>:
	<input class='form' type='checkbox' 
	<? if(!isset($show_event_date_flag) || $show_event_date_flag == "1"){echo("checked");}?>
	name='show_event_date_flag' /></p>
 
<p>Description:
<div id="fck">
<?php
include_once("fckeditor/fckeditor.php") ;

$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->ToolbarSet = "MyTool";
$oFCKeditor->Value = $event_desc ;
$oFCKeditor->Create() ;


?>
</div>
</p>

<p>Short Description: <input class="formreq" type="text" maxlength="255" size="60" value="<?=$event_short_desc?>" name="event_short_desc" /></p>
<p>Alt. Highlight Link: <input class="form" type="text" maxlength="255" size="60" value="<?=$alt_highlight_link?>" name="alt_highlight_link" /></p>
<p><?if(strlen($_SESSION['event_types_allowed']) == 0){?>Notes:<?}else{?>Link:<?}?> <input class="form" type="text" maxlength="255" size="60" value="<?=$event_note?>" name="event_note" />
</p>

<?if($event_doc_filename != ""){?>
  <p>Current Document<sup class="note">5</sup>:
  <a class="form" href="<?=$event_doc_path.$event_doc_filename;?>" name="currentdocument"><?=$event_doc_filename;?></a>
  </p>
<?}?>

<p><?if($event_doc_filename != ""){echo('Change');}?> Document<sup class="note">5</sup>:
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" /> 
<input class="form" name="event_doc" size="40" type="file" />
</p>

<p><?if($event_img_filename != ""){echo('Change');}?> Image:
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" /> 
<input class="form" name="event_img" size="40" type="file" />
</p>

<p>Image Caption: <input class="form" type="text" maxlength="120" size="60" value="<?=$event_img_caption?>" name="event_img_caption" /></p>
<p>Image Credit: <input class="form" type="text" maxlength="120" size="60" value="<?=$event_img_credit?>" name="event_img_credit" /></p>

<? if(strlen($_SESSION['event_types_allowed']) == 0){?>
  <!-- session 2 -->
  <hr>
  <p class="orange">Second Session (leave blank for single programs):</p>
  <p class="second">Event Code 2: <input class="form2" type="text" maxlength="10" size="10" value="<?=$event_code2?>" name="event_code2" /></p> 
  <p class="second">Ticket Code 2: <input class="form2" type="text" maxlength="11" size="10" value="<?=$ticket_code2?>" name="ticket_code2" /> </p>
  <p class="second">Show Buy Button 2: 
  	<input type='checkbox' class="form2"
  	<? if(isset($show_buy_button2) && $show_buy_button2 == "1"){echo("checked");}?>
  	name='show_buy_button2' /></p> 
  
  <p>Time: (<em>text</em>) <input class="form2" type="text" maxlength="255" size="30" value="<?=$event_time_desc2?>" name="event_time_desc2" /></p>
  <p>Start Time 2: (<em>hh:mm</em>) <input class="form2" type="text" maxlength="5" size="5" value="<?=$event_start_time2?>" name="event_start_time2" /><select class="form4" name="ampm2"><option <? if(!isset($ampm2)||$ampm2==""){?>selected<?}?> value=""></option><option <?if(isset($ampm2)&&$ampm2=="am"){?>selected<?}?> value="am">AM</option><option <? if(isset($ampm2)&&$ampm2=="pm"){?>selected<?}?> value="pm">PM</option></select></p>
  <p>Duration 2: (<em>hh:mm</em>) <input class="form2" type="text" maxlength="5" size="5" value="<?=$event_duration2?>" name="event_duration2" /></p>
  <hr>
  <!--end session 2 -->

  
  <!-- session 3 -->
  <hr>
  <p class="orange">Third Session (leave blank for single programs):</p>
  <p class="second">Event Code 3: <input class="form3" type="text" maxlength="10" size="10" value="<?=$event_code3?>" name="event_code3" /></p> 
  <p class="second">Ticket Code 3: <input class="form3" type="text" maxlength="11" size="10" value="<?=$ticket_code3?>" name="ticket_code3" /> </p>
  <p class="second">Show Buy Button 3:<input type='checkbox' class="form3"<? if(isset($show_buy_button3) && $show_buy_button3 == "1"){echo("checked");}?>
  	name='show_buy_button3' /></p> 
  
  <p>Time: (<em>text</em>) <input class="form3" type="text" maxlength="255" size="30" value="<?=$event_time_desc3?>" name="event_time_desc3" /></p>
  <p>Start Time 3: (<em>hh:mm</em>) <input class="form3" type="text" maxlength="5" size="5" value="<?=$event_start_time3?>" name="event_start_time3" /><select               
     class="form4" name="ampm3"><option 
  
  <? if(!isset($ampm3)||$ampm3==""){?>selected<?}?> value=""></option><option <? if(isset($ampm3)&&$ampm3=="am"){?>selected<?}?> value="am">AM</option><option 
  
  <? if(isset($ampm3)&&$ampm3=="pm"){?>selected<?}?> value="pm">PM</option></select></p>
  <p>Duration 3: (<em>hh:mm</em>) <input class="form3" type="text" maxlength="5" size="5" value="<?=$event_duration3?>" name="event_duration3" /></p>
  <hr>
  <!--end session 3 -->
  
<?}//end second event types allowed if statement?>
   	 <p class="orange">Add Tags:</p>
  	  <?php
  	  	/*
  	  		Added 2 new var, $startarea and $endarea
  	  		this take care of the space/indent problem.
  	  		July 28,09
  	  	*/
  	  	
  	  	$startarea='<textarea name="taggies" cols="75" rows="10" style="background-color: #FFF;">';
  	    $endarea='</textarea>';
  	   	echo $startarea;
  	   	//pull tags for display. 
  	   	if ($_GET['event_id'])
  	   	{
			$tag_query=mysql_query ("SELECT tag FROM tags 
  	  								 WHERE event_id = $event_id
  	  								 ORDER BY tag");
			$tags = array(); 
			while ($row = mysql_fetch_assoc($tag_query))
			{  
				foreach ($row as $k => $v){}
				$tags[] = trim($v);	
		   	}
		   	$taggies = implode(", ", $tags);
		   	
		   	echo $taggies;
		}
		echo $endarea;
		?>
		<br/>
  	   	<br/>
  	   	<a href="http://yoda.amnh.org/build/hnewsom/tag_cloud/index.php">See Cloud</a>
   <hr>

<p><?if($_SESSION['access_level'] != 3){?><input class="button" type="submit" name="submit" value="submit" /><?}?>
</p>

<div id="accessibility">

<img src="http://amnh.org/museum/welcome/accessibility/images/whlchr-p_sm.gif" />
<input class='accessibility' type='checkbox' <? if(isset($access_chair) && $access_chair == "1"){echo("checked");}?> name='access_chair' />

<img src="http://amnh.org/museum/welcome/accessibility/images/listen-p_sm.gif" />
<input class='accessibility' type='checkbox' <? if(isset($access_audio) && $access_audio == "1"){echo("checked");}?> name='access_audio' />

<img src="http://amnh.org/museum/welcome/accessibility/images/tty-p_sm.gif" />
<input class='accessibility' type='checkbox' <? if(isset($access_tty) && $access_tty == "1"){echo("checked");}?> name='access_tty' />

<img src="http://amnh.org/museum/welcome/accessibility/images/lgprnt-p_sm.gif" />
<input class='accessibility' type='checkbox' <? if(isset($access_largeprint) && $access_largeprint == "1"){echo("checked");}?> name='access_largeprint' />

<img src="http://amnh.org/museum/welcome/accessibility/images/cc-p_sm.gif" />
<input class='accessibility' type='checkbox' <? if(isset($access_cc) && $access_cc == "1"){echo("checked");}?> name='access_cc' />

<img src="http://amnh.org/museum/welcome/accessibility/images/sign-p_sm.gif" />
<input class='accessibility' type='checkbox' <? if(isset($access_sign) && $access_sign == "1"){echo("checked");}?> name='access_sign' />

<img src="http://amnh.org/museum/welcome/accessibility/images/braill-p_sm.gif" />
<input class='accessibility' type='checkbox' <? if(isset($access_braille) && $access_braille == "1"){echo("checked");}?> name='access_braille' />

<img src="http://amnh.org/museum/welcome/accessibility/images/whtcne-p_sm.gif" />
<input class='accessibility' type='checkbox' <? if(isset($access_touch) && $access_touch == "1"){echo("checked");}?> name='access_touch' />

</div>
<div id="alert">Note:<br />The fields in <br /><span style="font-size: 140%; color: #CC9;">YELLOW</span><br />are<br /><span style="font-size: 140%; color: red;">required</span></div>
</form>

<? include "includes/add_event_notes.inc"; ?>
	


<div id="clear"></div>
<?php include "includes/footer.inc";?>

</div>

</body>
</html>
