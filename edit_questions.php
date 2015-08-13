<?php
$questions = get_option('survey_quest');
$title_id = $_REQUEST['title'];
$q_id = $_REQUEST['id'];
?>

<div class="wrap">
	<h2>Welcome to RS Survey </h2>
<?php if (count($_POST)>0){ ?>
<div id="message" class="updated notice is-dismissible below-h2"><p>Question Updated Successfully</p> </div>
<?php } ?>
	
	<form class="novalidate" id="addtag" action="" method="POST">
		<table class="form-table">
			<tr>
				<th scope="row"><label for="blogname">Survey Title</label></th>
				<td>
					<?php echo $questions[$title_id]['title']; ?>
				</td>
			</tr>
			<?php 
			$ques = $questions[$title_id]['q'][$q_id];
			?>
			<tr>
				<th scope="row"><label for="blogname">Question</label></th>
				<td>
					<input type="hidden" name="title" value="<?php echo $_REQUEST['title']; ?>">
					<input type="hidden" name="q_id" value="<?php echo $_REQUEST['id']; ?>">
					<input name="tag-question" type="text" value="<?php echo $ques; ?>" size="40" required />
				</td>
			</tr>
			<?php 
			$options = $questions[$title_id]['c'][$q_id];
			if(!empty($options)) {
				$index = 1;
			foreach ($options as  $key =>$value){  ?> 
			<tr>
				<th scope="row"><label for="blogname">Option</label></th>
				<td>
					<input name="add-option[]" type="text" value="<?php echo $value; ?>" size="40" required /><?php echo $delete = ($index>=3) ? "<input type='button' class='button del_opt'  value='delete' data-id=\"$key\" data-title=\"$title_id\" data-qid=\"$q_id\" >" : '' ?>
				</td>
			</tr>
			<?php $index++; } } ?>
			<input type='submit' class='btn btn-primary' value='submit' id='update' style='display:none' name='update_question' >
		</table>
	</form> <br>
			<input type='button' class='button' value='Add+' id='add'>
			<button type='button' class='button'  id='update_q' >Update</button>
		
</div>

<script type="text/javascript">
jQuery(document).ready(function(){
	var i = 2;
	jQuery('#add').on('click',function(){
		i = i+1;
		var options = "<tr id='op-"+i+"'><th scope='row'><label for='blogname' >Option</label></th><td><input name='add-option[]' type='text' value='' size='40' required /><input type='button' class='button deleteq'  value='delete' data-id ='"+i+"' id='delete-"+i+"' ></td></tr>";
      
		jQuery(options).clone().appendTo( ".form-table" );
	});

jQuery(document).on("click", ".deleteq", function() 
   {
       var id = jQuery(this).data('id');
	   jQuery('#op-'+id).remove();
	   jQuery('#delete-'+id).remove();

   });

jQuery('#update_q').on("click",function()
   {
      jQuery('#update').trigger('click');
   });

});

jQuery('.del_opt').on('click',function()
	  {
         var opt_id = jQuery(this).data('id');
         var title_id = jQuery(this).data('title');
         var ques_id = jQuery(this).data('qid');

         jQuery.ajax(
         {
            type: 'POST',
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            data:{'opt_id' : opt_id, 'title_id' : title_id, 'ques_id': ques_id, 'action' : 'delete_options' },
            success: function(data)
            {
               location.reload();

       
            }
         });

	  });

</script>