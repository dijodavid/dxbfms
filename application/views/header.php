<?php
/**
 * Template Header
 * @author Dijo David
 * 
 */
	//set default timezone
	date_default_timezone_set("Asia/Kolkata");	
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo (isset($title)) ? $title : "DXBFMS"; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<?php //load_css_files(array("style.css", "template.css","docs.css","jquery-ui-1.10.3.custom")); ?>
    	<?php //add_stylesheet("template.css"); ?>
    	
    	<?php //add_script("jquery-1.8.2.min.js"); ?>
		<?php //load_js_files(array("jquery-1.8.2.min.js", "bootstrap.js", "noi.js")); ?>
		
		<script type="text/javascript">
			var baseUrl = "<?php echo base_url();?>";
			var classUrl = "<?php echo base_url().$this->router->fetch_class();?>";
		</script>
	</head>
	
	<body>
		<header class="navbar navbar-default" role="navigation">
		  	<!-- Brand and toggle get grouped for better mobile display -->
		  	<div class="navbar-header">
		    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		     	 	<span class="icon-bar"></span>
			      	<span class="icon-bar"></span>
			      	<span class="icon-bar"></span>
			    </button>
		    	<!-- <a class="navbar-brand" href="<?php echo base_url();?>">
		    		<img class="img-responsive" src="<?php echo base_url();?>assets/img/logo.png" alt="Logo" width="75px" /> 
		    	</a> -->
		  	</div>
		  	
  		 	<nav id="top_nav" class="">
	  	 		<?php if( !$this->ion_auth->logged_in() ): ?>
		  	 	<ul class="nav navbar-nav">
					<?php foreach($nav_list  as $i => $nav_item): ?>
						
						<?php if (is_array($nav_item)): ?>
							<li class="dropdown <?php echo array_key_exists($nav, $nav_item) ? "active": "";?>">
        					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ucfirst($i); ?> <b class="caret"></b></a>
							
							<ul class="dropdown-menu">
							<?php foreach($nav_item  as $i => $nav_item): ?>
								<li class="<?php echo ($nav == $i ? 'active' : '')?>">
									<?php echo anchor(strtolower($nav_item), ucfirst($i)) ?>
								</li>
							<?php endforeach; ?>
							</ul>
							
						<?php else: ?>
							<li class="<?php echo ($nav == $i ? 'active' : '')?>">
								<?php echo anchor(strtolower($nav_item), ucfirst($i)) ?>
							</li>
						<?php endif; ?>
						
					<?php endforeach ?>
				</ul>
				<form action="<?php echo base_url();?>auth/logout">
					<input type="submit" class="btn btn-danger navbar-btn pull-right" value="Logout">
				</form>
		      	<?php endif; ?>
	  	 	</nav>
		</header>