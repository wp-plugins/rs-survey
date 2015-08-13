<?php
	include('query.php');
?>
<?php $title = get_option('survey_quest'); ?>
<?php $idi = $_REQUEST['id']; 
$id = base64_decode($idi);

?>

<div class="wrap">
<h2>Welcome to RS Survey </h2>
<?php if (count($_POST)>0){ ?>
<div id="message" class="updated notice is-dismissible below-h2"><p>Question Added Successfully</p> </div>
<?php } ?>	
	
		<form class="novalidate" id="addtag" action="" method="POST">
		<table class="form-table">
				<tr>
					<th scope="row"><label for="blogname">Survey Title</label></th>
					<td>
						<?php echo $title[$id]['title']; ?>
					</td>
				</tr>
				
				<tr>
					<th scope="row"><label for="blogname">Question</label></th>
					<td>
						<input type="hidden" name="title" value="<?php echo $survey[$id]['title']; ?>">
						<input name="tag-question" type="text" value="" size="40" required />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="blogname">Option 1</label></th>
					<td>
						<input name="add-option[]" type="text" value="" size="40" required />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="blogname">Option 2</label></th>
					<td>
						<input name="add-option[]" type="text" value="" size="40" required />
					</td>
				</tr>

				<input type='submit' class='btn btn-primary' value='submit' id='submit' style='display:none' name='add_question' >
			</table>
		</form> <br>
			<input type='button' class='button' value='Add+' id='add'>
			<button type='button' class='button'  id='sub' >Submit</button>
		

</div>

<script type="text/javascript">
jQuery(document).ready(function(){
	var i = 2;
	jQuery('#add').on('click',function(){
		i = i+1;
		var options = "<tr id='op-"+i+"'><th scope='row'><label for='blogname' >Option &nbsp;"+ i +"</label></th><td><input name='add-option[]' type='text' value='' size='40' required /><input type='button' class='button deleteq'  value='delete' data-id ='"+i+"' id='delete-"+i+"' ></td></tr>";
      
		jQuery(options).clone().appendTo( ".form-table" );
	});

jQuery(document).on("click", ".deleteq", function() 
   {
       var id = jQuery(this).data('id');
	   jQuery('#op-'+id).remove();
	   jQuery('#delete-'+id).remove();

   });

jQuery('#sub').on("click",function()
   {
      jQuery('#submit').trigger('click');
   });
});
</script>