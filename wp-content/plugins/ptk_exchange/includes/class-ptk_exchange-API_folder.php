<?php

class Ptk_exchange_API_folder {

		public $id = "";
		public $title = "" ;
		public $description = "" ;
		public $thumb = "";
		public $nbSeries = "";
		public $children = Array();
  		public $type = "folder";	
  		
	public function __construct() {


	}


	public function get_my_folders(){
	
		$folders = Array();
		if(is_array($this->children)){
		
		
			foreach($this->children as $item){
			
				$folder = new Ptk_exchange_API_folder();
				
				$folder->id = $item->id ;
				$folder->title = "[:fr]".$item->name_fr."[:en]".$item->name_en ;
				$folder->author = $item->{'cUser:id'} ;
				$folder->story = "[:fr]".$item->description_fr."[:en]".$item->description_en ; 
				$folder->thumb = $item->{'photoPilot:id'} ;
				
				$folders[] = $folder ;
		
			}
		}
		
	//var_dump($folders);
		return $folders;
		
		
	
	
	
	}


}
