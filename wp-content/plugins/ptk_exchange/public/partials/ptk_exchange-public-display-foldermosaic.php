<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       josevillalobos.com
 * @since      1.0.0
 *
 * @package    Ptk_exchange
 * @subpackage Ptk_exchange/public/partials
 */
 
?>
<!--
	<h1><?php echo __($foldermosaic->title) ?></h1>
	<p>
	<?php  echo $content  ?>
	</p>-->
	

	<header class="entry-header">
	
		
		<?php  $foldermosaic->put_title('<h1 class="entry-title">','</h1>'); //only for level 2 ?>
		
	</header>
	
	
	
	<?php if($line_s){  ?>
		<div id="blocs" class="container <?php echo $foldermosaic->hautdouble ?>"><div class="row">
			<?php foreach($line_s as $blocs){  ?>
		
				
			
					<?php foreach($blocs as $bloc){  ?>
				
						
							<?php $bloc->display(); ?>
				
				
					<?php }  ?>
			
				
	
	
			<?php }  ?></div>
		</div>
	<?php }  ?>

