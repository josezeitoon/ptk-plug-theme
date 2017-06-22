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

<div class="photographeslist col-lg-4 col-md-6 col-sm-12">
		<header class="entry-header">
			<div id ="serie-titles">
				<h2><?php  echo __($liste["title"]) ; ?></h2>
			</div>
		
		</header>
	
	
	<?php if($liste["photographe_s"]){  ?>
		<ul>
			<?php foreach($liste["photographe_s"] as $photographe){  ?>
				
						
							<li><a href="/folder/?ref=<?php echo $photographe["id"]; ?>" ><?php echo $photographe["nom"]; ?></a></li>
	
			<?php }  ?>
		</ul>
	<?php }  ?>
</div>