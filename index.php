<?	
//PUBLIC PROGRAMS CALENDAR INDEX PAGE
//REDIRECTS TO programs.php IF DATE SUPPLIED
if(($_GET['date'] && count(explode("-",$_GET['date'])) == 3) || ($_GET['year'] && is_numeric($_GET['year'])) || ($_GET['month'] && is_numeric($_GET['month'])))
			{
			if($_GET['date'] && count(explode("-",$_GET['date'])) == 3)
				{
				$url_vars = '?date='.substr($_GET['date'], 0, 10);
				}
			elseif($_GET['year'] && is_numeric($_GET['year']) && $_GET['month'] && is_numeric($_GET['month']))
				{
				$url_vars = '?year='.substr($_GET['year'], 0, 4).'&month='.substr($_GET['month'], 0, 2);
				}
			header("Location: programs.php{$url_vars}");
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
 <title>Public Programs Calendar | American Museum of Natural History</title>
 <meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
 <?php include "/web/docs/common/meta/meta.txt"; ?>
  

  <script language="javascript" type="text/javascript" src="/common/navigation/header/header.js"></script>
  <script type="text/javascript" src="javascript/mootools.js"></script>
  <script type="text/javascript" src="tag_cloud/cloud.js"></script>
  <script language="javascript" type="text/javascript" src="scroller.js"></script>
  
  <script>
  var newwindow;
  function poptastic(url)
  {
	newwindow=window.open(url,'name','height=340,width=400');
	if (window.focus) {newwindow.focus()}
  }
	
 function searchVal()
  {  if(isBlank(document.searchform.keywords.value)){
		alert("Please enter a search term.");
		return false;
	}
     return true;
  }
 </script>
 <script language="javascript" type="text/javascript" src="/common/js/common_js.js"></script>
<link rel="stylesheet" href="/programs/css/programs.css" type="text/css" />

 <!--[if IE 8]>
	<link rel="stylesheet" type="text/css" href="/programs/css/programs_ie8.css" />
  <![endif]--> 
 
 <!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="/programs/css/programs_ie7.css" />
 <![endif]--> 

<link rel="stylesheet" href="/common/css/standard.css" type="text/css">
<link rel="stylesheet" href="/common/css/toplevel.css" type="text/css">
<link rel="stylesheet" href="tag_cloud/cloud.css" type="text/css"> 

  
 <?php include "includes/functions.inc";
	   include "includes/calendar1.inc";?>
 </head>
<!-- onload="	var scrollTimeout=setTimeout(beginNewScroll,2000);	" -->
 <body  bgcolor="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" return false">
  <?php include "/web/docs/common/navigation/header/header_flash.php"; ?>
  <?php include "/web/docs/common/inserts/ns4upgrade_white.php"; ?>
  
  <table id="wrapper" align="center" border="0" cellpadding="0" cellspacing="0" width="774" bgcolor="#ffffff"><tr><td>
    
    <div id="container">
    
    
    <div id="leftwrapper">
        <img src="/programs/images/rev3/title_pubprog.gif" border="0" alt="Public Programs" width="525" height="36"/> 
        <div id ="feature">
          <?php include "/web/docs/programs/inserts/feature.php"; ?>    
    	</div>
 <?    
    
    /* This code decides to show events based on the today's date. If there are no programs occuring today, the page will only display       the higlights div. With code by reused by Michael Sullivan, written by Clint Newsom. 8/13/08*/    
	  $today = date('Y-m-d');
 
    
      db_connect();

      //run query
	  $query_today = mysql_query("
	      SELECT a.event_id, a.event_title, a.event_short_desc, a.event_img_filename, a.is_member_event, a.event_type_id, c.event_date 
			FROM event a, event_schedule c
			WHERE c.event_date = '$today' 
			AND a.event_id = c.event_id 
			ORDER BY c.event_date") or die (mysql_error());
	
	 $results = mysql_num_rows($query_today);

?>      
   <? if ( $results > 0){?>
      
      <img src="/programs/images/rev3/todays_events.gif" width="522" height="17" alt="Today's Events" />

   <? } ?>


<?     while ($t_result = mysql_fetch_assoc($query_today)){
		   $t_year = substr($t_result['event_date'], 0, 4);
		   $t_day = ltrim(substr($t_result['event_date'], 8, 2), 0);
		   $t_day_name = gmdate('l',gmmktime(0,0,0,substr($t_result['event_date'], 5, 2),substr($t_result['event_date'], 8, 2), 
		   $t_year));
		   $t_month = gmdate('F',gmmktime(0,0,0,substr($t_result['event_date'], 5, 2),1,$t_year));
		   $t_event_schedule = "$t_day_name, $t_month $t_day";
		   $t_is_member_event = $t_result['is_member_event'];
		   $t_img = $t_result['event_img_filename'];
		 
     ?>   
  <? if ($query_today != ""){?>
    <div id ="today_entry">
      <p>
	  <? if($t_img !== ""){?>
  		 <a href="/programs/programs.php?src=p_h&date=<?=$t_result['event_date']?>&event_id=<?=$t_result['event_id']?>">
   		<img src="../programs/images/calendar/thumbs/<?=$t_img?>" alt="<?=$t_result['event_title']?>" title="<?=$t_result['event_title']?>" width="70" height="70" border="0" align="left" style="margin-top:3px; margin-right:7px;border:black 0px solid;" /></a><? }?>
       <strong><a href="/programs/programs.php?src=p_h&date=<?=$t_result['event_date']?>&event_id=<?=$t_result['event_id']?>"><?=$t_result['event_title']?></a></strong> - <?=$t_result['event_short_desc']?> <strong><?=$t_event_schedule?>.</strong><br clear="all" />
  
      </p>		
		
   <div id ="eventLinks">
<a href="/programs/programs.php?src=p_h&date=<?=$t_result['event_date']?>&event_id=<?=$t_result['event_id']?>">See this event</a> |
<a href="programs.php?event_type_id=<?=$t_result['event_type_id']?><? if(isset($_GET['member']) && $_GET['member'] == 'true'){echo '&member = true';}?>&bytype=1">See more programs like this</a>
  </div>
  </div>
<? } ?>

<? } ?>
    <div id="highlights">
      <img src="/programs/images/rev3/title_proghighlights.gif" width="522" height="17" alt="Program Highlights" />
        <?php include "/web/docs/programs/inserts/highlights.php"; ?>
    </div><!-- end highlights div -->
  </div><!-- end leftwrapper div -->
      
  <div id="rightwrapperborder">
		 <div id ="menu">
		  <div id="rightbuttons">
		  <?php include "/web/docs/common/inserts/enotes_visinfo.php"; ?>
		  </div>
		  <div id="calendar">
		     <?php include "/web/docs/programs/includes/generate_public_calendar.inc";
		  		   include "/web/docs/programs/includes/search.inc"; ?>
		  		       		     
		  </div>
			<? include "/web/docs/programs/includes/navmenu.inc";?>
	
		    
		  <!--<div id="curator">
		  	<img src="/programs/images/rev3/meet_lecturer_top.gif" width="234" height="24" alt="Meet the Lecturer" />
		  	<?php// include "/web/docs/programs/inserts/lecturer.php"; ?>
		  	<img src="/exhibitions/images/rev3/meet_curator_bottom.gif" width="234" height="16" alt="Meet the Curator" />
		  </div>--><!-- end curator div -->
	 
	 
	  <div id="gallery"></div>	
	 
	 </div><!--end menu-->
	  </div><!-- end rightwrapper div -->

	</div><!-- end container div -->
 
 </td>
 </tr>
</table>

<?php include "/web/docs/common/navigation/footer/footer_curve.php"; ?>
<?php include "/web/docs/common/analytics.txt";?>
</body>
</html>