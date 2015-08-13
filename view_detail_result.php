<div class="wrap">
<h2>Welcome to RS Survey </h2>
<div class="card pressthis">
<?php
$t_idi = $_REQUEST['title'];
$t_id = base64_decode($t_idi);
$ki = $_REQUEST['id'];
$k = base64_decode($ki);
$results = get_option('survey_taken');
$survey = get_option('survey_quest');
$res = array();

for($j=0; $j<sizeof($results); $j++)
{
  if($t_id == $results[$j]['title'] )
  {
       array_push($res,$results[$j]);
  }
}



	
	for($i=0; $i<sizeof($survey[$t_id]['q']); $i++)
	{ ?>
			
		<h3> <?php echo $survey[$t_id]['q'][$i]; ?> </h3>
		<?php $choice= $res[$k]['c'][$i]; ?>
		<p class="description"> <?php echo $survey[$t_id]['c'][$i][$choice]; ?> </p>
		

		
	<?php } 




	?>



</div>
</div>

