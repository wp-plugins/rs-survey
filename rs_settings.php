<style type="text/css">
.pagination {
clear:both;
padding:20px 0;
position:relative;
font-size:11px;
line-height:13px;

}

.pagination span, .pagination a {
display:block;
float:left;
margin: 2px 2px 2px 0;
padding:6px 9px 5px 9px;
text-decoration:none;
width:auto;
color:#a0a5aa;
background: #eee;
border-radius: 50px !important;
}

.pagination a:hover{
color:#fff;
background: #3279BB;
}

.pagination .current{
padding:6px 9px 5px 9px;
background: #3279BB;
color:#fff;
}
</style>

<?php 
	$page = $_REQUEST['paged'];
	 	$set_page = ($page - 1)*10;
	 	if(empty($page))
	 	{
	 		$set_page = 0;
	 	}
	 	$limt = $set_page + 10 ;
	 	$i=0;
?>
<div class="wrap">
	
	<?php  if(!isset($_REQUEST['action']))
	  {
	 ?>
	 <h2>Welcome to RS Survey <a href="admin.php?page=add-survey" class="add-new-h2">Add Survey</a></h2>
	<?php $title = get_option('survey_quest'); ?>
	
<?php if(!empty($title)) { ?>
<table class="wp-list-table widefat fixed striped posts">
	<thead>
		<tr>
			<th scope="col" id="cb" class="manage-column column-cb check-column" style=""><label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox"></th><th scope="col" id="title" class="manage-column column-title sortable desc" style=""><a href=""><span>Title</span></a></th><th scope="col" id="author" class="manage-column column-author" style="">View</th><th scope="col" id="categories" class="manage-column column-categories" style="">Edit</th><th scope="col" id="tags" class="manage-column column-tags" style="">Delete</th><th scope="col" id="author" class="manage-column column-author" style="">Results</th>
		</tr>
	</thead>
		
		<tbody id="the-list">
			<?php foreach ($title as $key => $value) { 
			if( $set_page <= $i && $i < $limt ){
			?>
			<tr>
				
				<th scope="row" class="check-column">
					<label class="screen-reader-text" for="cb-select-9">Select</label>
					<input id="cb-select-9" type="checkbox" name="" value="">
				</th>
				
				<td class="post-title page-title column-title"><strong><a class="row-title" href="admin.php?page=survey-settings&id=<?php echo base64_encode($key); ?>&action=view" title=""> <?php echo $value['title'];  ?></a></strong>
					<div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
				</td>
				
				<td>
					<a href="admin.php?page=survey-settings&id=<?php echo base64_encode($key); ?>&action=view" ><span class="dashicons dashicons-welcome-view-site" style="margin-left:6px;"></span></a>
				</td>
				
				<td>
					<a href="admin.php?page=survey-settings&id=<?php echo base64_encode($key); ?>&action=edit"><span class="dashicons dashicons-welcome-write-blog" style="margin-left:3px;"></span></a>
				</td>
				
				<td> 
					<a href="javascript:void(0)" style="margin-left:11px;" class="delete_t" data-id="<?php echo $key; ?>" ><span class="dashicons dashicons-no" ></span></a>
				</td>
				
				<td> 
					<a href="admin.php?page=survey-settings&id=<?php echo base64_encode($key); ?>&action=view_r"><span class="dashicons dashicons-media-text" style="margin-left:13px;"></span></a>
				</td>

			</tr>
			<?php } $i++; }
			$last_limit = ceil( $i / 10);
			?>
		</tbody>

</table>
<?php echo kriesi_pagination($last_limit); }else{ ?>

	<div id="message" class="updated notice below-h2">
		<p>Nothing To Display Please Add a Survey First</p>
	</div>
		
	<?php }?>
	<?php
	 }
	?>

</div>
<?php
 if($_REQUEST['action'] == 'view')
 {
 	include('view_question.php');
 }

?>



<?php 
if($_REQUEST['action'] == 'add_q')
{
	include('add_questions.php');
}
?>

<?php 
if($_REQUEST['action'] == 'edit')
{
	include('edit_title.php');
}
?>

<?php 
if($_REQUEST['action'] == 'view_r')
{
	include('results.php');
}
?>

<?php
 if($_REQUEST['action'] == 'view_l')
 {
 	include('view_detail_result.php');
 }

?>


<?php 

if(isset($_POST['update_question']))
{
   $questions = get_option('survey_quest');
    $title_id = $_POST['title'];
    $q_id = $_POST['q_id'];
	$questions[$title_id]['q'][$q_id] = $_POST['tag-question'];
	$questions[$title_id]['c'][$q_id]= $_POST['add-option'];
	$test = sanitize_option('survey_quest', $questions);
	update_option('survey_quest',$test);
	
}


?>
<?php 
if($_REQUEST['action'] == 'edit_q')
{
	include('edit_questions.php');

}
?>
<script>
	
	jQuery(document).ready(function()
	{
	  jQuery('.delete_t').on('click',function()
	  {
         var delId = jQuery(this).data('id');
         jQuery.ajax(
         {
            type: 'POST',
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            data:{'title_id' : delId, 'action' : 'delete_quest' },
            success: function(data)
            {
                location.reload();

       
            }
         });

	  });



	});
</script>

