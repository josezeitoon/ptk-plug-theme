<?php

/**
 * Construction of the content for a for a page of Folder type.
 *
 * @link       josevillalobos.com
 * @since      1.0.0
 *
 * @package    Ptk_exchange
 * @subpackage Ptk_exchange/public
 *
 * @author     Jose VILLALOBOS <contact@josevillalobos.com>
 */
class Ptk_exchange_Seriemosaic {

	public $title = "";
	public $story = "";
	public $author = "";
	public $thumb = "";
	public $ref = 0;
	public $default_h_line = "unquart";
	public $default_blocs_per_line = 4;
	public $default_format = "f_6x6";
	public $default_crop = TRUE;
	public $serie ;

	public function __construct( $ref ) {
	
		$this->ref = $ref;
		
		//create a serie object
		$ptkapi = new Ptk_exchange_API();
		
		$this->serie = $ptkapi->get_serie($this->ref,'fr');
		
		//var_dump($this->serie);
		$this->title = $this->serie->title;
		$this->author = $this->serie->author;
		$this->story = $this->serie->story;
		
		
//var_dump($this->title);
	}


	//put_title($before,$after);

	public function put_title($before,$after){
	
		echo ($this->title) ? $before.__($this->title).$after : "";
	
	
	}

	public function put_story($before,$after){
	
		echo ($this->story) ? $before.__($this->story).$after : "";
	
	
	}

	public function put_author($before,$after){
	
		echo ($this->author) ? $before.__($this->author).$after : "";
	
	
	}

	public function put_thumb(){
	
		//pour le moment la premiere
		
		echo ($this->thumb) ? '<img src="'.$this->thumb.'">' : '';
	
	
	}

	public function get_linesbloc_by_children(){
	
	
					$line_s = Array();
					
					
					//the line number 0 based
					$nbline = -1;
					$line_s[0] = Array();
					
					//$this->customline_s;


					// index of block displayed
					$ib = 0;
					
					//blocks per line by default
					$count_down = $this->default_blocs_per_line ? $this->default_blocs_per_line : 4;
					
					$h_line =  $this->default_h_line;
					
					// the position on line 0 based
					$bloc_pos_on_line = 0;
					
					$width_s = Array();

					if(is_array($this->serie->photoList)){
//$serieOrFolder
						foreach($this->serie->photoList as $photo){
							
							//var_dump($nbline);
							
							// FIRST BLOC AND FOR NEW LINE
							if( !--$count_down || $ib==0) {

								$nbline++;
								




								$line_s[$nbline] = Array();
								
								// number of blocks per line
								$count_down = $this->default_blocs_per_line ? $this->default_blocs_per_line : 3;
								
								
								
							}
							
							
		
		

							
							
/* object exemple of array $photoList



      0 => 
        object(stdClass)[4043]
          public 'id' => string '613983' (length=6)
          public 'photoReference' => string 'COP0613983' (length=10)
          public 'randomId' => string '1076cf11f4dd9d2067f23d0dae24339f' (length=32)
          public 'thumbnail' => string 'http://staging.picturetank.com/v2/?module=remoteServices&action=getPhoto&filename=1076cf11f4dd9d2067f23d0dae24339f&size=320&lang=fr&set=o' (length=137)
          public 'date' => string '2013-04-18' (length=10)
          public 'caption' => string 'Plateau de l'Arbois.
' (length=21)
          public 'location' => string 'France' (length=6)
          public 'instructions' => string 'TOUTES UTILISATIONS. Infos : +33(0)143 15 63 53.
' (length=49)
          public 'credit' => string 'Philippe Conti / Picturetank' (length=28)


*/
							// create block
							$displayblock =  new Ptk_exchange_Bloc();
						
							
							$displayblock->ref = $photo->id;
							
							$displayblock->titre = $photo->photoReference." - © ".$photo->credit;
							$displayblock->subhead = $photo->location."-".$photo->date;
							$displayblock->intro = $photo->caption;
							
							$ptkapi = new Ptk_exchange_API();
							$displayblock->poster = $ptkapi->get_ptk_photo($photo->randomId,480);
							$displayblock->posterid = $photo->randomId;
							
							$displayblock->photoReference = $photo->photoReference;
							$displayblock->credit = $photo->credit;
							
							
							//must be changed,  !
							 if($ib==0) $this->thumb = $displayblock->poster;
							
							
							//class en dur 4 lg 3 md pour planche contact
							$displayblock->class = "col-xs-6 col-sm-6 col-md-4 col-lg-3";
							
							
							$displayblock->classimbox =  $this->default_format._.$this->default_blocs_per_line." fit";
							


//	public $default_blocs_per_line = 4;
//	public $default_format = "f_6x6";
//	public $default_crop = TRUE;



							
							$displayblock->error =  $displayblock->poster ? "" : "image not found";
							
							$displayblock->classimbox .=  $displayblock->poster ? "" : " noimage";
							
							
							$displayblock->link = "/photo/".$photo->randomId;
							
							
							
							$line_s[$nbline][] = $displayblock ;
		
							
		
							$ib++;
	
	
	
						}


					}
					
					return $line_s;
	
	}
	

	


}
