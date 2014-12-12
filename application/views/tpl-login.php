<?php
/**
 * Login template
 * @author Dijo David
 * 
 */
?>

<?php $this->load->view("header"); ?>

<div id="container" class="clearfix">
	<article id="content" class="center-block" style="width:750px; margin:auto">
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