<div class="wrap">

	<?php
	if(isset($_POST['add_email']))
		{
			$email = sanitize_email($_POST['tag-email']);
			update_user_meta(get_current_user_id(), 'rs_admin_email', $email);
		}
         $rs_admin_email= get_user_meta(get_current_user_id(),'rs_admin_email', true);
	 ?>
	<h2>Welcome to RS Survey</h2>
	<?php if (count($_POST)>0){ ?>
	<div id="message" class="updated notice is-dismissible below-h2"><p>Email Added Successfully</p> </div>
	<?php } ?>
	<form class="novalidate" id="addsettings" action="" method="POST">
		<table class="form-table">
				
			<tr>
				<th scope="row"><label for="blogname">Email Address</label></th>
				<td>
					<input name="tag-email" type="email" value="<?php echo $admin_e = (!empty( $rs_admin_email)) ? $rs_admin_email : '' ;?>" size="40" placeholder="rs@email.com" required />
					<p class="description">Provide E-mail to get Survey Reports!!</p>
				</td>
			</tr>
			
			<input type='submit' class='btn btn-primary' value='submit' id='submit_e' style='display:none' name='add_email' >
		</table>
	</form> <br>
		<button type='button' class='button'  id='email' >Submit</button>
</div>

<script type="text/javascript">
	
	jQuery(document).ready(function(){
		jQuery('#email').on("click",function()
	   {
	      jQuery('#submit_e').trigger('click');
	   });

	});
</script>

<?php 




?>