<?php

/**
 * Construction of the content by rows and divs.
 *
 * @link       josevillalobos.com
 * @since      1.0.0
 *
 * @package    Ptk_exchange
 * @subpackage Ptk_exchange/public
 */

/**
 * 
 *
 * 
 * 
 *
 * @package    Ptk_exchange
 * @subpackage Ptk_exchange/public
 * @author     Jose VILLALOBOS <contact@josevillalobos.com>
 */
class Ptk_exchange_Bloc {

	public $ref = "";
	public $width = "";
	public $class = "";
	public $titre = "";
	public $subhead = "";
	public $intro = "";
	public $poster = "";
	public $error = "";
	public $link = "";
	public $classimbox = "auto";
	public $noposter = FALSE;
	public $level = 1;
	public $thumb = "";
	public $classimg = "";
	
	
	
	
	
	
	//should be on level + 1 ?	
	private $classes = Array(
	
		"auto" => "auto",
		"1_2" => "col-md-6",
		"1_3" => "col-md-4",
		"2_3" => "col-md-8",
		"1_4" => "col-md-3",
		"2_4" => "col-md-6",
		"3_4" => "col-md-9",
		"7_12" => "col-md-7",
		"5_12" => "col-md-5"
	
	);







	public function __construct() {
	
		//OLD $this->class = $class ? $class : $this->findClassByWidth($width);


	}
	
	public function put_title($before,$after){
	
		echo $this->titre ? $before.__($this->titre).$after : "";
	
	
	}
	
	public function put_subhead($before,$after){
	
		echo $this->subhead ? $before.__($this->subhead).$after : "";
	
	
	}
	public function put_intro($before,$after,$length,$more){
	
		echo $this->intro ? $before.$this->texte_resume_brut(__($this->intro), $length,$more).$after : "";
		
	
	}







	
	private function findClassByWidth($width){
	
		if ( isset($this->classes[$width]) ) {
		
			 return $this->classes[$width] ;

		 }else{
		 
		  	return "";

		 }
	
	
	}



	
	static function checkautowidth($blocs){
	
		if( $c = count($blocs) ){
			
									
			$setAutoWidth = FALSE;
		
			// are there auto width
			foreach($blocs as $bloc){
			
				// at least one auto width 
				if ($bloc->width == "auto"){
				
					$setAutoWidth = TRUE;
					break;
				
				}
			
			}
			
			if($setAutoWidth){
			
				foreach($blocs as $i => $bloc){
				
					$bloc->setAutoWidthOneOf($i+1,$c);
				}
			
			}
		
		}

	}
	
	static function classes4disposition($all,$format) {
		
		switch ($all){
		
			case 1 : return ["col-sm-12"];
			case 2 : {
			
				switch ($format){
				
					case "f_1t2t-24x36": return ["col-sm-4","col-sm-8"];
					case "f_2t1t-24x36": return ["col-sm-8","col-sm-4"];
					case "f_1t2t-4x3": return ["col-sm-4","col-sm-8"];
					case "f_2t1t-4x3": return ["col-sm-8","col-sm-4"];
					case "f_1t2t-6x6": return ["col-sm-5","col-sm-7"];
					case "f_2t1t-6x6": return ["col-sm-7","col-sm-5"];
					default : return ["col-sm-6","col-sm-6"];
				
				
				}
			
			
			} 
			case 3 : return ["col-sm-4","col-sm-4","col-sm-4"]; 
			case 4 : return ["col-sm-3","col-sm-3","col-sm-3","col-sm-3"];
			default : return Array();
		}
	}
	
	private function class4oneOf($mypos,$all) {
		switch ($all){
		
			case 1 : 
				$ptkapi = new Ptk_exchange_API();
				$this->poster = $ptkapi->get_ptk_photo($this->thumb,1280);
				//var_dump($this->thumb."-".$this->poster);
				return "col-md-12";
			case 2 : return "col-md-6";
			case 3 : return "col-md-4 ";
			//case 4 : return "col-md-4 col-lg-3 ";
			case 4 : return "col-md-3";
			case 5 : if($mypos <= 3) { return "col-md-2" ; }else{ return "col-md-3" ; }
			case 6 : return "col-md-2";
			case 7 : if($mypos <= 5) { return "col-md-2" ; }else{ return "col-md-1" ; }
			case 8 : if($mypos <= 4) { return "col-md-2" ; }else{ return "col-md-1" ; }
			case 9 : if($mypos <= 3) { return "col-md-2" ; }else{ return "col-md-1" ; }
			case 10 : if($mypos <= 2) { return "col-md-2" ; }else{ return "col-md-1" ; }
			case 11 : if($mypos <= 1) { return "col-md-2" ; }else{ return "col-md-1" ; }
			case 12 : return "col-md-1";
			default : return "col-md-1";
		}
	}

	public function setAutoWidthOneOf($mypos,$all){
	
		$this->class = $this->class4oneOf($mypos,$all);

	}


	public function display(){
	
		require ($this->level == 1) ?
		plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/ptk_exchange-public-display-bloc.php':
		plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/ptk_exchange-public-display-bloc-level2.php';
	
	
	}
	public function displayPC(){
	
		require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/ptk_exchange-public-display-blocPC.php';
	
	
	}
	
	private function texte_resume_brut($texte, $nbreCar , $PointSuspension)
	{
		$texte 				= trim(strip_tags($texte)); // suppression des balises HTML
		if(is_numeric($nbreCar))
		{
			//$PointSuspension	= '...'; // points de suspension (ou '' si vous n'en voulez pas)
			// ---------------------
			// COUPE DU TEXTE pour le RÉSUMÉ
			// ajout d'un espace de fin au cas où le texte n'en contiendrait pas...
			$texte			.= ' ';
			$LongueurAvant		= strlen($texte);
			if ($LongueurAvant > $nbreCar) {
				// pour ne pas couper un mot, on va à l'espace suivant
				$texte = substr($texte, 0, strpos($texte, ' ', $nbreCar));
				// On ajoute (ou pas) des points de suspension à la fin si le texte brut est plus long que $nbreCar
				if ($PointSuspension!='') {
					$texte	.= $PointSuspension;
				}
			}
			// ---------------------
		}
		// On renvoie le résumé du texte correctement formaté.
		return $texte;
	}

}
