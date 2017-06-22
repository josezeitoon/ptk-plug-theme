<?php
/**
 * AFFICHAGE DES BLOCS POUR PAGE FOLDER
 *
 * @package understrap
 */


//$nameref = str_replace("-","_",$post->post_name);
$nameref = $post->post_name;

$blocs = get_field("blocs");

//var_dump($blocs);

$line_s = Array();
$nbline = 0;
$line_s[0] = Array();

if($blocs){

	foreach($blocs as $bloc){
	
		//var_dump($bloc);
	
		if( $bloc['bloc_type']=='newline' ) {
		
			if ( count($line_s) ) $nbline++;
			$line_s[$nbline] = Array();
		
		}else{
		
			$dat = Array();
	
			$dat["bloc_ref"] = $bloc["bloc_ref"];
			$dat["bloc_width"] = $bloc["bloc_width"];
			
			
			if( $infos = get_serie_info($bloc["bloc_ref"])){
				$dat["titre"] = $infos["titre"];
				$dat["image"] = get_ptk_photo($infos["thumb"],400);
				$dat["error"] = FALSE;
			}else{
				$dat["error"] = TRUE;
			}
			$line_s[$nbline][] = $dat;
		}
	
	
	
	}


}

//var_dump($line_s);
//var_dump(get_serie_info('98769'));


?>

<div id="content<?php echo $nameref; ?>" >

	<?php // the_content();  ?>
	
	<?php if($line_s){  ?>
	
		<?php foreach($line_s as $blocs){  ?>
		
			<div class="container">
			
				<?php foreach($blocs as $bloc){  ?>
				
					<div>
						<img src="<?php echo $bloc['image'] ?>">
					<h2><?php echo $bloc['titre'] ?></h2>
					</div>
				
				
				<?php }  ?>
			
			</div>
	
	
		<?php }  ?>
	
	<?php }  ?>

</div>

