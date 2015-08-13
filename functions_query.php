<?php 
	$survey = get_option('survey_quest');
	$indexi = $_REQUEST['id'];
	$index = base64_decode($indexi);
	if(isset($_POST['update_title']))
	{

		$survey[$index]['title'] = sanitize_text_field($_POST['tag-title']);
		update_option('survey_quest', $survey);
		$survey = get_option('survey_quest');

	}

	

?>