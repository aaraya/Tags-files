<? //$start = microtime_float(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
 <title>Event Calendar | American Museum of Natural History</title>
 <meta http-equiv="Content-type" content="text/html; charset=iso-8859-1">
 <? include "/web/docs/common/meta/meta.txt";?>
 <? include "/web/docs/programs/includes/functions.inc";?>
 <? include "includes/webtrends_logic.inc";?>	
 <script>
  var newwindow;
  function poptastic(url)
  {
	newwindow=window.open(url,'name','height=370,width=400');
	if (window.focus) {newwindow.focus()}
  }
 </script>
 <script>
  function searchVal()
  {  if(isBlank(document.searchform.keywords.value)){
		alert("Please enter a search term.");
		return false;
  }
  return true;
  }
 </script>
 <script language="javascript" type="text/javascript" src="/common/navigation/header/header.js"></script>
 <script language="javascript" type="text/javascript" src="/common/js/common_js.js"></script>
 <link rel="stylesheet" href="/common/css/standard.css" type="text/css" />
 <link rel="stylesheet" href="/programs/css/programs.css" type="text/css" />
 <!--[if IE 8]>
	<link rel="stylesheet" type="text/css" href="/programs/css/programs_ie8.css" />
  <![endif]--> 
 
 <!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="/programs/css/programs_ie7.css" />
 <![endif]--> 
 
 <link rel="stylesheet" href="tag_cloud/cloud.css" type="text/css">
 <? include "/web/docs/programs/includes/buy_button.inc";?>
 <? include "/web/docs/programs/includes/calendar1.inc";?>
<script type="text/javascript" src="javascript/mootools.js"></script>
<script type="text/javascript" src="tag_cloud/cloud.js"></script>
<script language="javascript" src="/common/js/swfobject.js" type="text/javascript">
</script>
</head>
<body bgcolor="#000066" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include "/web/docs/common/navigation/header/header.php"; ?>
  <?php include "/web/docs/common/inserts/ns4upgrade_white.php"; ?>
  <? 
  if($_GET['event_id'])
	 {  
	    include "/web/docs/programs/includes/get_single_event.inc";
	 }
	 else
	 {  
	    include "/web/docs/programs/includes/get_events.inc";
	 } 
?>
  <table id="wrapper" align="center" border="0" cellpadding="0" cellspacing="0" width="774" bgcolor="#ffffff"><tr><td>
   
   <div id="container">
   
    <div id="leftwrapper" style="float:left; width:525px;>
 
     <?
     if(!$memberheader && !$_GET['ao']){?>
        <img src="/programs/images/rev3/title_pubprog.gif" alt="Public Programs" width="525" height="36" />
        <? } ?>
     
     </div><!--end leftwrapper div-->

	<div id="menu" style="margin-left: 20px;">
 
	  <div id="calendar">
		<? include "/web/docs/programs/includes/generate_public_calendar.inc"; 
		   include "/web/docs/programs/includes/search.inc";?>
	  </div>
         
        <? include "/web/docs/programs/includes/navmenu.inc"; ?>
        <div id="gallery"></div>
	
	</div>
    <? include "/web/docs/common/inserts/ns4upgrade.php"; ?>

    <? if($memberheader)
		 {include "/web/docs/programs/includes/members_only.inc";
		  $member = 'true';}
  else{$member='false';}?>
  
<? if($_GET['ao'])
		{include "/web/docs/programs/includes/access_options.inc";
		$ao = 'true';}
  else{$ao='false';}?>	

<br />
	    <?
	    	if(!$_GET[tag])
	    		echo("<h2>$headline</h2>");
	    ?>	

	<!-- only show the 'sorry' message if they have selected a specific program type -->
<? if($query && mysql_num_rows($query) == "" && ((isset($_REQUEST['event_type_id']) && $_REQUEST['event_type_id'] != 0) || (isset($_GET['member']) && $_GET['member'] == 'true') || ($_GET['ao']))){?>

	<!--hr /-->
	<p class="purple">Sorry, there are no programs matching your selection criteria. Please try a different date or event type or select one of our daily programs below.<br /><br/></p>

<!-- search results produce no records -->
<? }elseif($query && mysql_num_rows($query) == "" || $_REQUEST['event_type_id']=="NULL"){?>

  <p class="orange">Your search produced no results. Please try a different search term or select a date or category.<br /><br /></p>

<? }elseif($query){ ?>
	<? $rownum = 0; $buybuttonnum = 0; while ($result = mysql_fetch_assoc($query)){ 
		$rownum = $rownum + 1; $buybuttonnum = $buybuttonnum + 1;
  	$event_title_str = str_replace(" ","%20", str_replace("","",str_replace("'","",$result['event_title'])));
	?>
	<!-- this logic decides when to display a new event type subheading -->
	<? if($rownum == 1){$event_type = $result['event_type_desc'];?>
		<? if($result['event_type_note'] != "")
			{
				$event_type_note = $result['event_type_note'];
				
			}else{
				
				$event_type_note = NULL;
			}?>
							
<h2><?=$event_type?>&nbsp;&nbsp;
	  <?php if (!$_REQUEST['event_type_id']){
			   
			    echo "<a class='h2' href='programs.php?event_type_id=". $result['event_type_id'];
						if(isset($_GET['member']) && $_GET['member'] == 'true')
						    {echo "&member = true";}
				echo "&bytype=1'>see all</a>";
			}?>
</h2>
		<? 
			if(strlen($result['banner_filename']) > 0){
			
				?><div class="h2banner"><img src="/programs/images/calendar/banners/<?=$result['banner_filename']?>" class="h2banner" /></div><?
			
			}
			
		//no new event type heading
		}elseif($event_type != $result['event_type_desc']){$event_type = $result['event_type_desc'];?>
		
		<? if($event_type_note != "")//display the event type note at the end of its section
			{?>
			<p class="subtype_note">
				<?=$event_type_note?>
			</p>
		<?}?>
		
		<br />		
				
<h2><?=$event_type?>&nbsp;&nbsp;
	  <?php if (!$_REQUEST['event_type_id'])
			{   echo "<a class='h2' href='programs.php?event_type_id=". $result['event_type_id'] ."&bytype=1'>see all</a>";
		
			}
			
			
			?>
</h2>	
		<?
		if(strlen($result['banner_filename']) > 0){	
		?><div class="h2banner"><img src="/programs/images/calendar/banners/<?=$result['banner_filename']?>" class="h2banner" /></div><?			
		}
			if($result['event_type_note'] != "")
			{ 
			   $event_type_note = $result['event_type_note'];
				
			}else{
				
				$event_type_note = NULL;
				
			}?>
		
	<?}?>
	
		<!-- this logic decides IF and when to display a new event SUBtype subheading -->
	<? if($result['event_subtype_desc'] != '')
			{
			if(!isset($event_subtype))
				{
				$event_subtype = $result['event_subtype_desc'];?>
				<p class="h7"><span class="title"><?=$event_subtype?></span>&nbsp;&nbsp;<?if($result['event_subtype_id'] != ""){?><a class="h7" href="programs.php?event_type_id=<?=$result['event_type_id']?>&event_subtype_id=<?=$result['event_subtype_id']?>&bytype=1">see all</a><?}?></p>				
				<?if($result['event_subtype_note'] != "")
					{?>
					<p class="subtype_note">
						<?=$result['event_subtype_note']?>
					</p>
				<?}?>
		<?	}
			elseif(isset($event_subtype) && $event_subtype != $result['event_subtype_desc'])
				{
				$event_subtype = $result['event_subtype_desc']
				?>
				<p class="h7"><span class="title"><?=$event_subtype?></span>&nbsp;&nbsp;<? if($result['event_subtype_id'] != ""){?><a class="h7" href="programs.php?event_type_id=<?=$result['event_type_id']?>&event_subtype_id=<?=$result['event_subtype_id']?>&bytype=1">see all</a><?}?></p>
				<?if($result['event_subtype_note'] != "")
					{?>
					<p class="subtype_note">
						<?=$result['event_subtype_note']?>
					</p>
				<?}?>
			<?}
			}?>
	
	<!-- this logic decides IF and when to display a new event SUB_SUBtype (2nd level) subheading -->
	<? if($result['event_sub_subtype_desc'] != '')
			{
			if(!isset($event_sub_subtype))
				{
				$event_sub_subtype = $result['event_sub_subtype_desc'];?>
				<p class="h8"><?=$event_sub_subtype?>&nbsp;&nbsp;<!--a class="h8" href="programs.php?event_type_id=<?=$result['event_type_id']?>#<?=str_replace(" ","%20", str_replace("","",$result['event_sub_subtype_desc']))?>">see all</a--></p>
				<?if($result['event_sub_subtype_note'] != "")
					{?>
					<p class="sub_subtype_note">
						<?=$result['event_sub_subtype_note']?>
					</p>
				<?}?>
		<?	}
			elseif(isset($event_sub_subtype) && $event_sub_subtype != $result['event_sub_subtype_desc'])
				{
				$event_sub_subtype = $result['event_sub_subtype_desc']
				?>
				<p class="h8"><?=$event_sub_subtype?>&nbsp;&nbsp;<!--a class="h8" href="programs.php?event_type_id=<?=$result['event_type_id']?>#<?=str_replace(" ","%20", str_replace("","",$result['event_sub_subtype_desc']))?>">see all</a--></p>
				<?if($result['event_sub_subtype_note'] != "")
					{?>
					<p class="sub_subtype_note">
						<?=$result['event_sub_subtype_note']?>
					</p>
				<?}?>
			<?php }
			}
			
			if($_REQUEST['event_id']){
				include "includes/event_full_display.inc";
			}else{
				include "includes/event_list_display.inc";
			}
			}}
		
		if($event_type_note != "")//display the event type note at the end of its section (last event type)
			{?>
			
			<p class="subtype_note">
				<?=$event_type_note?>
			</p>
		<? }
		
		//here's where we include daily events, tags, member events and suchlike
	
		if (! $_GET['ao']){
			if(isset($_REQUEST['tag'])){
				include "includes/tag_results.inc";
			}
		}
			
		if($query && mysql_num_rows($query) != ""){echo("<br /><br />");}
		
		if(!$_GET['ao']){
		
		//if you want to understand what's happening here, please also look at includes/search.inc [C.N.]
		
		//echo ("<h1>Daily Programs</h1>");
		if(!$_REQUEST['event_id'] && (!$_REQUEST['event_type_id'] || $_REQUEST['event_type_id'] == "IMAX")){
			include "includes/imax.inc";
		}
		
		if(!$_REQUEST['event_id'] && (!$_REQUEST['event_type_id'] || $_REQUEST['event_type_id'] == "SPACESHOWS")){
			include "includes/spaceshows.inc";
		}
		
		//hack allowing member events to be queried from the select box in search.inc [C.N.]
		if(!$_REQUEST['event_id'] && (!$_REQUEST['event_type_id'] || $_REQUEST['event_type_id'] == "member_event")){
			include "includes/member_event.inc";
		}
							
		
		//hack allowing expeditions to be displayed in the same query as fieldtrips. [C.N.]
		if(!$_REQUEST['event_id'] && (!$_REQUEST['event_type_id'] || $_REQUEST['event_type_id'] == 8)){
			include "includes/expeditions.inc";
		}
		
		
		//only include Trip to the Moon if it is Wednesday
		//only include sonicvision if it is a friday or a saturday
		//or if we are viewing an entire month
		if(isset($_GET['date']))
		{
			$sv_days = array(5,6);
			$day_of_week = gmdate('w',gmmktime(0,0,0,substr($_GET['date'], 5, 2),substr($_GET['date'], 8, 2),substr($_GET['date'], 0, 4)));
			
			if(in_array($day_of_week, $sv_days))
			{
			include "includes/sonicvision.inc";
			}elseif($day_of_week == 3){
			include "includes/triptomoon.inc";
			}
		}
		else
		{
			include "includes/triptomoon.inc";
			include "includes/sonicvision.inc";
		}
	
	}
	?>

<?if($_GET['ao'] && (mysql_num_rows($query) == "" || mysql_num_rows($query) <= 1)){?><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><?}?>

<?php

//$end = microtime_float(); 

// Print results.
//echo 'Script Execution Time: ' . round($end - $start, 3) . ' seconds';   

?> 

</div>
<table id="wrapper" align="center" border="0" cellpadding="0" cellspacing="0" width="774" bgcolor="#ffffff"><tr><td>
<?include "/web/docs/common/navigation/footer/footer.php";?>
<?php include "/web/docs/common/analytics.txt";?>

</body>
</html>
