<?php
/**
 * Template footer
 * @author Dijo David
 * 
 */
?>	
		<footer class="navbar-fixed-bottom copyright">
			Copyright &copy; <?php echo date('Y'); ?> <a href="http://noikochi.com" target="_blank">Naval Officers Institute</a>
			<span class="pull-right powered">
				Powered by <a href="http://www.sblcorp.com" target="_blank"><img border="0" width="25px" alt="SBL" src="<?php echo base_url();?>/assets/img/logo-sbl.png"></a>
			</span>
		</footer>
		
		<!-- Modal used to load through ajax call-->
	  	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    	<div class="modal-dialog">
	      		<div class="modal-content">
	        		<div class="modal-header">
		          		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		          		<h4 class="modal-title">Modal title</h4>
		        	</div>
			        <div class="modal-body clearfix"></div>
		 		</div><!-- /.modal-content -->
	    	</div><!-- /.modal-dialog -->
	  	</div>
	  	<!-- modal end -->
	  	
	  	<!-- Message box using set_flashdata -->
	  	<?php
	  		$notification = ""; //notification in top of page
	  		$msg_type = ""; //notification type
	  		
	  		if($this->session->flashdata('msg_popup'))
	  		{
	  			$notification = $this->session->flashdata('msg_popup');
				$msg_type = $this->session->flashdata('msg_type');
	  		}
			else 
			{
				//do nothing
			}
		?>
		
	  	<?php if($notification): ?>
		<div id="msg_box" class="alert" style="display:none">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo $notification; ?>
		</div>
		<?php endif; ?>
	  	<!-- Message box using set_flashdata end -->
	  	
	  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	  	<?php add_script("common.js"); ?>
	  	
	  	<script type="text/javascript">
	  		var msgType = "<?php echo $msg_type;?>";
	  		
	  		//autocomplete
	  		(function(){
				if($('.autocomplete').length > 0)
				{
					var url = '<?php echo base_url().$this->router->fetch_class();?>'+'/autocomplete';
					
					$('.autocomplete').autocomplete({source:url+'?'+($('form').serialize())});
				}
	  		})();
	  	</script>
	</body>
</html>