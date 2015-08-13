<?php
	$survey = get_option('survey_quest');
	
	if(isset($_POST['add_title']))
	{
		if(sizeof($survey) == 0)
		{
	       delete_option('survey_quest');
		}

		if(empty($survey))
		{
			$surv = array();
			$surv[0]['title'] = sanitize_text_field($_POST['tag-title']);
			add_option('survey_quest',$surv);
		}
		
		else
		{
			$index = sizeof($survey);
			$surv = array();
			$surv[$index]['title'] = sanitize_text_field($_POST['tag-title']);
			$survey_new = array_merge($survey,$surv);
			update_option('survey_quest', $survey_new);
		}
		
	}


?>