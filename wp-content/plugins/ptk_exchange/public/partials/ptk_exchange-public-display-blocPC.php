<?php

/**
 * Provide the view for a bloc
 *
 * 
 *
 * @link       josevillalobos.com
 * @since      1.0.0
 *
 * @package    Ptk_exchange
 * @subpackage Ptk_exchange/public/partials
 */
 
?>



						<article class="bloc <?php echo $this->class ?>">
							<!-- <?php echo $this->error ?> -->
							<a href="<?php echo $this->link ?>" id="photo_<?php echo $this->posterid ?>" data-photo-modal-url="<?php echo $this->link ?>">
							<span class="imbox <?php echo $this->classimbox ?>" style="" >
								<?php if($this->poster){ ?>
									<img src="<?php echo $this->poster ?>">
								<?php } ?>
								
							</span>
							<header>
							<?php //$this->put_title('<h2>','</h2>') ?>
							<h2><span class="photoreference"><?php echo $this->photoReference ?></span><span class="copyright"> © <?php echo $this->credit ?></span></h2>
							
							<?php $this->put_intro('<p>','</p>',150,"(....)") ?>
							<?php $this->put_intro('<p class="allintro">','</p>',false,"(....)") ?>
							<?php $this->put_subhead('<h3 class="photo-subhead">','</h3>') ?>
							</header>
							</a>
							<!--<button type="button"  class="addphoto" data-toggle="modal" data-target="#mimodal" data-photoid="<?php echo $this->posterid ?>"><i class="icoptk-plus"></i></button>-->
							<button type="button"  class="addphoto toadd" data-photoid="<?php echo $this->posterid ?>"><i class="icoptk-point"></i></button>
						</article>

