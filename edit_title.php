<?php include('functions_query.php'); ?>
<?php $survey = get_option('survey_quest'); ?>
<?php $idi = $_REQUEST['id']; 
$id = base64_decode($idi);

?>
<div class="wrap">
	<h2>Welcome to RS Survey </h2>
	<?php if (count($_POST)>0){ ?>
		<div id="message" class="updated notice is-dismissible below-h2"><p>Survey title successfully Updated!!!</p> </div>
	<?php } ?>
	<form class="novalidate" id="add_survey" action="" method="POST">
		<table class="form-table">
				<tr>
					<th scope="row"><label for="blogname">Add Survey Title</label></th>
					<td>
						<input name="tag-title" type="text" id="blogdescription" size="40" value="<?php echo $survey[$id]['title']; ?>" required />
						<p class="description" id="tagline-description">Edit title for your Survey</p> <br>
						<input type='submit' class='button' value='Update Title' id='submit' name='update_title' >
					</td>
				</tr>
			</table>
		</form>
</div>