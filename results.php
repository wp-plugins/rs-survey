<?php
$t_idi = $_REQUEST['id'];
$t_id  = base64_decode($t_idi);
$results = get_option('survey_taken');
$survey = get_option('survey_quest');
$res = array();
for($j=0; $j<sizeof($results); $j++)
{
  if($t_id == $results[$j]['title'] )
  {
       array_push($res,$results[$j]);
       
  }

}

?>

<div class="wrap">
<h2>Welcome to RS Survey </h2>
<?php if(!empty($results[$t_id])) {?>
	<table class="wp-list-table widefat fixed striped posts">
	<thead>
		<tr>
			<th scope="col" id="cb" class="manage-column column-cb check-column" style=""><label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox"></th><th scope="col" id="title" class="manage-column column-title sortable desc" style=""><a href=""><span>Results</span></a></th><th scope="col" id="author" class="manage-column column-author" style="">View</th>
		</tr>
	</thead>
		<?php for($k=0; $k<sizeof($res); $k++)
			{ 

			?>
		<tbody id="the-list">
			
			<tr>
				
				<th scope="row" class="check-column">
					<label class="screen-reader-text" for="cb-select-9">Select</label>
					<input id="cb-select-9" type="checkbox" name="" value="">
				</th>
				
				<td class="post-title page-title column-title"><strong><a class="row-title" href="admin.php?page=survey-settings&id=<?php echo base64_encode($k); ?>&title=<?php echo base64_encode($t_id); ?>&action=view_l"> <?php echo "Survey Result--".($k+1);  ?></a></strong>
					<div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
				</td>
				
				<td>
					<a href="admin.php?page=survey-settings&id=<?php echo base64_encode($k); ?>&title=<?php echo base64_encode($t_id); ?>&action=view_l" ><span class="dashicons dashicons-welcome-view-site" style="margin-left:6px;"></span></a>
				</td>
				
			</tr>
			<?php } ?>
		</tbody>

</table>

<?php }
else
	{ ?>

	<div id="message" class="updated notice below-h2">
		<p>Nothing To Display!! No result</p>
	</div>

<?php }
?>
</div>



