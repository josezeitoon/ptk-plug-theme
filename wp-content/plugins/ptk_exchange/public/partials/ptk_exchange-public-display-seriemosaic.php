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

<div class="seriemosaic container" >
		<div class="row">
		<div id="seriethumb">
			<?php  $seriemosaic->put_thumb();  ?>
		</div>
		<div id="seriestory">
			<header class="entry-header">
				<div id ="serie-titles">
					<?php  $seriemosaic->put_title('<h1 class="entry-title">','</h1>');  ?>
					<?php  $seriemosaic->put_author('<h2 class="entry-author">','</h2>');  ?>
				</div>
		
			</header>
	
	
			<div id="entry-content">
				<?php  $seriemosaic->put_story('<p>','</p>');  ?>
			</div>
			
		</div>
		</div>
		
	<?php if($line_s){  ?>
		<div id="blocs" class="container pc"><div class="row">
			<?php foreach($line_s as $blocs){  ?>
		
				
			
					<?php foreach($blocs as $bloc){  ?>
				
						
							<?php $bloc->displayPC(); ?>
				
				
					<?php }  ?>
			
				
	
	
			<?php }  ?></div>
		</div>
	<?php }  ?>
</div>