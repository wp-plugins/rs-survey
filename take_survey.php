<?php 

$surv = array();
for($j=0 ; $j<sizeof($survey_q['q']); $j++)
{
	$surv[$j]['q']= $survey_q['q'][$j];
	foreach($survey_q['c'][$j] as $c=> $choice)
	{
		$surv[$j]['choices'][$c] = $choice;
	}
} ?>
	<h5 class="widget-title"><?php echo $survey_q['title']; ?></h5>
<?php

?>

<form name='survey' method='post' action='' id='survey-form'>
<input type='hidden' value='<?php echo sizeOf($surv)-1 ?>' id='qu-st' />

 <p class='alert-warning' id='choosen-warning' style='display:none;'>Must required an answer to proceed!!! </p>
<?php
	if(!empty($surv))
	{
   foreach($surv as $key => $ques)
   {
       // echo "<pre>";
       // print_r($ques);
	   // echo "</pre>";
	   // die();
     ?>	 
	 <div id='question-<?php echo $key ?>' style='display:none;' class='question quest'>
	 	<input type="hidden" value='<?php echo $title_id; ?>' name='t_id'>
	   <p><b><?php echo $key+1;  ?> )  <?php echo $ques['q'];  ?></b></p>
	   <input type="hidden" value='<?php echo $key; ?>' name='q_id[<?php echo $key ?>]'>
	   
	 <?php
	   foreach($ques['choices'] as $c => $choice)
	   {  
	   ?>
	       <label>
	       <input type = 'radio' name='choices[<?php echo $key  ?>]' value='<?php echo $c ?>'  class='question-<?php echo $key ?>-radio' required />
		   </label>
		   <span class='choice-option'><?php echo $choice  ?><span><br/>

		   
	      
	       
	 <?php  }
	 echo '</div>';
   }

?>
<!-- api connective modal  -->
<div class='api-info' style='display:none'>
<!-- pdf form text -->
   <p style='text-align:center; font-size:24px; font-weight:600'>Please Submit to Finish Survey!!!</p>
   
</div>


<!-- end api connective modal -->

<input type='button' value='previous'  id='pre' style='display:none' />
<input type='button' value='Next'  id='next'  />
<input type='button' value='Finish'  id='sub' style='display:none'  />
<input type='submit' id='send' value='invia' style='display:none;' name='send' style= />
<div class='submit-image'><input type='button' id='submit-image' value='Submit' ></div>
</form> <?php 
}
else
{
?>
	<p class="site-description">This Survey is not Active yet Please try another!!!</p>
<?php
}
 ?>
<script>
	
	 var i = 0;
   jQuery('#question-0').show();
   jQuery('#next').addClass('question-'+i);
    

   if(i > 0)
   {
      jQuery('#pre').show();

   }
   
   jQuery('.question-'+i).on('click',function(event)
   {  
     jQuery('#choosen-warning').hide();
     var checked = 1;
	 jQuery('.question-'+i+'-radio').each(function() {
		  if(jQuery(this).prop("checked") == false)
		  {
		     
			 checked = 0;
			
		  }
		  else
		  {
		     checked = 1;
		     return false;
		  }
	 });
	if(checked == 0)
	{
		  // alert(' You have to choose one option !');
		  jQuery('#choosen-warning').show();
		  
		  
	}
	if(checked == 1)
	{
	 
      i = i+1;
	 if(jQuery('#qu-st').val() == i)
	  {
			jQuery('#pre,#next').hide();
			jQuery('#sub').show();
			
			
	  }
      jQuery('.quest').css('display','none');
	  jQuery('#question-'+(i)).fadeIn();
	  jQuery('#next').removeClass('question-'+(i-1));
	  jQuery('#next').addClass('question-'+(i));
	  if(i > 0)
      {
			jQuery('#pre').show();
      }
	  else
	  {
	        jQuery('#pre').hide();
	  }
	  
	  if(i > 0)
	  {
	      jQuery('#pre').addClass('prequest-'+(i-1));
	  }
	  
	}
	  
	  
	  
   });
   
   jQuery('#pre').on('click',function()
   {
       jQuery('#sub,.submit-image,.api-info,#choosen-warning').hide();
	   jQuery('#next').show();
     i = i-1;
	 if(i < 1)
	 {
	    jQuery(this).hide();
	 }
	 jQuery('.quest').css('display','none');
	 jQuery('#question-'+(i)).fadeIn();
	 jQuery('#next').removeClass('question-'+(i));
	 jQuery('#next').addClass('question-'+(i+1));
   });
   
   jQuery('#sub').on('click',function()
   {        jQuery('.quest,#pre').hide();
       	jQuery('.api-info').fadeIn();		
		jQuery(this).hide();
		jQuery('.submit-image').show();
   });
   
   jQuery('#submit-image').on('click',function()
   {
       jQuery('#send').trigger('click');;
   });
   
   
   
</script>