<?php

class Ptk_exchange_API_serie {

	public $title = "";
  	public $id = "";
   	public $serieRandomId = "";
	public $story = "";  
  	public $author = "";
  	public $thumb = "";
  	public $photoList = Array();	
  	public $type = "serie";	

	public function __construct() {


	}

	public function setdefaultThumb (){
	
		if( isset( $this->photoList[0] ) ){
		
			return $this->thumb =  $this->photoList[0]->randomId;
		
		}
	
		return FALSE;
	
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





}
