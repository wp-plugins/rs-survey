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

<?php $survey = get_option('survey_quest'); ?>
<?php $idi = $_REQUEST['id']; 
$id = base64_decode($idi);

?>
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
<h2>Welcome to RS Survey <a href="admin.php?page=survey-settings&id=<?php echo $idi; ?>&action=add_q" class="add-new-h2">Add Question</a></h2>

<?php if(!empty($survey[$id]['q'])) { ?>
<table class="wp-list-table widefat fixed striped posts">
	<thead>
		<tr>
			<th scope="col" id="cb" class="manage-column column-cb check-column" style=""><label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox"></th><th scope="col" id="title" class="manage-column column-title sortable desc" style=""><a href=""><span><?php echo $survey[$id]['title'];?></span></a></th><th scope="col" id="author" class="manage-column column-author" style="">Edit</th><th scope="col" id="categories" class="manage-column column-categories" style="">Delete</th>
		</tr>
	</thead>
		<tbody id="the-list">
		<?php  $optTitle = $survey[$id]['title'];
			   $q = $survey[$id]['q'];
			   if( $set_page <= $i && $i < $limt ){
		       if(!empty($q))
		       {
		       foreach ($q as $key => $value) {
				 ?>
			<tr>
				
				<th scope="row" class="check-column">
					<label class="screen-reader-text" for="cb-select-9">Select</label>
					<input id="cb-select-9" type="checkbox" name="" value="">
				</th>
				
				<td class="post-title page-title column-title"><strong><a class="row-title" href="admin.php?page=survey-settings& title=<?php echo $id; ?>&id=<?php echo $key; ?>&action=edit_q" title=""><?php echo $value;  ?> </a></strong>
					<div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
				</td>
				
				<td>
					<a href="admin.php?page=survey-settings& title=<?php echo $id; ?>&id=<?php echo $key; ?>&action=edit_q"><span class="dashicons dashicons-welcome-write-blog" style="margin-left:3px;"></span></a>
				</td>
				
				<td> 
					<a href="javascript:void(0)" style="margin-left:11px;" class="delete_q" data-id="<?php echo $key; ?>" data-title="<?php echo $id;  ?>" ><span class="dashicons dashicons-no" ></span></a>
				</td>
				
			</tr>
			<?php } }$i++; }
			$last_limit = ceil( $i / 10);
			?>
		</tbody>

</table>

<?php echo kriesi_pagination($last_limit); } else
{ ?>

	<div id="message" class="updated notice below-h2">
		<p>Nothing To Display Please Add a Question First</p>
	</div>
		
<?php 
}
?>

</div>

<script type="text/javascript">
	
	jQuery(document).ready(function()
	{
	  jQuery('.delete_q').on('click',function()
	  {
         var delQ = jQuery(this).data('id');
         var delt = jQuery(this).data('title');

         jQuery.ajax(
         {
            type: 'POST',
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            data:{'question_id' : delQ, 'delt' : delt ,'action' : 'delete_question' },
            success: function(data)
            {
            	
                location.reload();
               

       
            }
         });

	  });



	});


</script>
