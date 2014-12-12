<?php
/**
 * Default template
 * @author Dijo David
 * 
 */
?>

<?php $this->load->view("header"); ?>

<div id="container" class="clearfix container">
	<?php
		$content_cls = "col-lg-12"; //content class to set the grid
	?>
	
	<article id="content" class="<?php echo $content_cls; ?>">
		<?php
			if(isset($page_title))
			{
		  		echo '<div class="page-header">';
				echo '<h3>'.$page_title.'</h3>';
				echo '</div>';
			}
		?>
		<?php echo $contents ?>
	</article>
</div>

<?php $this->load->view("footer"); ?>