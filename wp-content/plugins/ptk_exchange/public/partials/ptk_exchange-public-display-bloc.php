<?php

/**
 * Provide the view for a bloc of kind Ptk_exchange_Bloc (public/class-ptk_exchange_bloc.php)
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
							<a href="<?php echo $this->link ?>">
							<span class="imbox <?php echo $this->classimbox ?>" style="" >
								<?php if($this->poster){ ?>
									<img src="<?php echo $this->poster ?>" alt="" class="zz <?php echo $this->classimg ?>">
								<?php } ?>
							</span>
							<header>
								
								<?php $this->put_title('<h2>','</h2>') ?>
								<?php $this->put_subhead('<h3>','</h3>') ?>
							</header>
							</a>
						</article>
