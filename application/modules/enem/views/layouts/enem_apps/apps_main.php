<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">

	    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<title><?php echo $enem_title;?></title>
		<link rel="stylesheet" type="text/css" href="/themes/enem_apps/media/css/app.min.css">
		<script type="text/javascript" src="/themes/enem_apps/media/js/jquery.min.js"></script>
	</head>
	<body>
		<section id="container">
			<?php
				if(isset($enem_header)){
					$this->load->view($enem_header);
				}
			?>
			<?php
				if(isset($enem_contents)){
					$this->load->view($enem_contents);
				}
			?>
			<?php
				if(isset($enem_footer)){
					$this->load->view($enem_footer);
				}
			?>
		</section>
		<!-- Modal Dynamic -->
		<div aria-hidden="true" aria-labelledby="enemModalDynamicLabel" role="dialog" tabindex="-1" id="enemModalDynamic" class="modal fade">
		    <div class="enem loading-modal" data-dismiss="modal">
		    	<i class="icon-spinner icon-spin"></i>
		    </div>
		    <div class="enem modal-dialog modal-dynamic">
		        <div class="enem modal-content">
		            <div class="enem modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title">Modal Dynamic</h4>
		            </div>
		            <div class="enem modal-body">
		                Enem Apps
		            </div>
		            <!-- <div class="modal-footer">
		                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                <button class="btn btn-success" type="button">Submit</button>
		            </div> -->
		        </div>
		    </div>
		</div>
		<!-- modal -->
		<script type="text/javascript" src="/themes/enem_apps/media/js/app.min.js"></script>
		<script type="text/javascript">
			Waves.init();
		    // Waves.attach('.enem_waves', ['waves-block']);
		    Waves.attach('.enem-waves', ['waves-block']);
		    enem.powerEnem();
		    // enem.powerWaves();
		    <?php
				// var_dump($js['js1']);exit();
				if(isset($js)) {
					// echo '<script>'.$js.'</script>';
					echo $js;
				}

				if(isset($js_modal)) {
					echo $js_modal;
				}
			?>
		</script>
		<?php
			// var_dump($js['js1']);exit();
			// if(isset($js)) {
			// 	echo '<script>'.$js.'</script>';
			// }
		?>
	</body>
</html>