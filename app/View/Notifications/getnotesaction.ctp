<?php
/*

this is notificationa

*/

?>
<?php if(!empty($mytactonitems)) 
{
	foreach($mytactonitems as $key=>$actions)
	{
?>
	<div class="single-action">
		<input data-original-title="mark as done" <?php echo $actions['Actionitems']['completed']==1? 'checked':'' ?> data-rel="tooltip" type="checkbox" name="close" class="mark-as-complete" alt="<?php echo $actions['Actionitems']['id']; ?>">
		<div contenteditable="false" class="items-action <?php echo $actions['Actionitems']['completed']==1? 'mark-done':'' ?>"> 
			<?php echo $actions['Actionitems']['action_content'] ;?>
		</div>
	</div>
<?php 
	}
} ?>
