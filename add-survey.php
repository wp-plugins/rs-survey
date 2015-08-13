<?php include('title_function.php'); ?>
<div class="wrap">
	<h2>Welcome to RS Survey </h2>
	<?php if (count($_POST)>0){ ?>
		<div id="message" class="updated notice is-dismissible below-h2"><p>Survey created successfully!!!</p> </div>
	<?php } ?>
	<form class="novalidate" id="add_survey" action="" method="POST">
		<table class="form-table">
				<tr>
					<th scope="row"><label for="blogname">Add Survey Title</label></th>
					<td>
						<input name="tag-title" type="text" id="blogdescription" size="40" placeholder="Survey Title Here" required />
						<p class="description" id="tagline-description">Choose a title for your Survey</p> <br>
						<input type='submit' class='button' value='Add Title' id='submit' name='add_title' >
					</td>
				</tr>
			</table>
		</form>
</div>