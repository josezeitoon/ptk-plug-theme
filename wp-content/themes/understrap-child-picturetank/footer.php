<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_sidebar( 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_html( $container ); ?>">

		<div class="row">

			<div class="col-sm-12">

				<footer class="site-footer bg-silver" id="colophon">

				<h4>
					<a href="#">English</a> | <span>Français</span>
									</h4>
				<br><br><br>
			</div>
			<div class="col-sm-5">
				<h4>Restez informé de notre actualité et productions</h4>
				<p>
					<form action="/newsletter/register">
						<div class="input-group">
							<input type="text" class="form-control" name="email" placeholder="Your email">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">OK</button>
							</span>
						</div>
					</form>
				</p>
				<br>
				<h4>Suivez-nous</h4>
				<p>
					<a class="social ig" href="http://instagram.com/Picturetank_agency" target="_blank"><span class="ti-instagram"></span></a>
					<a class="social fb" href="http://facebook.com/picturetankagency" target="_blank"><span class="ti-facebook"></span></a>
					<a class="social tw" href="http://twitter.com/Picturetank" target="_blank"><span class="ti-twitter"></span></a>
				</p>
			</div>
			<div class="col-sm-5 offset-sm-2">
				<h4>Picturetank est une agence photo coopérative basée à Paris.</h4>
				<p>
					<a style="margin-top:8px;" href="#" class="btn btn-primary">A propos de picturetank
					<span class="ti-arrow-right"></span></a>
				</p>
				<br>
				<h4>Nous contacter</h4>
				<p>
					<script type="text/javascript" language="javascript">
					eval(unescape('%76%61%72%20%61%3D%27%65%64%6B%73%70%40%63%69%75%74%65%72%61%74%6B%6E%63%2E%6D%6F%27%3B%76%61%72%20%64%3D%27%27%3B%20%76%61%72%20%62%3D%27%27%3B%66%6F%72%28%76%61%72%20%63%3D%30%3B%63%3C%61%2E%6C%65%6E%67%74%68%3B%63%2B%2B%2C%63%2B%2B%29%7B%62%3D%62%2B%61%2E%73%75%62%73%74%72%69%6E%67%28%63%2B%31%2C%63%2B%32%29%2B%61%2E%73%75%62%73%74%72%69%6E%67%28%63%2C%63%2B%31%29%7D%64%6F%63%75%6D%65%6E%74%2E%77%72%69%74%65%28%27%3C%61%20%68%72%65%66%3D%22%6D%61%69%6C%74%6F%3A%27%2B%62%2B%64%2B%27%22%20%74%69%74%6C%65%3D%22%27%2B%62%2B%27%22%3E%27%2B%62%2B%27%3C%2F%61%3E%27%29'));
					</script>
				</p>
				<p>Tél. : +33 1 43 15 63 53</p>
			</div>
			<div class="col-sm-12" style="margin:60px 0;">
				<div class="text-center">
					<h4>©&nbsp;2003-2017&nbsp;Scic&nbsp;Picturetank. Tous droits reservés.
						<a href="/en/terms_of_use">Conditions d&#039;utilisation du site</a>.</h4>
				</div>

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page -->

<!-- #page 
<div id="modal-photo">
	<div id="modal-photo-content"></div>
	<div id="modal-photo-nav">
		<a class="btn btn-lg btn-black pull-left btn-photo-newwindow" href="#/" target="_blank"><span class="ti-new-window"></span></a>
		<span class="btn btn-lg btn-black btn-photo-close"><span class="ti-close"></span></span>
		<span class="btn btn-lg btn-black btn-photo-prev"><span class="ti-arrow-left"></span></span>
		<span class="btn btn-lg btn-black btn-photo-next"><span class="ti-arrow-right"></span></span>
	</div>
</div>
-->

<div id="modal-photo" style="display: none;">
	<div id="modal-photo-content"><div class="pageContent">
		<div class="container">
		<div class="row photo-file">
			<div class="col-sm-12">
				<p>
					<a href="" class="btn btn-small btn-default"><span class="ti-download"></span> Télécharger </a>
					<!--					<button class="btn btn-small btn-default"><span class="ti-folder"></span> Lightbox </button>-->
				</p>
			</div>
			<div class=" col-sm-8">
				<div class="text-right">
					<img class="photo-img-file vertical" data-src-lo="" data-src-hi="" src="">
				</div>
				<br>
				<p class="photo-credit">
					<span class="photo-reference"></span>
					<span class="photo-copyright"></span><br>
					<br>
				</p>
				<p class="text text-danger small">
					
				</p>
				
			</div>
			<div class="col-sm-4">
			
			<p class="legend"></p>
			<p class="locationdate"></p>
				
			</div>
		</div>
	</div>
	
	</div></div>
	<div id="modal-photo-nav">
		<a class="btn btn-lg btn-black pull-left btn-photo-newwindow" href="/fr/photo/650952-e9a61a6d/DAG-0650952/" target="_blank"><span class="ti-new-window"></span></a>
		<span class="btn btn-lg btn-black btn-photo-close"><span class="ti-close"></span></span>
		<span class="btn btn-lg btn-black btn-photo-prev"><span class="ti-arrow-left"></span></span>
		<span class="btn btn-lg btn-black btn-photo-next"><span class="ti-arrow-right"></span></span>
		<span class="ptkpagination pull-right ">1/1</span>
	</div>
</div>
<!-- data-backdrop="false" -->
<div class="modal fade" id="mimodal" tabindex="-1"  role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">l'image à été ajoutée au dossier<br>"favorits # 1"</h5>
		<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
    </div>
  </div>
</div>
<?php wp_footer(); ?>

</body>

</html>

