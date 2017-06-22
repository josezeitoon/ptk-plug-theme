<?php

class Ptk_exchange_API {

	public function __construct() {


	}



	public function get_ptk_photo($ref,$size){
	
		if(!$ref) return FALSE;
		
		$url = 'http://staging.picturetank.com/v2/?module=remoteServices&action=getPhoto&filename='.$ref.'&size='.$size.'&lang=fr&set=o';

		//var_dump( $this->check_image_url($url));
		// ALERT this check is long... //ok if page cached
		return ( $this->check_image_url($url) ) ? $url : FALSE;
		//return $url ;
	}

	public function get_serie($ref,$lang){

		$request = 'http://staging.picturetank.com/v2/?module=site&action=displayContactSheet&orderSet=o&infoSet=o&randomId='.$ref.'&lang='.$lang.'&json=1';

		$retour_json = file_get_contents($request);
//		var_dump($retour_json);

		if(strpos( $retour_json, "error" ) === 0 ) return FALSE;

		$retour_obj = json_decode ($retour_json);
		
		//var_dump($retour_obj);

		$serie = new Ptk_exchange_API_serie();
		$serie->id = $retour_obj->serieId ;
		$serie->title = $retour_obj->title ;
		$serie->photoList = $retour_obj->photoList ;
		$serie->setdefaultThumb() ;
		$serie->author = $retour_obj->author ;
		$serie->story = $retour_obj->story ;
		//$serie->serieRandomId = $retour_obj->serieRandomId ;

		

		return $serie;
	}

	public function get_folder($ref){

		if(!$ref) return FALSE;
		
		$request = 'http://npa.staging.picturetank.com/api/folders/'.$ref;
		
		//var_dump($this->check_url($request));
		
		if (!$this->check_url($request) ) return FALSE;
		
		$retour_json = file_get_contents($request);
		
		if(strpos( $retour_json, "error" ) === 0 ) return FALSE;

		$retour_obj = json_decode ($retour_json);
		
		
		//
		//var_dump($retour_obj);

		$folder = new Ptk_exchange_API_folder();
		$folder->id = $retour_obj->id;
		$folder->title = "[:fr]".$retour_obj->name_fr."[:en]".$retour_obj->name_en ;
		$folder->description = "[:fr]".$retour_obj->description_fr."[:en]".$retour_obj->description_en ;
		$folder->thumb = $retour_obj->photoPilot;
		$folder->nbSeries = $retour_obj->nbSeries;
		$folder->children = $retour_obj->children;

		return $folder;
	}

	public function get_blocs_from_ptk_folder($id){

		$infos = Array();

		$request = 'http://npa.staging.picturetank.com/api/folders/'.$id;
	
	
	
		$retoursearch_json = file_get_contents($request);
		//var_dump($retoursearch_json);
	
		if(strpos( $retoursearch_json, "error" ) === 0 ) return FALSE;

		$retoursearch_obj = json_decode ($retoursearch_json);

	
		//var_dump($infos);
		//var_dump($retoursearch_obj);
	
		return $retoursearch_obj;


	}


	public function get_series_from_ptk_folderseries($id,$langue){

		$infos = Array();

		//$request = 'http://npa.staging.picturetank.com/api/folders/'.$id;

		$request = 'http://staging.picturetank.com/v2/?module=site&action=getFolderSeriesFiltered&lang='.$langue.'&folderId='.$id;
	
	
	
		$retoursearch_json = file_get_contents($request);
		//var_dump($retoursearch_json);
	
		if(strpos( $retoursearch_json, "error" ) === 0 ) return FALSE;

		
		/*///////////
		//An ARRAY 
array (size=8)
  0 => 
    object(stdClass)[4074]
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
		
		//////////*/
		
		$retoursearch_obj = json_decode ($retoursearch_json);
		//var_dump($retoursearch_obj);
		
		
		$series = Array ();
		foreach($retoursearch_obj as $ob){
		
			$serie = new Ptk_exchange_API_serie();
			
			$serie->id = $ob->serieId ;
			$serie->title = $ob->serieInfoTitle ;
			$serie->author = $ob->serieInfoSubHeader ;
			$serie->story = $ob->serieInfoStory ;
			$serie->thumb = $ob->photoPilotRandomId ;
			$serie->serieRandomId = $ob->serieRandomId ;

			$series[] = $serie;
		
		
		}

/*	*/
		//var_dump($infos);
		//var_dump($retoursearch_obj);




	
		return $series;


	}

	public function get_info_from_ptk_folder($id){



		$request = 'http://npa.staging.picturetank.com/api/folders/'.$id;
	
	
	
		$retoursearch_json = file_get_contents($request);
		//var_dump($retoursearch_json);
	
		if(strpos( $retoursearch_json, "error" ) === 0 ) return FALSE;

		$retoursearch_obj = json_decode ($retoursearch_json);

	
		//var_dump($infos);
		//var_dump($retoursearch_obj);
	
		return $retoursearch_obj;


	}
	
	public function check_image_url($url) {
   		$headers = @get_headers( $url);
		$headers = (is_array($headers)) ? implode( "\n ", $headers) : $headers;
		//var_dump($headers);
		//return (bool)preg_match('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers);
		return (strpos($headers, 'image/jpeg')!==FALSE) ? TRUE : FALSE;
	}

	public function check_url($url) {
   		$headers = @get_headers( $url);
		$headers = (is_array($headers)) ? implode( "\n ", $headers) : $headers;
		//var_dump($headers);
		return (bool)preg_match('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers);
	}




}
