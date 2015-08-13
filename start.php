<?php 
include(plugin_dir_path( __FILE__ ).'/quest.php');
if(isset($_POST['send']))
{
    $survey_taken = get_option('survey_taken');
    if(sizeof($survey_taken) == 0)
	{
       delete_option('survey_taken');
	}
    if(empty($survey_taken))
    {
        
    	$result = array();
    	$result[0]['title'] = $_POST['t_id'];
    	$result[0]['q'] = $_POST['q_id'];
    	$result[0]['c'] = $_POST['choices'];
        $test = sanitize_option('survey_taken', $result);
    	add_option('survey_taken',$test);

    }
    else
    {
    	$index = sizeof($survey_taken);
    	$result = array();
    	$result[$index]['title'] = $_POST['t_id'];
    	$result[$index]['q'] = $_POST['q_id'];
    	$result[$index]['c'] = $_POST['choices'];
    	$survey_new = array_merge($survey_taken,$result);
        $test = sanitize_option('survey_taken', $survey_new);
    	update_option('survey_taken', $test);
    }

    $rs_admin_email= get_user_meta(get_current_user_id(),'rs_admin_email', true);

    $headers = 'From: My Name <myname@example.com>' . "\r\n";
	wp_mail( $rs_admin_email, 'Notification:Survey Completed', 'A Survey on your website is Submitted by a user Please Check results to View.', $headers);

    echo "Thank You!!!! Your Survey Submitted Successfully";
    

}

 ?>

 <div class="survey_titles">
<?php if(!isset($_POST['send'])){  ?>

<?php
	if(!empty($surv))
	{
        ?>
        <p class="site-description">Choose a Topic to start Survey!!</p> <br>
        <?php
		foreach($surv as $key => $value)
		{ ?>
			<ul>
				<li> <a href="javascript:viod(0)" class="topics" data-id='<?php echo $key;?>' style="text-decoration:none;"> <?php echo $value['title']; ?> </a> </li>
			</ul>
	<?php 
	}
	}

?>






<?php } ?>
</div>

<div class="start_survey" style="display:none;">

</div>

<script type="text/javascript">
jQuery(document).ready(function()
{
	jQuery('.topics').on('click',function()
   {
      
	 jQuery('.survey_titles').hide();
	 jQuery('.start_survey').show();
	 var title_key = jQuery(this).data('id');
         jQuery.ajax(
         {
            type: 'POST',
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            data:{'title_id' : title_key, 'action' : 'all_questions' },
            success: function(data)
            {
                //location.reload();
                //alert(data);
                jQuery('.start_survey').html(data);

       
            }
         });
   });



});


</script>



<!-- <input type='button' value='Previous'  id='pre' style='display:none' />
<input type='button' value='Next'  id='next'  />
<input type='button' value='End'  id='sub' style='display:none'  />
<input type='submit' id='send' value='invia' style='display:none;' name='send' style= />
 -->