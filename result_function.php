<?php
$t_id = $_REQUEST['title'];
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


for($k=0; $k<sizeof($res); $k++)
{
	echo "<h2>Survey--".($k+1)."</h2>";
	for($i=0; $i<sizeof($survey[$t_id]['q']); $i++)
	{
			echo '<h4>'.$survey[$t_id]['q'][$i].'</h4><br/>';
			$choice= $res[$k]['c'][$i];
		    echo $survey[$t_id]['c'][$i][$choice].'<br/>';
		

	}
}



?>