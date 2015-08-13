<?php 
$survey = get_option('survey_quest'); 
$idi = $_REQUEST['id'];
$id = base64_decode($idi);

$questionArray= $survey[$id]['q'];
$choiceArray= $survey[$id]['c'];

if(isset($_POST['add_question']))
{
	$title = $_POST['title'];
	$q = $_POST['tag-question'];

	if(empty($questionArray) && empty($choiceArray))
    {
	   $questionArray[] = $q;
	   $ch[] = $_POST['add-option'];
    } 
    else
    {
		$questionArray= $survey[$id]['q'];
        array_push($questionArray,$q);

         $choices[] = $_POST['add-option'];
         $ch = array_merge($choiceArray,$choices);
    
    }
    $surv[0]['title'] = $title;
    $surv[0]['q'] = $questionArray;
    $surv[0]['c'] = $ch;
    $survey[$id] = $surv[0];
    $test = sanitize_option('survey_taken', $survey);
    update_option('survey_quest',$test);

}

?>