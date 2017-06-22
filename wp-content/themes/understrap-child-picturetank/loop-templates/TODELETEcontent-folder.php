<?php
/**
 * AFFICHAGE DES BLOCS POUR PAGE FOLDER
 *
 * @package understrap
 */


//$nameref = str_replace("-","_",$post->post_name);
$nameref = $post->post_name;

$ptk_folder_id = get_field("ptk_folder_id");

$blocs = get_blocs_from_ptk_folder($ptk_folder_id);

function get_blocs_from_ptk_folder($id){

	$infos = Array();

	//$request = 'http://npa.staging.picturetank.com/api/folders/'.$id;

	$request = 'http://staging.picturetank.com/v2/?module=site&action=getFolderSeriesFiltered&lang=fr&folderId='.$id;
	
	
	
	$retoursearch_json = file_get_contents($request);
	//var_dump($retoursearch_json);
	
	if(strpos( $retoursearch_json, "error" ) === 0 ) return FALSE;

	$retoursearch_obj = json_decode ($retoursearch_json);

	
	//var_dump($infos);
	//var_dump($retoursearch_obj);
	
	return $retoursearch_obj;


}

//var_dump($blocs);

$line_s = Array();
$nbline = 0;
$line_s[0] = Array();

$blocsparligne=3;


$ib = 0;




if($blocs){

	foreach($blocs as $bloc){
	
		
		$ib++;
		
		//var_dump($ib % $blocsparligne);
	
		
		$dat = Array();

		$dat["bloc_ref"] = $bloc->serieId;
		$dat["bloc_width"] = "auto";
			$dat["titre"] = $bloc->serieName;
			$dat["image"] = get_ptk_photo($bloc->photoPilotRandomId,400);
			$dat["error"] = FALSE;
		

		$line_s[$nbline][] = $dat;
		
		if( $ib>1 && $ib % $blocsparligne ==0) {
		
			$nbline++;
			
			//echo "toto<br>";
			
			$line_s[$nbline] = Array();
		
		}
	
	
	
	}


}
/*
array (size=8)
  0 => 
    object(stdClass)[3597]
      public 'serieId' => string '50373' (length=5)
      public 'serieRandomId' => string '21180983a5b382166e2f477584513620' (length=32)
      public 'serieName' => string 'BOM looking for a job (50373)' (length=29)
      public 'photoPilotId' => string '610458' (length=6)
      public 'photoPilotRandomId' => string '397e4e0016495a64baeadbc407f9e8b5' (length=32)
      public 'serieInfoId' => string '86491' (length=5)
      public 'serieInfoLanguage' => string 'fr' (length=2)
      public 'serieInfoTitle' => string 'Recherche d'emploi' (length=18)
      public 'serieInfoHeader' => string '' (length=0)
      public 'serieInfoSubHeader' => string 'Michele Borzoni /TerraProject ' (length=30)
      public 'serieInfoCredit' => string '' (length=0)
      public 'serieInfoIntroduction' => string '' (length=0)
      public 'serieInfoStory' => string 'Des candidats aux concours externes de l’administration publique à perte de vue… L’Institut national de statistique italien compte 3 236 000 chômeurs, soit 12,5% de la population, avec un taux de chômage qui monte jusqu’à 42,5% chez les jeunes de 15-24 ans. Même si, selon de nombreux économistes et chroniqueurs, l’Italie sort aujourd’hui de la crise économique qui frappe le pays depuis 2011, beaucoup continuent à rêver d’un poste fixe dans l’administration publique, les concours ext'... (length=804)
      public 'orderRow' => string '20' (length=2)
      public 'contactSheetUrl' => string 'http://staging.picturetank.com/v2/?module=site&action=displayContactSheet&randomId=21180983a5b382166e2f477584513620&lang=office&infoSet=o&orderSet=o&publicLanguagesOnly=1' (length=170)
      public 'photoPilotThumbUrl' => string 'http://staging.picturetank.com/v2/?module=remoteServices&action=getPhoto&filename=397e4e0016495a64baeadbc407f9e8b5&size=120&lang=fr&set=o' (length=137)
      public 'slideshowUrl' => string 'http://staging.picturetank.com/v2/?module=site&action=slideshow&lang=fr&infoSet=o&serieId=21180983a5b382166e2f477584513620' (length=122)
*/

//var_dump($line_s);
//var_dump(get_serie_info('98769'));


?>

<div id="content<?php echo $nameref; ?>" class="container" >

	<?php // the_content();  ?>
	
	<?php if($line_s){  ?>
	
		<?php foreach($line_s as $blocs){  ?>
		
			<div class="row">
			
				<?php foreach($blocs as $bloc){  ?>
				
					<div class="col-md-3">
						<img src="<?php echo $bloc['image'] ?>">
					<h2><?php echo $bloc['titre'] ?></h2>
					</div>
				
				
				<?php }  ?>
			
			</div>
	
	
		<?php }  ?>
	
	<?php }  ?>

</div>

